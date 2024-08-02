<?php

    header( 'Content-type: text/html; charset=utf-8' );
    
    function set_messages($message, $className){
        $_SESSION['message'] = $message;
        $_SESSION['className'] = $className;
    }

    function get_messages(){
        if(isset($_SESSION['message'])){
            $message = $_SESSION['message'];
            echo '<div class="alert alert-'.$_SESSION['className'].'" role="alert">
            '.$message.'
            </div>';
            unset($_SESSION['message']);
            unset($_SESSION['className']);
        }
    }
?>
