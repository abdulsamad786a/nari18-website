<?php 
    session_start();
    error_reporting(0);
    include('includes/config.php');
    if(strlen($_SESSION['login'])==0)
        {   
    header('location:login.php');
    }
    else{

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        if(isset($_SESSION['order_data']) && isset($_SESSION['grandtotal_data'])) {
            $order_data = $_SESSION['order_data'];
            $amount = $_SESSION['grandtotal_data'];

            $userID = $_SESSION['id'];
            echo $userID;
            $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
            $row=mysqli_fetch_array($query);
            $name = $row['name'];
            $email = $row['email'];
            $mobile = $row['contactno'];
            // if ($result) {
            //     // Check if there is at least one row of data
            //     if ($result->num_rows > 0) {
            //         // Fetch the data and display it
            //         while ($row = $result->fetch_assoc()) {
            //             echo "Name: " . $row['name'] . "<br>";
            //             echo "Email: " . $row['email'] . "<br>";
            //             echo "Contact Number: " . $row['contactno'] . "<br>";
            //         }
            //     } 
            // } else {
            //     echo "Error: " . $sql . "<br>" . $conn->error;
            // }
            
        } else {
            echo "asdfasdfasdf";
        }
    ?>

    <?php }?>
</body>
</html>