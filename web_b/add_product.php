<?php
include 'key.php'; // Mengikutsertakan file key.php untuk mendapatkan URL API
$data = json_encode(["name" => "Produk Baru", "price" => 30000]); // Mengencode data produk baru ke dalam format JSON

$ch = curl_init(); // Inisialisasi cURL
curl_setopt($ch, CURLOPT_URL, $api_url); // Mengatur URL API
curl_setopt($ch, CURLOPT_POST, true); // Mengatur metode HTTP menjadi POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // Mengatur data yang akan dikirim
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Mengatur agar hasil cURL disimpan dalam variabel
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]); // Mengatur header konten tipe menjadi JSON

$response = curl_exec($ch); // Eksekusi cURL
curl_close($ch); // Tutup cURL

echo $response; // Tampilkan respon dari API
?>
