<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>បញ្ជីម៉ូតូ | MotoShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>body { font-family: 'Kantumruy Pro', sans-serif; background-color: #f8f9fa; }</style>
</head>
<body>
<div class="container py-5">
    <div class="d-flex justify-content-between mb-4">
        <h3><i class=""></i> គ្របគ្រងស្តុកម៉ូតូ</h3>
        <a href="add.php" class="btn btn-primary"><i class="bi bi-plus-lg"></i> បន្ថែមម៉ូតូថ្មី</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table id="motoTable" class="table table-hover">
                <thead>
                    <tr>
                        <th>ម៉ាក/ម៉ូដែល</th>
                        <th>លេខតួ</th>
                        <th>ឆ្នាំ</th>
                        <th>តម្លៃ</th>
                        <th>ស្ថានភាព</th>
                        <th class="text-end">សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <?php
                    $result = $conn->query("SELECT * FROM motos ORDER BY id DESC");
                    while($row = $result->fetch_assoc()):
                    ?> -->
                    <tr>
                        <td><strong><?php echo $row['brand']; ?></strong> <?php echo $row['model']; ?></td>
                        <td><code><?php echo $row['chassis_number']; ?></code></td>
                        <td><?php echo $row['year_made']; ?></td>
                        <td class="text-danger fw-bold">$<?php echo number_format($row['price'], 2); ?></td>
                        <td>
                            <span class="badge <?php echo ($row['status']=='Available')?'bg-success':'bg-secondary'; ?>">
                                <?php echo $row['status']; ?>
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('លុបម៉ូតូនេះ?')"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
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