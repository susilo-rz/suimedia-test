<?php
// Set header agar response dalam bentuk JSON
header('Content-Type: application/json');

// Ambil parameter dari URL (dengan fallback default)
$page = $_GET['page'] ?? 1;
$size = $_GET['size'] ?? 10;
$sort = $_GET['sort'] ?? '-published_at';

// Bangun URL lengkap ke API Suitmedia
$apiUrl = "https://suitmedia-backend.suitdev.com/api/ideas";
$apiUrl .= "?page[number]=$page";
$apiUrl .= "&page[size]=$size";
$apiUrl .= "&sort=$sort";
$apiUrl .= "&append[]=small_image&append[]=medium_image";

// Inisialisasi cURL
$ch = curl_init($apiUrl);

// Set opsi cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json'
]);

// Eksekusi cURL dan ambil responsenya
$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

// Jika error, tampilkan pesan error
if ($error) {
    echo json_encode([
        'success' => false,
        'message' => 'Gagal mengambil data dari API.',
        'error' => $error
    ]);
    exit;
}

// Tampilkan response API ke client (browser/JS/PHP frontend)
echo $response;
