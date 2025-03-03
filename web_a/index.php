<?php
$servername = "localhost"; // Nama server
$username = "root"; // Nama pengguna database
$password = ""; // Kata sandi database
$dbname = "db_produk"; // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Pesan error jika koneksi gagal
}

$sql = "SELECT id, name, price FROM products"; // Query untuk mengambil data produk
$result = $conn->query($sql); // Menjalankan query

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Product List</title>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Product List</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table class='table table-bordered table-striped'><thead class='thead-dark'><tr><th>ID</th><th>Name</th><th>Price</th></tr></thead><tbody>";
        // Menampilkan data dari setiap baris
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . htmlspecialchars($row["id"]) . "</td><td>" . htmlspecialchars($row["name"]) . "</td><td>" . htmlspecialchars($row["price"]) . "</td></tr>";
        }
        echo "</tbody></table>";
    } else {
        echo "<div class='alert alert-warning'>0 results</div>"; // Pesan jika tidak ada hasil
    }
    $conn->close(); // Menutup koneksi
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
