<?php
    //connection to the database
    include  '../Database/connect.h';
    session_start();
    $username = $_SESSION['username'];
    $userType = $_SESSION['userType'];
    //only the admin have access to this page 
    if($_SESSION['Login'] && $_SESSION['userType'] === "Admin"){
        $username = $_SESSION['username'];
?>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/2a41b7c649.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script language="JavaScript" type="text/javascript">function checkDelete(){return confirm('Are you sure you want to Delete?');}</script>
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
    min-height: 500px;
    height: 600px;
    max-height:1000px;
    padding-left:85px;
    background-color:#ecf0f3;
    box-shadow: 10px 10px 10px #d1d9e6 , -10px -10px 10px #f9f9f9 ;
    border-radius: 12px;
    overflow: hidden;
    }


    .form{
  margin-right:5px;
  
    }
    h3{
  font-size:35px;
  text-align:center;
  margin:35px;
    }

    .button{
  
  width: 30%;
  height: 8%;
  border-radius: 25px;
  margin-top: 5px;
  margin-bottom: 1px;
  font-weight: 700;
  font-size: 18px;
  letter-spacing: 1.15px;
  background-color:rgb(66, 76, 47) ;
  color:#f9f9f9;
  
    }
    .buttons{
    margin-top:15px;
    margin-left:23%;
    }
    .button-edit {
    width: 50px;
    height: 20px;
    background-color:#60b078;
    border-radius: 5px;

    }
    .activate-button{
    width: 50px;
    height: 20px;
    border-radius: 5px;
    background-color:green;

    }

    .disactive-button{
    width: 50px;
    height: 20px;
    border-radius: 5px;
    background-color:red;
    }


    .button-delete{
    width: 50px;
    height: 20px;
    background-color:#da7a3e;
    border-radius: 5px;
    }
</style>
        
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

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
    <h3>Manage Users</h3>

<?php
	$sql = 'SELECT * FROM User';
	$retval = mysqli_query( $conn, $sql );
	if(! $retval ){
		die(mysqli_error($conn)); 
		}
    echo "<form class = 'form' >";
    echo "<table class='table' style='text-align:center;'>";
    echo "<tr><td>Username</td><td>E-mail</td><td>Phone Number</td><td>Adress</td><td>User Type</td><td>Activated | Deactivated</td><td>Edit</td><td>Delete</td></tr>";
	while($row = mysqli_fetch_array($retval)){	
		echo "<tr>";
        echo "<td>".$row['username']."</td>";
        echo "<td>".$row['email']."</td>";
		echo "<td>".$row['phoneNumber']."</td>";
        echo "<td>".$row['adress']."</td>";
        echo "<td>".$row['userType']."</td>";
        //if the user is not authotized 
        if ($row['userType'] === "Unauthorized_User"){
            echo "<td><a href='ValidateUserScript.php?username=".$row['username']."'><button type='button' class='disactive-button  px-3'><i class='bi bi-patch-minus'></i></button></a></td>";
        }else{ //if the user is authorized 
            echo "<td><a href='DeactivateUserScript.php?username=".$row['username']."'><button type='button' class='activate-button px-3'><i class='bi bi-patch-check'></i></button></a></td>";
        }
        echo "<td><a  href='EditUser.php?username=".$row['username']."' disabled ><button type='button' class='button-edit px-3'><i class='bi bi-pen'></i></button></a></td>";
        echo "<td><a  href='DeleteUser.php?username=".$row['username']."'><button type='button' class='button-delete px-3'><i class='bi bi-trash3'></i></button></a></td>";
		echo "</tr>";
		}
		echo "</table><br/> </form>";
?>
<div id="btn-return" class="buttons">
    <a href="AddUser.php">
        <button class="button">Add User </button>
    </a>
    <a href="Profile.php">
        <button type="button" class="button">Return</button>
    </a>
</div>
</div>
</body>

<?php
}else{
    echo '<script>alert("You dont have permission to access this Page!")</script>';
    echo '<script>window.location.href="welcomeHeader2.php"</script>';
}
?>