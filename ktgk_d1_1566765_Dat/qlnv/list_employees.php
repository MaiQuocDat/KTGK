<?php
require_once 'db_connect.php';
require_once 'includes/header.php';

// Xử lý sắp xếp
$order = isset($_GET['order']) ? $_GET['order'] : 'employee_id';
$direction = isset($_GET['dir']) && $_GET['dir'] === 'desc' ? 'DESC' : 'ASC';

// Xử lý tìm kiếm
$search = isset($_GET['search']) ? $_GET['search'] : '';
$searchCondition = '';
if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $searchCondition = "WHERE e.full_name LIKE '%$search%' OR d.dept_name LIKE '%$search%'";
}

// Lấy dữ liệu nhân viên
$sql = "SELECT e.*, d.dept_name 
        FROM employees e 
        INNER JOIN departments d ON e.dept_id = d.dept_id
        $searchCondition
        ORDER BY $order $direction";
$result = $conn->query($sql);
?>

<div class="container mt-4">
    <h2 class="mb-4">Danh sách nhân viên</h2>
    
    <!-- Form tìm kiếm -->
    <form method="get" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm theo tên hoặc phòng ban..." value="<?= htmlspecialchars($search) ?>">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>
    
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Họ và tên</th>
                    <th>
                        <a href="?order=birth_date&dir=<?= ($order === 'birth_date' && $direction === 'ASC') ? 'desc' : 'asc' ?>">
                            Ngày sinh <?= ($order === 'birth_date') ? ($direction === 'ASC' ? '↑' : '↓') : '' ?>
                        </a>
                    </th>
                    <th>Giới tính</th>
                    <th>Ngày vào làm</th>
                    <th>
                        <a href="?order=salary&dir=<?= ($order === 'salary' && $direction === 'ASC') ? 'desc' : 'asc' ?>">
                            Lương <?= ($order === 'salary') ? ($direction === 'ASC' ? '↑' : '↓') : '' ?>
                        </a>
                    </th>
                    <th>Phòng ban</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['employee_id'] ?></td>
                            <td><?= htmlspecialchars($row['full_name']) ?></td>
                            <td><?= date('d/m/Y', strtotime($row['birth_date'])) ?></td>
                            <td><?= $row['gender'] ?></td>
                            <td><?= date('d/m/Y', strtotime($row['hire_date'])) ?></td>
                            <td><?= number_format($row['salary'], 0, ',', '.') ?> VNĐ</td>
                            <td><?= htmlspecialchars($row['dept_name']) ?></td>
                            <td>
                                <a href="edit_employee.php?id=<?= $row['employee_id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                                <a href="delete_employee.php?id=<?= $row['employee_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa nhân viên này?')">Xóa</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Không có nhân viên nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <a href="add_employee.php" class="btn btn-success">Thêm nhân viên mới</a>
</div>

<?php require_once 'includes/footer.php'; ?>