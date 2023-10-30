<?php
session_start();
if (isset($_SESSION["email"])) {
    header("Location: index.php");
}


$email = $_POST["email"] ?? "";
$password = $_POST["password"] ?? "";
$_SESSION['password_hash']= $password_hash = sha1 ($email.$password);

$errorMessage = "";


$fp = fopen("data/userData.txt", "r");

$role = array();
$userName = array();
$emails = array();
$passwords = array();

while ($line = fgets($fp)) {
    $values = explode(",", $line); 
    array_push($role, trim($values[0]));
    array_push($userName, trim($values[1]));
    array_push($emails, trim($values[2]));
    array_push($passwords, trim($values[3]));
 
  
}

fclose($fp);


for ($i = 0; $i < count($role); $i++) {
    if ($email == $emails[$i] && $password == $passwords[$i]) {
        $_SESSION["role"] = $role[$i];
        $_SESSION["userName"] = $userName[$i];
        $_SESSION["email"] = $emails[$i];
       
        setcookie( 'PHPHHPHPMSSDDF',$password_hash, time() + 300 );
       header("Location: index.php");
       
    }
    else {
        $errorMessage = "Wrong email or password";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    
    <div class="container mt-5">
        <h1 class="text-center">Login to you account</h1>

        <form action="login.php" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="******">
        <!-- </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Remember me</label>
        </div> -->

        <p class="text-warning">
            <?php echo $errorMessage; ?>
        </p>
        <button type="submit" name="submit" class="btn btn-primary">Login</button>
        </form>
        <a class="btn btn-warning" href="registration.php">Register</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>