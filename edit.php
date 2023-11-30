<?php

$servername="localhost";
$username="root";
$password="";
$database="myshop";

$connection = new mysqli($servername,$username,$password,$database);
$id="";
$name="";
$email="";
$phone="";
$address="";

$errorMessage="";
$successMessage="";

if($_SERVER['REQUEST_METHOD']=='GET'){
    if( !isset($_GET["id"])){
        header("location: /index.php");
        exit;
    }
    $id=$_GET["id"];
    $sql = "SELECT * FROM clients where id=$id";
    $result = $connection->query($sql);
    $row=$result->fetch_assoc();
    

    if(!$row){
        header("location: /index.php");
        exit;
    }
    $name=$row["name"];
   $email=$row["email"];
   $phone=$row["phone"];
   $address=$row["address"];
}
else{
    $name=$_POST["name"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];
}

    do{
        if(empty($name)||empty($email) ||empty($phone)||empty($address)){
          $errorMessage ="All field are required";
          break;
        }
        $sql=  "UPDATE clients".
               "SET name='$name ', email='$email',phone='$phone',address='$address'".
                "WHERE id = $id ";
        $result==$connection-> query($sql);

        if($results){
            $errorMessage="Invalid Query: " . $connection->error;
            break;
        }

        $successMessage = "Client updated succesfully";
        header("location: /index.php");
        exit;

}while(false);

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MY shop</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>
<body>
  <div class="container my-5">
    <h2>New client</h2>

    <?php
    if(!empty($errorMessage)){
      echo "
      <div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong?>$errorMessage</strong>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button> 
      </div>
      ";
    }

    ?>
    <form method="post">
        <input type="hidden" name="id" value=" <?php echo $id ?>">
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="name" value=" <?php echo $name?>"
          </div>
          
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-6">
          <input type="email" class="form-control" name="email" value=" <?php echo $email ?>"
          </div>
          
        </div>
      </div>
      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Phone</label>
        <div class="col-sm-6">
          <input type="number" class="form-control" name="phone" value="<?php echo $phone ?>"
          </div>
          
        </div>
      </div>

      <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Address</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name="adress" value="<?php echo $address ?>"
          </div>
          
        </div>
      </div>

      <?php



?>
      <div class="row mb-3">
        <div class="offset-sm-3 d-grid">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div class="col-sm-3 d-grid">
          <a class=btn btn-otline-primary href="/index.php" role="button">Cancel</a>
        </div>
      </div>
    </form>
  </div>
  
</body>
</html>