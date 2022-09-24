<?php
    require_once 'dbh.inc.php'; 
    session_start();
    $bikeid=$_SESSION['bikeid'];
    $prevpage=$_SESSION['pagename'];
    $advanceprice=$_SESSION['ap'];
    $username=$_SESSION['username'];
    
    $radio = $_POST['radio'];
    if(isset($_POST['payment-btn'])){
        
        $qtyquery = "select * from stock where bikeid='$bikeid';";
        $resultqty = mysqli_query($conn,$qtyquery);
        $rowqty = mysqli_fetch_assoc($resultqty);
        $qty = $rowqty['bikeqty'];
        if(!empty($radio)){
            if($radio === "cheque"){
                $sqlclient = "select * from client where clientusername='$username';";
                $resultclient = mysqli_query($conn,$sqlclient);
                $rowclient = mysqli_fetch_assoc($resultclient);
                $clientid=$rowclient['clientid'];
                $bankholdername = $_POST['accholderinput'];
                $branchname = $_POST['branchinput'];
                $accountno = $_POST['bankaccountnoinput'];
                if(empty($bankholdername)||empty($branchname)||empty($accountno)){
                    header("location:../booking.php?error=emptyfields&bikeid=$bikeid&pagename=$prevpage&ap=$advanceprice");
                    exit();
                }else{
                $paytype = "cheque";
                $bookingdate1 = date('Y-m-d');
                $timestamp = strtotime($bookingdate1);
                $bookingdate = date("d-m-Y",$timestamp);

                $random = uniqid();
                if(strlen($accountno) < 12){
                    header("location:../booking.php?error=accnonotaccurate&bikeid=$bikeid&pagename=$prevpage&ap=$advanceprice");
                    exit();
                }

                $sqlbike = "select * from stock where bikeid='$bikeid';";
                $resultbike = mysqli_query($conn,$sqlbike);
                $rowbike=mysqli_fetch_assoc($resultbike);
                $bikeprice = $rowbike['bikeprice'];
                $qty = $rowbike['bikeqty'];
                $qty = $qty-1;
                $update = "update stock set bikeqty=$qty where bikeid='$bikeid';";
                mysqli_query($conn,$update);

                #inserting into booking table--
                $bookingquery = "insert into booking (bookinguno,clientid,clientusername,bikeid,clientbankaccno,bikeadvanceprice,bikeprice,bookingstatus,bookingdate,paymentmode,bookingst) values ('$random','$clientid','$username','$bikeid','$accountno','$advanceprice','$bikeprice','na','$bookingdate','$paytype','not-set');";
                mysqli_query($conn,$bookingquery);

                #getting bookingid from booking--
                $bookingidquery = "select * from booking where bookinguno='$random';";
                $resultbid = mysqli_query($conn,$bookingidquery);
                if(mysqli_num_rows($resultbid)>0){
                    $bid=mysqli_fetch_assoc($resultbid);
                    $bookingid=$bid['bookingid'];
                }
                #inserting into prebooking1 table--
                $prebookingquery = "insert into prebooking1 (bookingid,clientid,clientusername,bikeid) values ('$bookingid','$clientid','$username','$bikeid');";
                mysqli_query($conn,$prebookingquery);

                #inserting clientspayment information into a table
                $sql = "insert into clientpaymentinfo (bookingid,clientid,clientbankname,clientbankaccno,clientbankbranchname,clientpaymentmode) values ('$bookingid','$clientid','$bankholdername','$branchname','$accountno','$paytype');";
                mysqli_query($conn,$sql);
             

                header("location:../index.php?booking=considered&bookingid=$bid");
                exit();
            }
            }else if($radio === "neft"){
                $sqlclient = "select * from client where clientusername='$username';";
                $resultclient = mysqli_query($conn,$sqlclient);
                $rowclient = mysqli_fetch_assoc($resultclient);
                $clientid=$rowclient['clientid'];
                $bankholdername = $_POST['accholderinput1'];
                $branchname = $_POST['branchinput1'];
                $accountno = $_POST['bankaccountnoinput1'];
                if(empty($bankholdername)||empty($branchname)||empty($accountno)){
                    header("location:../booking.php?error=emptyfields&bikeid=$bikeid&pagename=$prevpage&ap=$advanceprice");
                    exit();
                }else{
                    $bookingdate1 = date('Y-m-d');
                    $timestamp = strtotime($bookingdate1);
                    $bookingdate = date("d-m-Y",$timestamp);
                $paytype = "neft";
                $sql = "insert into clientpaymentinfo (clientid,clientbankname,clientbankaccno,clientbankbranchname,clientpaymentmode) values ('$clientid','$bankholdername','$branchname','$accountno','$paytype');";
                mysqli_query($conn,$sql);
                $random = uniqid();
                if(strlen($accountno) < 12){
                    header("location:../booking.php?error=accnonotvalid&bikeid=$bikeid&pagename=$prevpage&ap=$advanceprice");
                    exit();
                }

                $sqlbike = "select * from stock where bikeid='$bikeid';";
                $resultbike = mysqli_query($conn,$sqlbike);
                $rowbike=mysqli_fetch_assoc($resultbike);
                $bikeprice = $rowbike['bikeprice'];
                $qty = $rowbike['bikeqty'];
                $qty = $qty-1;
                $update = "update stock set bikeqty=$qty where bikeid='$bikeid';";
                mysqli_query($conn,$update);

                #inserting into booking table--
                $bookingquery = "insert into booking (bookinguno,clientid,clientusername,bikeid,clientbankaccno,bikeadvanceprice,bikeprice,bookingstatus,bookingdate,paymentmode,bookingst) values ('$random','$clientid','$username','$bikeid','$accountno','$advanceprice','$bikeprice','na','$bookingdate','$paytype','not-set');";
                mysqli_query($conn,$bookingquery);

                #getting bookingid from booking--
                $bookingidquery = "select * from booking where bookinguno='$random';";
                $resultbid = mysqli_query($conn,$bookingidquery);
                if(mysqli_num_rows($resultbid)>0){
                    $bid=mysqli_fetch_assoc($resultbid);
                    $bookingid=$bid['bookingid'];
                }
                #inserting into prebooking1 table--
                $prebookingquery = "insert into prebooking1 (bookingid,clientid,clientusername,bikeid) values ('$bookingid','$clientid','$username','$bikeid');";
                mysqli_query($conn,$prebookingquery);

                #inserting clientspayment information into a table
                $sql = "insert into clientpaymentinfo (bookingid,clientid,clientbankname,clientbankaccno,clientbankbranchname,clientpaymentmode) values ('$bookingid','$clientid','$bankholdername','$branchname','$accountno','$paytype');";
                mysqli_query($conn,$sql);
                

                header("location:../index.php?booking=considered&bookingid=$bid");
                exit();
            }
            }else if($radio === "cash"){
                $sqlclient = "select * from client where clientusername='$username';";
                $resultclient = mysqli_query($conn,$sqlclient);
                $rowclient = mysqli_fetch_assoc($resultclient);
                $clientid=$rowclient['clientid'];
                $bankholdername="";
                $branchname="";
                $accountno="";
                $paytype = "cash";
                $bookingdate1 = date('Y-m-d');
                $timestamp = strtotime($bookingdate1);
                $bookingdate = date("d-m-Y",$timestamp);
                $random = uniqid();

                #inserting into booking table--
                $bookingquery = "insert into booking (bookinguno,clientid,clientusername,bikeid,clientbankaccno,bikeadvanceprice,bikeprice,bookingstatus,bookingdate,paymentmode,bookingst) values ('$random','$clientid','$username','$bikeid','$accountno','$advanceprice','$bikeprice','na','$bookingdate','$paytype','not-set');";
                mysqli_query($conn,$bookingquery);

                #getting bookingid from booking--
                $bookingidquery = "select * from booking where bookinguno='$random';";
                $resultbid = mysqli_query($conn,$bookingidquery);
                if(mysqli_num_rows($resultbid)>0){
                    $bid=mysqli_fetch_assoc($resultbid);
                    $bookingid=$bid['bookingid'];
                    
                }
                #inserting into prebooking1 table--
                $prebookingquery = "insert into prebooking1 (bookingid,clientid,clientusername,bikeid) values ('$bookingid','$clientid','$username','$bikeid');";
                mysqli_query($conn,$prebookingquery);

                $sqlbike = "select * from stock where bikeid='$bikeid';";
                $resultbike = mysqli_query($conn,$sqlbike);
                $rowbike = mysqli_fetch_assoc($resultbike);
                $qty = $rowbike['bikeqty'];
                $qty = $qty-1;
                $update = "update stock set bikeqty='$qty' where bikeid='$bikeid';";
                mysqli_query($conn,$update);

                #inserting clientspayment information into a table
                $sql = "insert into clientpaymentinfo (bookingid,clientid,clientbankname,clientbankaccno,clientbankbranchname,clientpaymentmode) values ('$bookingid','$clientid','$bankholdername','$branchname','$accountno','$paytype');";
                mysqli_query($conn,$sql);
                header("location:../index.php?booking=considered&bookingid=$bid");
                exit();
            }
            
        }else{
            header("location:../booking.php?error=nomethodselected&bikeid=$bikeid&pagename=$prevpage&ap=$advanceprice");
            exit();
        }
    
    }else {
        header("location:../booking.php?pagenotaccessible&bikeid=$bikeid&pagename=$prevpage&ap=$advanceprice");
        exit();
    }