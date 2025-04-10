<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUẢN LÝ NHÂN VIÊN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="list_employees.php">Quản lý nhân viên</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="list_employees.php">Danh sách</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_employee.php">Thêm mới</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php
        if (isset($_GET['delete'])) {
            if ($_GET['delete'] === 'success') {
                echo '<div class="alert alert-success mt-3">Xóa thành công!</div>';
            } else {
                echo '<div class="alert alert-danger mt-3">Lỗi khi xóa nhân viên!</div>';
            }
        }
        ?>