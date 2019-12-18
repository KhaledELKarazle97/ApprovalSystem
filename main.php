<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="container">

<?php
require 'connection.php';
session_start();
if($_SESSION['username'] == null){
    header('Location:index.php');
}else{


echo'<h1>Welcome '.$_SESSION['name'].'</h1>';
$usernme = $_SESSION['username'];
if ($_SESSION['role'] === 'user') {
    echo'<a href="new.php">+ Add New Form</a> <br>';
}


echo '<a href="logout.php">Logout</a>';
if($_SESSION['role'] === 'user'){
    $query = "SELECT * FROM forms WHERE owner = '$usernme'";
}else{
    $query = "SELECT * FROM forms"; 
}

$result = $conn->query($query);
if ($result->num_rows > 0) { 
    echo'<table class="table table-stripped">';
    echo '<tr>';
                echo '<th>Owner</th>';
                echo '<th>Date</th>';
                echo '<th>Status</th>';
                echo '<th colspan="2">Actions</th>';
    echo '</tr>';
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
                echo'<td>'.$row["owner"].'</td>';
                echo'<td>'.$row["date"].'</td>';
                echo'<td>'.$row["status"].'</td>';
                echo'<td>';
                echo "<a href=edit.php?id=".$row['ID'].">Edit</a>";
                echo'</td>';
                echo '<td>';
                     echo "<a href=delete.php?id=".$row['ID'].">Delete</a>";
                echo'</td>';
                
        echo '</tr>';
    }  
    echo'</table>'; 
}else{
    echo '<h2>You dont have any forms yet</h2>';
}


}
?>
    
    </body>
</html>