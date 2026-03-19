
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>បន្ថែមអតិថិជនថ្មី | MotoShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { font-family: 'Kantumruy Pro', sans-serif; background-color: #f4f7f6; }
        .card-custom { border: none; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .form-label { font-weight: 600; color: #555; }
        .btn-save { border-radius: 10px; padding: 10px 30px; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="mb-3">
                <a href="list.php" class="text-decoration-none text-muted">
                    <i class="bi bi-arrow-left"></i> ត្រឡប់ទៅបញ្ជីអតិថិជន
                </a>
            </div>

            <div class="card card-custom">
                <div class="card-header bg-white border-0 pt-4 px-4 text-center">
                    <h3 class="fw-bold text-primary">បន្ថែមអតិថិជនថ្មី</h3>
                    <p class="text-muted">សូមបំពេញព័ត៌មានអតិថិជនខាងក្រោម</p>
                </div>

                <div class="card-body p-4">
                    <!-- <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?> -->

                    <!-- <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="needs-validation" novalidate> -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name" class="form-label">ឈ្មោះអតិថិជន <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="ឈ្មោះពេញ" required>
                                    <div class="invalid-feedback">សូមបញ្ចូលឈ្មោះអតិថិជន</div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">លេខទូរស័ព្ទ <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-telephone"></i></span>
                                    <input type="tel" name="phone" class="form-control" id="phone" placeholder="012 345 678" required>
                                    <div class="invalid-feedback">សូមបញ្ចូលលេខទូរស័ព្ទ</div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">អ៊ីមែល (បើមាន)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="example@mail.com">
                                </div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="address" class="form-label">អាសយដ្ឋាន</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="bi bi-geo-alt"></i></span>
                                    <textarea name="address" class="form-control" id="address" rows="3" placeholder="ផ្ទះលេខ, ផ្លូវ, ខណ្ឌ..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-save shadow">
                                <i class="bi bi-check-lg"></i> រក្សាទុកទិន្នន័យ
                            </button>
                            <button type="reset" class="btn btn-light border">សម្អាត Form</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// ស្គ្រីបសម្រាប់ Bootstrap Validation
(() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})()
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>