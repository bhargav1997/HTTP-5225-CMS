<?php

include( '../reusable/con.php' );

session_destroy();

header( 'Location: index.php' );
