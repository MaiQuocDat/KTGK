<?php
// Kết nối MySQL
$servername = "localhost:3306"; // Tên server MySQL
$username = "root";        // Username mặc định của XAMPP
$password = "";            // Password (trống trong XAMPP)
$dbname = "quan_ly_nhan_vien"; // Tên database

// Thực hiện kết nối
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
