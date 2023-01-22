
<?php
    //connection to the database
    include  '../Database/connect.h';   
    session_start();

    //if the user clicks on register 
    if(isset($_POST['register'])){
      
    $username = $_POST['userName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $adress = $_POST['adress'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    
    //Comparing the passwords inserted ; if they don't match 
    if($password != $confirmPassword){
        echo '<script>alert("The passwords not match!")</script>';
        echo '<script>window.location.href="Register.php"</script>';
    }else{ // if they match 
        if(empty($username) || empty($email) || empty($phoneNumber) || empty($adress) || empty($password) ){
        echo '<script>alert("There are empty field! Please verify your information and try again")</script>';
        echo '<script>window.location.href="Register.php"</script>';

        }else{
        //check if the username is already used 
            $getUser = "SELECT username FROM User WHERE username='".$username."'";
            $res = mysqli_query($conn, $getUser);
            $exists = mysqli_num_rows($res);

            //if it exists we show an error message to the user trying to register 
            if($exists){
                echo '<script>alert("This Username already exists! Please try another one.")</script>';
                echo '<script>window.location.href="Register.php"</script>';

            }else {
                
                $password = md5($password);

                //userType to a non authorized one 
                $userType = "Unauthorized_User";
                // the insert query 
                $insertUser = "INSERT INTO User VALUES ('".$username."','".$password."','".$email."','".$phoneNumber."','".$adress."','".$userType."')";
                $query = mysqli_query($conn, $insertUser);

                echo '<script>alert("The Registration is completed. \n Please wait for the  confirmation of the Admin")</script>';
                echo '<script>window.location.href="welcomeHeader2.php"</script>';
                }
        }
    }
    
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
<style>
            <style>
        
        *, *::after, *::before {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            user-select: none;
            font-family: "Montserrat" , sans-serif;
        
        }
        
        body {
            width: 100em;
            height: 51em;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
            background-color: #ecf0f3;
            color: #a0a5a8;
        }
        
        .container{
            position: relative;
            width: 1000px;
            min-width: 1000px; 
            min-height: 600px;
            height: 600px;
            padding-left:85px;
            background-color:#ecf0f3;
            box-shadow: 10px 10px 10px #d1d9e6 , -10px -10px 10px #f9f9f9 ;
            border-radius: 12px;
            overflow: hidden;
        }
        
        
        
        form{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
            height: 100%;
            padding-right:95px;
            padding-bottom:100px;
        
        }
        
        .form-input {
            width: 350px;
            height: 40px;
            margin: 6px 0;
            padding-left: 25px;
            font-size: 18px;
            letter-spacing: 0.18px;
            border: none;
            outline: none;
            transition: 0.25s ease;
            border-radius: 20px;
            box-shadow: 4px 4px 4px #d1d9e6 , inset -4px -4px 4px #f9f9f9;
            
        }

        input{
            text-align:center;
        }
        
        .form-input:focus{
            box-shadow: 2px 2px 4px #d1d9e6, inset -2px -2px 4px #f9f9f9;
        }
        
        button{
            width: 350px;
            height: 50px;
            border-radius: 25px;
            margin-top: 20px;
            margin-bottom: 10px;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: 1.15px;
            background-color:rgb(66, 76, 47) ;
            color : #f9f9f9;
            box-shadow: 8px 8px 16px #d1d9e6 , -8px -8px 16px #f9f9f9;
            border :none ;
            outline:none ;
            cursor : pointer; 
        
        }
        
        h1{
            font-size:30px;
            font-weight :700;
            line-height :3 ;
            color :rgb(66, 76, 47) ;
            padding-right: 15px;
        }
        
        
        .login-left{
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
        
        
        
        .login-right {
            position: absolute;
            top: 0;
            transition: 1.25s;
            overflow: hidden;
            box-shadow: 4px 4px 10px #d1d9e6 , -4px -4px 10px #f9f9f9;
            left: calc(100% - 400px);
        
        }
        
        .login-right > img {
            height: 150%;
            width: 150%;
        }
            </style>
    </style>
</head>
<body>
<div class="container">
    <div class="login-left">
        <form class="login-form" method="POST">
            <h1>Register in the plattform</h1>   
            <input type="text" class="form-input" id="userName" name="userName" placeholder="Username" >
            <input type="email" class="form-input" id="email" name="email" placeholder="E-mail">
            <input type="text" class="form-input" id="phoneNumber" name="phoneNumber" placeholder="Phone Number"> 
            <input type="text" class="form-input" id="adress" name="adress" placeholder="Adress">
            <input type="password" class="form-input" id="password" name="password" placeholder="Password">
            <input type="password" class="form-input" id="confirmpassword" name="confirmPassword"  placeholder=" Conform Password">
            <button type="submit" name="register" class="form-button">Register</button>
            <a href="welcomeHeader2.php"> <button type="button" class="form-button">Return</button></a>
        </form>
    </div>
    <div class="login-right">
            <img src="loginfood1.jfif" alt="foodimage">
    </div>
</div>
</body>
</html>