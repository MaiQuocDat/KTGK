-- Tạo database
CREATE DATABASE IF NOT EXISTS quan_ly_nhan_vien;
USE quan_ly_nhan_vien;

-- Tạo bảng departments
CREATE TABLE IF NOT EXISTS departments (
    dept_id INT PRIMARY KEY AUTO_INCREMENT,
    dept_name VARCHAR(50) NOT NULL,
    manager_name VARCHAR(100)
);

-- Tạo bảng employees
CREATE TABLE IF NOT EXISTS employees (
    employee_id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    birth_date DATE NOT NULL,
    gender ENUM('Nam', 'Nữ') NOT NULL,
    hire_date DATE NOT NULL,
    salary DECIMAL(10,2) NOT NULL,
    dept_id INT,
    FOREIGN KEY (dept_id) REFERENCES departments(dept_id)
);

-- Thêm dữ liệu mẫu cho departments
INSERT INTO departments (dept_name, manager_name) VALUES
('Phòng Kế toán', 'Nguyễn Thị Hương'),
('Phòng Nhân sự', 'Trần Văn Nam'),
('Phòng Kỹ thuật', 'Lê Minh Tuấn');

-- Thêm dữ liệu mẫu cho employees
INSERT INTO employees (full_name, birth_date, gender, hire_date, salary, dept_id) VALUES
('Nguyễn Văn An', '1990-05-15', 'Nam', '2015-06-01', 15000000, 1),
('Trần Thị Bích', '1992-08-20', 'Nữ', '2016-07-15', 12000000, 1),
('Lê Văn Nam', '1988-03-10', 'Nam', '2014-05-10', 18000000, 2),
('Phạm Thị Nga', '1991-11-25', 'Nữ', '2017-09-01', 13000000, 2),
('Hoàng Văn Thụ', '1985-07-30', 'Nam', '2013-01-15', 20000000, 3),
('Vũ Thị Xuân', '1993-04-05', 'Nữ', '2018-03-20', 11000000, 3),
('Đặng Văn Ngọc', '1989-09-12', 'Nam', '2016-11-05', 16000000, 1),
('Bùi Thị Hà', '1990-12-18', 'Nữ', '2015-08-10', 14000000, 2),
('Mai Văn Danh', '1987-06-22', 'Nam', '2014-04-15', 17000000, 3),
('Lý Khả', '1994-02-28', 'Nữ', '2019-01-20', 10000000, 1);