<?php
  //connection to the database
  include  '../Database/connect.h';
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
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
    min-width: 100px; 
    min-height: 500px;
    height: 500px;
    padding-left:85px;
    background-color:#ecf0f3;
    box-shadow: 10px 10px 10px #d1d9e6 , -10px -10px 10px #f9f9f9 ;
    border-radius: 12px;
    overflow: hidden;
  }

  h1{
    color: rgb(139, 137, 121);
    font-size:4em;
    text-align:center;
    padding-right:55px;
  }

  h2{
    color :rgb(182, 113, 88);
    font-size:2em;

  }

  td{
    color: black;
    font-size: 150%;
    width: 350px;
    height: 40px;
    
  }
  .price-food{
    padding-left :55px
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
</style>
</head>
<body>
  <header>
        <div class="wrapper">
            <div class="logo">
                <a href="welcomeHeader2.php">IO_Restaurant</a>
            </div>
            <nav>
                    <a href="Login.php">Login</a>
                    <a href="Register.php">Register</a>
                    <a href="#">Contact</a>
            </nav>
            
        </div>
  </header>
    
  <div class="container">
    
    <h1>The Menu </h1>
    <div class="menu-left">
      <h2>Dishes</h2>

    <?php
      $sql = 'SELECT * FROM Product WHERE productType="Dish"';
      $retval = mysqli_query($conn, $sql);
      if (!$retval) {
        die(mysqli_error($conn));
      }
  
      echo "<table class='table'  style='text-align:center;'>";
      while ($row = mysqli_fetch_array($retval)) {
        echo "<tr><td class='name-food'>" . $row['name'] . "</td>";
        echo "<td class='price-food'>" . $row['price'] . ",00 TND </td>";
        echo "</tr>";
      }
      echo "</table><br/>";
    ?>
  
    <h2>Drinks</h2>
    <?php 
      $sql = 'SELECT* FROM Product WHERE productType="Drink"';
      $retval = mysqli_query($conn, $sql);
      if (!$retval) {
        die(mysqli_error($conn)); 
      }
      echo "<table class='table ' style='text-align:center;'>";
      while ($row = mysqli_fetch_array($retval)) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td class='price-food'>" . $row['price'] . ",00 TND</td>";
        echo "</tr>";
      }
      echo "</table><br/>";
  ?>

  <h2>Desserts</h2>
  <?php

    $sql = 'SELECT* FROM Product WHERE productType="Dessert"';
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
      die(mysqli_error($conn));
    }
  
    echo "<table class='table   ' style='text-align:center;'>";
    while ($row = mysqli_fetch_array($retval)) {
      echo "<tr>";
      echo "<td>" . $row['name'] . "</td>";
      echo "<td class='price-food'>" . $row['price'] . ",00 TND</td>";
      echo "</tr>";
    }
    echo "</table><br/>";
  ?>
  </div>
  
</div>

</body>
</html>