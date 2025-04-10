document.addEventListener('DOMContentLoaded', function() {
    // Xác nhận trước khi xóa
    const deleteButtons = document.querySelectorAll('.btn-danger');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Bạn có chắc chắn muốn xóa nhân viên này?')) {
                e.preventDefault();
            }
        });
    });
    
    // Tự động đóng thông báo sau 5 giây
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 1s';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 1000);
        }, 5000);
    });
});