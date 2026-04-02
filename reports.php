<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moto Shop Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/layout.css?v=1">
    <link rel="stylesheet" href="./assets/css/table.css?v=1">
</head>

<body>
    <?php include 'layout/header.php'; ?>
    <?php
    require("db.php");
    $start = $_POST['startdate'] ?? date('Y-m-t', strtotime('-1 month'));
    $end = $_POST['enddate'] ?? date('Y-m-t');

    // Pagination logic
    $limit = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start_from = ($page - 1) * $limit;

    $count_sql = "SELECT COUNT(*) as total FROM tblsales WHERE saledate BETWEEN '$start' AND '$end'";
    $total_results = $conn->query($count_sql)->fetch_assoc()['total'];
    $pages = ceil($total_results / $limit);
    ?>
    <div class="main-wrapper">
        <?php include 'layout/sidebar.php'; ?>
        <main class="content-wrapper">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h3 class="fw-bold text-success"><i class="fa-solid fa-clipboard-list me-1"></i>List Of Reports</h3>
                    <p class="text-muted">List all reports of motorcycle transactions in the shop</p>
                </div>
                <div>
                    <button type="button" class="btn btn-success rounded-pill fw-bold" onclick="window.print()">
                        <i class="bi bi-printer-fill me-1"></i> Print Report
                    </button>
                </div>
            </div>

            <div class="bg-white p-3 rounded-4 shadow-sm mb-4">
                <form method="post" class="row g-3 align-items-end">
                    <div class="col-md-auto">
                        <label class="form-label small fw-bold text-muted">From Date</label>
                        <input type="date" name="startdate" class="form-control shadow-none border-dark-subtle rounded-pill" value="<?php echo $start; ?>">
                    </div>
                    <div class="col-md-auto">
                        <label class="form-label small fw-bold text-muted">To Date</label>
                        <input type="date" name="enddate" class="form-control shadow-none border-dark-subtle rounded-pill" value="<?php echo $end; ?>">
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary rounded-circle">
                            <i class="fa-solid fa-filter"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="bg-white p-3 rounded-4 shadow-sm mb-4">
                <ul class="nav nav-pills d-flex justify-content-center gap-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active px-4" id="pills-customer-tab" data-bs-toggle="pill" data-bs-target="#customer_report" type="button" role="tab">Customer Report</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link px-4" id="pills-employee-tab" data-bs-toggle="pill" data-bs-target="#employee_report" type="button" role="tab">Employee Report</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link px-4" id="pills-motos-tab" data-bs-toggle="pill" data-bs-target="#motos_report" type="button" role="tab">Motos Report</button>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="customer_report" role="tabpanel">
                    <?php include 'reports/customer_report.php'; ?>
                </div>
                <div class="tab-pane fade" id="employee_report" role="tabpanel">
                    <?php include 'reports/employee_report.php'; ?>
                </div>
                <div class="tab-pane fade" id="motos_report" role="tabpanel">
                    <?php include 'reports/motos_report.php'; ?>
                </div>
            </div>

        </main>
    </div>
    <?php include 'layout/footer.php'; ?>
</body>

</html>