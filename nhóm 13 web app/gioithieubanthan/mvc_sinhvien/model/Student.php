<?php
class Student {

    /**
     * Khởi tạo dữ liệu mẫu trong SESSION nếu chưa có
     */
    private static function init(): void {
        if (!isset($_SESSION['students'])) {
            $_SESSION['students'] = [
                ['id' => 1, 'name' => 'Nguyễn Văn An',    'major' => 'Công nghệ thông tin'],
                ['id' => 2, 'name' => 'Trần Thị Bình',    'major' => 'Kỹ thuật phần mềm'],
                ['id' => 3, 'name' => 'Lê Văn Cường',     'major' => 'Hệ thống thông tin'],
                ['id' => 4, 'name' => 'Phạm Thị Dung',    'major' => 'An toàn thông tin'],
                ['id' => 5, 'name' => 'Hoàng Văn Em',     'major' => 'Khoa học máy tính'],
                ['id' => 6, 'name' => 'Đỗ Thị Phương',    'major' => 'Công nghệ thông tin'],
                ['id' => 7, 'name' => 'Vũ Minh Quân',     'major' => 'Kỹ thuật phần mềm'],
                ['id' => 8, 'name' => 'Bùi Thị Hoa',      'major' => 'Hệ thống thông tin'],
            ];
            $_SESSION['next_id'] = 9;
        }
    }

    /** Lấy tất cả sinh viên */
    public static function getAll(): array {
        self::init();
        return $_SESSION['students'];
    }

    /** Lấy sinh viên theo ID */
    public static function getById(int $id): ?array {
        self::init();
        foreach ($_SESSION['students'] as $student) {
            if ((int)$student['id'] === $id) {
                return $student;
            }
        }
        return null;
    }

    /** Thêm sinh viên mới */
    public static function add(string $name, string $major): void {
        self::init();
        $id = $_SESSION['next_id']++;
        $_SESSION['students'][] = [
            'id'    => $id,
            'name'  => $name,
            'major' => $major,
        ];
    }

    /** Cập nhật sinh viên */
    public static function update(int $id, string $name, string $major): bool {
        self::init();
        foreach ($_SESSION['students'] as &$student) {
            if ((int)$student['id'] === $id) {
                $student['name']  = $name;
                $student['major'] = $major;
                return true;
            }
        }
        return false;
    }

    /** Xóa sinh viên theo ID */
    public static function delete(int $id): void {
        self::init();
        $_SESSION['students'] = array_values(
            array_filter($_SESSION['students'], fn($s) => (int)$s['id'] !== $id)
        );
    }

    /** Tìm kiếm sinh viên theo tên */
    public static function search(string $keyword): array {
        self::init();
        return array_values(
            array_filter($_SESSION['students'], fn($s) => stripos($s['name'], $keyword) !== false)
        );
    }
}
