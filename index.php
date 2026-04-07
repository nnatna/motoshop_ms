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
    <link rel="stylesheet" href="./assets/css/layout.css<?php time() ?>">
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
            </div>
            <div class="card bg-white p-3 rounded-4 mb-4">
                <form method="post" class="row g-3 align-items-end">
                    <div class="col-md-auto">
                        <label class="form-label small fw-bold">Start Date</label>
                        <input type="date" name="startdate" class="form-control form-control shadow-none border-dark-subtle rounded-pill"
                            value="<?php echo $start; ?>">
                    </div>
                    <div class="col-md-auto">
                        <label class="form-label small fw-bold">End Date</label>
                        <input type="date" name="enddate" class="form-control form-control shadow-none border-dark-subtle rounded-pill"
                            value="<?php echo $end; ?>">
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary rounded-circle fw-bold">
                            <i class="fa-solid fa-filter"></i>
                        </button>
                    </div>
                </form>
            </div>


            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card h-100 border-success">
                        <div class="card-body d-flex text-success align-items-center">
                            <div class="icon-box fs-1 me-3">
                                <i class="fa-solid fa-cart-shopping me-1"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0">$<?php echo number_format($total_income); ?></h3>
                                <p class="text-muted small mb-0">Revenue by Sale</p>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card h-100">
                        <div class="card-body d-flex text-info align-items-center">
                            <div class="icon-box fs-1 me-3">
                                <i class="fa-solid fa-clock-rotate-left me-1"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0"><?php echo sprintf("%02d", mysqli_num_rows($res_recent)); ?></h3>
                                <p class="text-muted small mb-0">Recent Sales</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card h-100">
                        <div class="card-body d-flex  text-primary align-items-center">
                            <div class="icon-box fs-1 me-3">
                                <i class="fa-solid fa-warehouse"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0"><?php echo sprintf("%02d", $total_stock); ?></h3>
                                <p class="text-muted small mb-0">Motorcycle in Stock</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card h-100 border-start <?php echo ($low_stock_count > 5) ? 'border-danger' : ''; ?>">
                        <div class="card-body d-flex align-items-center">
                            <div class="icon-box fs-1 me-3 text-danger">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0 text-danger">
                                    <?php echo sprintf("%02d", $low_stock_count); ?>
                                </h3>
                                <p class="text-muted small mb-0 font-weight-bold">Low Stock Alert</p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card h-100">
                        <div class="card-body d-flex text-primary lign-items-center">
                            <div class="icon-box fs-1 me-3">
                                <i class="fa-solid fa-motorcycle me-1"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0"><?php echo sprintf("%02d", $total_sold); ?></h3>
                                <p class="text-muted small mb-0">Total Sold</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card h-100 <?php echo ($hard_to_sell_count > 0) ? 'border-warning' : ''; ?>">
                        <div class="card-body d-flex text-warning align-items-center">
                            <div class="icon-box fs-1 me-3">
                                <i class="fa-solid fa-hourglass-half"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0"><?php echo sprintf("%02d", $hard_to_sell_count); ?></h3>
                                <p class="text-muted small mb-0">Hard to Sell Items</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card h-100">
                        <div class="card-body d-flex text-warning align-items-center">
                            <div class="icon-box fs-1  me-3">
                                <i class="fa-solid fa-user-group me-1"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0"><?php echo sprintf("%02d", $total_customers); ?></h3>
                                <p class="text-muted small mb-0">Total Customers</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card stat-card h-100">
                        <div class="card-body d-flex text-secondary align-items-center">
                            <div class="icon-box fs-1  me-3">
                                <i class="bi bi-archive-fill"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold  mb-0"><?php echo sprintf("%02d", $total_brands); ?></h3>
                                <p class="text-muted  small mb-0">Total Brands</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-12 col-lg-6">
                    <div class="card stat-card h-100">
                        <div class="card-body" id="chartContainer" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card stat-card h-100">
                        <div class="card-body" id="employeeChartContainer" style="height: 370px; width: 100%;"></div>
                    </div>
                </div>
            </div>

        </main>
    </div>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "Revenue by Brand",
                    fontFamily: "Inter, sans-serif",
                    fontWeight: "bold"
                },
                axisY: {
                    title: "Total Revenue ($)",
                    prefix: "$",
                    includeZero: true
                },
                data: [{
                    type: "bar", // Try "pie", "bar", or "line"
                    yValueFormatString: "$#,##0.00",
                    indexLabel: "{y}",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

            var employeeChart = new CanvasJS.Chart("employeeChartContainer", {
                animationEnabled: true,
                theme: "light1",
                title: {
                    text: "Revenue by Employee",
                    fontFamily: "Inter, sans-serif",
                    fontWeight: "bold"
                },
                axisY: {
                    title: "Total Revenue ($)",
                    prefix: "$",
                    includeZero: true
                },
                data: [{
                    type: "pie",
                    yValueFormatString: "$#,##0.00",
                    indexLabel: "{y}",
                    dataPoints: <?php echo json_encode($employeeDataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            employeeChart.render();
        }
    </script>

    <?php include 'layout/footer.php'; ?>
</body>

</html>