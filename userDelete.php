<?php 
session_start();
if (isset($_SESSION["role"])) {
    $admin=$_SESSION["role"];
} else {
   // header("location:index.php");
}

if (isset($_GET['delete'])) {
    $index =  $_GET['delete']-1;
  
    $data = file('data/userData.txt');
    
    unset($data[$index]);
    
    $count = count($data);
  
    if ($count != 0) {
      $fp = fopen("data/userData.txt","w");
  
      foreach($data as $line) {
        fwrite($fp,$line);
      }
  
      fclose($fp); 
    }
    header("Location:index.php");
  }
  

?>