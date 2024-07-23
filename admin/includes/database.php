<?php

$connect = mysqli_connect( 
    "localhost", // Host
    "root", // Username
    "root", // Password
    "phpcms" // Database
);

mysqli_set_charset( $connect, 'UTF8' );
