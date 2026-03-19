

<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>របាយការណ៍លក់ | MotoShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { font-family: 'Kantumruy Pro', sans-serif; background-color: #f8f9fa; }
        .card { border-radius: 12px; border: none; }
        .table thead { background-color: #198754; color: white; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-success"><i class="bi bi-cart-check-fill"></i> ប្រវត្តិការលក់</h2>
            <p class="text-muted">ពិនិត្យមើលរាល់ប្រតិបត្តិការលក់ម៉ូតូក្នុងហាង</p>
        </div>
        <a href="sales/add.php" class="btn btn-success btn-lg">
            <i class="bi bi-plus-circle"></i> បង្កើតការលក់ថ្មី
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">លេខវិក្កយបត្រ</th>
                            <th>កាលបរិច្ឆេទ</th>
                            <th>អតិថិជន</th>
                            <th>ម៉ូដែលម៉ូតូ</th>
                            <th>តម្លៃសរុប</th>
                            <th>ប្រភេទបង់ប្រាក់</th>
                            <th class="text-center">សកម្មភាព</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <?php if ($result->num_rows > 0): ?>
                            <?php while($row = $result->fetch_assoc()): ?> -->
                            <tr>
                                <td class="ps-4 fw-bold">#INV-<?php echo str_pad($row['id'], 5, '0', STR_PAD_LEFT); ?></td>
                                <td><?php echo date('d-M-Y H:i', strtotime($row['sale_date'])); ?></td>
                                <td><?php echo $row['customer_name']; ?></td>
                                <td><span class="badge bg-light text-dark border"><?php echo $row['moto_model']; ?></span></td>
                                <td class="text-danger fw-bold">$<?php echo number_format($row['total_amount'], 2); ?></td>
                                <td>
                                    <?php if($row['payment_method'] == 'Cash'): ?>
                                        <i class="bi bi-cash-stack text-success"></i> សាច់ប្រាក់
                                    <?php else: ?>
                                        <i class="bi bi-credit-card text-primary"></i> វេរតាមធនាគារ
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="print_invoice.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-printer"></i>
                                        </a>
                                        <a href="delete_sale.php?id=<?php echo $row['id']; ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('តើអ្នកចង់លុបទិន្នន័យលក់នេះឬ?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">មិនទាន់មានទិន្នន័យលក់នៅឡើយ</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>