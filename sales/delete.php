<?php 
require '../db.php'; // ត្រូវប្រាកដថា file នេះភ្ជាប់ទៅកាន់ database ត្រឹមត្រូវ

// ១. ទទួលយក ID ពី URL
if (isset($_GET["id"])) {
    $saleid = $_GET["id"];

    // ២. រៀបចំ SQL Statement (ប្រើ saleid ជាលក្ខខណ្ឌ)
    $sql = "DELETE FROM tblSales WHERE saleid = ?";
    
    $stmt = $conn->prepare($sql);
    
    // "i" មានន័យថា integer (ព្រោះ saleid ជាលេខ)
    $stmt->bind_param("i", $saleid);

    // ៣. អនុវត្តការលុប
    if ($stmt->execute()) {
        // បើលុបជោគជ័យ បញ្ជូនទៅកាន់ទំព័របញ្ជីលក់វិញ
        header("Location: ../sales.php?msg=deleted");
        exit();
    } else {
        // បើមានកំហុស
        echo "Error deleting record: " . $conn->error;
    }
    
    $stmt->close();
} else {
    echo "រកមិនឃើញ ID សម្រាប់ការលុបឡើយ!";
}

$conn->close();
?>