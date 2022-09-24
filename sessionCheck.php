<?php
session_abort();
session_start();
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    if(isset($_SESSION['username'])){
        echo "Hello ".$_SESSION['username'] ."your session is already active!";
    }else{
        echo $_SESSION['username']."Session";
    }
}else{
    header("Location:example.php");
}
?>