<!-- <!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>គ្រប់គ្រងទិន្នន័យម៉ូតូ | MotoShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { font-family: 'Kantumruy Pro', sans-serif; background-color: #f4f7f6; }
        .moto-img { width: 60px; height: 60px; object-fit: cover; border-radius: 8px; }
        .card { border-radius: 15px; border: none; }
        .table thead { background-color: #212529; color: white; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h3 class="fw-bold text-primary"><i class="bi bi-bicycle"></i> បញ្ជីម៉ូតូក្នុងស្តុក</h3>
            <p class="text-muted">គ្រប់គ្រងព័ត៌មានម៉ូតូ និងតម្លៃលក់</p>
        </div>
        <div class="col-md-6 text-md-end">
            <button class="btn btn-primary btn-lg shadow-sm" data-bs-toggle="modal" data-bs-target="#addMotoModal">
                <i class="bi bi-plus-circle"></i>  បន្ថែមម៉ូតូថ្មី
            </button>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>រូបភាព</th>
                            <th>ម៉ាក & ម៉ូដែល</th>
                            <th>លេខតួ / ម៉ាស៊ីន</th>
                            <th>ឆ្នាំផលិត</th>
                            <th>តម្លៃលក់</th>
                            <th>ស្ថានភាព</th>
                            <th class="text-center">សកម្មភាព</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img src="https://via.placeholder.com/60" class="moto-img" alt="moto"></td>
                            <td>
                                <div class="fw-bold">Honda Dream 125</div>
                                <small class="text-muted">ពណ៌ខ្មៅ (Black Gold)</small>
                            </td>
                            <td>NC125-1234567</td>
                            <td>2024</td>
                            <td class="text-danger fw-bold">$2,650</td>
                            <td><span class="badge bg-success">មានក្នុងស្តុក</span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-info me-1"><i class="bi bi-pencil-square"></i></button>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addMotoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">បញ្ចូលព័ត៌មានម៉ូតូថ្មី</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="save_moto.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ម៉ាកម៉ូតូ (Brand)</label>
                            <select class="form-select" name="brand">
                                <option value="Honda">Honda</option>
                                <option value="Suzuki">Suzuki</option>
                                <option value="Yamaha">Yamaha</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ម៉ូដែល (Model)</label>
                            <input type="text" name="model" class="form-control" placeholder="ឧ. Dream 125" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">លេខតួ (Chassis Number)</label>
                            <input type="text" name="chassis" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">ឆ្នាំផលិត</label>
                            <input type="number" name="year" class="form-control" value="2024">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">តម្លៃ ($)</label>
                            <input type="number" step="0.01" name="price" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">រូបភាពម៉ូតូ</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">បោះបង់</button>
                    <button type="submit" class="btn btn-primary">រក្សាទុកទិន្នន័យ</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> -->
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>គ្រប់គ្រងម៉ូតូ | MotoShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Kantumruy Pro', sans-serif; background-color: #f8f9fa; }</style>
</head>
<body>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary"><i class="bi bi-bicycle"></i> បញ្ជីម៉ូតូក្នុងហាង</h3>
        <a href="motos/add.php" class="btn btn-primary shadow-sm"><i class="bi bi-plus-circle"></i> បន្ថែមម៉ូតូថ្មី</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
            <table id="motoTable" class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ម៉ាក & ម៉ូដែល</th>
                        <th>លេខតួ</th>
                        <th>ឆ្នាំផលិត</th>
                        <th>តម្លៃលក់</th>
                        <th>ស្ថានភាព</th>
                        <th class="text-center">សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <?php
                    $result = $conn->query("SELECT * FROM motos ORDER BY id DESC");
                    while($row = $result->fetch_assoc()):
                    ?> -->
                    <tr>
                        <td><strong><?php echo $row['brand']; ?></strong> <?php echo $row['model']; ?></td>
                        <td><span class="badge bg-light text-dark border"><?php echo $row['chassis_number']; ?></span></td>
                        <td><?php echo $row['year_made']; ?></td>
                        <td class="text-danger fw-bold">$<?php echo number_format($row['price'], 2); ?></td>
                        <!-- <td>
                            <?php if($row['status'] == 'Available'): ?>
                                <span class="badge bg-success">ក្នុងស្តុក</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">លក់ដាច់</span>
                            <?php endif; ?>
                        </td> -->
                        <td class="text-center">
                            <a href="motos/edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                            <a href="motos/delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('តើអ្នកពិតជាចង់លុបទិន្នន័យម៉ូតូនេះមែនទេ?')"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <!-- <?php endwhile; ?> -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>$(document).ready(function() { $('#motoTable').DataTable(); });</script>
</body>
</html>