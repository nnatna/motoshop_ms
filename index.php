<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotoShop Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/layout.css">
</head>

<body>
    <?php include 'layout/header.php'; ?>
    <div class="main-wrapper">
        <?php include 'layout/sidebar.php'; ?>
        <main class="content-wrapper">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <div>
                    <h3 class="fw-bold text-success"><i class="bi bi-clipboard2-data-fill me-1"></i>Dashboard</h3>
                    <p class="text-muted">Dashboard of motorcycle transactions in the shop</p>
                </div>
                <div>
                    <button type="button" class="btn btn-success rounded-pill fw-bold"><i class="bi bi-floppy-fill me-1"></i>DPF</button>
                </div>
            </div>
            <?php include "layout/statistic.php"; ?>
            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-box bg-primary-subtle text-primary me-3">
                                <i data-lucide="bike"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0"><?php echo countBrand($conn); ?></h3>
                                <p class="text-muted small mb-0">Total Brands</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-box bg-success-subtle text-success me-3">
                                <i data-lucide="package"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0"><?php echo countMoto($conn); ?></h3>
                                <p class="text-muted small mb-0">Moto in Stock</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-box bg-warning-subtle text-warning me-3">
                                <i data-lucide="users"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0"><?php echo countCustomer($conn);?></h3>
                                <p class="text-muted small mb-0">Total Customers</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-box bg-danger-subtle text-danger me-3">
                                <i data-lucide="alert-triangle"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0"><?php echo countowStock($conn); ?></h3>
                                <p class="text-muted small mb-0">Low Stock Alert</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row g-3 mb-4">
                <div class="col-lg-8">
                    <div class="table-container h-100">
                        <h6 class="fw-bold mb-4">Monthly Sales Revenue</h6>
                        <canvas id="salesChart" height="250"></canvas>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="table-container h-100 text-center">
                        <h6 class="fw-bold mb-4 text-start">Top Selling Brands</h6>
                        <canvas id="brandChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold mb-0">Recent Transactions</h6>
                    <a href="#" class="btn btn-sm btn-link text-decoration-none">View All</a>
                </div>
            </div>
        </main>
    </div>
    <?php include 'layout/footer.php'; ?>
</body>

</html>