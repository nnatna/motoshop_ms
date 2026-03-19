
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>ប្រវត្តិលក់ | MotoShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>body { font-family: 'Kantumruy Pro', sans-serif; background-color: #f4f7f6; }</style>
</head>
<body>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><i class="bi bi-receipt-cutoff text-success"></i> ប្រវត្តិការលក់</h3>
        <a href="add.php" class="btn btn-success"><i class="bi bi-cart-plus"></i> លក់ម៉ូតូថ្មី</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table id="salesTable" class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>កាលបរិច្ឆេទ</th>
                        <th>អតិថិជន</th>
                        <th>ម៉ូតូ</th>
                        <th>តម្លៃសរុប</th>
                        <th>ការបង់ប្រាក់</th>
                        <th class="text-center">សកម្មភាព</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- <?php
                    $sql = "SELECT sales.*, customers.name, motos.brand, motos.model 
                            FROM sales 
                            JOIN customers ON sales.customer_id = customers.id 
                            JOIN motos ON sales.moto_id = motos.id 
                            ORDER BY sales.id DESC";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()):
                    ?> -->
                    <tr>
                        <td><?php echo date('d-m-Y H:i', strtotime($row['sale_date'])); ?></td>
                        <td class="fw-bold"><?php echo $row['name']; ?></td>
                        <td><?php echo $row['brand'] . " " . $row['model']; ?></td>
                        <td class="text-danger fw-bold">$<?php echo number_format($row['total_amount'], 2); ?></td>
                        <td><span class="badge bg-info text-dark"><?php echo $row['payment_method']; ?></span></td>
                        <td class="text-center">
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('លុបការលក់នេះ?')"><i class="bi bi-trash"></i></a>
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
<script>$(document).ready(function() { $('#salesTable').DataTable({ "order": [[0, "desc"]] }); });</script>
</body>
</html>