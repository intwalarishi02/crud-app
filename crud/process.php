<?php


session_start();
$id = 0;
$update = false;
$SongName='';
$SingerName='';

$mysqli = new mysqli('localhost' , 'root' , 'rishi' , 'mgmt') or die(mysqli_error($mysqli));

 if(isset($_POST['save'])){
     $SongName = $_POST['SongName'];
     $SingerName = $_POST['SingerName'];

     $mysqli->query("INSERT INTO data (SongName , SingerName) VALUES('$SongName' , '$SingerName')") or 
            die($mysqli->error);

     $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "Success";

    header("Location: index.php");
    exit();

  
 }

 if(isset($_GET['delete'])){
     $id = $_GET['delete'];
     $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

     $_SESSION['message'] = "Record has been deleted!";
     $_SESSION['msg_type'] = "Danger";

     header("Location: index.php");
     exit();

 
 }

 if(isset($_GET['edit'])){
     $id =  $_GET['edit'];
     
     $update = true; 
     $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    
     if(count($_GET)>0){
         
         $row = $result->fetch_array();
         $SongName = $row['SongName'];
         $SingerName = $row['SingerName'];
     

     }
 }

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $SongName = $_POST['SongName'];
    $SingerName = $_POST['SingerName'];

    $mysqli->query("UPDATE data SET SingerName = '$SingerName' , SongName = '$SongName' WHERE id=$id") or
    die($mysqli->error);
    
    $_SESSION['message'] = "Record has been updated";
    $_SESSION['msg_type'] = "warning";

    header("Location: index.php" );
    exit();
}