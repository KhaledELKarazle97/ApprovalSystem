<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>New Form</title>
</head>
<body class="container">
    <form action="" method="post">
    <fieldset>
    <legend>Section A</legend>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control"><br>
        <label>Gender:</label>
        <input type="radio" name="gender" id="gender" value="male">Male
        <input type="radio" name="gender" id="gender" value="female">Female<br><br>
        <label for="address">Address:</label><br>
        <textarea name="address" id="address" cols="30" rows="5" class="form-control"></textarea>
        <br><label>Country:</label>
        <select name="country" id="country" class="form-control">
        <option value="Malaysia">Malaysia</option>
        <option value="Australia">Australia</option>
        </select><br>
        </fieldset>

        <?php
        session_start();
        echo'
        <fieldset disabled>
        <legend>Section B</legend>
        <label for="f1">File 1:</label>
        <input type="file" name="file1" id="f1" >
        <label for="v1">Verified:</label>
        <input type="checkbox" name="v1" id="v1" >Verified
        <br><br>

        <label for="f2">File 2:</label>
        <input type="file" name="file2" id="f2" >
        <label for="v2">Verified:</label>
        <input type="checkbox" name="v2" id="v2" >Verified
        </fieldset>';
        
        ?>

        <fieldset>
        <legend>Section C</legend>
        <label for="d">Description:</label><br>
        <textarea name="description" id="d" cols="30" rows="10" class="form-control"></textarea>
        </fieldset>
        <?php
        echo'
        <fieldset disabled>
        <legend>Section D</legend>
        <label for="reason">Reason:</label>
        <br> <textarea name="reason" id="reason" cols="30" rows="10" class="form-control"></textarea>
        <br><label>Status:</label>
        <input type="radio" name="status" id="status" value="Approved">Approved
        <input type="radio" name="status" id="status" value="Not Approved">Not Approved
        </fieldset><br>';
        ?>
        <br>
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </form>
<?php
require 'connection.php';
if(
    isset($_POST['name']) &&
    isset($_POST['gender']) &&
    isset($_POST['address'])&&
    isset($_POST['country']) &&
    isset($_POST['description'])
){
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $usernme = $_SESSION['username'];
    $id = time();
    $date = date('Y-m-d');
    
    $query = "INSERT INTO forms (ID,owner,date,name,description,gender,address,country,status,reason,verif1,verif2) VALUES ('$id','$usernme','$date','$name','$description','$gender','$address','$country','Pending','',0,0)";
   


    if(mysqli_query($conn,$query) ){
         header('Location:main.php');

    }else{
        echo mysqli_error($conn);
    }
    
}


?>
</body>
</html>