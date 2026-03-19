<!-- <?php
include '../db_connect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $chassis = $_POST['chassis_number'];
    $year = $_POST['year_made'];
    $price = $_POST['price'];

    $sql = "INSERT INTO motos (brand, model, chassis_number, year_made, price, status) 
            VALUES ('$brand', '$model', '$chassis', '$year', '$price', 'Available')";
    if ($conn->query($sql)) { header("Location: list.php"); }
}
?> -->
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>បន្ថែមម៉ូតូ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card mx-auto shadow-sm" style="max-width: 600px;">
        <div class="card-header bg-primary text-white text-center"><h5>បញ្ចូលម៉ូតូថ្មី</h5></div>
        <div class="card-body p-4">
            <form method="POST">
                <div class="mb-3"><label class="form-label">ម៉ាក (Brand)</label><input type="text" name="brand" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">ម៉ូដែល (Model)</label><input type="text" name="model" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">លេខតួ (Chassis)</label><input type="text" name="chassis_number" class="form-control" required></div>
                <div class="row">
                    <div class="col-6 mb-3"><label class="form-label">ឆ្នាំ</label><input type="number" name="year_made" class="form-control" value="2024"></div>
                    <div class="col-6 mb-3"><label class="form-label">តម្លៃ ($)</label><input type="number" step="0.01" name="price" class="form-control" required></div>
                </div>
                <button type="submit" class="btn btn-primary w-100">រក្សាទុក</button>
                <a href="list.php" class="btn btn-link w-100 mt-2 text-decoration-none text-muted">បោះបង់</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>