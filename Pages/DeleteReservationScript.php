<?php
//connection to the database
include  '../Database/connect.h';
session_start();

$reservationId = $_GET['idReservation'];

//the delete query 
$sql = "DELETE FROM Reservation WHERE idReservation='".$reservationId."'";
$retval = mysqli_query( $conn, $sql );

		if(! $retval ){
			die(mysqli_error($conn)); 
		}

        echo '<script>alert("Reservation Deleted!")</script>';
        echo '<script>window.location.href="ManageReservations.php"</script>';

?>