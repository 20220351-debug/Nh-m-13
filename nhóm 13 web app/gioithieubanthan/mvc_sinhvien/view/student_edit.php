<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sinh Viên</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; color: #333; }
        .container { max-width: 480px; margin: 60px auto; padding: 0 16px; }
        h1 { text-align: center; margin-bottom: 24px; color: #d97706; font-size: 1.6rem; }
        .card { background: #fff; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,.1); padding: 28px 32px; }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-weight: 600; margin-bottom: 6px; font-size: 0.9rem; }
        input[type="text"] {
            width: 100%; padding: 10px 12px; border: 1px solid #d1d5db;
            border-radius: 6px; font-size: 0.95rem;
        }
        input[type="text"]:focus { outline: none; border-color: #d97706; box-shadow: 0 0 0 2px #fde68a; }
        .btn { padding: 10px 20px; border: none; border-radius: 6px; cursor: pointer; font-size: 0.9rem; text-decoration: none; display: inline-block; }
        .btn-warning  { background: #d97706; color: #fff; }
        .btn-warning:hover { background: #b45309; }
        .btn-secondary { background: #6b7280; color: #fff; }
        .btn-secondary:hover { background: #4b5563; }
        .btn-row { display: flex; gap: 10px; margin-top: 8px; }
        .errors { background: #fee2e2; border: 1px solid #fca5a5; border-radius: 6px; padding: 12px 16px; margin-bottom: 18px; }
        .errors p { color: #dc2626; font-size: 0.875rem; margin-bottom: 4px; }
        .errors p:last-child { margin-bottom: 0; }
        .id-badge { display: inline-block; background: #fef3c7; color: #92400e; padding: 2px 10px; border-radius: 999px; font-size: 0.8rem; margin-bottom: 16px; }
    </style>
</head>
<body>
<div class="container">
    <h1>✏️ Sửa Sinh Viên</h1>
    <div class="card">
        <span class="id-badge">ID: <?= (int)$student['id'] ?></span>

        <?php if (!empty($errors)): ?>
        <div class="errors">
            <?php foreach ($errors as $err): ?>
                <p>⚠ <?= htmlspecialchars($err) ?></p>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <form method="post" action="index.php?action=edit&id=<?= (int)$student['id'] ?>" novalidate>
            <div class="form-group">
                <label for="name">Họ và Tên</label>
                <input type="text" id="name" name="name"
                       value="<?= htmlspecialchars($student['name']) ?>"
                       placeholder="Nhập họ tên (ít nhất 3 ký tự)">
            </div>
            <div class="form-group">
                <label for="major">Ngành học</label>
                <input type="text" id="major" name="major"
                       value="<?= htmlspecialchars($student['major']) ?>"
                       placeholder="Nhập ngành học">
            </div>
            <div class="btn-row">
                <button type="submit" class="btn btn-warning">💾 Cập nhật</button>
                <a href="index.php?action=list" class="btn btn-secondary">← Quay lại</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
