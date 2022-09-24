<?php
    include_once 'dbh.inc.php';
    if(isset($_POST['form1-submit'])){
        $bookingid = $_POST['client'];
        $status = $_POST['select-booking-status'];
        $bdate = date("y-m-d");
        $sql2 = "select * from booking where bookingid='$bookingid';";
        $result2 = mysqli_query($conn,$sql2);
        if(mysqli_num_rows($result2)>0){
            $row2 = mysqli_fetch_assoc($result2);
        }
        $clientid=$row2['clientid'];
        $username = $row2['clientusername'];
        $bikeid=$row2['bikeid'];
        if($status === "a"){
            $qtystatus = "select * from stock where bikeid='$bikeid';";
            $resultstatus=mysqli_query($conn,$qtystatus);
            $rowqty = mysqli_fetch_assoc($resultstatus);
            $qty = $rowqty['bikeqty'];
            if($qty !== 0){
            $bdate = date("Y-m-d");
            $sql = "update booking set bookingstatus='$status',bookingdate='$bdate' where bookingid='$bookingid';";
            $result=mysqli_query($conn,$sql);
            $prebooking2 = "insert into prebooking2 (bookingid,clientid,clientusername,bikeid) values ('$bookingid','$clientid','$username','$bikeid');";
            mysqli_query($conn,$prebooking2);
            $sql2 = "update sales set salesstatus='a' where bookingid='$bookingid';";
            mysqli_query($conn,$sql2);
            $stupdate="update booking set bookingst='active' where bookingid='$bookingid';";
            mysqli_query($conn,$stupdate);
            header("Location:../adminbookings.php?update=success");
            exit();
            }else{
                header("location:../adminbookings.php?bikeqty=0");
                exit();
            }
        }elseif($status==="na"){
            $stockselect = "select * from stock where bikeid='$bikeid';";
            $qtyres = mysqli_query($conn,$stockselect);
            $qtyrow = mysqli_fetch_assoc($qtyres);
            $qty = $qtyrow['bikeqty'];
            $qty = $qty + 1;
            $updatestock = "update stock set bikeqty='$qty' where bikeid='$bikeid';";
            mysqli_query($conn,$updatestock);
            $sql = "update booking set bookingstatus='$status' where bookingid='$bookingid';";
            $result=mysqli_query($conn,$sql);
            $stupdate="update booking set bookingst='deactive' where bookingid='$bookingid';";
            mysqli_query($conn,$stupdate);
            header("Location:../adminbookings.php?update=success");
            exit();
        }elseif ($status==="s") {
            $sql = "update booking set bookingstatus='$status' where bookingid='$bookingid';";
            $result=mysqli_query($conn,$sql);
            $sql2 = "update sales set salesstatus='$status' where bookingid='$bookingid';";
            $result2=mysqli_query($conn,$sql2);
    
            $sql3 = "insert into validation3 (bookingid,clientid,clientusername,bikeid) values ('$bookingid','$clientid','$username','$bikeid');";
            $result3=mysqli_query($conn,$sql3);
            header("Location:../adminbookings.php?update=success");
            exit();
        }
    }else{
        header("location:../adminbookingsupdate.php?invalidaccesstopage");
    }