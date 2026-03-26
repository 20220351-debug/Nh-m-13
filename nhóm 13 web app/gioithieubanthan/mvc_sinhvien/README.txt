============================================================
  ỨNG DỤNG QUẢN LÝ SINH VIÊN - PHP MVC THUẦN
  Bài tập thực hành 2 - Chương 1
============================================================

CÁCH CHẠY
----------
1. Cài đặt XAMPP (hoặc bất kỳ môi trường PHP server nào).
2. Sao chép thư mục "mvc_sinhvien" vào: C:\xampp\htdocs\
3. Bật Apache trong XAMPP Control Panel.
4. Mở trình duyệt và truy cập:
   http://localhost/mvc_sinhvien/index.php

CẤU TRÚC THƯ MỤC
-----------------
mvc_sinhvien/
├── index.php                  ← Router chính (điều hướng theo ?action=...)
├── controller/
│   └── StudentController.php  ← Xử lý logic, validation
├── model/
│   └── Student.php            ← Dữ liệu, lưu bằng SESSION
└── view/
    ├── student_list.php       ← Hiển thị danh sách
    ├── student_add.php        ← Form thêm sinh viên
    └── student_edit.php       ← Form sửa sinh viên

CÁC CHỨC NĂNG ĐÃ LÀM
----------------------
[✓] Phần 1 – Hiển thị danh sách sinh viên (ID, Họ tên, Ngành học)
[✓] Phần 2 – CRUD:
      - Thêm sinh viên (form + redirect)
      - Xóa sinh viên (confirm trước khi xóa)
      - Sửa sinh viên (form điền sẵn dữ liệu cũ)
[✓] Phần 3 – Routing đơn giản trong index.php:
      ?action=list
      ?action=add
      ?action=delete&id=1
      ?action=edit&id=1
[✓] Phần 4 – Kiểm tra dữ liệu:
      - Không để trống tên & ngành
      - Tên phải >= 3 ký tự
      - Hiển thị lỗi trên giao diện, giữ lại giá trị đã nhập

PHẦN NÂNG CAO ĐÃ LÀM
----------------------
[✓] Lưu dữ liệu bằng SESSION (dữ liệu không mất khi reload)
[✓] Tìm kiếm sinh viên theo tên (không phân biệt hoa thường)
[✓] Phân trang (5 sinh viên / trang)
