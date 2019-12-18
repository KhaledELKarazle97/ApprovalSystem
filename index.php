<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form System</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="login">
        <h3>Login into the system</h3>
        <form method="POST">
            <input type="text" id="uname"  placeholder="Username..." class="form-control" name="uname"><br>
            <input type="password" placeholder="Password..." class="form-control" id="pwrd" name="pwrd">
            <button class="btn btn-success" onclick="submit()">Login</button>
        </form>
                  
            </div>
      
</body>

<?php
require 'connection.php';
session_start();
if(isset($_POST['uname']) &&  isset($_POST['pwrd'])){    
  $username = $_POST['uname'];
  $password = $_POST['pwrd'];
    $query = "SELECT * FROM users WHERE username ='$username' AND password = '$password'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $_SESSION["username"] = $row["username"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["role"] = $row["role"];
        }
        header('Location:main.php');
    } 
    else {
        $_SESSION["username"] = null;
        echo '<script>alert("Invalid Login");</script>';
    }

}

?>
<script
  src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
  integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="scripts/index.js"></script>
</html>