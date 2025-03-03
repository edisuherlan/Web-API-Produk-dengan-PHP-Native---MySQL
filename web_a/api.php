<?php
header("Content-Type: application/json"); // Mengatur tipe konten menjadi JSON
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE"); // Mengizinkan metode HTTP tertentu
header("Access-Control-Allow-Origin: *"); // Mengizinkan akses dari semua domain

$API_KEY = "RAHASIA123"; // API Key

// Cek API Key
if (!isset($_GET['api_key']) || $_GET['api_key'] !== $API_KEY) {
    echo json_encode(["status" => "error", "message" => "API Key tidak valid"]); // Pesan error jika API Key tidak valid
    exit;
}

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "db_produk");

// Cek koneksi
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Koneksi database gagal"])); // Pesan error jika koneksi database gagal
}

// Ambil data produk
if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['search'])) {
    $result = $conn->query("SELECT * FROM products"); // Mengambil semua data produk
    $products = [];

    while ($row = $result->fetch_assoc()) {
        $products[] = $row; // Menyimpan data produk ke dalam array
    }

    echo json_encode(["status" => "success", "data" => $products]); // Mengembalikan data produk dalam format JSON
}

// Pencarian produk berdasarkan nama
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
    $search = "%" . $_GET['search'] . "%"; // Menyiapkan kata kunci pencarian

    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ?"); // Query pencarian produk
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row; // Menyimpan hasil pencarian ke dalam array
    }

    echo json_encode(["status" => "success", "data" => $products]); // Mengembalikan hasil pencarian dalam format JSON
    exit;
}

// Tambah produk
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents("php://input"), true); // Mendapatkan data input dari request
    
    if (!isset($input['name']) || !isset($input['price'])) {
        echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]); // Pesan error jika data tidak lengkap
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO products (name, price) VALUES (?, ?)"); // Query untuk menambah produk
    $stmt->bind_param("si", $input['name'], $input['price']);
    $stmt->execute();

    echo json_encode(["status" => "success", "message" => "Produk berhasil ditambahkan"]); // Pesan sukses jika produk berhasil ditambahkan
}

// Update produk
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $input = json_decode(file_get_contents("php://input"), true); // Mendapatkan data input dari request
    
    if (!isset($input['id']) || !isset($input['name']) || !isset($input['price'])) {
        echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]); // Pesan error jika data tidak lengkap
        exit;
    }

    $stmt = $conn->prepare("UPDATE products SET name = ?, price = ? WHERE id = ?"); // Query untuk memperbarui produk
    $stmt->bind_param("sii", $input['name'], $input['price'], $input['id']);
    $stmt->execute();

    echo json_encode(["status" => "success", "message" => "Produk berhasil diperbarui"]); // Pesan sukses jika produk berhasil diperbarui
}

// Hapus produk
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $input = json_decode(file_get_contents("php://input"), true); // Mendapatkan data input dari request

    if (!isset($input['id'])) {
        echo json_encode(["status" => "error", "message" => "ID produk tidak diberikan"]); // Pesan error jika ID produk tidak diberikan
        exit;
    }

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?"); // Query untuk menghapus produk
    $stmt->bind_param("i", $input['id']);
    $stmt->execute();

    echo json_encode(["status" => "success", "message" => "Produk berhasil dihapus"]); // Pesan sukses jika produk berhasil dihapus
}

$conn->close(); // Menutup koneksi database
?>
