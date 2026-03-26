<?php
require_once __DIR__ . '/../model/Student.php';

class StudentController {

    private const PER_PAGE = 5;

    /**
     * Hiển thị danh sách sinh viên (có tìm kiếm + phân trang)
     */
    public function list(): void {
        $keyword    = trim($_GET['search'] ?? '');
        $students   = $keyword !== '' ? Student::search($keyword) : Student::getAll();

        // Phân trang
        $total      = count($students);
        $perPage    = self::PER_PAGE;
        $totalPages = max(1, (int)ceil($total / $perPage));
        $page       = max(1, min($totalPages, (int)($_GET['page'] ?? 1)));
        $students   = array_slice($students, ($page - 1) * $perPage, $perPage);

        require __DIR__ . '/../view/student_list.php';
    }

    /**
     * Thêm sinh viên
     */
    public function add(): void {
        $errors = [];
        $name   = '';
        $major  = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name  = trim($_POST['name']  ?? '');
            $major = trim($_POST['major'] ?? '');

            if ($name === '') {
                $errors[] = 'Họ tên không được để trống.';
            } elseif (mb_strlen($name) < 3) {
                $errors[] = 'Họ tên phải có ít nhất 3 ký tự.';
            }

            if ($major === '') {
                $errors[] = 'Ngành học không được để trống.';
            }

            if (empty($errors)) {
                Student::add($name, $major);
                header('Location: index.php?action=list');
                exit;
            }
        }

        require __DIR__ . '/../view/student_add.php';
    }

    /**
     * Sửa sinh viên
     */
    public function edit(): void {
        $id      = (int)($_GET['id'] ?? 0);
        $student = Student::getById($id);
        $errors  = [];

        if (!$student) {
            header('Location: index.php?action=list');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name  = trim($_POST['name']  ?? '');
            $major = trim($_POST['major'] ?? '');

            if ($name === '') {
                $errors[] = 'Họ tên không được để trống.';
            } elseif (mb_strlen($name) < 3) {
                $errors[] = 'Họ tên phải có ít nhất 3 ký tự.';
            }

            if ($major === '') {
                $errors[] = 'Ngành học không được để trống.';
            }

            if (empty($errors)) {
                Student::update($id, $name, $major);
                header('Location: index.php?action=list');
                exit;
            }

            // Giữ lại giá trị đã nhập để hiển thị lại
            $student['name']  = $name;
            $student['major'] = $major;
        }

        require __DIR__ . '/../view/student_edit.php';
    }

    /**
     * Xóa sinh viên
     */
    public function delete(): void {
        $id = (int)($_GET['id'] ?? 0);
        Student::delete($id);
        header('Location: index.php?action=list');
        exit;
    }
}
