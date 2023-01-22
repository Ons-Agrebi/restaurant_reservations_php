<?php
//connection to the database
include  '../Database/connect.h';
//we start the session 
session_start();
$username = $_SESSION['username'];
$userType = $_SESSION['userType'];

 //if the user clicks on the return button    
if(isset($_POST['return'])){
  header("Location:Profile.php");

}

$user = $_SESSION['username'];
$password = $_SESSION['password'];

$sql = "SELECT * FROM User WHERE username='" . $user . "'";

$retval = mysqli_query($conn, $sql);
if (!$retval) {
  die(mysqli_error($conn)); 
}

$row = mysqli_fetch_array($retval); /* function fetches a result row as an associative array, a numeric array, or both */

?>

<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/2a41b7c649.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
    margin-top:50px;
    min-width: 100px; 
    min-height: 700px;
    height: 700px;
    padding-left:85px;
    background-color:#ecf0f3;
    box-shadow: 10px 10px 10px #d1d9e6 , -10px -10px 10px #f9f9f9 ;
    border-radius: 12px;
    overflow: hidden;
  }


  .form{
  margin-right:5px;
  
  }

  .button{
  
    width: 20%;
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

  <form class="form" method="POST">
  <h3>Edit Personal Informations </h3>
    <div class="val">
      <input type="hidden" name="oldName" value="<?php echo $row['username']; ?>"> <!-- This line helps saving the old username for the php change-->
      <label for="newUserName" class="form-label">User Name</label>
      <input type="text" class="form-control" id="newUserName" name="newUserName" value="<?php echo $row['username']; ?>">
    </div>
    <div class="val">
      <label for="email" class="form-label">E-mail</label>
      <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
    </div>
    <div class="val">
      <label for="phoneNumber" class="form-label">Phone Number</label>
      <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $row['phoneNumber']; ?>">
    </div>
    <div class="val">
      <label for="adress" class="form-label">Adress</label>
      <input type="text" class="form-control" id="adress" name="adress" value="<?php echo $row['adress']; ?>">
    </div>
    <div class="val">
      <label for="newPassword" class="form-label">New Password</label>
      <input type="password" class="form-control" id="newPassword" name="newPassword">
    </div>
    <div class="val">
      <label for="confPassword" class="form-label">Confirm new Password</label>
      <input type="password" class="form-control" id="confPassword" name="confPassword">
    </div>
    <div class="buttons">
    <button type="submit" name="save" class="button">Save</button>
    <button type="submit" name="return" class="button">Return</button>
    </div>
   
  </form>

  </div>
</body>

</html>

<?php


//if the user clicks on the save button

if (isset($_POST['save'])) {
  
  //First we need to check if the user has set a new password
  if (!empty($_POST['newPassword'])) {

      //if the user wants to change his password , we need to verify that the passwords match 
          if ($_POST['newPassword'] === $_POST['confPassword']) {
            //we add the hash function md5
          $password = md5($_POST['newPassword']);
          //the update query of all the fields
          $query = "UPDATE User SET username='" . $_POST['newUserName'] . "', email='" . $_POST['email'] . "',
          phoneNumber='" . $_POST['phoneNumber'] . "',adress='" . $_POST['adress'] . "',password='" . $password . "' 
          WHERE username='" . $_POST['oldName'] . "'";
          }  else {
              //if the passwords don't match 
              echo '<script>alert("Passwords are not equal!")</script>';
              echo '<script>window.location.href="EditPersonalInfo.php"</script>';
          }      
  } else {
    //if the user won't change the password ; this is the update query of all the fields except the password 
    $query = "UPDATE User SET username='" . $_POST['newUserName'] . "', email='" . $_POST['email'] . "',
    phoneNumber='" . $_POST['phoneNumber'] . "',adress='" . $_POST['adress'] . "' 
    WHERE username='" . $_POST['oldName'] . "'";
  }

  //the execution of the update query 
  $retval = mysqli_query($conn, $query);

  if (!$retval) {
    die(mysqli_error($conn)); 
  } else {
    echo '<script>alert("Personal information updated! ")</script>';
    echo '<script>window.location.href="Profile.php"</script>';
  }
}

?>