<?php
// public/api.php
// API endpoint mahasiswa (JSON only)

session_start();

// Tampilkan error saat development
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Semua response berbentuk JSON
header('Content-Type: application/json; charset=utf-8');

// CORS headers untuk akses dari domain lain
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Credentials: true');

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Load controller
require_once __DIR__ . '/../src/controllers/ApiMahasiswaController.php';
use src\controller\ApiMahasiswaController;

/**
 * Helper kirim response JSON
 */
function respond(int $status, array $body): void {
    http_response_code($status);
    echo json_encode($body);
    exit;
}

// HTTP method yang dipakai client
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// Ambil parameter dari query string
$resource = isset($_GET['resource']) ? trim($_GET['resource']) : null;
$nim = isset($_GET['nim']) ? trim($_GET['nim']) : null;

// Default resource
if ($resource === null || $resource === '') {
    $resource = 'mahasiswa';
}

// Saat ini hanya support resource mahasiswa
if ($resource !== 'mahasiswa') {
    respond(404, [
        'success' => false,
        'message' => 'Resource tidak dikenal. Saat ini hanya mendukung resource=mahasiswa.'
    ]);
}

// Buat controller
$controller = new ApiMahasiswaController();

/**
 * Helper untuk ambil input body (WAJIB JSON)
 * Tidak lagi menerima data dari form ($_POST)
 */
function getRequestBody(): array {
    // Cek Content-Type wajib application/json
    $contentType = $_SERVER['CONTENT_TYPE'] ?? ($_SERVER['HTTP_CONTENT_TYPE'] ?? '');

    if (stripos($contentType, 'application/json') === false) {
        respond(415, [
            'success' => false,
            'message' => 'Content-Type harus application/json. Data dari form tidak diterima.',
        ]);
    }

    // Baca body mentah
    $raw = file_get_contents('php://input');

    if (empty($raw)) {
        respond(400, [
            'success' => false,
            'message' => 'Body request kosong. Harus mengirim JSON.',
        ]);
    }

    // Decode JSON ke array asosiatif
    $json = json_decode($raw, true);

    if (json_last_error() !== JSON_ERROR_NONE || !is_array($json)) {
        respond(400, [
            'success' => false,
            'message' => 'Format JSON tidak valid.',
        ]);
    }

    return $json;
}

// Routing berdasarkan HTTP method
switch ($method) {
    case 'GET':
        if (!empty($nim)) {
            $result = $controller->show($nim);
            respond($result['status'], $result['body']);
        } else {
            $result = $controller->index();
            respond($result['status'], $result['body']);
        }
        break;

    case 'POST':
        // Wajib login untuk mutasi data
        if (empty($_SESSION['user'])) {
            respond(401, [
                'success' => false,
                'message' => 'Unauthorized. Silakan login terlebih dahulu.',
            ]);
        }
        $input = getRequestBody();
        $result = $controller->store($input);
        respond($result['status'], $result['body']);
        break;

    case 'PUT':
    case 'PATCH':
        // Wajib login untuk mutasi data
        if (empty($_SESSION['user'])) {
            respond(401, [
                'success' => false,
                'message' => 'Unauthorized. Silakan login terlebih dahulu.',
            ]);
        }
        if (empty($nim)) {
            respond(400, [
                'success' => false,
                'message' => 'Parameter nim wajib diisi untuk update.',
            ]);
        }
        $input = getRequestBody();
        $result = $controller->update($nim, $input);
        respond($result['status'], $result['body']);
        break;

    case 'DELETE':
        // Wajib login untuk mutasi data
        if (empty($_SESSION['user'])) {
            respond(401, [
                'success' => false,
                'message' => 'Unauthorized. Silakan login terlebih dahulu.',
            ]);
        }
        if (empty($nim)) {
            respond(400, [
                'success' => false,
                'message' => 'Parameter nim wajib diisi untuk delete.',
            ]);
        }
        $result = $controller->destroy($nim);
        respond($result['status'], $result['body']);
        break;

    default:
        respond(405, [
            'success' => false,
            'message' => 'Metode tidak diizinkan. Gunakan GET, POST, PUT/PATCH, atau DELETE.',
        ]);
}