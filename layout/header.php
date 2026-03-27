<?php
session_start();
if (!isset($_SESSION['full_name'])) {
    header("Location: login.php");
    exit();
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container-fluid">
        <button class="btn btn-dark d-md-none me-2" type="button" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>

        <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
            <i class="bi bi-hexagon-fill text-primary me-2 fs-4"></i>
            <span class="brand-text d-none d-md-inline">MotoShop Management System</span>
        </a>

        <div class="ms-auto d-flex align-items-center">
            

            <div class="dropdown">
                <a href="#" class="text-light fs-4" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li>
                        <a class="dropdown-item" href="profile.php?uerid=<?php echo $_SESSION['userid']; ?>">
                            <i class="bi bi-person me-1"></i>Profile</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="logout.php">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>