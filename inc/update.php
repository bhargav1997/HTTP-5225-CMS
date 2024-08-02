<?php
    include('../reusable/con.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $className = $_POST['className'];
        $classType = $_POST['classType'];
        $instructorId = $_POST['instructorId'];
        $imagePath = $_POST['currentImage'];
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
 
        // echo $ima0gePath;
        $sql = "UPDATE classes SET `name` = '$className', `level` = '$classType', `instructor_id` = '$instructorId', `imagePath` = '$imagePath' WHERE id = '$id'";
    
        $result = mysqli_query($connect, $sql);
        if($result) {
            header("Location: ../index.php");
            set_messages('Class Updated Successfully', 'success');
        }
        else {
            set_messages('Something went wrong' , 'error');
            die(mysqli_error($connect));
        }
    } else {
        header('Location: ../index.php');
        exit();
    }
?>
