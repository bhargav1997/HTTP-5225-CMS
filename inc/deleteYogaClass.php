<?php
    include('../reusable/con.php');

    if(isset($_GET['id'])) {
        print_r($_GET);
        $id = $_GET['id'];

        $id = intval($id); // convert string to int


        $query = "DELETE FROM classes WHERE `id` = '$id'";
        $result = mysqli_query($connect, $query);

        if (!$result) {
            set_messages('Error, Class Not Added', 'error');
            die('Query Failed' . mysqli_error($connect));
        }

        header('Location: ../index.php');
        mysqli_close($connect);
    } else {
        set_messages('Something Went Wrong, Please Try Again', 'error');
    }
?>