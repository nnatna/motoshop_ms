<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moto Shop Management System</title>
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
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-3 mb-4 border-bottom">
                <h1 class="h2 fw-bold text-dark">Dashboard Overview</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="button" class="btn btn-sm btn-outline-primary d-flex align-items-center gap-1">
                        <i class="bi bi-download"></i> Export Report
                    </button>
                </div>
            </div>
            <div class="row g-4 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="card-title text-muted mb-0">Total Sales</h6>
                                <div class="bg-primary bg-opacity-10 p-2 rounded-3 text-primary">
                                    <i class="bi bi-currency-dollar fs-5"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold mb-1">$24,500</h3>
                            <p class="text-success small mb-0"><i class="bi bi-arrow-up"></i> +12% from last week</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="card-title text-muted mb-0">New Users</h6>
                                <div class="bg-success bg-opacity-10 p-2 rounded-3 text-success">
                                    <i class="bi bi-people fs-5"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold mb-1">1,250</h3>
                            <p class="text-success small mb-0"><i class="bi bi-arrow-up"></i> +5% from last week</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                    <h5 class="fw-bold">Recent Activity</h5>
                </div>
                <div class="card-body p-4">
                    <p class="text-secondary">This is your main content area. Any PHP files you create for different pages will follow this same structure: include the header, include the sidebar, put your page content here, and then include the footer.</p>
                </div>
            </div>
        </main>
    </div>

    <?php 
    include 'layout/footer.php'; 
    ?>
</body>
</html>