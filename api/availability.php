<?php

/**
 * API Endpoint: Room Availability Checker
 * Checks booked dates for a specific room in a given month and year
 */

// Only allow JSON responses
header('Content-Type: application/json');

// Get parameters
$roomId = isset($_GET['room_id']) ? (int)$_GET['room_id'] : 0;
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

// Validate parameters
if ($roomId <= 0 || $month < 1 || $month > 12 || $year < 2000 || $year > 2100) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid parameters',
        'bookedDates' => []
    ]);
    exit;
}

// Include database configuration
require_once __DIR__ . '/../config/app.php';

try {
    // Connect to database
    $dbConfig = require __DIR__ . '/../config/database.php';
    $pdo = new PDO(
        "mysql:host={$dbConfig['host']};dbname={$dbConfig['database']}",
        $dbConfig['username'],
        $dbConfig['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Get the first and last day of the month
    $firstDay = date('Y-m-d', strtotime("$year-$month-01"));
    $lastDay = date('Y-m-t', strtotime("$year-$month-01"));

    // Query for booked dates
    $sql = "
        SELECT DISTINCT DATE(check_in) as booking_date
        FROM bookings
        WHERE room_id = :room_id
        AND status IN ('confirmed', 'pending')
        AND DATE(check_in) >= :start_date
        AND DATE(check_in) <= :end_date
        UNION
        SELECT DISTINCT DATE(check_out) as booking_date
        FROM bookings
        WHERE room_id = :room_id
        AND status IN ('confirmed', 'pending')
        AND DATE(check_out) >= :start_date
        AND DATE(check_out) <= :end_date
        ORDER BY booking_date
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':room_id' => $roomId,
        ':start_date' => $firstDay,
        ':end_date' => $lastDay
    ]);

    $bookedDates = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $bookedDates[] = $row['booking_date'];
    }

    // Return success response
    http_response_code(200);
    echo json_encode([
        'success' => true,
        'roomId' => $roomId,
        'month' => $month,
        'year' => $year,
        'bookedDates' => $bookedDates,
        'availableDates' => countAvailableDates($firstDay, $lastDay, $bookedDates)
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage(),
        'bookedDates' => []
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage(),
        'bookedDates' => []
    ]);
}

/**
 * Count available dates in the month
 */
function countAvailableDates($start, $end, $bookedDates) {
    $current = strtotime($start);
    $endTime = strtotime($end);
    $count = 0;

    while ($current <= $endTime) {
        $dateStr = date('Y-m-d', $current);
        if (!in_array($dateStr, $bookedDates) && strtotime($dateStr) >= strtotime('today')) {
            $count++;
        }
        $current = strtotime('+1 day', $current);
    }

    return $count;
}
?>
