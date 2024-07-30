<?php
include './reusable/con.php';
include 'inc/functions.php';

$instructor_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($instructor_id == 0) {
    header('Location: about.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $bio = mysqli_real_escape_string($connect, $_POST['bio']);
    $photoUrl = mysqli_real_escape_string($connect, $_POST['photoUrl']);
    $phone = mysqli_real_escape_string($connect, $_POST['phone']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);

    $query = "UPDATE instructors SET name = '$name', bio = '$bio', photoUrl = '$photoUrl', phone = '$phone', email = '$email' WHERE id = $instructor_id";
    if (mysqli_query($connect, $query)) {
        header('Location: about.php');
        exit();
    } else {
        echo 'Error: ' . mysqli_error($connect);
    }
} else {
    $query = "SELECT * FROM instructors WHERE id = $instructor_id";
    $result = mysqli_query($connect, $query);
    $instructor = mysqli_fetch_assoc($result);
    if (!$instructor) {
        header('Location: about.php');
        exit();
    }
}
?>

<?php include "reusable/nav.php"; ?>

<div class="container mt-5">
    <h2>Edit Instructor</h2>
    <form action="edit_instructor.php?id=<?php echo $instructor_id; ?>" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($instructor['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($instructor['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea class="form-control" id="bio" name="bio" rows="3" required><?php echo htmlspecialchars($instructor['bio']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="photoUrl" class="form-label">Photo URL</label>
            <input type="text" class="form-control" id="photoUrl" name="photoUrl" value="<?php echo htmlspecialchars($instructor['photoUrl']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($instructor['phone']); ?>" required>
        </div>
        <button type="submit" class="btn btn-warning">Update Instructor</button>
    </form>
</div>

<?php include "reusable/footer.php"; ?>
