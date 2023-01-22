<?php
    //connection to the database
    include  '../Database/connect.h';

    session_start();

    $productId = $_GET['productId'];

    //the delete query 
    $sql = "DELETE FROM Product WHERE productId='$productId'";
    $query = mysqli_query($conn, $sql);

    echo '<script>alert("The selected Food was deleted from the database")</script>';
    echo '<script>window.location.href="ManageFoods.php"</script>';

?>