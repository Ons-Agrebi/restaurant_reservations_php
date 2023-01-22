<?php
  //connection to the database
  include  '../Database/connect.h';
  session_start();
  $username = $_SESSION['username'];
  $userType = $_SESSION['userType'];

  //only the Admin  have access to this page
  if($_SESSION['Login'] && $_SESSION['userType'] === "Admin"){

    //get the id of the food 
    $productId = $_GET['productId'];

    //select the food with that specific id ; the one the admin wants to edit 
    $sql = "SELECT * FROM Product WHERE productId='" . $productId . "'";

    $retval = mysqli_query($conn, $sql);
        if (!$retval) {
            die(mysqli_error($conn)); 
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
    min-height: 500px;
    height: 400px;
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
<h3>Edit Selected Food</h3><br>

  <div class="val">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name'] ?>">
  </div>

  <div class="val">
      <label for="productType" class="form-label">Select the type of the Product</label>
      <select class="form-select" name="productType" type="text" required value="<?php echo $row['productType'] ?>">
        <option value="Dish">Dish</option>
        <option value="Drink">Drink</option>
        <option value="Dessert">Dessert</option>
      </select>
    </div>
  <div class="val">
    <label for="price" class="form-label">Price</label>
    <input type="text" class="form-control" id="price" name="price" value="<?php echo $row['price'] ?>">
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

  //If the admin clicks on save button the selected food will be updated in the database 
if (isset($_POST['save'])) {
    
    //the update query
    $query = "UPDATE Product SET name='" . $_POST['name'] . "', productType='" . $_POST['productType'] . "',price='" . $_POST['price'] .
     "' WHERE productId='" . $productId . "'";
    //we execute the query  
    $retval = mysqli_query($conn, $query);

    if (!$retval) {
        die(mysqli_error($conn)); 
    } else {
        echo '<script>alert("Food information updated!")</script>';
        echo '<script>window.location.href="ManageFoods.php"</script>';
  }
}
?>
<?php
    //If the session User is not an Admin, it cannot access this page
    }else{
        echo '<script>alert("You dont have permission to access this Page!")</script>';
        echo '<script>window.location.href="welcomeHeader2.php.php"</script>';
    }
  

    if(isset($_POST['return'])){
      header("Location:ManageFoods.php");
    
    }
?>