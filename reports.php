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
            <div class="d-flex justify-content-between align-items-center mb-1">
                <div>
                    <h3 class="fw-bold text-success"><i class="bi bi-clipboard2-data-fill me-1"></i>List Of Reports</h3>
                    <p class="text-muted">List all reports of motorcycle transactions in the shop</p>
                </div>
                <div>
                    <button type="button" class="btn btn-success rounded-pill fw-bold"><i class="bi bi-floppy-fill me-1"></i>DPF</button>
                </div>
            </div>
        </main>
    </div>
    <?php include 'layout/footer.php'; ?>
</body>

</html>

</html>