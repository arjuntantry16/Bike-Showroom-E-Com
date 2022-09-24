<?php
    include_once 'dbh.inc.php';
    session_start();
    $bikeid=$_SESSION['bikeid'];
    $prevpage=$_SESSION['pagename'];
    $price=$_SESSION['ap'];
    $username=$_SESSION['username'];
    $bookingid=$_SESSION['bookingid'];
    $radio = $_POST['radio'];
   
    if(isset($_POST['payment-btn'])){
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
                    header("location:../payment.php?error=emptyfields&bookingid=$bookingid&bikeid=$bikeid&pagename=$prevpage&ap=$price");
                    exit();
                }else{
                $paytype = "cheque";
                $salesdate = date('Y-m-d');
                if(strlen($accountno) < 12){
                    header("location:../payment.php?error=accnonotaccurate&bookingid=$bookingid&bikeid=$bikeid&pagename=$prevpage&ap=$price");
                    exit();
                }
                #updating into clientpaymentinfo table--
                $sql = "update clientpaymentinfo set clientfinalpaymentmode='$paytype' where bookingid='$bookingid';";
                mysqli_query($conn,$sql);
                $random = uniqid();

                $sql3 = "insert into clientfinalpaymentinfo (bookingid,clientid,clientusername,clientbankname,clientbankaccno,clientbankbranchname,clientfinalpaymode) values ('$bookingid','$clientid','$username','$bankholdername','$accountno','$branchname','cheque');";
                mysqli_query($conn,$sql3);
                $random = uniqid();


                #inserting into sales table--
                $bookingquery = "insert into sales (bookingid,clientid,clientusername,bikeid,salesstatus,salesdate,paymentmode,deliverystatus) values ('$bookingid','$clientid','$username','$bikeid','na','$salesdate','$paytype','n');";
                mysqli_query($conn,$bookingquery);
                $sqlsalesquery = "select * from sales where bookingid='$bookingid';";
                $resultsales=mysqli_query($conn,$sqlsalesquery);
                if(mysqli_num_rows($resultsales)>0){
                    $rowsales=mysqli_fetch_assoc($resultsales);
                    $salesid=$rowsales['salesid'];
                }
                header("location:../index.php?sales=considered&bookingid=$bookingid&salesid=$salesid");
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
                    header("location:../payment.php?error=emptyfields&bookingid=$bookingid&bikeid=$bikeid&pagename=$prevpage&ap=$price");
                    exit();
                }else{
                    $paytype = "neft";
                    $salesdate = date('Y-m-d');
                    if(strlen($accountno) < 12){
                        header("location:../payment.php?error=accnonotaccurate&bookingid=$bookingid&bikeid=$bikeid&pagename=$prevpage&ap=$price");
                        exit();
                    }
                    #updating into clientpaymentinfo table--
                $sql = "update clientpaymentinfo set clientfinalpaymentmode='$paytype' where bookingid='$bookingid';";
                mysqli_query($conn,$sql);
                $random = uniqid();

                $sql3 = "insert into clientfinalpaymentinfo (bookingid,clientid,clientusername,clientbankname,clientbankaccno,clientbankbranchname,clientfinalpaymode) values ('$bookingid','$bankholdername','$branchname','$accountno');";
                mysqli_query($conn,$sql3);
                $random = uniqid();


                #inserting into sales table--
                $bookingquery = "insert into sales (bookingid,clientid,clientusername,bikeid,salesstatus,salesdate,paymentmode,deliverystatus) values ('$bookingid','$clientid','$username','$bikeid','na','$salesdate','$paytype','n');";
                mysqli_query($conn,$bookingquery);
                $sqlsalesquery = "select * from sales where bookingid='$bookingid';";
                $resultsales=mysqli_query($conn,$sqlsalesquery);
                if(mysqli_num_rows($resultsales)>0){
                    $rowsales=mysqli_fetch_assoc($resultsales);
                    $salesid=$rowsales['salesid'];
                }
                header("location:../index.php?sales=considered&bookingid=$bookingid&salesid=$salesid");
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
                $salesdate = date('Y-m-d');

               #updating into clientpaymentinfo table--
               $sql = "update clientpaymentinfo set clientfinalpaymentmode='$paytype' where bookingid='$bookingid';";
               mysqli_query($conn,$sql);
               $random = uniqid();

               $sql3 = "insert into clientfinalpaymentinfo (bookingid,clientid,clientusername,clientbankname,clientbankaccno,clientbankbranchname,clientfinalpaymode) values ('$bookingid','$bankholdername','$branchname','$accountno');";
               mysqli_query($conn,$sql3);
               $random = uniqid();


               #inserting into sales table--
               $bookingquery = "insert into sales (bookingid,clientid,clientusername,bikeid,salesstatus,salesdate,paymentmode,deliverystatus) values ('$bookingid','$clientid','$username','$bikeid','na','$salesdate','$paytype','n');";
               mysqli_query($conn,$bookingquery);
               $sqlsalesquery = "select * from sales where bookingid='$bookingid';";
               $resultsales=mysqli_query($conn,$sqlsalesquery);
               if(mysqli_num_rows($resultsales)>0){
                $rowsales=mysqli_fetch_assoc($resultsales);
                $salesid=$rowsales['salesid'];
               }

                header("location:../index.php?sales=considered&bookingid=$bookingid&salesid=$salesid");
            }
        }else{
            header("location:../payment.php?error=nomethodselected&bookingid=$bookingid&bikeid=$bikeid&pagename=$prevpage&ap=$price");
        }
    }else {
        header("location:../payment.php?pagenotaccessible&bookingid=$bookingid&bikeid=$bikeid&pagename=$prevpage&ap=$price");
    }