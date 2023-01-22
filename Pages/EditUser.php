<?php
  //connection to the database
  include  '../Database/connect.h';
  //we start the session
  session_start();
  $username = $_SESSION['username'];
  $userType = $_SESSION['userType'];

  //if the session user is an admin 
  if($_SESSION['Login'] && $_SESSION['userType'] === "Admin"){

  $sql = "SELECT * FROM User WHERE username='" . $_GET['username'] . "'";

  $retval = mysqli_query($conn, $sql);  
  if (!$retval) {
    die(mysqli_error($conn)); // if does not work it gives an error
  }

  $row = mysqli_fetch_array($retval);
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
    min-height: 600px;
    height: 600px;
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

  label{
    margin-top:5px;
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
  <h3>Edit User Information</h3><br>

    <div class="val">
      <input type="hidden" name="oldName" value="<?php echo $row['username']; ?>"> 
      <label for="newUserName" class="form-label">Username</label>
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
      <label for="adress" class="form-label">Address</label>
      <input type="text" class="form-control" id="adress" name="adress" value="<?php echo $row['adress']; ?>">
    </div>
    <div class="val">
      <label for="newUserType">User type</label>
      <select class="form-select" name="newUserType" type="number">
        <option value='<?php echo $row['userType']; ?>'> Select an option: </option>
        <option value="Admin">Admin</option>
        <option value="Table_manager">Table Manager</option>
        <option value="Client">Client</option>
        <option value="Unoutorized_User">Unauthorized_User</option>
      </select>
      <div class="buttons">
      <button type="submit" name="save" class="button">Save</button>
      <a href="ManageUsers.php"><button type="button" class="button">Return</button></a>
      </div>
    </div>
  </form>
  </div>
</body>

</html>

<?php
//if the user clicks on the save button
  if (isset($_POST['save'])) {
    //the update user query 
    $query = "UPDATE User SET username='" . $_POST['newUserName'] . "', email='" . $_POST['email'] . "',
        phoneNumber='" . $_POST['phoneNumber'] . "',adress='" . $_POST['adress'] . "',userType='" . $_POST['newUserType'] . "' 
        WHERE username='" . $_POST['oldName'] . "'";
    //the execution of the update 
    $retval = mysqli_query($conn, $query);

    if (!$retval) {
      die(mysqli_error($conn)); 
    } else {
        echo '<script>alert("User Updated!")</script>';
        echo '<script>window.location.href="ManageUsers.php"</script>';
      }
  } 
  }else{
    echo '<script>alert("You dont have permission to access this Page!")</script>';
    echo '<script>window.location.href="=welcomeHeader2.php"</script>';
}
?>
