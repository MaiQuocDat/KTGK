<?php
require_once 'db_connect.php';

$errors = [];
$success = false;

// Lấy danh sách phòng ban
$deptQuery = "SELECT * FROM departments";
$deptResult = $conn->query($deptQuery);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $hire_date = $_POST['hire_date'];
    $salary = floatval($_POST['salary']);
    $dept_id = intval($_POST['dept_id']);
    
    // Validate dữ liệu
    if (empty($full_name)) {
        $errors[] = "Họ và tên không được để trống";
    }
    
    if ($salary < 0) {
        $errors[] = "Lương không được âm";
    }
    
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO employees (full_name, birth_date, gender, hire_date, salary, dept_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssdi", $full_name, $birth_date, $gender, $hire_date, $salary, $dept_id);
        
        if ($stmt->execute()) {
            $success = true;
        } else {
            $errors[] = "Lỗi khi thêm nhân viên: " . $stmt->error;
        }

        $stmt->close();
    }
}

require_once 'includes/header.php';
?>

<div class="container mt-4">
    <h2 class="mb-4">Thêm nhân viên mới</h2>
    
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <?php if ($success): ?>
        <div class="alert alert-success">
            Thêm nhân viên thành công!
            <a href="list_employees.php" class="btn btn-sm btn-primary ml-3">Xem danh sách</a>
        </div>
    <?php endif; ?>
    
    <form method="post">
        <div class="form-group">
            <label for="full_name">Họ và tên</label>
            <input type="text" class="form-control" id="full_name" name="full_name" required>
        </div>
        
        <div class="form-group">
            <label for="birth_date">Ngày sinh</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date" required>
        </div>
        
        <div class="form-group">
            <label for="gender">Giới tính</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="hire_date">Ngày vào làm</label>
            <input type="date" class="form-control" id="hire_date" name="hire_date" required>
        </div>
        
        <div class="form-group">
            <label for="salary">Lương</label>
            <input type="number" class="form-control" id="salary" name="salary" min="0" step="100000" required>
        </div>
        
        <div class="form-group">
            <label for="dept_id">Phòng ban</label>
            <select class="form-control" id="dept_id" name="dept_id" required>
                <?php while($dept = $deptResult->fetch_assoc()): ?>
                    <option value="<?= $dept['dept_id'] ?>"><?= htmlspecialchars($dept['dept_name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Thêm nhân viên</button>
        <a href="list_employees.php" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<?php require_once 'includes/footer.php'; ?>