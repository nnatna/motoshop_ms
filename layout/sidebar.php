<?php
$currentPage = basename($_SERVER['PHP_SELF'] ?? '');
$linkBaseActive = 'nav-link active bg-dark text-white rounded';
$linkBaseInactive = 'nav-link text-dark rounded hover-bg-secondary';
?>
<aside class="sidebar-wrapper d-flex flex-column" id="sidebar">
    <div class="p-4">
        <small class="text-secondary d-block text-muted">Logged in as:</small>
        <h5 class="fw-bold">
            <?php echo $_SESSION['full_name']; ?>
        </h5>
        <span class="text-danger rounded-pill fw-bold">
            <i class="bi bi-shield-lock-fill"></i>
            <?php echo $_SESSION['role']; ?>
        </span>
    </div>
    <hr>
    <ul class="nav flex-column mb-auto px-2">
        <li class="nav-item mb-1">
            <a href="index.php" class="<?php echo ($currentPage === 'index.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                <i class="bi bi-house-door me-1"></i>Dashboard
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="motos.php" class="<?php echo ($currentPage === 'motos.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                <i class="bi bi-speedometer2 me-1"></i>Motorcycle
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="customer.php" class="<?php echo ($currentPage === 'customer.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                <i class="bi bi-people me-1"></i>Customer
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="sales.php" class="<?php echo ($currentPage === 'sales.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                <i class="bi bi-cart4 me-1"></i>Sales
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="report.php" class="<?php echo ($currentPage === 'report.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                <i class="bi bi-bar-chart me-2"></i>Reports
            </a>
        </li>
        </li>
        <li class="nav-item mb-1">
            <a href="user.php" class="<?php echo ($currentPage === 'user.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                <i class="bi bi-person-gear me-1"></i>User
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="#" class="nav-link text-dark rounded hover-bg-secondary">
                <i class="bi bi-gear me-2"></i>Settings
            </a>
        </li>
    </ul>
    <hr>
    <div class="p-4 text-center">
        <a href="logout.php" class="btn btn-danger fw-bold rounded-pill"><i class="bi bi-box-arrow-right me-1"></i>Logout</a>
    </div>
</aside>