<?php
include './reusable/con.php';

$instructor_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($instructor_id > 0) {
    $query = "DELETE FROM instructors WHERE id = $instructor_id";
    if (mysqli_query($connect, $query)) {
        header('Location: about.php');
        exit();
    } else {
        echo 'Error: ' . mysqli_error($connect);
    }
} else {
    header('Location: about.php');
    exit();
}
?>
