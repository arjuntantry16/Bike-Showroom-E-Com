<?php
    include_once 'dbh.inc.php';

    if(isset($_POST['tax-btn'])){
        $newvalue = $_POST['tax-value'];
        $selectedvalue =$_POST['tax-select'];
        if(empty($newvalue) || empty($selectedvalue)){
            header("Location:../taxupdate.php?error=emptyfields");  
        }else 
            if(preg_match("/\D/",$newvalue)){
                header("Location:../taxupdate.php?error=invalidentry");
        }else {
            if($selectedvalue === "greaterthan350cc"){
                $sql="update taxrates set greaterthan350cc='$newvalue' where taxid='1';";
                mysqli_query($conn,$sql);
                header("Location:../taxupdate.php?update=success");
            }else{
                $sql="update taxrates set lessthan350cc='$newvalue' where taxid='1';";
                mysqli_query($conn,$sql);
                header("Location:../taxupdate.php?update=success");
           }
        }
    
    }else {
        header("Location:../taxupdate.php?error=pageaccessdenied");
    }