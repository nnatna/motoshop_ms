<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>គ្រប់គ្រងម៉ូតូ | MotoShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Kantumruy Pro', sans-serif; background-color: #f8f9fa; }
        .table-card { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary"><i class="bi bi-bicycle"></i> ស្តុកម៉ូតូសរុប</h3>
        <a href="motos/add.php" class="btn btn-primary shadow-sm"><i class="bi bi-plus-circle"></i> បន្ថែមម៉ូតូថ្មី</a>
    </div>

    <div class="card table-card">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ម៉ាក & ម៉ូដែល</th>
                        <th>លេខតួ</th>
                        <th>ឆ្នាំ </th>
                        <th>តម្លៃលក់</th>
                        <th>ស្ថានភាព</th>
                        <th class="text-center pe-4">សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-4"><strong>Honda</strong> Dream 125</td>
                        <td><code>NC125-2024</code></td>
                        <td>2024</td>
                        <td class="text-danger fw-bold">$2,600</td>
                        <td><span class="badge bg-success text-white">Available</span></td>
                        <td class="text-center pe-4">
                            <a href="customers/edit.php" class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-pencil"></i></a>
                            <a href="customers/delete.php" class="btn btn-sm btn-outline-danger" onclick="return confirm('លុបម៉ូតូនេះ?')"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>