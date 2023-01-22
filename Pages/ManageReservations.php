<?php
  //connection to the database
  include  '../Database/connect.h';
  session_start();
  $username = $_SESSION['username'];
  $userType = $_SESSION['userType'];
?>

<html>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/2a41b7c649.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script language="JavaScript" type="text/javascript">
    function checkDelete() {
      return confirm('Are you sure you want to Delete the selected reservation ?');
    }
  </script>
  
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


  .form{
  margin-right:5px;
  
  }

  .button{
  
    width: 30%;
    height: 8%;
    border-radius: 25px;
    margin-top: 5px;
    margin-bottom: 1px;
    margin-left:15em;
    font-weight: 700;
    font-size: 18px;
    letter-spacing: 1.15px;
    background-color:rgb(66, 76, 47) ;
    color:#f9f9f9;
  }


  .button-edit {
    width: 50px;
    height: 20px;
    background-color:#60b078;
    border-radius: 5px;

  }

  .attended-button{
    width: 50px;
    height: 20px;
    background-color:green;
    border-radius: 5px;

  }
  .not-attended-button{
    width: 50px;
    height: 20px;
    background-color:red;
    border-radius: 5px;

  }

  .button-delete{
  width: 50px;
    height: 20px;
    background-color:#da7a3e;
    border-radius: 5px;
  }
  h3{
  font-size:35px;
  text-align:center;
  margin:35px;
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

  <h3>Manage reservations</h3>

  <?php
  // admin and table manager can create reservation 
  if ($_SESSION['userType'] === "Admin" || $_SESSION['userType'] === "Table_manager") {
   
    $sql = 'SELECT * FROM Reservation';
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
      die(mysqli_error($conn)); 
    }
    echo "<form class='form'><table class='table' style='text-align:center;'>";
    echo "<tr><td>Id Reservation</td><td>Client Username</td><td>Reservation Date</td><td>Reservation Hour</td><td>Number of Seats</td><td>Attended</td><td>Edit</td><td>Delete</td></tr>";
    while ($row = mysqli_fetch_array($retval)) {
      echo "<tr>";
      echo "<td>" . $row['idReservation'] . "</td>";
      echo "<td>" . $row['clientName'] . "</td>";
      echo "<td>" . $row['reservationDate'] . "</td>";
      echo "<td>" . $row['reservationHour'] . "</td>";
      echo "<td>" . $row['seatsQty'] . "</td>";

      if ($row['is_Attended'] == 0) { //if the reservation is not attended 
        echo "<td class='btt'>
                <a href='AttendReservation.php?idReservation=" . $row['idReservation'] . "'>
                  <button type='button' class='not-attended-button px-3'>
                  <i class='bi bi-hand-thumbs-down-fill'></i></button>
                </a>
              </td>";
      } else { //if the reservation is attended 
        echo "<td>
                <a href='NotAttendedReservation.php?idReservation=" . $row['idReservation'] . "'>
                  <button type='button' class='attended-button px-3'>
                  <i class='bi bi-hand-thumbs-up-fill'></i></button>
                  </a>
              </td>";
      }
      //the edit reservation button 
      echo "<td>
              <a href='EditREservation.php?idReservation=" . $row['idReservation'] . "'>
                <button type='button' class='button-edit px-3'><i class='bi bi-pen'></i></button>
              </a>
            </td>";
      //the delete reservation button 
      echo "<td>
              <a href='DeleteReservationScript.php?idReservation=" . $row['idReservation'] . "' onclick='return checkDelete()'>
                <button type='button' class='button-delete px-3'><i class='bi bi-trash3'></i></button>
              </a>
          </td></tr>";
          
    }
    echo "</table>
    <div class='bt'>
    <a href='Profile.php'>
    <button  type='button' class='button '>Return</button>
  </a></div
  </form>"
    ;
    echo '<div  id="btn-return" >
    <a href="MakeReservation.php">
      <button  type="button" class="button ">Create Reservation</button>
    </a>
  </div>';

  //if the session user is a client 
  } else if ($_SESSION['userType'] === "Client") {

    $name = $_SESSION['username'];

    $sql = "SELECT * FROM Reservation WHERE clientName='$name'";
    $retval = mysqli_query($conn, $sql);
    if (!$retval) {
      die(mysqli_error($conn)); 
    }
    echo "<form class='form'><table class='table' style='text-align:center;'>";
    echo "<tr><td>Username</td><td>Reservation Date</td><td>Reservation Hour</td><td>Number of Seats</td><td>Edit</td><td>Delete</td></tr>";
    while ($row = mysqli_fetch_array($retval)) {
      echo "<tr>";
      echo "<td>" . $row['clientName'] . "</td>";
      echo "<td>" . $row['reservationDate'] . "</td>";
      echo "<td>" . $row['reservationHour'] . "</td>";
      echo "<td>" . $row['seatsQty'] . "</td>";

      //the edit reservation button 
      echo "<td>
              <a href='EditREservation.php?idReservation=" . $row['idReservation'] . "'>
                <button type='button' class='button-edit px-3'> <i class='bi bi-pen'></i> </button> </a>
            </td>";
       //the delete reservation button 
      echo "<td>
              <a href='DeleteReservationScript.php?idReservation=" . $row['idReservation'] . "' onclick='return checkDelete()'>
                <button type='button' class='button-delete px-3'  confirm('do you want to delete Y/N')>
                <i class='bi bi-trash3'></i> </button>  </a>
          </td></tr>";
    }
    echo "<form>" ;
    echo "</table><br/>
    <a href='Profile.php'>
    <button  type='button' class='button '>Return</button>
  </a>";
    
  }

  ?>
  </div>
</body>

</html>