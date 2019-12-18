<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="container">


<?php
require 'connection.php';
session_start();
if($_REQUEST['id']){
$id = $_REQUEST['id'];
$query = "SELECT * FROM forms WHERE ID = $id";
$result = $conn->query($query);
if ($result->num_rows > 0) { 
    while($row = $result->fetch_assoc()) {
    $name = $row['name'];
    $gender = $row['gender'];
    $address = $row['address'];
    $country[] = $row['country'];
    $description = $row['description'];
    $status = $row['status'];
    $v1 = $row['verif1'];
    $v2 = $row['verif2'];
    $reason = $row['reason'];

    }
}
}
?>
<form action="" method="POST" enctype="multipart/form-data">
<fieldset <?php if($_SESSION['role'] === 'manager'){ ?> disabled <?php } ?>>
<legend>Section A</legend>
<label for="">Name:</label>
<input type="text" name="uname" id="" value='<?php echo $name ?>' class="form-control"><br>
<label for="">Gender:</label>
<?php
if($gender==='male'){
    echo '<input type="radio" name="ugender" id="gender" value="male" checked>Male';
    echo '<input type="radio" name="ugender" id="gender" value="female">Female';
}
if($gender==='female'){
    echo '<input type="radio" name="ugender" id="gender" value="male" >Male';
    echo '<input type="radio" name="ugender" id="gender" value="female" checked>Female';
}
?>
<br><br>
<label for="">Address:</label><br>
<textarea name="uaddress" id="" cols="30" rows="10" class="form-control"> <?php echo $address ?></textarea>
<br><label for="">Country:</label>
<select name="ucountry" class="form-control">
<?php

foreach($country as $country){
    echo "<option value='{$country}'>{$country}</option>";	
}
    if($country == 'Australia'){
        echo "<option value='Malaysia'>Malaysia</option>";	

    }else{
        echo "<option value='Australia'>Australia</option>";	
    }
?>
</select>
</fieldset>

<fieldset <?php if($_SESSION['role'] === 'user' ){ ?> disabled <?php } ?>  >
<legend>Section B</legend>
        <label for="f1">File 1:</label>
        <input type="file" name="file1" id="f1">
        <label for="v1">Verified:</label>
        <?php  
            if($v1 === 'verified'){
                echo'<input type="checkbox" name="v1" id="v1" value="verified" checked>Verified';
            }else{
                echo'<input type="checkbox" name="v1" id="v1" value="verified">Verified';
            }
        ?>         
        <br><br>
        <label for="f2">File 2:</label>
        <input type="file" name="file2" id="f2">
        <label for="v2">Verified:</label>
        <?php  
            if($v2 === 'verified'){
                echo'<input type="checkbox" name="v2" id="v2" value="verified" checked>Verified';
            }else{
                echo'<input type="checkbox" name="v2" id="v2" value="verified">Verified';
            }
        ?> 
</fieldset>

<fieldset <?php if($_SESSION['role'] === 'manager'){ ?> disabled <?php } ?>> 
        <legend>Section C</legend>
        <label for="d">Description:</label><br>
        <textarea name="udescription" id="d" cols="30" rows="10" class="form-control"> <?php echo $description ?></textarea>
</fieldset>

<fieldset <?php if($_SESSION['role'] === 'user'){ ?> disabled <?php } ?>  >
        <legend>Section D</legend>
        <label for="reason">Reason:</label>
        <br> <textarea name="reason" id="reason" cols="30" rows="10" class="form-control"><?php echo $reason ?></textarea>
        <br><label>Status:</label>
        <?php
        
        if($status == 'Approved'){
            echo'  <input type="radio" name="status" id="status" value="Approved" checked>Approved
            <input type="radio" name="status" id="status" value="Not Approved">Not Approved';
        }else if($status == 'Not Approved'){
            echo'  <input type="radio" name="status" id="status" value="Approved" >Approved
            <input type="radio" name="status" id="status" value="Not Approved" checked>Not Approved';
        }else{
             echo'  <input type="radio" name="status" id="status" value="Approved" >Approved
            <input type="radio" name="status" id="status" value="Not Approved" >Not Approved';
        }
        
        ?>
      
        </fieldset><br>

<?php
require 'connection.php';


if($status == 'Pending' && $_SESSION['role']==='user' ){
    echo 'Your form is still pending, you cannot edit it until it is approved / disapproved';
}
else{
    echo '<input type="submit" value="Update"></input>';   
}

if($_SESSION['role'] != 'user'){
    
    if(isset($_FILES['file1']) && isset($_FILES['file2'])){
    move_uploaded_file($_FILES['file1']['tmp_name'],'file_server/'.$_FILES['file1']['name']);
    move_uploaded_file($_FILES['file2']['tmp_name'],'file_server/'.$_FILES['file2']['name']);
    }

    if(
        isset($_POST['reason']) &&
        isset($_POST['status'])
    ){
    
        $reason = $_POST['reason'];
        $status = $_POST['status'];
        $v1 = $_POST['v1'];
        $v2 = $_POST['v2'];
    
        $query = "
        UPDATE forms
        SET 
        reason = '$reason',
        status = '$status',
        verif1 = '$v1',
        verif2 = '$v2'
        WHERE ID = '$id'";
    
        if(mysqli_query($conn,$query) ){
            header("Location:main.php");
           
       }else{
           echo mysqli_error($conn);
       }
    
    }

}
else{
    if(
        isset($_POST['uname']) &&
        isset($_POST['ugender']) &&
        isset($_POST['uaddress'])&&
        isset($_POST['ucountry']) &&
        isset($_POST['udescription'])
    ){
    
        $uname = $_POST['uname'];
        $ugender = $_POST['ugender'];
        $uaddress = $_POST['uaddress'];
        $ucountry = $_POST['ucountry'];
        $udescription = $_POST['udescription'];
    
    
        $query = "
        UPDATE forms
        SET 
        name = '$uname',
        gender = '$ugender',
        address = '$uaddress',
        country = '$ucountry',
        description = '$udescription'
        WHERE ID = '$id'";
    
    
        
    
        if(mysqli_query($conn,$query) ){
            header("Location:main.php");
           
       }else{
           echo mysqli_error($conn);
       }
    
    }
}

?>

</form>

</body>
</html>