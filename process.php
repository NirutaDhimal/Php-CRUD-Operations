<?php

session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$databasename = 'crud';
$port = NULL;
$tablename = 'User Details';

$mysqli = new mysqli('127.0.0.3', $username, $password, $databasename, $port);

$name = '';
$location = '';
$email = '';
$update = false;
$ID = 0;

if($mysqli->connect_error){
    die("connection failed" . $mysqli->connect_error);
}

if (isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];
    $email = $_POST['email'];
   

    $mysqli->query("INSERT INTO `user details`( `Name`, `Location`, `Email`) VALUES ('$name','$location','$email')")
     or die($mysqli->error);

     $_SESSION['message'] = "Record has been saved!";
     $_SESSION['msg_type'] = "success";

     header("location: index.php");
}

if(isset($_GET['delete'])){
    $ID = $_GET['delete'];
    $mysqli->query("DELETE FROM `user details` WHERE  ID = $ID ") 
     or die($mysqli->error());

     $_SESSION['message'] = "Record has been deleted!";
     $_SESSION['msg_type'] = "danger";

     header("location: index.php");
}

if(isset($_GET['edit'])){
    $ID = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM `user details` WHERE ID = $ID") or die($mysqli->error());
    if (count( $result ) == 1){
        $row = $result->fetch_array();
        $name = $row['Name'];
        $location = $row['Location'];
        $email = $row['Email'];
    }
}

if(isset($_POST['update'])){
    $ID = $_POST['ID'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $email = $_POST['email'];

    $mysqli->query("UPDATE `user details` SET `Name` = '$name', `Location` = '$location', `Email` = '$email' WHERE ID = $ID ")
    or die($mysqli->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}

?>