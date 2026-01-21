<?php
// src/models/MahasiswaModel.php

require_once __DIR__ . '/../config/Connection.php';

class MahasiswaModel {
    private $conn;
    private $table = "mahasiswa";

    public function __construct() {
        $database = new Connection();
        $this->conn = $database->getConnection();
    }

    // Mengambil semua data mahasiswa
    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY nim ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil data mahasiswa berdasarkan NIM
    public function getByNim($nim) {
        $query = "SELECT * FROM " . $this->table . " WHERE nim = :nim";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nim', $nim);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Menambah data mahasiswa
    public function insertData($nim, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $telepon, $alamat) {
        // Cek apakah NIM sudah ada
        if ($this->getByNim($nim)) {
            return false; // NIM sudah ada
        }

        $query = "INSERT INTO " . $this->table . " (nim, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, telepon, alamat) 
                  VALUES (:nim, :nama, :tempat_lahir, :tanggal_lahir, :jenis_kelamin, :telepon, :alamat)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nim', $nim);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':tempat_lahir', $tempat_lahir);
        $stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
        $stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
        $stmt->bindParam(':telepon', $telepon);
        $stmt->bindParam(':alamat', $alamat);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Update data mahasiswa
    public function updateData($nim, $nama, $tempat_lahir, $tanggal_lahir, $jenis_kelamin, $telepon, $alamat) {
        $query = "UPDATE " . $this->table . " 
                  SET nama = :nama, 
                      tempat_lahir = :tempat_lahir, 
                      tanggal_lahir = :tanggal_lahir, 
                      jenis_kelamin = :jenis_kelamin, 
                      telepon = :telepon, 
                      alamat = :alamat 
                  WHERE nim = :nim";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nim', $nim);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':tempat_lahir', $tempat_lahir);
        $stmt->bindParam(':tanggal_lahir', $tanggal_lahir);
        $stmt->bindParam(':jenis_kelamin', $jenis_kelamin);
        $stmt->bindParam(':telepon', $telepon);
        $stmt->bindParam(':alamat', $alamat);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Hapus data mahasiswa
    public function deleteData($nim) {
        $query = "DELETE FROM " . $this->table . " WHERE nim = :nim";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nim', $nim);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}