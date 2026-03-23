<?php
    $currentPage = basename($_SERVER['PHP_SELF'] ?? '');
    $linkBaseActive = 'nav-link active bg-dark text-white rounded';
    $linkBaseInactive = 'nav-link text-dark rounded hover-bg-secondary';
?>
<aside class="sidebar-wrapper d-flex flex-column" id="sidebar">
    <div class="p-3">
<i class='bi fa-user-shield me-2'></i>
    </div>
    <ul class="nav flex-column mb-auto px-2">
        <li class="nav-item mb-1">
            <a href="index.php" class="<?php echo ($currentPage === 'index.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                <i class="bi bi-house-door me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="motos.php" class="<?php echo ($currentPage === 'motos.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                <i class="bi bi-speedometer2 me-2"></i> Motorcycle
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="customer.php" class="<?php echo ($currentPage === 'customer.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                <i class="bi bi-people me-2"></i> Customer
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="sales.php" class="<?php echo ($currentPage === 'sales.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                <i class="bi bi-cart4 me-2"></i> Sales
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="user.php" class="<?php echo ($currentPage === 'user.php') ? $linkBaseActive : $linkBaseInactive; ?>">
                <i class="bi bi-person-gear me-2"></i> User
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="#" class="nav-link text-dark rounded hover-bg-secondary">
                <i class="bi bi-gear me-2"></i> Settings
            </a>
        </li>
    </ul>
</aside>