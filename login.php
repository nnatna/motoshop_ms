<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motoshop Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .login-container { margin-top: 100px; max-width: 400px; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px d12px rgba(0,0,0,0.1); }
        .btn-primary { background-color: #d9534f; border: none; } /* Racing Red */
        .btn-primary:hover { background-color: #c9302c; }
    </style>
</head>
<body>

<div class="container login-container">
    <div class="card p-4">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-uppercase">Motoshop MS</h3>
        </div>
        
        <form action="auth.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <!-- <button type="submit" name="login" class="btn btn-primary w-100 py-2"><a href="index.php"></a>Login to Dashboard</button> -->
            <a href="index.php" class="btn btn-primary w-100 py-2">Login to Dashboard</a>
        </form>
        
        <div class="text-center mt-3">
        </div>
    </div>
</div>

</body>
</html>