<?php

include('../reusable/con.php');
include('./includes/admin_functions.php');

if (isset($_POST['first'])) {
    if ($_POST['first'] && $_POST['last'] && $_POST['email'] && $_POST['password']) {
        $first = mysqli_real_escape_string($connect, $_POST['first']);
        $last = mysqli_real_escape_string($connect, $_POST['last']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $password = md5($_POST['password']);
        $active = mysqli_real_escape_string($connect, $_POST['active']);

        $query = "INSERT INTO users (first, last, email, password, active) VALUES ('$first', '$last', '$email', '$password', '$active')";
        if (mysqli_query($connect, $query)) {
            set_message('User has been added');
        } else {
            set_message('Error adding user: ' . mysqli_error($connect));
        }

        header('Location: index.php');
        exit();
    }
}

?>

<?php
  include('./includes/header.php');
  include('./includes/nav.php');
?>

<div class="container custom-spacing">
    <h2>Add User</h2>
    <form method="post">
        <div class="mb-3">
            <label for="first" class="form-label">First Name:</label>
            <input type="text" class="form-control" id="first" name="first" required>
        </div>
        <div class="mb-3">
            <label for="last" class="form-label">Last Name:</label>
            <input type="text" class="form-control" id="last" name="last" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="active" class="form-label">Active:</label>
            <select class="form-select" id="active" name="active" required>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Add User</button>
    </form>
    <p class="mt-3"><a href="index.php"><i class="fas fa-arrow-circle-left"></i> Return to User List</a></p>
</div>

<?php include('../reusable/footer.php'); ?>
