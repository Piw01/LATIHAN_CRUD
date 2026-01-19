<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation - Sistem Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 30px 0;
        }

        .container {
            max-width: 1200px;
        }

        .api-header {
            background: white;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        .api-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .api-subtitle {
            color: #666;
            font-size: 1.1rem;
        }

        .api-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .method-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.875rem;
            margin-right: 10px;
        }

        .method-get {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .method-post {
            background: linear-gradient(135deg, #4caf50 0%, #45a049 100%);
            color: white;
        }

        .method-put {
            background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
            color: white;
        }

        .method-delete {
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
            color: white;
        }

        .endpoint {
            font-family: 'Fira Code', monospace;
            background: #f5f5f5;
            padding: 10px 15px;
            border-radius: 8px;
            font-size: 0.95rem;
            color: #667eea;
            display: inline-block;
        }

        .code-block {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 20px;
            border-radius: 10px;
            overflow-x: auto;
            font-family: 'Fira Code', monospace;
            font-size: 0.875rem;
            line-height: 1.6;
            margin: 15px 0;
        }

        .response-example {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #667eea;
            margin: 15px 0;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: #667eea;
        }

        .param-table {
            width: 100%;
            margin: 15px 0;
        }

        .param-table th {
            background: #f5f5f5;
            padding: 10px;
            text-align: left;
            font-weight: 600;
            color: #333;
        }

        .param-table td {
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
        }

        .required {
            color: #f44336;
            font-weight: 600;
        }

        .optional {
            color: #999;
        }

        .btn-test {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-test:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        .base-url-box {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid #667eea;
            margin: 20px 0;
        }

        .base-url-box strong {
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="api-header">
            <i class="fas fa-code" style="font-size: 3rem; color: #667eea; margin-bottom: 15px;"></i>
            <h1 class="api-title">REST API Documentation</h1>
            <p class="api-subtitle">Dokumentasi lengkap untuk Sistem Manajemen Mahasiswa API</p>
        </div>

        <!-- Base URL -->
        <div class="api-card">
            <div class="base-url-box">
                <h5><i class="fas fa-link"></i> <strong>Base URL</strong></h5>
                <code style="font-size: 1.1rem;">http://localhost/LATIHAN_CRUD/public/api.php</code>
                <p style="margin: 10px 0 0 0; color: #666;">Semua endpoint menggunakan base URL di atas</p>
            </div>
        </div>

        <!-- GET All Mahasiswa -->
        <div class="api-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <span class="method-badge method-get">GET</span>
                    <span class="endpoint">/mahasiswa</span>
                </div>
            </div>
            
            <p><strong>Deskripsi:</strong> Mengambil semua data mahasiswa</p>

            <div class="section-title">
                <i class="fas fa-terminal"></i> Request Example
            </div>
            <div class="code-block">curl -X GET http://localhost/LATIHAN_CRUD/public/api.php/mahasiswa</div>

            <div class="section-title">
                <i class="fas fa-check-circle"></i> Response (200 OK)
            </div>
            <div class="code-block">{
  "status": 200,
  "message": "Data mahasiswa berhasil diambil",
  "data": [
    {
      "nim": "123456",
      "nama": "Pi aha",
      "tempat_lahir": "Subang",
      "tanggal_lahir": "2004-11-14",
      "jenis_kelamin": "Laki-Laki",
      "telepon": "1234567890",
      "alamat": "Dimana aja"
    }
  ]
}</div>
        </div>

        <!-- GET Mahasiswa by NIM -->
        <div class="api-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <span class="method-badge method-get">GET</span>
                    <span class="endpoint">/mahasiswa/{nim}</span>
                </div>
            </div>
            
            <p><strong>Deskripsi:</strong> Mengambil data mahasiswa berdasarkan NIM</p>

            <div class="section-title">
                <i class="fas fa-list"></i> Parameters
            </div>
            <table class="param-table">
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Type</th>
                        <th>Required</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>nim</code></td>
                        <td>Integer</td>
                        <td><span class="required">Required</span></td>
                        <td>NIM mahasiswa yang akan dicari</td>
                    </tr>
                </tbody>
            </table>

            <div class="section-title">
                <i class="fas fa-terminal"></i> Request Example
            </div>
            <div class="code-block">curl -X GET http://localhost/LATIHAN_CRUD/public/api.php/mahasiswa/123456</div>

            <div class="section-title">
                <i class="fas fa-check-circle"></i> Response (200 OK)
            </div>
            <div class="code-block">{
  "status": 200,
  "message": "Data mahasiswa ditemukan",
  "data": {
    "nim": "123456",
    "nama": "Pi aha",
    "tempat_lahir": "Subang",
    "tanggal_lahir": "2004-11-14",
    "jenis_kelamin": "Laki-Laki",
    "telepon": "1234567890",
    "alamat": "Dimana aja"
  }
}</div>
        </div>

        <!-- POST Create Mahasiswa -->
        <div class="api-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <span class="method-badge method-post">POST</span>
                    <span class="endpoint">/mahasiswa</span>
                </div>
            </div>
            
            <p><strong>Deskripsi:</strong> Menambahkan data mahasiswa baru</p>

            <div class="section-title">
                <i class="fas fa-list"></i> Request Body Parameters
            </div>
            <table class="param-table">
                <thead>
                    <tr>
                        <th>Field</th>
                        <th>Type</th>
                        <th>Required</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>nim</code></td>
                        <td>Integer</td>
                        <td><span class="required">Required</span></td>
                        <td>NIM mahasiswa (harus unik)</td>
                    </tr>
                    <tr>
                        <td><code>nama</code></td>
                        <td>String</td>
                        <td><span class="required">Required</span></td>
                        <td>Nama lengkap mahasiswa</td>
                    </tr>
                    <tr>
                        <td><code>tempat_lahir</code></td>
                        <td>String</td>
                        <td><span class="required">Required</span></td>
                        <td>Tempat lahir mahasiswa</td>
                    </tr>
                    <tr>
                        <td><code>tanggal_lahir</code></td>
                        <td>Date</td>
                        <td><span class="required">Required</span></td>
                        <td>Tanggal lahir (format: YYYY-MM-DD)</td>
                    </tr>
                    <tr>
                        <td><code>jenis_kelamin</code></td>
                        <td>String</td>
                        <td><span class="required">Required</span></td>
                        <td>Laki-Laki atau Perempuan</td>
                    </tr>
                    <tr>
                        <td><code>telepon</code></td>
                        <td>String</td>
                        <td><span class="optional">Optional</span></td>
                        <td>Nomor telepon mahasiswa</td>
                    </tr>
                    <tr>
                        <td><code>alamat</code></td>
                        <td>Text</td>
                        <td><span class="optional">Optional</span></td>
                        <td>Alamat lengkap mahasiswa</td>
                    </tr>
                </tbody>
            </table>

            <div class="section-title">
                <i class="fas fa-terminal"></i> Request Example
            </div>
            <div class="code-block">curl -X POST http://localhost/LATIHAN_CRUD/public/api.php/mahasiswa \
-H "Content-Type: application/json" \
-d '{
  "nim": 2301001,
  "nama": "Ahmad Fauzi",
  "tempat_lahir": "Jakarta",
  "tanggal_lahir": "2003-05-15",
  "jenis_kelamin": "Laki-Laki",
  "telepon": "081234567890",
  "alamat": "Jl. Sudirman No. 10, Jakarta"
}'</div>

            <div class="section-title">
                <i class="fas fa-check-circle"></i> Response (201 Created)
            </div>
            <div class="code-block">{
  "status": 201,
  "message": "Data mahasiswa berhasil ditambahkan",
  "data": {
    "nim": 2301001,
    "nama": "Ahmad Fauzi"
  }
}</div>
        </div>

        <!-- PUT Update Mahasiswa -->
        <div class="api-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <span class="method-badge method-put">PUT</span>
                    <span class="endpoint">/mahasiswa/{nim}</span>
                </div>
            </div>
            
            <p><strong>Deskripsi:</strong> Mengupdate data mahasiswa berdasarkan NIM</p>

            <div class="section-title">
                <i class="fas fa-terminal"></i> Request Example
            </div>
            <div class="code-block">curl -X PUT http://localhost/LATIHAN_CRUD/public/api.php/mahasiswa/2301001 \
-H "Content-Type: application/json" \
-d '{
  "nama": "Ahmad Fauzi Updated",
  "tempat_lahir": "Jakarta",
  "tanggal_lahir": "2003-05-15",
  "jenis_kelamin": "Laki-Laki",
  "telepon": "081234567890",
  "alamat": "Jl. Sudirman No. 20, Jakarta"
}'</div>

            <div class="section-title">
                <i class="fas fa-check-circle"></i> Response (200 OK)
            </div>
            <div class="code-block">{
  "status": 200,
  "message": "Data mahasiswa berhasil diupdate",
  "data": {
    "nim": 2301001,
    "nama": "Ahmad Fauzi Updated"
  }
}</div>
        </div>

        <!-- DELETE Mahasiswa -->
        <div class="api-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <span class="method-badge method-delete">DELETE</span>
                    <span class="endpoint">/mahasiswa/{nim}</span>
                </div>
            </div>
            
            <p><strong>Deskripsi:</strong> Menghapus data mahasiswa berdasarkan NIM</p>

            <div class="section-title">
                <i class="fas fa-terminal"></i> Request Example
            </div>
            <div class="code-block">curl -X DELETE http://localhost/LATIHAN_CRUD/public/api.php/mahasiswa/2301001</div>

            <div class="section-title">
                <i class="fas fa-check-circle"></i> Response (200 OK)
            </div>
            <div class="code-block">{
  "status": 200,
  "message": "Data mahasiswa berhasil dihapus",
  "data": {
    "nim": 2301001
  }
}</div>
        </div>

        <!-- Error Responses -->
        <div class="api-card">
            <div class="section-title">
                <i class="fas fa-exclamation-triangle"></i> Error Responses
            </div>

            <h6 class="mt-4"><strong>400 Bad Request</strong></h6>
            <div class="code-block">{
  "status": 400,
  "message": "Data tidak lengkap. NIM, Nama, Tempat Lahir, Tanggal Lahir, dan Jenis Kelamin wajib diisi"
}</div>

            <h6 class="mt-4"><strong>404 Not Found</strong></h6>
            <div class="code-block">{
  "status": 404,
  "message": "Data mahasiswa tidak ditemukan"
}</div>

            <h6 class="mt-4"><strong>409 Conflict</strong></h6>
            <div class="code-block">{
  "status": 409,
  "message": "Data mahasiswa gagal ditambahkan. NIM mungkin sudah ada"
}</div>

            <h6 class="mt-4"><strong>500 Internal Server Error</strong></h6>
            <div class="code-block">{
  "status": 500,
  "message": "Error: Database connection failed"
}</div>
        </div>

        <!-- Testing Section -->
        <div class="api-card">
            <div class="section-title">
                <i class="fas fa-flask"></i> Testing API
            </div>
            <p>Anda dapat menggunakan tools berikut untuk testing API:</p>
            <ul>
                <li><strong>Postman</strong> - GUI tool untuk testing API</li>
                <li><strong>cURL</strong> - Command line tool</li>
                <li><strong>Thunder Client</strong> - VS Code extension</li>
                <li><strong>Insomnia</strong> - REST client</li>
            </ul>
            
            <div class="alert alert-info mt-3">
                <i class="fas fa-info-circle"></i>
                <strong>Tips:</strong> Pastikan server XAMPP (Apache & MySQL) sudah berjalan sebelum testing API!
            </div>
        </div>

        <!-- Back to App -->
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-test">
                <i class="fas fa-arrow-left"></i> Kembali ke Aplikasi
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>