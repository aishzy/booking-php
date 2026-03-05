<?php

namespace App\Controllers;

use App\Database\Database;

class UserController extends BaseController {
    protected Database $db;

    public function __construct($request, $response) {
        parent::__construct($request, $response);
        $this->db = Database::getInstance();
    }

    public function registerForm() {
        $csrf = new \App\Security\CsrfToken();
        return $this->view('auth/register', [
            'title' => 'Register',
            'csrf_token' => $csrf->getToken()
        ]);
    }

    public function register() {
        // Validate form input
        $validation = $this->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|confirmed:password',
        ]);

        if (!$validation['valid']) {
            return $this->error('Validation failed', $validation['errors'], 422);
        }

        // Check if email already exists
        $existingUser = $this->db->queryOne(
            'SELECT id FROM users WHERE email = ?',
            [$validation['data']['email']]
        );

        if ($existingUser) {
            return $this->error('Email already registered', null, 422);
        }

        // Hash password and create user
        $hashedPassword = password_hash($validation['data']['password'], PASSWORD_BCRYPT);

        $this->db->insert('users', [
            'name' => $validation['data']['name'],
            'email' => $validation['data']['email'],
            'password' => $hashedPassword,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return $this->success(
            ['redirect' => '/login'],
            'Registration successful! Please log in.'
        );
    }

    public function loginForm() {
        $csrf = new \App\Security\CsrfToken();
        return $this->view('auth/login', [
            'title' => 'Login',
            'csrf_token' => $csrf->getToken()
        ]);
    }

    public function login() {
        // Validate form input
        $validation = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!$validation['valid']) {
            return $this->error('Validation failed', $validation['errors'], 422);
        }

        // Find user by email
        $user = $this->db->queryOne(
            'SELECT id, name, email, password FROM users WHERE email = ?',
            [$validation['data']['email']]
        );

        if (!$user || !password_verify($validation['data']['password'], $user['password'])) {
            return $this->error('Invalid email or password', null, 401);
        }

        // Set session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];

        return $this->success(
            ['redirect' => '/'],
            'Login successful!'
        );
    }

    public function logout() {
        session_destroy();
        return $this->redirect('/');
    }
}