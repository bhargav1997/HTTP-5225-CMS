<?php
    include('../reusable/con.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];
        $className = $_POST['className'];
        $classType = $_POST['classType'];
        $instructorId = $_POST['instructorId'];
 
        $sql = "UPDATE classes SET `name` = '$className', `level` = '$classType', `instructor_id` = '$instructorId' WHERE id = '$id'";
    
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
