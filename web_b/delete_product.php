<?php
include 'key.php'; // Mengikutsertakan file key.php untuk mendapatkan URL API
$data = json_encode(["id" => 1]); // Mengencode data ID produk yang akan dihapus ke dalam format JSON

$ch = curl_init(); // Inisialisasi cURL
curl_setopt($ch, CURLOPT_URL, $api_url); // Mengatur URL API
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); // Mengatur metode HTTP menjadi DELETE
curl_setopt($ch, CURLOPT_POSTFIELDS, $data); // Mengatur data yang akan dikirim
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Mengatur agar hasil cURL disimpan dalam variabel
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]); // Mengatur header konten tipe menjadi JSON

$response = curl_exec($ch); // Eksekusi cURL
curl_close($ch); // Tutup cURL

echo $response; // Tampilkan respon dari API
?>
