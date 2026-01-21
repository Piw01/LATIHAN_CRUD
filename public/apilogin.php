<?php
// public/apilogin.php
// API auth untuk login/logout

session_start();

// Tampilkan error saat development
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Semua response berbentuk JSON
header('Content-Type: application/json; charset=utf-8');

// CORS headers untuk akses dari domain lain
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header('Access-Control-Allow-Credentials: true');

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Load controller auth
require_once __DIR__ . '/../src/controllers/ApiAuthController.php';
use src\controllers\ApiAuthController;

/**
 * Helper kirim response JSON
 */
function respond(int $status, array $body): void {
    http_response_code($status);
    echo json_encode($body);
    exit;
}

/**
 * Helper untuk ambil input body (WAJIB JSON)
 */
function getRequestBody(): array {
    $contentType = $_SERVER['CONTENT_TYPE'] ?? ($_SERVER['HTTP_CONTENT_TYPE'] ?? '');

    if (stripos($contentType, 'application/json') === false) {
        respond(415, [
            'success' => false,
            'message' => 'Content-Type harus application/json. Data dari form tidak diterima.',
        ]);
    }

    $raw = file_get_contents('php://input');

    if (empty($raw)) {
        respond(400, [
            'success' => false,
            'message' => 'Body request kosong. Harus mengirim JSON.',
        ]);
    }

    $json = json_decode($raw, true);

    if (json_last_error() !== JSON_ERROR_NONE || !is_array($json)) {
        respond(400, [
            'success' => false,
            'message' => 'Format JSON tidak valid.',
        ]);
    }

    return $json;
}

// Default: login via POST, action=login|logout|me
$method = $_SERVER['REQUEST_METHOD'] ?? 'POST';
$action = isset($_GET['action']) ? trim((string) $_GET['action']) : 'login';

// Cek session login aktif (GET ?action=me)
if ($method === 'GET' && $action === 'me') {
    if (!empty($_SESSION['user'])) {
        respond(200, [
            'success' => true,
            'message' => 'Session aktif.',
            'data' => [
                'username' => $_SESSION['user'],
            ],
        ]);
    }

    respond(401, [
        'success' => false,
        'message' => 'Session tidak ditemukan. Silakan login.',
    ]);
}

if ($method !== 'POST') {
    respond(405, [
        'success' => false,
        'message' => 'Metode tidak diizinkan. Gunakan POST.',
    ]);
}

// Logout: hapus session (POST ?action=logout)
if ($action === 'logout') {
    session_unset();
    session_destroy();
    respond(200, [
        'success' => true,
        'message' => 'Logout berhasil.',
    ]);
}

// Login (POST default atau ?action=login)
$controller = new ApiAuthController();
$input = getRequestBody();
$result = $controller->login($input);

// Simpan user ke session jika login sukses
if ($result['status'] === 200 && !empty($result['body']['data']['username'])) {
    $_SESSION['user'] = $result['body']['data']['username'];
}

respond($result['status'], $result['body']);