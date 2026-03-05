<?php

namespace App\Controllers;

use App\Database\Database;
use App\Models\User;
use Exception;

/**
 * BookingController - Example of a well-structured controller
 * 
 * This shows best practices for:
 * - Input validation
 * - Database operations
 * - Error handling
 * - Response formatting
 */
class BookingController extends BaseController {
    private Database $db;

    public function __construct($request, $response) {
        parent::__construct($request, $response);
        $this->db = Database::getInstance();
    }

    /**
     * GET /api/bookings
     * List all bookings (with pagination)
     */
    public function index() {
        // Check authentication
        if (!$this->isAuthenticated()) {
            return $this->unauthorized('Please log in');
        }

        try {
            $userId = $this->getAuthId();
            $page = (int)$this->request->getQuery('page', 1);
            $limit = 10;
            $offset = ($page - 1) * $limit;

            // Query user's bookings
            $bookings = $this->db->query(
                'SELECT b.*, r.name as room_name, r.price 
                 FROM bookings b 
                 JOIN rooms r ON b.room_id = r.id 
                 WHERE b.user_id = ? 
                 ORDER BY b.created_at DESC 
                 LIMIT ? OFFSET ?',
                [$userId, $limit, $offset]
            );

            return $this->success([
                'bookings' => $bookings,
                'page' => $page,
                'limit' => $limit
            ]);
        } catch (\Exception $e) {
            return $this->serverError('Failed to fetch bookings');
        }
    }

    /**
     * GET /api/bookings/{id}
     * Get single booking details
     */
    public function show($id) {
        if (!$this->isAuthenticated()) {
            return $this->unauthorized('Please log in');
        }

        try {
            $booking = $this->db->queryOne(
                'SELECT b.*, r.name as room_name, r.description, r.price, u.name as guest_name
                 FROM bookings b
                 JOIN rooms r ON b.room_id = r.id
                 JOIN users u ON b.user_id = u.id
                 WHERE b.id = ? AND b.user_id = ?',
                [$id, $this->getAuthId()]
            );

            if (!$booking) {
                return $this->notFound('Booking not found');
            }

            return $this->success(['booking' => $booking]);
        } catch (\Exception $e) {
            return $this->serverError('Failed to fetch booking');
        }
    }

    /**
     * POST /api/bookings
     * Create a new booking
     */
    public function create() {
        if (!$this->isAuthenticated()) {
            return $this->unauthorized('Please log in');
        }

        // Validate input
        $validation = $this->validate([
            'room_id' => 'required|numeric',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'notes' => 'max:500',
        ]);

        if (!$validation['valid']) {
            return $this->error('Validation failed', $validation['errors'], 422);
        }

        try {
            $data = $validation['data'];

            // Additional validation
            $checkIn = strtotime($data['check_in']);
            $checkOut = strtotime($data['check_out']);

            if ($checkOut <= $checkIn) {
                return $this->error('Check-out date must be after check-in date', null, 422);
            }

            if ($checkIn < strtotime('today')) {
                return $this->error('Cannot book dates in the past', null, 422);
            }

            // Check room exists and is available
            $room = $this->db->queryOne(
                'SELECT id, price FROM rooms WHERE id = ? AND status = "available"',
                [$data['room_id']]
            );

            if (!$room) {
                return $this->error('Room not available', null, 404);
            }

            // Calculate total price
            $nights = ($checkOut - $checkIn) / (60 * 60 * 24);
            $totalPrice = $nights * $room['price'];

            // Create booking
            $this->db->insert('bookings', [
                'user_id' => $this->getAuthId(),
                'room_id' => $data['room_id'],
                'check_in' => $data['check_in'],
                'check_out' => $data['check_out'],
                'total_price' => $totalPrice,
                'status' => 'pending',
                'notes' => $data['notes'] ?? null,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            $bookingId = $this->db->lastInsertId();

            return $this->success(
                ['id' => $bookingId, 'total_price' => $totalPrice],
                'Booking created successfully'
            );
        } catch (\Exception $e) {
            return $this->serverError('Failed to create booking');
        }
    }

    /**
     * PUT /api/bookings/{id}
     * Update booking
     */
    public function update($id) {
        if (!$this->isAuthenticated()) {
            return $this->unauthorized('Please log in');
        }

        // Check if booking belongs to user
        $booking = $this->db->queryOne(
            'SELECT id FROM bookings WHERE id = ? AND user_id = ?',
            [$id, $this->getAuthId()]
        );

        if (!$booking) {
            return $this->notFound('Booking not found');
        }

        $validation = $this->validate([
            'notes' => 'max:500',
        ]);

        if (!$validation['valid']) {
            return $this->error('Validation failed', $validation['errors'], 422);
        }

        try {
            $this->db->update('bookings', $validation['data'], ['id' => $id]);
            return $this->success(null, 'Booking updated');
        } catch (\Exception $e) {
            return $this->serverError('Failed to update booking');
        }
    }

    /**
     * DELETE /api/bookings/{id}
     * Cancel booking
     */
    public function delete($id) {
        if (!$this->isAuthenticated()) {
            return $this->unauthorized('Please log in');
        }

        // Check if booking belongs to user and can be cancelled
        $booking = $this->db->queryOne(
            'SELECT id, status FROM bookings WHERE id = ? AND user_id = ?',
            [$id, $this->getAuthId()]
        );

        if (!$booking) {
            return $this->notFound('Booking not found');
        }

        if (!in_array($booking['status'], ['pending', 'confirmed'])) {
            return $this->error('Cannot cancel ' . $booking['status'] . ' booking', null, 422);
        }

        try {
            $this->db->update('bookings', ['status' => 'cancelled'], ['id' => $id]);
            return $this->success(null, 'Booking cancelled');
        } catch (\Exception $e) {
            return $this->serverError('Failed to cancel booking');
        }
    }
}
