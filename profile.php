<?php
require("db.php");
$userid = $_SESSION['userid'];
if (isset($_POST['btnsubmit'])) {
    $fullname = $_POST["full_name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    if (!empty($password) && $password !== $cpassword) {
        $error = "Passwords do not match!";
    } else {
        if (!empty($password)) {
            $hashed = md5($password);
            $sql = "UPDATE tbluser SET full_name=?, username=?, password=? WHERE userid=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi", $fullname, $username, $hashed, $userid);
        } else {
            $sql = "UPDATE tbluser SET full_name=?, username=? WHERE userid=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $fullname, $username, $userid);
        }

        if ($stmt->execute()) {
            $_SESSION['full_name'] = $fullname;
            if (isset($_FILES['profile']) && !empty($_FILES['profile']['tmp_name'])) {
                $ext = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
                $filename = "profile" . $userid . "." . $ext;
                if (move_uploaded_file($_FILES['profile']['tmp_name'], "image/profile/" . $filename)) {
                    if ($conn->query("UPDATE tbluser SET profile_img='$filename' WHERE userid=$userid")) {
                        $_SESSION['profile_img'] = $filename;
                    }
                }
            }
            $success = "Profile updated successfully!";
        } else {
            $error = "Error updating profile: " . $conn->error;
        }
    }
}
$sql = "SELECT * FROM tbluser WHERE userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>


<div class="d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="text-center">
            <div class="position-relative d-inline-block">
                <img src="image/profile/<?php echo $user['profile_img'] ?: 'default.jpg'; ?>"
                    id="picture"
                    class="rounded-circle img-thumbnail"
                    style="width: 150px; height: 150px; object-fit: cover; cursor: pointer;"
                    onclick="document.getElementById('profile').click();">
                <div class="position-absolute bottom-0 end-0 bg-dark text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                    style="width: 40px; height: 40px; cursor: pointer; border: 3px solid white;"
                    onclick="document.getElementById('profile').click();">
                    <i class="fas fa-camera"></i>
                </div>
            </div>
            <p class="text-muted small mt-2">Click photo to change</p>
        </div>


        <form method="post" class="p-4" enctype="multipart/form-data">
            <div class="mb-3">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger py-2 text-center"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php if (isset($success)): ?>
                    <div class="alert alert-success py-2 text-center"><?php echo $success; ?></div>
                <?php endif; ?>
            </div>
            <input type="file" name="profile" id="profile" class="d-none" onchange="showimg()" accept="image/*">

            <div class="mb-3">
                <label class="form-label text-muted fw-bold d-block text-start">Full Name</label>
                <input type="text" class="form-control rounded-pill shadow-none border-dark-subtle"
                    name="full_name" value="<?php echo $user['full_name']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-muted fw-bold d-block text-start">Username</label>
                <input type="text" class="form-control rounded-pill shadow-none border-dark-subtle"
                    name="username" value="<?php echo $user['username']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label text-muted fw-bold d-block text-start">New Password</label>
                <input type="password" class="form-control rounded-pill shadow-none border-dark-subtle"
                    name="password" placeholder="Enter new password">
            </div>

            <div class="mb-3">
                <label class="form-label text-muted fw-bold d-block text-start">Confirm New Password</label>
                <input type="password" class="form-control rounded-pill shadow-none border-dark-subtle"
                    name="cpassword" placeholder="Confirm new password">
            </div>

            <div class="d-flex gap-2 justify-content-around mt-3">
                <button type="submit" name="btnsubmit" class="btn btn-success w-100 rounded-pill fw-bold">Update Profile</button>
                <a href="settings.php" class="btn btn-secondary w-100 rounded-pill">Cancel</a>
            </div>
        </form>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>