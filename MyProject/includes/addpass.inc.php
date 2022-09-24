<?php

include_once 'dbh.inc.php';

if(isset($_POST['submit'])){
$password = $_POST['password'];
$pass = password_hash($password,PASSWORD_DEFAULT);

$sql = "insert into admin (password) values ('$pass');";
mysqli_query($conn,$sql);
header("Location:../addpass.php?done");
}else {
    header("Location:../addpass.php?nope");
}
?>