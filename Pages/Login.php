<!-- Login Script-->
<?php
//connection to the database
include  '../Database/connect.h';

if (isset($_POST['login'])) {

  //first we see if the user inserted the two field needed to login
  if (isset($_POST['userName']) && isset($_POST['password'])) {

    session_start();
    //lets check if the data corresponds to an user in the database
    $username = $_POST['userName'];
    $password = $_POST['password'];
    $password = md5($password);

    $getUser = "SELECT * FROM User WHERE username='" . $username . "' AND password='" . $password . "'";
    $query = mysqli_query($conn, $getUser);

    //if the data is valid, we need to grab and array of user information
    if (mysqli_num_rows($query) == 1) {
      $row = mysqli_fetch_array($query);
      if ($row == FAlSE) {
        die();
      }

      //now we need to create the SESSION variables to the valid Users of our Sytem
      $_SESSION['Login'] = True;
      $_SESSION['username'] = $username;
      $_SESSION['password']= $password;
       
      //and the SESSION variable for the userType
      switch ($row['userType']) {
        case "Admin":
          $_SESSION['userType'] = "Admin";
          header("Location:Profile.php");
          break;
        case "Table_manager":
          $_SESSION['userType'] = "Table_manager";
          header("Location:Profile.php");
          break;
        case "Client":
          $_SESSION['userType'] = "Client";
          header("Location:Profile.php");
          break;
        case "Unauthorized_User":
          echo '<script>alert("Login failed!! Wait for Admin to validate your account.")</script>';
          echo '<script>window.location.href="welcomeHeader2.php"</script>';
          break;
        default:
          echo '<script>alert("Invalid type of User!!")</script>';
          echo '<script>window.location.href="Login.php"</script>';
          break;
      }
    } else {
      //echo " <script>Swal.fire('Login failed!! Username or password is incorrect!') ; </script>" ;
      echo '<script>alert("Login failed!! Username or password is incorrect!")</script>';
      echo '<script>window.location.href="Login.php"</script>';
    }
  } else {
    echo '<script>alert("Empty fields, please try again!")</script>';
    echo '<script>window.location.href="Login.php"</script>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,700;0,800;1,400;1,700;1,800&display=swap" rel="stylesheet">
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

  } 
  input{
    text-align:center;
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
    padding-right: 185px;
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
</head>
<body >
    
    <div class="container">
        
        <div class="login-left">

            <form action="" method="POST" class="login-form">
                <h1>Login to your profile </h1>
                <div class="login-form-content">
                    <div class="form-item">
                        <input type="text" class="form-input" name="userName" placeholder="Username"  >
                    </div>
                    <div class="form-item">
                        <input type="password" class="form-input"  name="password" placeholder="Password">
                    </div>
                    <button type="submit" name="login" class="form-button">Login</button>
                    <a href="welcomeHeader2.php"> <button type="button" class="form-button">Return</button></a>

                </div>
            </form>
        </div>
        <div class="login-right">
            <img src="loginfood1.jfif" alt="foodimage">
        </div>
    </div>
</body>
</html>