<?php
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="cssfiles/taxupdate.css">
    </head>
    <body>
    <div class="admin-panel-container">
            <div class="left-panel-container">
                <div class="left-panel-wrapper">
                    <div class="first-item-wrapper item-wrapper">
                        <div class="first-item">
                            Stock
                            <div class="drop-down-contents">
                                <a href="adminupdate.php" id="update-a"><div class="update">Update</div></a>
                                <a href="adminadd.php" id="add-a"><div class="add">Add Bikes</div></a>
                                <a href="admindelete.php" id="delete-a"><div class="delete">Delete</div></a>
                            </div>
                        </div>
                    </div>
                    <div class="second-item-wrapper item-wrapper">
                        <div class="second-item">
                            <a href="adminbookings.php" id="bookings-a">
                            <div class="bookings">Bookings
                            </div></a>
                        </div>
                    </div>
                    <div class="third-item-wrapper item-wrapper">
                        <div class="third-item">
                            <a href="adminsales.php" id="sales-a">
                            <div class="sales">Sales
                            </div></a>
                        </div>
                    </div>
                    <div class="fourth-item-wrapper item-wrapper">
                        <div class="fourth-item">
                            <a href="clientinfo.php" id="client-a">
                            <div class="client-info">Client Info
                            </div></a>
                        </div>
                    </div>
                    <div class="fifth-item-wrapper item-wrapper">
                        <div class="fifth-item">
                        <a href="adminpasswordchange.php" id="change-password-a">
                            <div class="change-password-info">Change Password
                            </div></a>
                        </div>
                    </div>
                    <div class="sixth-item-wrapper item-wrapper">
                        <div class="sixth-item">
                        <a href="taxupdate.php" id="tax-a">
                            <div class="tax-update-info">Tax Update
                            </div></a>
                        </div>
                    </div>
                    <div class="seventh-item-wrapper item-wrapper">
                        <a href='adminaddsupplier.php' id='addsup-a'>
                        <div class="seventh-item">
                            <a href="adminaddsupplier.php" id="tax-a">
                            <div class="supplier-info">Supplier
                            </div></a>
                        </div>
                        <div class="drop-down-contents2">
                                <a href="adminaddsupplier.php" id="add-supplier-a"><div class="update">Add</div></a>
                                <a href="adminorder.php" id="order-a"><div class="add">Order/Update</div></a>
                        </div>
                    </div></a>
                </div>
            </div>
            <!--Right Container-->
            <div class="right-container">
            <?php
                if(isset($_GET['error'])){
                    $errormsg=$_GET['error'];
                    if($errormsg == "emptyfields"){
                        echo "<div class='error-container'><p id='emptyfields'>*Enter All Fields</p></div>";
                    }elseif($errormsg == "invalidentry"){
                        echo "<div class='error-container'><p id='emptyfields'>*Enter Only Numbers!</p></div>";
                    }
                }elseif(isset($_GET['update'])){
                    $success = $_GET['update'];
                    if($success == "success"){
                    echo "<div class='error-container'><p id='emptyfields'>Updated!</p></div>";
                }
            }
                ?>
                <div class="right-wrapper">
                    <div class="tax-header-wrapper">
                        <h2 id="tax-header">
                            Tax Update
                        </h2>
                    </div>
                    <div class="tax-update-form-container">
                        <div class="tax-update-form-wrapper">
                            <form action="includes/taxupdate.inc.php" method="post" id="tax-update-form">
                            <label id='label1'>Select:</label>
                                <select name="tax-select" id="tax-select">
                                    <?php
                                        $sql = "select * from taxrates;";
                                        $result = mysqli_query($conn,$sql);
                                        echo "
                                        <option value='lesserthan350cc' id='options'>Lesser Than 350CC</option>
                                        <option value='greaterthan350cc' id='options'>Greater Than 350CC</option>";
                                    ?>
                                </select>
                                <label id="label1">Enter New Tax Rate:</label>
                                <input id="tax-value" type="text" placeholder="Enter New Tax Rate In Numbers" name="tax-value">
                                <button type="submit" id="tax-btn" name="tax-btn">UPDATE</button>
                            </form>
                        </div>
                        <div class="tax-info-wrapper">
                            <table id='tax-table'>
                                <tr>
                                    <th>Greater Than 350CC</th>
                                    <th>Lesser Than 350CC</th>
                                </tr>
                                    <?php
                                        $query = "select * from taxrates;";
                                        $result1 = mysqli_query($conn,$sql);
                                        $row1=mysqli_fetch_assoc($result1);
                                        echo "<tr><td>".$row1['greaterthan350cc']."</td>
                                        <td>".$row1['lessthan350cc']."</td></tr>";
                                    ?>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>