<?php
$currentPage = basename($_SERVER['PHP_SELF'] ?? '');
$linkBaseActive = 'nav-link active bg-dark text-white rounded';
$linkBaseInactive = 'nav-link text-dark rounded hover-bg-secondary';
?>

<ul class="nav flex-column mb-auto p-2">
    <li class="nav-item fw-medium mb-1">
        <a href="settings.php" class="<?= ($currentPage === 'settings.php') ? $linkBaseActive : $linkBaseInactive ?>">
            <i class="fa-solid fa-user me-1"></i>Profile Settings
        </a>
    </li>
    <li class="nav-item fw-medium mb-1">
        <a href="system.php" class="<?= ($currentPage === 'system.php') ? $linkBaseActive : $linkBaseInactive ?>">
            <i class="fa-solid fa-cogs me-1"></i>System Settings
        </a>
    </li>
    <li class="nav-item fw-medium mb-1">
        <a href="brand.php" class="<?= ($currentPage === 'brand.php') ? $linkBaseActive : $linkBaseInactive ?>">
            <i class="fa-solid fa-tags me-1"></i>Brand Management
        </a>
    </li>
</ul>