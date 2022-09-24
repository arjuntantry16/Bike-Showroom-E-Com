<?php 
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
    
?>

<html>
    <head>
        <link rel = "stylesheet" href = "cssfiles/adminnav.css">
        <link rel = "stylesheet" href = "cssfiles/adminaddproducts.css">
        <link rel = "stylesheet" href = "cssfiles/customerinfo.css">
    </head>
    <body>
        <div class="overall-container">
            <div class = "left-container">
                <div class = "list-items">
                    <a href="admin.php">Add Bikes</a>
                </div>
                <div class = "list-items">
                    <a href="updatestock.php">Update Stock</a>
                </div>
                <div class = "list-items">
                    <a href="viewbooking.php">View Bookings</a>
                </div>
                <div class = "list-items">
                    <a href="viewsales.php">View Sales</a>
                </div>
                <div class = "list-items">
                    <a href="customerinfo.php">View Customer Info</a>
                </div>
                <div class = "list-items">
                    <a href="adminpasschange.php">Change Password</a>
                </div>
            </div>
            <div class="right-container">
                <div class="heading-wrapper">
                    <h1 id="heading">Clients Information</h1>
                </div>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>ClientID</th>
                            <th>ClientUserName</th>
                            <th>ClientName</th>
                            <th>ClientEmail</th>
                            <th>ClientPhone</th>
                            <th>ClientAddress</th>
                            <th>ClientCity</th>
                            <th>ClientState</th>
                        </tr>
                   
                        <?php
                            $sql = "select * from client;";
                            $result = mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result) > 0){            
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<tr>
                                            <td>".$row['clientid']."</td>
                                            <td>".$row['clientusername']."</td>
                                            <td>".$row['clientname']."</td>
                                            <td>".$row['clientemail']."</td>
                                            <td>".$row['clientphone']."</td>
                                            <td class='tdaddress'>".$row['clientaddress']."</td>
                                            <td>".$row['clientcity']."</td>
                                            <td>".$row['clientstate']."</td>
                                        </tr>";
                                    }
                                }else {
                                    echo "<tr>
                                        <td>No Users</td>";
                                 }
                        ?>
                    </table>
                </div>
            <div>
        </div>
    </body>
</html>