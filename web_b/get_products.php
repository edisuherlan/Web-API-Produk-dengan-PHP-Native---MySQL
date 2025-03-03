<?php
include 'key.php';

// Inisialisasi cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url); // Mengatur URL API
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Mengatur agar hasil cURL disimpan dalam variabel

$response = curl_exec($ch); // Eksekusi cURL

// Cek apakah ada error pada cURL
if (curl_errno($ch)) {
    echo "Curl error: " . curl_error($ch); // Tampilkan pesan error cURL
    curl_close($ch); // Tutup cURL
    exit; // Keluar dari script
}

curl_close($ch); // Tutup cURL

$data = json_decode($response, true); // Decode JSON response

// Cek apakah ada error pada JSON decoding
if (json_last_error() !== JSON_ERROR_NONE) {
    echo "JSON decode error: " . json_last_error_msg(); // Tampilkan pesan error JSON
    exit; // Keluar dari script
}

// Cek status dari data yang diterima
if ($data['status'] === 'success') {
    // Loop melalui setiap produk dan tampilkan
    foreach ($data['data'] as $product) {
        echo "ID: " . htmlspecialchars($product['id']) . " - Nama: " . htmlspecialchars($product['name']) . " - Harga: " . htmlspecialchars($product['price']) . "<br>";
    }
} else {
    echo "Gagal mengambil data: " . htmlspecialchars($data['message']); // Tampilkan pesan error jika gagal
}
?>
