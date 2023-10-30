<?php
session_start();

if($_SESSION["role"] != "admin"){
header("location:index.php");
}
if(!isset($_REQUEST["edit"]) || $_REQUEST["edit"]==""){
header("location:index.php");
}
 $editId=$_REQUEST['edit'] ? $_REQUEST['edit'] -1:0;

$data=file("data\userData.txt");
$info=explode(",",$data[$editId]);
$dataRole=$info[0];

  $userErr = $emailErr = $passErr = "";
  
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['userName'];
    $email    = $_POST['email'];
    $role = $_POST['role'] ?? "";


    $error = [];

    if (empty($username)) {
      $userErr = 'Username field must not be empty!';
      $error[] = true;
    }
    if(empty($email)) {
      $emailErr = "Email field must not be empty!";
      $error[] = true;
    }
    if (empty($role)) {
      $passErr = "Role field must not be empty!";
      $error[] = true;
    }

    if ( count($error) === 0 ) {
      $filename = "data/userData.txt";

  
      unset($data[$editId]);

      echo "<pre>";
      print_r($data);

      $newData = sprintf("%s,%s,%s,%s",$role,$username,$email,$info[3]);
      array_push($data,$newData);
      print_r($data);
      echo "</pre>";
      
      
      if ( is_writeable($filename) ) {

        $fp = fopen($filename,"w");
        
        foreach($data as $line) {
          fwrite($fp,$line);
          header("location:index.php");
        }

        fclose($fp);

      }
      
    } 

  }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    
    <div class="container mt-5">
        <h1 class="text-center">Edit account</h1>

        <form action="userEdit.php" method="POST">
<input type="hidden" name="editId" value="<?php echo$count?>">
      

        <div class="form-group">
            <label for="lastname">User Name </label>
            <input type="text" class="form-control" name="userName" value="<?php echo$info[1]?>" id="lastName" placeholder="User Name">
            
        </div>

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" name="email" id="email" value="<?php echo$info[2]?>" aria-describedby="emailHelp" placeholder="Enter email">
            
        </div>
        <div class="form-group">
            <label for="exampleCheck1">Role </label>
       
            <select name="role" class="form-control" id="exampleCheck1">

                <?php if($dataRole=='admin') { ?>
                <option selected value='admin'>Admin</option>
                <option  value='manager'>Manager</option>
                <option  value='user'>User</option>
                <?php }elseif($dataRole =='manager') { ?>
                <option  value='admin'>Admin</option>
                <option selected value='manager'>Manager</option>
                <option  value='user'>User</option>
                <?php }elseif($dataRole=='user') { ?>
                    <option  value='admin'>Admin</option>
                <option  value='manager'>Manager</option>
                <option selected  value='user'>User</option>
                    <?php }?>
                
            </select>
            
        </div>
        

        

        <p class="text-warning">
            
        </p>

        <button type="submit" class="btn btn-warning"> Edit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>