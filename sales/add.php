<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <title>លក់ម៉ូតូ | MotoShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="card mx-auto shadow-sm border-0" style="max-width: 600px;">
        <div class="card-header bg-success text-white py-3"><h5><i class="bi bi-cart-plus"></i> បញ្ចូលការលក់ថ្មី</h5></div>
        <div class="card-body p-4">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">ជ្រើសរើសអតិថិជន</label>
                    <select name="customer_id" class="form-select" required>
                        <option value="">-- ជ្រើសរើសអតិថិជន --</option>
                     
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">ជ្រើសរើសម៉ូតូ (ក្នុងស្តុក)</label>
                    <select name="moto_id" class="form-select" id="motoSelect" required>
                        <option value="">-- ជ្រើសរើសម៉ូតូ --</option>
                       
                </div>
                <div class="mb-3">
                    <label class="form-label">តម្លៃលក់សរុប ($)</label>
                    <input type="number" step="0.01" name="total_amount" id="priceInput" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">វិធីបង់ប្រាក់</label>
                    <select name="payment_method" class="form-select">
                        <option value="Cash">សាច់ប្រាក់</option>
                        <option value="ABA/Bank">វេរតាមធនាគារ</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success w-100 py-2">បញ្ជាក់ការលក់</button>
            </form>
        </div>
    </div>
</div>
<script>
    // មុខងារដាក់តម្លៃអូតូពេលរើសម៉ូតូ
    document.getElementById('motoSelect').addEventListener('change', function() {
        var price = this.options[this.selectedIndex].getAttribute('data-price');
        document.getElementById('priceInput').value = price;
    });
</script>
</body>
</html>