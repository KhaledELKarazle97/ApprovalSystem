<?php
include 'connection.php';
if($_REQUEST['id']){
$id = $_REQUEST['id'];

$query = "DELETE FROM forms WHERE ID = '$id'";
$query2 = "DELETE FROM form_user WHERE formID = '$id'";

if(mysqli_query($conn,$query) && mysqli_query($conn,$query2)){
header('Location:main.php');
}
}
?>