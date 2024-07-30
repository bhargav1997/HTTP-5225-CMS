<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    print_r($_POST);

    $className = $_POST['className'];
    $classType = $_POST['classType'];
    $instructorId = $_POST['instructorId'];

    // Include database connection
    include('../reusable/con.php');
    include('./functions.php');

    // Prepare SQL statement to prevent SQL injection
    $query = "INSERT INTO classes (`name`, `level`, `instructor_id`) VALUES 
        ('" . mysqli_real_escape_string($connect, $className) . "', 
         '" . mysqli_real_escape_string($connect, $classType) . "')";

    $result = mysqli_query($connect, $query);

    if (!$result) {
        set_messages('Error, Class Not Added', 'error');
        die("Query Failed: " . mysqli_error($connect));
    }

    set_messages('Class Added', 'success');

    mysqli_close($connect);

    header('Location: ../index.php');
    exit();
} else {
    header('Location: ../index.php');
    exit();
}
?>
