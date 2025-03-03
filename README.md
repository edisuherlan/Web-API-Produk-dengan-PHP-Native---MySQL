# 🌐 Web API Produk dengan PHP Native & MySQL

Proyek ini adalah sistem sederhana dengan **dua website berbeda** yang dapat **bertukar data produk secara real-time** menggunakan **API berbasis cURL & JSON**.  

## 📌 Fitur Utama
- ✅ **REST API** dengan PHP Native  
- ✅ **CRUD Produk** (Create, Read, Update, Delete)  
- ✅ **Pencarian Produk** berdasarkan nama  
- ✅ **API Key untuk Keamanan**  
- ✅ **Pertukaran Data Real-time** antara Website A & B  

---

## 🛠️ Instalasi & Konfigurasi

### **1️⃣ Clone Repository**
```bash
git clone https://github.com/edisuherlan/Web-API-Produk-dengan-PHP-Native---MySQL.git
cd repository
```

### **2️⃣ Setup Database**
1. Buat database baru dengan nama **`db_produk`**  
2. Jalankan SQL berikut di phpMyAdmin / MySQL:
```sql
CREATE DATABASE db_produk;

USE db_produk;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price INT NOT NULL
);

INSERT INTO products (name, price) VALUES
('Kopi Hitam', 10000),
('Teh Tarik', 15000),
('Susu Coklat', 20000),
('Air Mineral', 5000),
('Jus Jeruk', 18000),
('Jus Alpukat', 25000),
('Mie Goreng', 22000),
('Nasi Goreng Spesial', 30000),
('Ayam Geprek', 28000),
('Burger Keju', 35000),
('Pizza Mini', 45000),
('Kentang Goreng', 20000),
('Es Cincau', 12000),
('Cappuccino', 25000),
('Es Teh Manis', 8000),
('Soto Ayam', 30000),
('Bakso Kuah', 25000),
('Roti Bakar Coklat', 18000),
('Martabak Manis', 40000),
('Pisang Goreng Keju', 15000);
```

### **3️⃣ Konfigurasi Website A (Server/API Provider)**
- Masukkan file `api.php` ke dalam **Website A**
- Edit `api.php` jika perlu  
- Pastikan API bisa diakses melalui URL:  
  ```
  http://website-a.com/api.php
  ```

### **4️⃣ Konfigurasi Website B (Client/API Consumer)**
- Masukkan file **`get_products.php`**, **`add_product.php`**, **`update_product.php`**, **`delete_product.php`**, dan **`search_product.php`** ke dalam Website B
- Pastikan URL API sudah sesuai di setiap file

---

## 🚀 Cara Menjalankan

### 🔍 **Ambil Semua Produk**
```bash
http://website-b.com/get_products.php
```

### ➕ **Tambah Produk Baru**
```bash
http://website-b.com/add_product.php
```

### ✏️ **Update Produk**
```bash
http://website-b.com/update_product.php
```

### ❌ **Hapus Produk**
```bash
http://website-b.com/delete_product.php
```

### 🔎 **Cari Produk**
```bash
http://website-b.com/search_product.php
```
- Masukkan nama produk yang ingin dicari.

---

## 🔐 API Key  
Gunakan API Key berikut untuk mengakses API:  
```text
RAHASIA123
```
> API Key bisa diubah di `api.php`.

---

## 📜 Lisensi  
Proyek ini bersifat **open-source**. Silakan gunakan, modifikasi, atau kembangkan sesuai kebutuhan. 🚀  

---

