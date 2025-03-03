<?php
include 'key.php';

// Inisialisasi data default untuk respon
$data = ["status" => "error", "message" => "Masukkan kata kunci pencarian"];

// Cek apakah parameter 'keyword' ada dalam URL
if (isset($_GET['keyword'])) {
    $keyword = urlencode($_GET['keyword']); // Encode kata kunci untuk URL
    $api_url_with_search = $api_url . "&search=$keyword"; // Tambahkan kata kunci ke URL API

    // Inisialisasi cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url_with_search); // Set URL untuk cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Set agar hasil cURL disimpan dalam variabel

    $response = curl_exec($ch); // Eksekusi cURL

    // Cek apakah ada error pada cURL
    if (curl_errno($ch)) {
        $data = ["status" => "error", "message" => "Curl error: " . curl_error($ch)]; // Set pesan error jika ada
    } else {
        // Cek apakah respon adalah string JSON yang valid
        if ($response === false || is_null(json_decode($response))) {
            $data = ["status" => "error", "message" => "JSON decode error: Syntax error"]; // Set pesan error jika JSON tidak valid
        } else {
            $data = json_decode($response, true); // Decode JSON
            // Cek apakah ada error pada JSON decoding
            if (json_last_error() !== JSON_ERROR_NONE) {
                $data = ["status" => "error", "message" => "JSON decode error: " . json_last_error_msg()]; // Set pesan error jika ada
            }
        }
    }

    curl_close($ch); // Tutup cURL
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Produk</title>
</head>
<body>
    <h2>Cari Produk</h2>
    <form method="GET">
        <input type="text" name="keyword" placeholder="Masukkan nama produk..." required>
        <button type="submit">Cari</button>
    </form>

    <h3>Hasil Pencarian:</h3>
    <ul>
        <?php
        // Cek apakah status data adalah 'success' dan data tidak kosong
        if ($data['status'] === 'success' && !empty($data['data'])) {
            // Loop melalui setiap produk dan tampilkan
            foreach ($data['data'] as $product) {
                echo "<li>ID: " . htmlspecialchars($product['id']) . " - Nama: " . htmlspecialchars($product['name']) . " - Harga: Rp" . number_format($product['price'], 0, ',', '.') . "</li>";
            }
        } else {
            // Tampilkan pesan error jika ada
            $message = isset($data['message']) ? $data['message'] : "Unknown error occurred";
            echo "<li>" . htmlspecialchars($message) . "</li>";
        }
        ?>
    </ul>
</body>
</html>
