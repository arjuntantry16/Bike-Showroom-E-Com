<?php
    include_once 'dbh.inc.php';

    if(isset($_POST['update-btn'])){
        $selectedbike = strtolower($_POST['select']);
        $qty = $_POST['qty'];
        if(empty($selectedbike) || empty($qty)){
            header("Location:../updatestock.php?error=emptyfields");  
        }else {
            $sql = "select * from stock where bikename='$selectedbike';";
            $result = mysqli_query($conn,$sql);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $sqlupdate = "update stock set bikeqty='$qty' where bikename='$selectedbike';";
                    mysqli_query($conn,$sqlupdate);
                    if($qty == 0){
                        $sqlstatus = "update stock set bikeqtystatus=1 where bikename='$selectedbike';";
                        mysqli_query($conn,$sqlstatus);
                        header("Location:../updatestock.php?success");
                    }else {
                        $sqlstatus = "update stock set bikeqtystatus=0 where bikename='$selectedbike';";
                        mysqli_query($conn,$sqlstatus);
                        header("Location:../updatestock.php?success");
                    }
                }
            }else {
                header("Location:../updatestock.php?error=nobikesfound");
            }
        }
    }else if(isset($_POST['delete-btn'])){
        $selectedbike = strtolower($_POST['select']);
        $deletequery = "delete from stock where bikename='$selectedbike';";
        mysqli_query($conn,$deletequery);
        header("Location:../updatestock.php?delete=success");
        }else {
            header("Location:../updatestock.php?notsuccessful");
            }
        