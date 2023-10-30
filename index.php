<?php 
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
}

if (isset($_SESSION["role"])) {
    $admin=$_SESSION["role"];
}
if($_SESSION["userName"]){
  $userName=$_SESSION["userName"];
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Admin </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<div class="content">
    
    <div class="container">
      <div>
        <h4>CRUD</h4>
        <h1>Welcome !
           <?php 
           if ($admin) {
            echo "$userName .  Website {$admin}";
           }
        
        
        
        ?></h1>
        <h1>A Sample Project CRUD Operations</h1>
      </div>
      <?php 
      if($admin== "admin") {?>
      <a class="btn btn-success" href="registration.php">Add Admin</a>
<?php }?>

<a class="btn btn-success" href="logout.php">Log Out</a>
      <div class="table-responsive custom-table-responsive">

        <table class="table custom-table">
          <thead>
            <tr> 
                             
              <th scope="col">Serial</th>
              <th scope="col">User Name</th>
              <th scope="col">Email</th>
              <th scope="col">User Role</th>
              <?php if($admin=="admin"){?>
              <th scope="col">Action</th>
              <?php }?>
              <?php if($admin=="manager"){?>
              <th scope="col">Action</th>
              <?php }?>
            </tr>
          </thead>
          <tbody>
            <?php 
            $fileName="data\userData.txt";
            $filePath=fopen($fileName,"r");
            $count=0;
            while($file=fgetcsv($filePath)){
             $count++;
             $userName=$file[1];
             $email=$file[2];
             $password=$file[3];
             $role=$file[0];
            ?>
            <tr scope="row">
            <td><?php echo $count < 10 ? 0 . $count : $count;?></td>
                <td><?php echo$userName;?></td>
                <td><?php echo$email;?></td>
                <td><?php echo$role?></td>
                <?php if($admin== "admin"){?>
                <td>
                <a class="btn btn-info" href="userEdit.php?<?php echo"edit=$count"; ?>">Edit</a> ||
                <a class="btn btn-danger" href="userDelete.php?<?php echo "delete=$count"; ?>">Delete</a>

                </td>
                <?php }?>
                <?php if($admin== "manager"){?>
                <td>
                <a class="btn btn-info" href="">Edit</a>

                </td>
                <?php }?>
             
              
            </tr>
            <?php }?>
            

            
          </tbody>
        </table>
      </div>


    </div>

  </div>
    


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</body>
</html>