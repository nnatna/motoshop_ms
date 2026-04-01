<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moto Shop Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/layout.css">
</head>

<body>
    <?php include 'layout/header.php'; ?>
    <?php 
    require("db.php");
    $start = $_POST['startdate'] ?? date('Y-m-01');
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

            <!-- Date Filter -->
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
                        <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">
                            <i class="fa-solid fa-filter me-1"></i> Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Report Table -->
            <div class="table-responsive bg-white rounded-4 shadow-sm p-3">
                <h5 class="text-success text-center fw-bold">Sales Report</h5>
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr class="table-secondary">
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Motorcycle</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            <th>Seller</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM vsales_report WHERE saledate BETWEEN '$start' AND '$end' ORDER BY saledate desc LIMIT $start_from, $limit;";
                        
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . date('d-M-Y', strtotime($row['saledate'])) . "</td>";
                                echo "<td class='fw-medium'>" . $row['cusname'] . "</td>";
                                echo "<td>" . $row['braname'] . " " . $row['modname'] . "</td>";
                                echo "<td>" . $row['quantity'] . "</td>";
                                echo "<td class='text-success fw-medium'>$" . number_format($row['amount'], 2) . "</td>";
                                echo "<td class='text-muted'><small>" . $row['full_name'] . "</small></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center py-4 text-muted'>No transactions found for this period.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <?php include 'layout/Pagination.php'; ?>
            </div>
        </main>
    </div>
    <?php include 'layout/footer.php'; ?>
</body>

</html>