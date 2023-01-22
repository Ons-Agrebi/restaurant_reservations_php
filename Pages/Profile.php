<?php

include '../Database/connect.h';

?>
<?php

//we start by checking if the logged user have acess to this page
session_start();
$username = $_SESSION['username'];
$userType = $_SESSION['userType'];
$password = $_SESSION['password'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

<style>

        
    *, *::after, *::before {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    user-select: none;
    font-family: "Montserrat" , sans-serif;

    }

    body {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 14px;
    background-color: #ecf0f3;
    color: #a0a5a8;
    }

    .wrapper{
    width: 1170px;
    margin: 0 auto;
    }

    header{
    height: 100px;
    background: #000000;
    width: 100%;
    z-index: 12;
    position: fixed;
    margin-top:-680px;
    }

    .logo{
    width: 30%;
    float: left;
    line-height: 100px;
    }
    .logo a{
    text-decoration: none;
    font-size: 30px;
    font-family: bignoondletitling;
    color: antiquewhite; ;
    letter-spacing: 5px;
    }

    nav{
    float: right;
    line-height: 100px;
    }

    nav a{
    text-decoration: none;
    font-family: bignoondletitling;
    letter-spacing: 4px;
    font-size: 20px;
    margin: 0 10px;
    color: antiquewhite;
    }

    .container{
    position: relative;
    width: 1000px;
    min-width: 100px; 
    min-height: 500px;
    height: 500px;
    padding-left:85px;
    background-color:#ecf0f3;
    box-shadow: 10px 10px 10px #d1d9e6 , -10px -10px 10px #f9f9f9 ;
    border-radius: 12px;
    overflow: hidden;
    }

    .profile-left{
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 0;
    width: 600px;
    height: 100%;
    padding: 25px;
    background-color: #ecf0f3;
    transform: 1.25s;

    }


    button{
    width: 350px;
    height: 50px;
    border-radius: 25px;
    margin-top: 5px;
    margin-bottom: 1px;
    margin-left:50px;
    font-weight: 700;
    font-size: 18px;
    letter-spacing: 1.15px;
    background-color:rgb(66, 76, 47) ;
    color:#f9f9f9;
    padding-left: 15px;
    }

    .form{
    flex-direction: column;
    width: 50%;
    height: 50%;
    color: rgb(139, 137, 121);

    }
    h1{
    font-size:30px;
    font-weight :700;
    color :rgb(66, 76, 47) ;
    padding-right:15px;
    }
</style>
</head>
<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <header>
        <div class="wrapper">
            <div class="logo">
                <a href="welcomeHeader2.php">IO_Restaurant</a>
            </div>
            <nav>
                    <a href="Logout.php">Logout</a>
            </nav>
            
        </div>
    </header> 
<div class="container">
    <div class="profile-left">
        <h1>Welcome  <?php echo "$username"  ;   ?> to your personal profile </h1>
        <div class="form">
    
    <?php 
    //if the session user is an admin
    if($userType==="Admin"){
    ?>

    <div  id="btn-manageFoods">
        <a href="ManageFoods.php">
            <button type="button" class="btn btn-secondary btn-lg">Manage Menu</button>
        </a>
    </div>
    <div id="btn-users" style="padding-top: 10px">
        <a href="ManageUsers.php">
            <button type="button" class="btn btn-secondary btn-lg">Manage Users</button>
        </a>
    </div>
    <div id="btn-reservations" style="padding-top: 10px">
        <a href="ManageReservations.php">
            <button type="button" class="btn btn-secondary btn-lg">Manage Reservations</button>
        </a>
    </div>
    <div id="btn-personalInfo" style="padding-top: 10px">
        <a href="EditPersonalInfo.php">
            <button type="button" class="btn btn-secondary btn-lg">Edit Personal Information</button>
        </a>
    </div>

    <?php
        //if the session user is a table manager 
        }else if($userType==="Table_manager"){
    
    ?>

    <div id="btn-reservations" style="padding-top: 10px">
        <a href="ManageReservations.php">
            <button type="button" class="btn btn-secondary btn-lg">Manage Table Reservations</button>
        </a>
    </div>
    <div id="btn-personalInfo" style="padding-top: 10px">
        <a href="EditPersonalInfo.php">
            <button type="button" class="btn btn-secondary btn-lg">Edit Personal Information</button>
        </a>
    </div>


    <?php    
        //if the session user is a client 
        }else if($userType==="Client"){
    ?>
   
    <div id="btn-users">
        <a href="MakeReservation.php">
            <button type="button" class="btn btn-secondary btn-lg">Make Reservation</button>
        </a>
    </div>
    <div id="btn-reservations" style="padding-top: 10px">
        <a href="ManageReservations.php">
            <button type="button" class="btn btn-secondary btn-lg">Manage Reservations</button>
        </a>
    </div>
    
    <div id="btn-personalInfo" style="padding-top: 10px">
        <a href="EditPersonalInfo.php">
            <button type="button" class="btn btn-secondary btn-lg">Edit Personal Information</button>
        </a>
    </div>
    
</div>

    <?php 
} ?>
    
</body>
</html>