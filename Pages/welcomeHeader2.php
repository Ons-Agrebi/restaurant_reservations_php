
<?php

include '../Database/connect.h';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Header </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<div class="box-area" >
    <header>
        <div class="wrapper">
            <div class="logo">
                <a href="welcomeHeader2.php">IO_Restaurant</a>
            </div>
            <nav>
                    <a href="Menu.php">Menu</a>
                    <a href="Login.php">Login</a>
                    <a href="Register.php">Register</a>
                    <a href="#">Contact</a>
            </nav>
            
        </div>
    </header>
    <div class="banner-area">
        <h1>
            Welcome to the offical website of IO_Restaurant
        </h1>
    </div>
    <div class="content-area">
        <div class="wrapper">
            <h2>ABOUT US </h2>
            <p>
                    We believe in the commitment to our community and in fostering 
                    long term relationships with local farmers and fishermen.
                    Our menus reflect these connections, featuring local, seasonal
                    produce and sustainably sourced seafood and meat
            </p>
        </div>
        <footer style ="background: #000000; color: antiquewhite;">
        <div class="contenu-footer" >
            <div style = "margin : 1px" class="bloc-footer-service">
                <h3>Address</h3>
                <ul style = "list-style-type: none;">
                <li>Rue, El Kods - Radès - Tunis</li>
            </ul>

        </div>
        <div style = "margin : 1px" class="bloc-footer-service">
            <h3>Scheduale</h3>
            <ul style = "list-style-type: none;">
                <li>Everyday from 11:30 am to 14:30 pm </li>
            </ul>
        </div>
        <div  style = "margin : 1px" class="bloc-footer-service">
            <h3>Contact Us</h3>
            <ul style = "list-style-type: none;" >
                <li>Phone :+216 71 460 700</li>
            </ul>

        </div>
        <div style = "margin-left : 20px" class="bloc-footer-service">
            <h3>Social Media</h3>
            <ul class="list-media">
                <li style = "list-style-type: none;"><a href="#"><img src="instagram.png" alt="Bootstrap" height="25px" width="25px"></a></li>
                
            </ul>
        </div>
        </footer>
    </div>
    </div>
    

</div>
    
</body>
</html>