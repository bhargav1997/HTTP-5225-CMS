<?php
include './reusable/con.php';
include 'inc/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $bio = mysqli_real_escape_string($connect, $_POST['bio']);
    $photoUrl = mysqli_real_escape_string($connect, $_POST['photoUrl']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);

    $query = "INSERT INTO instructors (name, bio, photoUrl, phone, email) VALUES ('$name', '$bio', '$photoUrl', '$phone', '$email')";
    if (mysqli_query($connect, $query)) {
        header('Location: about.php');
        exit();
    } else {
        echo 'Error: ' . mysqli_error($connect);
    }
}
?>

<?php include "reusable/nav.php"; ?>

<div class="container mt-5">
    <h2>Add Instructor</h2>
    <form action="add_instructor.php" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required placeholder="Enter Instructor name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required placeholder="Enter Instructor email">
        </div>
        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea class="form-control" id="bio" name="bio" rows="3" required placeholder="Enter Instructor bio"></textarea>
        </div>
        <div class="mb-3">
            <label for="photoUrl" class="form-label">Photo URL</label>
            <input type="text" class="form-control" id="photoUrl" name="photoUrl" required placeholder="Enter Instructor photo URL">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required placeholder="Enter Instructor phone number (ex: 123-456-7890)">
        </div>
        <button type="submit" class="btn btn-success">Add Instructor</button>
    </form>
</div>

<?php include "reusable/footer.php"; ?>
