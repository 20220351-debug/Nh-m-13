<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sinh Viên</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; color: #333; }
        .container { max-width: 900px; margin: 40px auto; padding: 0 16px; }
        h1 { text-align: center; margin-bottom: 24px; color: #2563eb; font-size: 1.8rem; }

        /* Toolbar */
        .toolbar { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; margin-bottom: 16px; }
        .search-form { display: flex; gap: 6px; }
        .search-form input[type="text"] {
            padding: 8px 12px; border: 1px solid #d1d5db; border-radius: 6px;
            font-size: 0.9rem; width: 220px;
        }
        .btn { padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer; font-size: 0.875rem; text-decoration: none; display: inline-block; }
        .btn-primary  { background: #2563eb; color: #fff; }
        .btn-primary:hover  { background: #1d4ed8; }
        .btn-success  { background: #16a34a; color: #fff; }
        .btn-success:hover  { background: #15803d; }
        .btn-warning  { background: #d97706; color: #fff; }
        .btn-warning:hover  { background: #b45309; }
        .btn-danger   { background: #dc2626; color: #fff; }
        .btn-danger:hover   { background: #b91c1c; }
        .btn-secondary { background: #6b7280; color: #fff; }
        .btn-secondary:hover { background: #4b5563; }

        /* Table */
        .card { background: #fff; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,.1); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        thead { background: #2563eb; color: #fff; }
        thead th { padding: 12px 16px; text-align: left; font-weight: 600; }
        tbody tr { border-bottom: 1px solid #e5e7eb; transition: background .15s; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: #f9fafb; }
        td { padding: 11px 16px; vertical-align: middle; }
        .actions { display: flex; gap: 6px; }

        /* Badge */
        .badge { display: inline-block; padding: 2px 10px; border-radius: 999px; font-size: 0.78rem; background: #dbeafe; color: #1d4ed8; white-space: nowrap; }

        /* Empty state */
        .empty { text-align: center; padding: 40px; color: #9ca3af; font-size: 1rem; }

        /* Pagination */
        .pagination { display: flex; justify-content: center; gap: 6px; margin-top: 20px; flex-wrap: wrap; }
        .pagination a, .pagination span {
            padding: 6px 14px; border-radius: 6px; font-size: 0.875rem; text-decoration: none;
            border: 1px solid #d1d5db; color: #374151;
        }
        .pagination a:hover { background: #e5e7eb; }
        .pagination .active { background: #2563eb; color: #fff; border-color: #2563eb; }

        /* Info bar */
        .info-bar { font-size: 0.85rem; color: #6b7280; margin-bottom: 8px; }
    </style>
</head>
<body>
<div class="container">
    <h1>📋 Quản lý Sinh Viên</h1>

    <!-- Toolbar: tìm kiếm + nút thêm -->
    <div class="toolbar">
        <form class="search-form" method="get" action="index.php">
            <input type="hidden" name="action" value="list">
            <input type="text" name="search" placeholder="Tìm theo tên..."
                   value="<?= htmlspecialchars($keyword) ?>">
            <button type="submit" class="btn btn-primary">🔍 Tìm</button>
            <?php if ($keyword !== ''): ?>
                <a href="index.php?action=list" class="btn btn-secondary">✕ Xóa lọc</a>
            <?php endif; ?>
        </form>
        <a href="index.php?action=add" class="btn btn-success">+ Thêm sinh viên</a>
    </div>

    <!-- Thống kê -->
    <div class="info-bar">
        <?php if ($keyword !== ''): ?>
            Kết quả tìm kiếm cho "<strong><?= htmlspecialchars($keyword) ?></strong>":
            <strong><?= $total ?></strong> sinh viên &nbsp;|&nbsp;
        <?php else: ?>
            Tổng: <strong><?= $total ?></strong> sinh viên &nbsp;|&nbsp;
        <?php endif; ?>
        Trang <strong><?= $page ?></strong> / <strong><?= $totalPages ?></strong>
    </div>

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th style="width:60px">ID</th>
                    <th>Họ và Tên</th>
                    <th>Ngành học</th>
                    <th style="width:140px">Thao tác</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($students)): ?>
                <tr>
                    <td colspan="4" class="empty">Không có sinh viên nào.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($students as $sv): ?>
                <tr>
                    <td><?= (int)$sv['id'] ?></td>
                    <td><?= htmlspecialchars($sv['name']) ?></td>
                    <td><span class="badge"><?= htmlspecialchars($sv['major']) ?></span></td>
                    <td>
                        <div class="actions">
                            <a href="index.php?action=edit&id=<?= (int)$sv['id'] ?>"
                               class="btn btn-warning">✏️ Sửa</a>
                            <a href="index.php?action=delete&id=<?= (int)$sv['id'] ?>"
                               class="btn btn-danger"
                               onclick="return confirm('Xóa sinh viên này?')">🗑 Xóa</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Phân trang -->
    <?php if ($totalPages > 1): ?>
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="index.php?action=list&page=<?= $page - 1 ?>&search=<?= urlencode($keyword) ?>">‹ Trước</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i === $page): ?>
                <span class="active"><?= $i ?></span>
            <?php else: ?>
                <a href="index.php?action=list&page=<?= $i ?>&search=<?= urlencode($keyword) ?>"><?= $i ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="index.php?action=list&page=<?= $page + 1 ?>&search=<?= urlencode($keyword) ?>">Sau ›</a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>
</body>
</html>
