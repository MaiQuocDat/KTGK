<?php
require_once 'db_connect.php';

$employee_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($employee_id > 0) {
    $stmt = $conn->prepare("DELETE FROM employees WHERE employee_id = ?");
    $stmt->bind_param("i", $employee_id);
    
    if ($stmt->execute()) {
        $success = true;
    } else {
        $error = "Lỗi khi xóa nhân viên: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    $error = "ID nhân viên không hợp lệ";
}

header("Location: list_employees.php?delete=" . (isset($success) ? 'success' : 'error'));
exit();
?>