<?php

session_start(); // Start the session

include('../reusable/con.php');
include('./includes/admin_functions.php');

if (!isset($_GET['id'])) {
    header('Location: users.php');
    exit();
}

$userId = intval($_GET['id']);
$query = "SELECT * FROM users WHERE id = $userId LIMIT 1";
$result = mysqli_query($connect, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    header('Location: users.php');
    exit();
}

$record = mysqli_fetch_assoc($result);

if (isset($_POST['first'])) {
    if ($_POST['first'] && $_POST['last'] && $_POST['email']) {
        $first = mysqli_real_escape_string($connect, $_POST['first']);
        $last = mysqli_real_escape_string($connect, $_POST['last']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $active = mysqli_real_escape_string($connect, $_POST['active']);

        $query = "UPDATE users SET first = '$first', last = '$last', email = '$email', active = '$active' WHERE id = $userId LIMIT 1";
        if (mysqli_query($connect, $query)) {
            set_message('User has been updated');
        } else {
            set_message('Error updating user: ' . mysqli_error($connect));
        }

        if ($_POST['password']) {
            $password = md5($_POST['password']);
            $query = "UPDATE users SET password = '$password' WHERE id = $userId LIMIT 1";
            if (!mysqli_query($connect, $query)) {
                set_message('Error updating password: ' . mysqli_error($connect));
            }
        }

        header('Location: manage_users.php');
        exit();
    }
}

?>

<?php
  include('./includes/header.php');
  include('./includes/nav.php');
?>

<div class="container custom-spacing">
    <h2>Edit User</h2>
    <form method="post">
        <div class="mb-3">
            <label for="first" class="form-label">First:</label>
            <input type="text" class="form-control" id="first" name="first" value="<?php echo htmlspecialchars($record['first']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="last" class="form-label">Last:</label>
            <input type="text" class="form-control" id="last" name="last" value="<?php echo htmlspecialchars($record['last']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($record['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password (leave blank to keep current):</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="active" class="form-label">Active:</label>
            <select class="form-select" id="active" name="active" required>
                <option value="Yes" <?php if ($record['active'] == 'Yes') echo 'selected'; ?>>Yes</option>
                <option value="No" <?php if ($record['active'] == 'No') echo 'selected'; ?>>No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Edit User</button>
    </form>
    <p class="mt-3"><a href="manage_users.php"><i class="fas fa-arrow-circle-left"></i> Return to User List</a></p>
</div>

<?php include('../reusable/footer.php'); ?>
