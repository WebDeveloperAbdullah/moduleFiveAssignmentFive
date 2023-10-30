<?php 
session_start();



echo $emailUser = $_POST["email"] ?? "";
echo $password = $_POST["password"] ?? "";



$errorMessage = "";
$fileName="data\userData.txt";
$filePath= fopen($fileName,"r");

$userName = array();
$emailUser = array();
$password = array();
$admin = array();


while ($line = fgets($filePath)) {
 $values=explode(",", $line);
    array_push($userName, trim($values[0]));
    array_push($emailUser, trim($values[1]));
    array_push($password,trim($values[2]));
    array_push($admin, trim($values[3])); 
}

 fclose($filePath);

$count=count($admin);

for ($i = 0; $i < $count; $i++) {
    if ($emailUser == $emailUser[$i] && $password == $password[$i]) {
        $_SESSION["userName"] = $userName[$i];
        $_SESSION["emailUser"] = $emailUser[$i];
        $_SESSION["password"] = $password[$i];
        $_SESSION["admin"] = $admin[$i];
     
       header("Location:index.php");
    }
    else {
        $errorMessage = "Wrong email or password";
    }
}





?>