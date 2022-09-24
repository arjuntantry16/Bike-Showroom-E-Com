<?php
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
    $bikeid=$_GET['bikeid'];
    $pagename=$_GET['pagename'];
    $bookingid = $_GET['bookingid'];
?>

<html>
    <head>
        <link rel="stylesheet" href="cssfiles/invoice.css">
    </head>
    <body>
        <div class='advance-invoice-container'>
            <div class='advance-invoice-wrapper'>
                <div class='top-flex-container'>
                    <div class='company-details-flex-container'>
                        <div class='company-name-wrapper'>
                            <?php
                                $sql = "select * from companydetails;";
                                $result = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result)>0){
                                    while($rows=mysqli_fetch_assoc($result)){
                                   echo "<p id='company-name'>".$rows['companyname']."</p>
                                    <p id='company-slogan'>".$rows['companyslogan']."</p>
                            </div>
                        <div class='address-no-container'>
                            <p id='address'>".$rows['companyaddress']."</p>
                            <p id='address2'>".$rows['companyaddress2']."</p>
                            <p id='phone'>".$rows['companyphone']."</p>
                        </div>
                    </div>
                    <div class='invoice-date-container'>
                        <div class='invoice-text-wrapper'>
                            <p id='invoice'>INVOICE</p>
                        </div>
                        <p id='invoice-number'>Invoice #".$bookingid."</p>";
                        
                        $date = date('d-m-y');
                       echo "<p id='date'>Date:".$date."</p>
                       
                    </div>
                </div>";
                $clientusername = $_SESSION['username'];
                $sql3 = "select * from client where clientusername='$clientusername';"; 
                $result3=mysqli_query($conn,$sql3);
                $rows3 = mysqli_fetch_assoc($result3);
                echo "<div class='bill-to-wrapper'>
                    <p id='bill-to'>Bill To:</p>
                    <p id='name'>".$rows3['clientname']."</p>
                    <p id='email'>".$rows3['clientemail']."</p>
                    <p id='address'>".$rows3['clientaddress']."</p>
                    <p id='city-state'>".$rows3['clientcity'].",".$rows3['clientstate']."</p>
                    <p id='phone1'>".$rows3['clientphone']."</p>
                </div>
                <table id='table1'>
                    <tr>
                        <th id='qty'>QUANTITY</th>
                        <th id='desc'>DESCRIPTION</th>
                        <th id='unit-price'>UNIT PRICE</th>
                        <th id='total'>TOTAL</th>
                    </tr>
                    <tr>";
                    $sql2 = "select * from taxrates;";
                    $result2=mysqli_query($conn,$sql2);
                    $rows2=mysqli_fetch_assoc($result2);

                    $sqlstock = "select * from stock where bikeid='$bikeid';";
                    $resultstock = mysqli_query($conn,$sqlstock);
                    $rowsstock=mysqli_fetch_assoc($resultstock);
                    $bikeenginevalue = $rowsstock['bikeengine'];
                        $price=$rowsstock['bikeprice'];
                        $bikeprice = str_replace(",","",$price);
                        if($bikeenginevalue >= 350){
                            $advanceamt = $rows2['greaterthan350cc']/100 * $bikeprice; 
                            $bikebaseprice = $bikeprice - $advanceamt;
                            $taxamt = 92 / 100 * $advanceamt;
                            $bikebaseprice = 92 /100 * $bikebaseprice;
                        }else{
                            $advanceamt = $rows2['lessthan350cc']/100 * $bikeprice;
                            $bikebaseprice = $bikeprice - $advanceamt;
                            $taxamt = 92 / 100 * $advanceamt;
                            $bikebaseprice = 92 /100 * $bikebaseprice;
                        }
                        echo "<td id='qty'>1</td>
                        <td id='desc'>Payment for ".strtoupper($rowsstock['bikename'])."</td>
                        <td id='unit-price'>".number_format((float)$bikebaseprice,2,'.',',')."</td>
                        <td id='total'>".number_format((float)$bikebaseprice,2,'.',',')."</td>
                    </tr>
                </table>
                <table id='table2'>
                    <tr>
                        <td id='subtotal'>".number_format((float)$bikebaseprice,2,'.',',')."</td>
                    </tr>
                    <tr >
                        <td id='tax'>".number_format((float)$taxamt,2,'.',',')."</td>
                    </tr>
                    <tr>";
                    $ap = number_format($bikebaseprice + $taxamt,0);
                        echo "<td id='total-amt'>".number_format($bikebaseprice + $taxamt,0)."</td>
                    </tr>
                </table>
                <div class='info'>
                    <p id='sub-total-text'>Sub Total</p>
                    <p id='tax-amt-text'>Tax Amount</p>
                    <p id='total-text'>Total</p>
                </div>
                <div class='bottom-wrapper'>
                    <p id='text1'>Make all checks/NEFTs payable to ".$rows['companyname'].".</p>
                    <p id='text2'>If you have any questions concerning this invoice contact us at-".$rows['companyemail'].".</p>
                    <p id='thank-u'>Thank you for your business!</p>
                </div>
                <?php
                    <a href='".$pagename.".php?bikeid=".$bikeid."'id='a-prev-tag'>Previous</a>
                    <a href='payment.php?bookingid=".$bookingid."&bikeid=".$bikeid."&pagename=invoice&ap=".$ap."' id='a-next-tag'>Payments</a>";
                                    }
                                }
                    ?>
            </div>
        </div>
    </body>
</html>