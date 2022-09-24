<?php 
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="cssfiles/adminaddsupplier.css">
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
            <div class="right-container">
            <?php
                if(isset($_GET['error'])){
                    $errormsg=$_GET['error'];
                    if($errormsg == "emptyfields"){
                        echo "<div class='error-container'><p id='emptyfields'>*Enter All Fields</p></div>";
                    }elseif ($errormsg == "invalidno"){
                        echo "<div class='error-container'><p id='emptyfields'>*Invalid Contact Number</p></div>";
                    }elseif ($errormsg == "invalidemail"){
                        echo "<div class='error-container'><p id='emptyfields'>*Invalid Email</p></div>";
                    }
                }elseif(isset($_GET['insert'])){
                    $success = $_GET['insert'];
                    echo "<div class='error-container'><p id='emptyfields'>Inserted!</p></div>";
                }elseif(isset($_GET['delete'])){
                    $success = $_GET['delete'];
                    echo "<div class='error-container'><p id='emptyfields'>Deleted!</p></div>";
                }

                ?>
                <div class="supplier-header-wrapper">
                    <h2 id="supplier-header">
                        Add Supplier
                    </h2>
                </div>
                <div class="supplier-form-container">
                    <div class="supplier-form-wrapper">
                        <form id="supplier-form" action="includes/adminaddsupplier.inc.php" method="post">
                            <div class="contents-wrapper">
                                <label>Supplier Name:</label>
                                <input type="text" name="name" placeholder="Enter Supplier Name">
                            </div>
                            <div class="contents-wrapper">
                                <label>Supplier Brand:</label>
                                <input type="text" name="brand" placeholder="Enter Supplier Brand">
                            </div>
                            <div class="contents-wrapper">
                                <label>Supplier Contact No.:</label>
                                <input type="text" name="contactno" placeholder="Enter Supplier Contact Number">
                            </div>
                            <div class="contents-wrapper">
                                <label>Supplier Email:</label>
                                <input type="text" name="email" placeholder="Enter Supplier Email">
                            </div>
                            <div class="contents-wrapper">
                                <label>Supplier Address:</label>
                                <input type="text" name="address" placeholder="Enter Supplier Address">
                            </div>
                            <button type="submit" name="supplier-btn" id="supplier-btn">ADD</button>
                        </form>
                    </div>
                    <div class="supplier-table-wrapper">
                        <table id="supplier-table">
                            <tr>
                                <th>Supplier ID</th>
                                <th>Supplier Name</th>
                                <th>Supplier Brand</th>
                                <th>Supplier Contact No.</th>
                                <th>Supplier Email</th>
                                <th>Supplier Address</th>
                            </tr>
                            <?php
                                $sql ="select * from supplier;";
                                $result = mysqli_query($conn,$sql);
                                if(mysqli_num_rows($result)>0){
                                    while($row=mysqli_fetch_assoc($result)){
                                        echo "<tr>
                                                    <td>".$row['supplierid']."</td>
                                                    <td>".$row['suppliername']."</td>
                                                    <td>".$row['supplierbrand']."</td>
                                                    <td>".$row['suppliercontactno']."</td>
                                                    <td>".$row['supplieremail']."</td>
                                                    <td>".$row['supplieraddress']."</td>
                                                    <td><a href='includes/adminsupplierdelete.inc.php?id=".$row['supplierid']."'>
                                                        <button type='button' id='delete-btn'>DELETE</button>
                                                    </a></td></tr>";
                                    }
                                }else{
                                    echo "<tr><td>No results</td></tr>";
                                }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>