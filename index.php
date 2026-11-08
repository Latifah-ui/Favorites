<?php
// تضمين ملف الاتصال بقاعدة البيانات
require_once 'db.php';

try {
    // جلب العناصر المفضلة أو بيانات رحلة ديار من قاعدة البيانات
    $stmt = $pdo->query("SELECT * FROM favorites");
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $items = [];
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مشروع ديار - DIYAR</title>
    <style>
        body {
            font-family: Tahoma, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
            direction: rtl;
            text-align: right;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .empty {
            text-align: center;
            color: #777;
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>مرحباً بكِ في مشروع ديار (DIYAR)</h1>
    <p style="text-align: center;">لوحة تحكم وعرض بيانات المفضلة والرحلات</p>

    <table>
        <thead>
            <tr>
                <th>المعرف (ID)</th>
                <th>التفاصيل / العناصر</th>
                <th>الوقت والتاريخ</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($row['item_name'] ?? $row['title'] ?? 'عنصر تفاعلي') ?></td>
                        <td><?= htmlspecialchars($row['created_at'] ?? 'غير متوفر') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="empty">لا توجد بيانات مضافة حتى الآن في قاعدة البيانات.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>