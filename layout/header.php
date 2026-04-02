<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
            <?php
            require("db.php");
            $logoQuery = $conn->query("SELECT logo FROM tbllogo WHERE id = 1");
            $logoRow = $logoQuery->fetch_assoc();
            if ($logoRow) {
                $logo = $logoRow['logo'];
            } else {
                $logo = 'default.jpg';
            }
            ?>
            <img src="./image/logo/<?php echo $logo; ?>" alt="Logo" class="me-2 rounded-circle border border-light shadow-sm" style="width: 35px; height: 35px; object-fit: cover;">
            <span class="brand-text d-none d-md-inline">MotoShop Management System</span>
        </a>

        <div class="ms-auto d-flex">
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none" data-bs-toggle="dropdown">
                    <?php $header_pic = !empty($_SESSION['profile_img']) ? $_SESSION['profile_img'] : 'default.jpg'; ?>
                    <img src="./image/profile/<?php echo $header_pic; ?>" alt="User" 
                         class="rounded-circle border border-light shadow-sm" style="width: 35px; height: 35px; object-fit: cover;">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li>
                        <a class="dropdown-item" href="settings.php?userid=<?php echo $_SESSION['userid']; ?>">
                            <i class="fa-solid fa-user me-1"></i>Profile</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="logout.php">
                            <i class="fa-solid fa-right-from-bracket me-1"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>