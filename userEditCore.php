<?php 

if($_REQUEST["editId"]){
echo $editId = $_REQUEST["editId"];
}
else {
   // header("location:index.php");
}
if(isset($_REQUEST['userName'])){
$editUserName=$_REQUEST['userName'];
}else{
    header('location:index.php');
}
if(isset($_REQUEST['email'])){
$editEmail=$_REQUEST['email'];
}else{
    header('location:index.php');
}
if(isset($_REQUEST['role'])){
$editRole=$_REQUEST['role'];
}else{
    header('location:index.php');
}




?>
