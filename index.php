<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotoShop Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/layout.css">
</head>

<body>
    <?php include "layout/statistic.php"; ?>
    <?php include 'layout/header.php'; ?>
    <div class="main-wrapper">
        <?php include 'layout/sidebar.php'; ?>
        <main class="content-wrapper">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <div>
                    <h3 class="fw-bold text-success"><i class="fa-solid fa-house me-1"></i>Dashboard</h3>
                    <p class="text-muted">Dashboard of motorcycle transactions in the shop</p>
                </div>
                <div>
                    <button type="button" class="btn btn-success rounded-pill fw-bold">
                        <i class="bi bi-floppy-fill me-1"></i>DPF
                    </button>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card h-100 border-success">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-box fs-1 text-success me-3">
                                <i class="fa-solid fa-cart-shopping me-1"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold text-success mb-0">$<?php echo number_format($total_income); ?></h3>
                                <p class="text-muted small mb-0">Total Income</p>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-box fs-1 text-primary me-3">
                                <i class="fas fa-warehouse"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0"><?php echo number_format($total_stock); ?></h3>
                                <p class="text-muted small mb-0">Motorcycle in Stock</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-box fs-1 text-warning me-3">
                                <i class="fa-solid fa-user-group me-1"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0"><?php echo number_format($total_customers); ?></h3>
                                <p class="text-muted small mb-0">Total Customers</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-box fs-1 text-secondary me-3">
                                <i class="bi bi-archive-fill"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0"><?php echo number_format($total_brands); ?></h3>
                                <p class="text-muted small mb-0">Total Brands</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card h-100 <?php echo ($low_stock_count > 0) ? 'border-danger' : ''; ?>">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-box text-danger fs-1 me-3">
                                <i class="bi bi-speedometer me-1"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0 text-danger"><?php echo sprintf("%02d", $low_stock_count); ?></h3>
                                <p class="text-muted small mb-0">Low Stock Alert</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </div>
    <?php include 'layout/footer.php'; ?>
</body>

</html>