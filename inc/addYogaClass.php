<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    print_r($_POST);

    $className = $_POST['className'];
    $classType = $_POST['classType'];
    $instructorId = $_POST['instructorId'];
    $imagePath = '';
    if(isset($_FILES['ClassImg']) && $_FILES['ClassImg']['error'] == 0) {
        $uploadDir = '../images/'; // Make sure this directory exists and is writable
        $fileName = basename($_FILES['ClassImg']['name']);
        $targetFilePath = $uploadDir . $fileName;
        
        // Move the uploaded file to the specified directory
        if(move_uploaded_file($_FILES['ClassImg']['tmp_name'], $targetFilePath)) {
            $imagePath = 'images/' . $fileName; // Store the relative path in the database
        } else {
            set_messages('Error uploading file.', 'error');
            header('Location: ../index.php');
            exit();
        }
    }
    // Include database connection
    include('../reusable/con.php');
    include('./functions.php');

    // Prepare SQL statement to prevent SQL injection
    $query = "INSERT INTO classes (`name`, `level`, `instructor_id`, `imagePath`) VALUES 
        ('" . mysqli_real_escape_string($connect, $className) . "', 
         '" . mysqli_real_escape_string($connect, $classType) . "',
         '" . mysqli_real_escape_string($connect, $instructorId) . "',
         '" . mysqli_real_escape_string($connect, $imagePath) . "')";

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
