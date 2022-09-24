<?php
    include_once 'dbh.inc.php';
    if(isset($_POST['update-submit'])){
        $bikename=$_POST['bike-select'];
        $valueselect =$_POST['value-select'];
        $value=$_POST['update-value'];
        if(empty($bikename) ||empty($valueselect)||empty($value)){
            header("Location:../adminupdate.php?error=emptyfields");
        }else {
           if($valueselect != 'bikeqty'){
               $sql = "update stock set $valueselect='$value' where bikename='$bikename';";
               mysqli_query($conn,$sql);
               header("Location:../adminupdate.php?update=success");
           }else{
            if(!preg_match("/[a-zA-Z]/",$value)){
                if($value == "0"){
                    $sql = "update stock set $valueselect='$value',bikeqtystatus=1 where bikename='$bikename';";
                    mysqli_query($conn,$sql);
                    header("Location:../adminupdate.php?update=success");
                }else {
                    $sql = "update stock set $valueselect='$value',bikeqtystatus=0 where bikename='$bikename';";
                    mysqli_query($conn,$sql);
                    header("Location:../adminupdate.php?update=success");
                }
            }else{
                header("Location:../adminupdate.php?error=qtyerror");
            }
           }
        }
    }else {
        header("Location:../adminupdate.php?update=failure");
    }