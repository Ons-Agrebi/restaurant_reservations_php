<?php
  //connection to the database
  include  '../Database/connect.h';
  //start the session 
  session_start();
  $username = $_SESSION['username'];
  $userType = $_SESSION['userType'];

  $idRes = $_GET['idReservation'];

  $sql = "SELECT * FROM Reservation WHERE idReservation='$idRes'";

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
    min-width: 100px; 
    min-height: 500px;
    height: 500px;
    padding-left:85px;
    background-color:#ecf0f3;
    box-shadow: 10px 10px 10px #d1d9e6 , -10px -10px 10px #f9f9f9 ;
    border-radius: 12px;
    overflow: hidden;
  }
    .buttons{
      margin :15px;
    }

    .form{
      display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width: 100%;
    height: 100%;
    color: rgb(139, 137, 121);

    }


  .form-input , .form-select{
    width: 350px;
    height: 40px;
    margin: 6px 0;
    text-align:center;
    font-size: 18px;
    letter-spacing: 0.18px;
    border: none;
    outline: none;
    transition: 0.25s ease;
    border-radius: 20px;
    box-shadow: 4px 4px 4px #d1d9e6 , inset -4px -4px 4px #f9f9f9;
    }

    

    .make-reservation-left{
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

    h1{
    font-size:30px;
    font-weight :700;
    color :rgb(66, 76, 47) ;
    padding-right:15px;
  }

  h3{
  font-size:35px;

  }

  form{
  margin-left:65px;
  } 

  .form-label{
  margin-top:5px;
  margin-bottom:-3px;
  padding-left:20px;
  }

  .button{
  
    width: 100px;
    height: 50px;
    border-radius: 25px;
    margin-top:05px;
    margin-bottom: 1px;
    margin-left:5px;
    font-weight: 700;
    font-size: 18px;
    letter-spacing: 1.15px;
    background-color:rgb(66, 76, 47) ;
    color:#f9f9f9;
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
  
<div class=" container" >
  <div class="make-reservation-left">
      <h1>Welcome  <?php echo "$username" ;?> to your personal profile </h1> 

  <form class="form" method="POST">
  <h3>Edit Reservation</h3><br>
    <div class="val">
      <label for="date" class="form-label">Change Date</label>
      <input type="date" class="form-input" id="date" name="date" value='<?php echo $row['reservationDate']; ?>'>
    </div>
    <div class="val">
      <label for="hour" class="form-label">Change Hour</label>
      <select class="form-select" name="hour" type="text">
        <option value="<?php echo $row['reservationHour']; ?>"><?php echo $row['reservationHour']; ?></option>
        <option value="11:30">11:30</option>
        <option value="12:30">12:30</option>
        <option value="13:30">13:30</option>
        <option value="14:30">14:30</option>
      </select>
    </div>
    <div class="val">
      <label for="seats" class="form-label">Change Table Seats</label>
      <select class="form-select" name="seats" type="number">
        <option value="<?php echo $row['seatsQty']; ?>"><?php echo $row['seatsQty']; ?></option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="6">6</option>
      </select>
    </div>
    <div class="buttons">
      <button type="submit" name="save" class="button">Save</button>
      <button type="submit" name="return" class="button">Return</button>
    </div>
  </form>
  </div>
 </div>
</body>

</html>

<?php
//if the user clicks on the save button 
if (isset($_POST['save'])) {

  $date = $_POST['date']; // date selected by the user 
  $hour = $_POST['hour']; // hour selected by the user 
  $seats = $_POST['seats']; // seats selected by the user 
  $NumberofSeats = 0; // to count the seats Ocupied in the data base


  $verifyQuery = "SELECT * FROM Reservation WHERE reservationDate='$date'";
  $res = mysqli_query($conn, $verifyQuery);

  while ($row = mysqli_fetch_array($res)) {
    if ($row['reservationHour'] == $hour) {
      $NumberofSeats += $row['seatsQty']; //incrementing the number of seats ocupied
    }
  }
  // we verify if the seats already occupied and the seats selected by the user does not reach the limit of the restaurant 
  if (($NumberofSeats + $seats) <= 20) {
    // if we have available seats we update the reservation 
    $query = "UPDATE Reservation SET reservationDate='$date', reservationHour='$hour',
              seatsQty='$seats' WHERE idReservation='$idRes'";

    $retval = mysqli_query($conn, $query);

    echo '<script>alert("Reservation updated.")</script>';
    echo '<script>window.location.href="Profile.php"</script>';
  } else {
    //if not the user will get an error message 
    echo '<script>alert("We are sorry to inform you that all the tables at that time are reserved , Please choose another date  !")</script>';
    echo '<script>window.location.href="EditReservation.php"</script>';
  }
}
//if the user clicks on the return button 
if(isset($_POST['return'])){
  echo '<script>window.location.href="ManageReservations.php"</script>';

}

?>