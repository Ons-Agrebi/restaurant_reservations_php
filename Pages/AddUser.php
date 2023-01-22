<?php
    //connection to the database
    include  '../Database/connect.h';
    //start the session 
    session_start();
    $username = $_SESSION['username'];
    $userType = $_SESSION['userType'];

    //only the Admin can access this page ; so verify if it's a login session and if the userType is an Admin
    if($_SESSION['Login'] && $_SESSION['userType'] === "Admin"){
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/2a41b7c649.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!--CSS Script-->   
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
    nav a:hover{
    color: antiquewhite; 
    }
    .container{
    position: relative;
    width: 1000px;
    margin-top:50px;
    min-width: 100px; 
    min-height: 500px;
    height: 600px;
    padding-left:85px;
    background-color:#ecf0f3;
    box-shadow: 10px 10px 10px #d1d9e6 , -10px -10px 10px #f9f9f9 ;
    border-radius: 12px;
    overflow: hidden;
    }

    label{
    margin-top:5px;
    font-size:15px;
    
    }
    .form{
    margin-rignt:50px;
  
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

       
        
    .form-input:focus{
        box-shadow: 2px 2px 4px #d1d9e6, inset -2px -2px 4px #f9f9f9;
        }

    .button{
  
    width: 22%;
    height: 8%;
    border-radius: 25px;
    margin-top: 5px;
    margin-bottom: 1px;
    color:#f9f9f9;
    font-weight: 700;
    font-size: 18px;
    letter-spacing: 1.15px;
    background-color:rgb(66, 76, 47) ;
    }

    .buttons{
    margin-top:15px;
    margin-left:33%;
    }


    h3{
    font-size:35px;
    text-align:center;
    margin:35px;
    }
</style>
</head>
<body>
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
        <h3>Add User </h3>
        <form action="" method="POST" class="form">
            <label for="userName">Username</label>
            <input type="text" class="form-control" id="userName" name="userName" >
            
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" >
            
            <label for="phoneNumber"> Phone Number </label>   
            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" > 
            <label for="address"> Address </label>  
            <input type="text" class="form-control" id="address" name="adress" >
            <label for="password">Password </label>  
            <input type="password" class="form-control" id="password" name="password" >
            <label for="cpassword">Confirm Password </label>  
            <input type="password" class="form-control" id="cpassword" name="confirmPassword" >
            
            <div class="buttons">
                <button type="submit" name="addUser" class="button">Click to add</button>
                <a href="ManageUsers.php"> <button type="button" class="button">Return</button></a>
            </div>
        </form>
    </div>
</body>
</html>

<?php
   
    //if the admin clicks on the add button 
    if(isset($_POST['addUser'])){
      
        // we get all the variables 
        $username = $_POST['userName'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];
        $adress = $_POST['adress'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        //Compare if the passwords are matching ; if they don't match 
        if($password != $confirmPassword){
            echo '<script>alert("The passwords not match!")</script>';
            echo '<script>window.location.href="AddUser.php"</script>';
        }else{
            //if the passwords are matching 
            //Now we verify if there are empty fields 
            if(empty($username) || empty($email) || empty($phoneNumber) || empty($adress) || empty($password) || empty($confirmPassword)){
                echo '<script>alert("There are empty field! Please verify your information and try again")</script>';
                echo '<script>window.location.href="AddUser.php"</script>';
            }else{

                //Now we check if the admin is trying to a user that is already registred in the database by checking the username inserted 
                $getUser = "SELECT username FROM User WHERE username='".$username."'";
                $res = mysqli_query($conn, $getUser);
                $exists = mysqli_num_rows($res);

                //if the username already exists 
                if($exists){
                    echo '<script>alert("This Username already exists! Please try another one.")</script>';
                    echo '<script>window.location.href="AddUser.php"</script>';

                }else {
                   
                    //Now everything is okay , we encrypt the password 
                    $password = md5($password);

                    //we put the userType to non validated
                    $userType = "Unauthorized_User";

                    //Insertion in the database 
                    $insertUser = "INSERT INTO User VALUES ('".$username."','".$password."','".$email."','".$phoneNumber."','".$adress."','".$userType."')";
                    $query = mysqli_query($conn, $insertUser);
                    echo '<script>alert("The Registration is completed. \n Please wait confirmation of one of our Administrators")</script>';
                    echo '<script>window.location.href="ManageUsers.php"</script>';
                    }
            }
         }
    }
    
?>


<?php
//If the session user  is not an admin, it cannot access this page
    }else{
        echo '<script>alert("You dont have permission to access this Page!")</script>';
        echo '<script>window.location.href="welcomeHeader2.php"</script>';
    }

    if(isset($_POST['return'])){
      header("Location:ManageUsers.php");
    }
?>