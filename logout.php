<?php

session_start();
if($_SESSION['password_hash']){
    $password_hash=$_SESSION['password_hash'] ;
}

setcookie( 'PHPHHPHPMSSDDF',$password_hash, time()-300 );
session_unset();
header("Location: login.php");

?>