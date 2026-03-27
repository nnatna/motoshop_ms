<?php require_once dirname(__DIR__) . "/db.php"; ?>

<?php
function countBrand($conn)
{
    $sql = "SELECT COUNT(*) AS total FROM tblbrand";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        return $row['total'];
    }
    return 0;
}
function countMoto($conn)
{
    $sql = "SELECT SUM(stock) AS total FROM tblmodel";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        return $row['total'];
    }
    return 0;
}

function countCustomer($conn)
{
    $sql = "SELECT COUNT(*) AS total FROM tblcustomers";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        return $row['total'];
    }
    return 0;
}

function countowStock($conn)
{
    $sql = "SELECT COUNT(*) AS total FROM tblmodel WHERE stock <= 5";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        return $row['total'];
    }
    return 0;
}
?>