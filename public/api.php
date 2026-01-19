<?php
// public/api.php
// REST API Endpoint untuk Mahasiswa

require_once __DIR__ . '/../src/controllers/ApiController.php';

$apiController = new ApiController();

// Ambil HTTP method
$method = $_SERVER['REQUEST_METHOD'];

// Ambil URI
$uri = $_SERVER['REQUEST_URI'];
$uri = parse_url($uri, PHP_URL_PATH);
$uri = explode('/', trim($uri, '/'));

// Ambil parameter NIM jika ada
// Format: /api.php/mahasiswa atau /api.php/mahasiswa/123456
$resource = isset($uri[1]) ? $uri[1] : '';
$nim = isset($uri[2]) ? $uri[2] : null;

// Routing API berdasarkan HTTP Method
switch ($method) {
    case 'GET':
        if ($nim) {
            // GET /api.php/mahasiswa/{nim} - Get by NIM
            $apiController->getMahasiswaByNim($nim);
        } else {
            // GET /api.php/mahasiswa - Get all
            $apiController->getAllMahasiswa();
        }
        break;

    case 'POST':
        // POST /api.php/mahasiswa - Create new
        $apiController->createMahasiswa();
        break;

    case 'PUT':
        if ($nim) {
            // PUT /api.php/mahasiswa/{nim} - Update by NIM
            $apiController->updateMahasiswa($nim);
        } else {
            http_response_code(400);
            echo json_encode([
                'status' => 400,
                'message' => 'NIM diperlukan untuk update data'
            ]);
        }
        break;

    case 'DELETE':
        if ($nim) {
            // DELETE /api.php/mahasiswa/{nim} - Delete by NIM
            $apiController->deleteMahasiswa($nim);
        } else {
            http_response_code(400);
            echo json_encode([
                'status' => 400,
                'message' => 'NIM diperlukan untuk delete data'
            ]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode([
            'status' => 405,
            'message' => 'Method tidak diizinkan'
        ]);
        break;
}