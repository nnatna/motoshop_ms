<?php include 'db.php'; // ភ្ជាប់ទៅកាន់ Database ?>
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>គ្រប់គ្រងអ្នកប្រើប្រាស់ | MotoShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Kantumruy Pro', sans-serif; background-color: #f4f7f6; }
        .user-card { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .avatar-circle { width: 40px; height: 40px; background: #e9ecef; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #0d6efd; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold"><i class="bi bi-people-fill text-primary"></i> គ្រប់គ្រងអ្នកប្រើប្រាស់</h3>
        <button class="btn btn-primary px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <i class="bi bi-person-plus-fill"></i> បន្ថែមអ្នកប្រើប្រាស់
        </button>
    </div>

    <div class="card user-card">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>រូបភាព</th>
                            <th>ឈ្មោះពេញ</th>
                            <th>ឈ្មោះគណនី (Username)</th>
                            <th>តួនាទី</th>
                            <th class="text-center">សកម្មភាព</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><div class="avatar-circle">A</div></td>
                            <td class="fw-bold">Administrator</td>
                            <td><code>admin_01</code></td>
                            <td><span class="badge bg-danger">ម្ចាស់ហាង</span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-shield-lock"></i></button>
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('លុបអ្នកប្រើប្រាស់នេះ?')"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><div class="avatar-circle">S</div></td>
                            <td>សុខ សំណាង</td>
                            <td><code>samnang_sales</code></td>
                            <td><span class="badge bg-info text-dark">បុគ្គលិកលក់</span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-warning me-1"><i class="bi bi-shield-lock"></i></button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">បង្កើតគណនីថ្មី</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="save_user.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">ឈ្មោះពេញ</label>
                        <input type="text" name="fullname" class="form-control" placeholder="ឧ. សុខ សំណាង" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">ឈ្មោះគណនី (Username)</label>
                        <input type="text" name="username" class="form-control" placeholder="សម្រាប់ Login" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">លេខសម្ងាត់ (Password)</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">តួនាទី</label>
                        <select name="role" class="form-select">
                            <option value="Admin">ម្ចាស់ហាង (Admin)</option>
                            <option value="Staff">បុគ្គលិក (Staff)</option>
                        </select>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary py-2 fw-bold">បង្កើតគណនី</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>