<?php
session_start();
include("conn.php");
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql="SELECT * from users where username='$username' and password='$password'";
    $ress = $conn->query($sql);
    if($row=$ress->fetch_array(MYSQLI_ASSOC)){
        $_SESSION['secure']=$row['id'];
	    $_SESSION['user']=$row['username'];
	    $_SESSION['email']=$row['email'];
	    $_SESSION['image']=$row['image'];
        header("location: ../index.php");
    }else{
        header("location: ../login.php");
        // echo $conn->error;
    }

?>