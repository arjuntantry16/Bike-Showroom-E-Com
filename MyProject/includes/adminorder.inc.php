<?php
    include_once 'dbh.inc.php';
    if(isset($_POST['order-btn'])){
        $brand=$_POST['brand-select'];
        $bike=$_POST['bike-select'];
        $qty=$_POST['qty'];
        if(empty($brand) || empty($bike)|| empty($qty)){
            header("location:../adminorder.php?error=emptyfields");
            exit();
        }else{
            if(!preg_match("/[0-9]/",$qty)){
                header("location:../adminorder.php?error=invalidqty");
                exit();
            }else{
                $sql = "select * from supplier where supplierbrand='$brand';";
                $result = mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)>0){
                    $row = mysqli_fetch_assoc($result);
                    $email=$row['supplieremail'];
                    $to_email = $email;
                    $subject = "Purchase Order From HTMotors";
                    $body = "Placing An Order For $bike,Quantity $qty";
                    $from_header="From: arjuntantry1013@gmail.com";
   
                    if(mail($to_email,$subject,$body,$from_header)){
                        $supplierid=$row['supplierid'];
                        $sqlbike="select * from stock where bikename='$bike';";
                        $resultbike=mysqli_query($conn,$sqlbike);
                        if(mysqli_num_rows($resultbike)>0){
                            $rowbike=mysqli_fetch_assoc($resultbike);
                            $bikeid=$rowbike['bikeid'];
                            $today=date("Y-m-d");
                            $orderdate1=strtotime($today);
                            $orderdate=date("d-m-Y",$orderdate1);
                            $sqlorder="insert into porder (supplierid,bikeid,orderqty,orderdate,orderstatus) values ('$supplierid','$bikeid','$qty','$today','Pending');";
                            mysqli_query($conn,$sqlorder);
                            header("Location:../adminorder.php?mail=sent");
                            exit();
                        }
                    }
                    else{
                        header("Location:../adminorder.php?error=mailnotsent");
                        exit();
                        }
                    }else{
                        header("location:../adminorder.php?noresults");
                        exit();
                    }
            }
        }
    }elseif(isset($_POST['status-btn'])){
        $brand=$_POST['brand-select'];
        $bike=$_POST['bike-select'];
        $qty=$_POST['qty'];
        $order=$_POST['order-select'];
        $status=$_POST['status-select'];
        if($status=="pending"){
            $sqlorder="update porder set orderstatus='$status' where orderid='$order';";
            mysqli_query($conn,$sqlorder);
            $selectorder="select * from porder where orderid='$order';";
            $resultorder=mysqli_query($conn,$selectorder);
            $rowresult=mysqli_fetch_assoc($resultorder);
            $qty = $rowresult['orderqty'];
            $bikeid=$rowresult['bikeid'];
            $selectbike="select * from stock where bikeid='$bikeid';";
            $resultbike=mysqli_query($conn,$selectbike);
            $rowbike=mysqli_fetch_assoc($resultbike);
            $qty1=$rowbike['bikeqty'];
            $qty1=$qty1-$qty;
            $updatestock="update stock set bikeqty='$qty1' where bikeid='$bikeid';";
            mysqli_query($conn,$updatestock);
            header("location:../adminorder.php?update=success");
            exit();
        }elseif($status=="delivered"){
            $sqlorder="update porder set orderstatus='$status' where orderid='$order';";
            mysqli_query($conn,$sqlorder);
            $selectorder="select * from porder where orderid='$order';";
            $resultorder=mysqli_query($conn,$selectorder);
            $rowresult=mysqli_fetch_assoc($resultorder);
            $qty = $rowresult['orderqty'];
            $bikeid=$rowresult['bikeid'];
            $selectbike="select * from stock where bikeid='$bikeid';";
            $resultbike=mysqli_query($conn,$selectbike);
            $rowbike=mysqli_fetch_assoc($resultbike);
            $qty1=$rowbike['bikeqty'];
            $qty1=$qty1+$qty;
            $updatestock="update stock set bikeqty='$qty1' where bikeid='$bikeid';";
            mysqli_query($conn,$updatestock);
            header("location:../adminorder.php?update=success");
            exit();
        }
    }
    else{
        header("location:../adminorder.php?pagenotaccessible");
        exit();
    }