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
        <li class="nav-item fw-medium mb-1">
            <a href="index.php" class="
            <?php echo ($currentPage === 'index.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                <i class="fa-solid fa-house me-1"></i>Dashboard
            </a>
        </li>
        <li class="nav-item fw-medium mb-1">
            <a href="motos.php" class="<?php echo ($currentPage === 'motos.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                <i class="fa-solid fa-motorcycle me-1"></i>Motorcycles
            </a>
        </li>
        <li class="nav-item fw-medium mb-1">
            <a href="customer.php" class="<?php echo ($currentPage === 'customer.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                <i class="fa-solid fa-user-group me-1"></i>Customers
            </a>
        </li>
        <li class="nav-item fw-medium mb-1">
            <a href="sales.php" class="<?php echo ($currentPage === 'sales.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                <i class="fa-solid fa-cart-shopping me-1"></i>Sales
            </a>
        </li>
        <li class="nav-item fw-medium mb-1">
            <a href="reports.php" class="<?php echo ($currentPage === 'reports.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                <i class="fa-solid fa-clipboard-list me-1"></i>Reports
            </a>
        </li>
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin'): ?>
            <li class="nav-item fw-medium mb-1">
                <a href="user.php" class="<?php echo ($currentPage === 'user.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                    <i class="fa-solid fa-user me-1"></i>Users
                </a>
            </li>
        <?php endif; ?>
        <li class="nav-item fw-medium mb-1">
            <a href="settings.php" class="<?php echo ($currentPage === 'settings.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                <i class="fa-solid fa-gear me-1"></i>Settings
            </a>
        </li>
    </ul>
    <hr>
    <div class="p-4 text-start">
        <a href="logout.php" class="fw-bold text-decoration-none text-danger">
            <i class="fa-solid fa-right-from-bracket me-1"></i>Logout
        </a>
    </div>
</aside>