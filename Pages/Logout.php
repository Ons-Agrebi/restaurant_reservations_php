<?php
    //connection to the database
    include  '../Database/connect.h';

    session_start();

    if($_SESSION['Login']){
        session_destroy();
        echo '<script>window.location.href="welcomeHeader2.php"</script>';

    }else{
        echo '<script>alert("There are no session started!")</script>';
        echo '<script>window.location.href="welcomeHeader2.php"</script>';
    }
