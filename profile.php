<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Moto Shop MS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/layout.css">
    <style>
        .main-wrapper {
            display: flex;
            min-height: calc(100vh - 56px);
        }

        .content-wrapper {
            flex-grow: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }

        form {
            min-width: 400px;
            min-width: 500px;
        }
    </style>
</head>

<body>
    <?php include 'layout/header.php'; ?>

    <div class="main-wrapper">
        <?php include 'layout/sidebar.php'; ?>

        <main class="content-wrapper">
            <div class="container-fluid">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Edit Profile</li>
                    </ol>
                </nav>

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-bottom p-3">
                        <h4 class="mb-0 fw-bold"><i class="bi bi-person-gear me-2"></i>Edit Profile</h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="text-center">
                                    <i class="bi bi-person-circle text-secondary" style="font-size: 5rem;"></i>
                                    <p class="text-muted">Update your personal information</p>
                                </div>
                                <hr>
                                <form method="post">
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0 rounded-start-pill text-secondary">
                                                <p class="mb-0">Full Name</p>
                                            </span>
                                            <input type="text" class="form-control shadow-none border-dark-subtle border-start-0  rounded-end-pill" name="full_name" required>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2 justify-content-around mt-3">
                                        <div class="col-md-6">
                                            <div class="d-grid">

                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>

    <?php include 'layout/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>