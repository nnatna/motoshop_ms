

<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>កែប្រែការលក់ | MotoShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Kantumruy Pro', sans-serif; background-color: #f4f7f6; }</style>
</head>
<body>
<div class="container py-5">
    <div class="card mx-auto shadow border-0" style="max-width: 600px; border-radius: 15px;">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">កែប្រែព័ត៌មានវិក្កយបត្រ </h5>
        </div>
        <div class="card-body p-4">
            <form method="POST">
                <input type="hidden" name="id" value="">
                <input type="hidden" name="old_moto_id" value="">

                <div class="mb-3">
                    <label class="form-label fw-bold">អតិថិជន</label>
                    <select name="customer_id" class="form-select" required>
                      
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">ម៉ូតូ</label>

                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">តម្លៃលក់ ($)</label>
                    <input type="number" step="0.01" name="total_amount" class="form-control" value="<?php echo $sale['total_amount']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">វិធីបង់ប្រាក់</label>
                  
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary py-2 fw-bold">រក្សាទុកការកែប្រែ</button>
                    <a href="list.php" class="btn btn-light border">បោះបង់</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>