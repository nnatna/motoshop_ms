
<aside class="sidebar-wrapper d-flex flex-column" id="sidebar">
    <div class="p-3">
        <span class="text-uppercase text-secondary fw-bold fs-6 tracking-wide">Main Menu</span>
    </div>
    <ul class="nav flex-column mb-auto px-2">
        <li class="nav-item mb-1">
            <a href="index.php" class="nav-link text-dark rounded hover-bg-secondary">
                <i class="bi bi-house-door me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="motos.php" class="nav-link text-dark rounded hover-bg-secondary">
                <i class="bi bi-speedometer2 me-2"></i> Motos
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="customer.php" class="nav-link text-dark rounded hover-bg-secondary">
                <i class="bi bi-people me-2"></i> Customer
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="sales.php" class="nav-link text-dark rounded hover-bg-secondary">
                <i class="bi bi-cart4 me-2"></i> Sales
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="user.php" class="nav-link text-dark rounded hover-bg-secondary">
                <i class="bi bi-person-gear me-2"></i> User
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="#" class="nav-link text-dark rounded hover-bg-secondary">
                <i class="bi bi-gear me-2"></i> Settings
            </a>
        </li>
    </ul>
    <div class="p-3">
        <?php
            require('db.php');
            $userid = 1;
            if ($userid && ctype_digit((string)$userid)) {
                $sql = "SELECT * FROM users WHERE userid=" . (int)$userid . " LIMIT 1";
                $result = $conn->query($sql);
                if ($result && ($row = $result->fetch_assoc())) {
                    echo "<h4 class='text-uppercase text-secondary fw-bold fs-6 tracking-wide'>" . $row["full_name"] . "</h4>";
                    echo "<p class='text-muted'>" . $row["role"] . "</p>";
                } else {
                    echo "<h4>Guest</h4>";
                }
            } else {
                echo "<h4>Guest</h4>";
            }
            ?>
    </div>
</aside>