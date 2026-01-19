<?php
// src/model/AuthModel.php

require_once __DIR__ . '/../config/Connection.php';

class AuthModel {
    private $conn;
    private $table = "users";

    public function __construct() {
        $database = new Connection();
        $this->conn = $database->getConnection();
    }

    // Login user
    public function login($username, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }

    // Get user by ID
    public function getUserById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Register user baru
    public function register($username, $password, $nama_lengkap, $role = 'user') {
        // Cek username sudah ada atau belum
        $query = "SELECT id FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        if ($stmt->fetch()) {
            return false; // Username sudah ada
        }

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user baru
        $query = "INSERT INTO " . $this->table . " (username, password, nama_lengkap, role) 
                  VALUES (:username, :password, :nama_lengkap, :role)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':nama_lengkap', $nama_lengkap);
        $stmt->bindParam(':role', $role);

        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}