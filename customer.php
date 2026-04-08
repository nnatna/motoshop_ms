<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moto Shop Management System</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.3.8/css/bootstrap.min.css?v=<?php echo time() ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/layout.css?v=<?php echo time() ?>">
</head>
<body>
    <?php include 'layout/header.php'; ?>
    <div class="main-wrapper">
        <?php include 'layout/sidebar.php'; ?>
        <main class="content-wrapper">
            <?php include 'customers/list.php'; ?>
        </main>
    </div>
    <?php include 'layout/footer.php';?>
</body>
</html>
</html>