<?php 
    include_once 'includes/dbh.inc.php';
    include_once 'header.php';
    
?>

<html>
    <head>
        <link rel = "stylesheet" href = "cssfiles/adminnav.css">
        <link rel = "stylesheet" href = "cssfiles/adminaddproducts.css">
        <link rel = "stylesheet" href = "cssfiles/customerinfo.css">
        <link rel = "stylesheet" href = "cssfiles/updatestock.css">
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
                <div class="update-container">
                    <h1 class="stock-header">Stock</h1>
                    <form action="includes/updatestock.inc.php" method="post" id="updateform">
                        <label id="selectlabel">Select Bike:</label>
                        <select name='select'>
                        <?php 
                            $sql = "select * from stock ORDER BY bikebrand asc;";
                            $result = mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result) > 0){
                                while ($rows = mysqli_fetch_assoc($result)) {
                                    $bikename = strtoupper($rows['bikename']);
                                    $lowerbikename = strtolower($rows['bikename']);
                                    echo "<option value='".$lowerbikename."'>".$bikename."</option>";
                                }
                                echo "</select>";
                            }else {
                                echo "<select>
                                        <option value='none'>No Bikes</option>
                                </select>";
                            }  
                        ?>  
                        <label for="qty">Enter the Quantity:</label>
                        <input type="text" name="qty" placeholder="Enter 00 for Quantity 0">
                        <button type="submit" name="update-btn" id="update-btn">UPDATE</button>
                        <button type="submit" name="delete-btn" id="update-btn">DELETE</button>

                    </form>
                </div>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>BikeID</th>
                            <th>BikeName</th>
                            <th>BikeBrand</th>
                            <th>BikePrice</th>
                            <th>BikeQuantity</th>
                            <th>BikeQuantityStatus</th>
                        </tr>
                   
                        <?php
                            $sql = "select * from stock ORDER BY bikebrand asc;";
                            $result = mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result) > 0){            
                            while($row = mysqli_fetch_assoc($result)){
                                echo "<tr>
                                            <td>".strtoupper($row['bikeid'])."</td>
                                            <td>".strtoupper($row['bikename'])."</td>
                                            <td>".strtoupper($row['bikebrand'])."</td>
                                            <td>".strtoupper($row['bikeprice'])."</td>
                                            <td>".strtoupper($row['bikeqty'])."</td>
                                            <td>".strtoupper($row['bikeqtystatus'])."</td>
                                        </tr>";
                                    }
                                }else {
                                    echo "<tr>
                                        <td>No Bikes</td>";
                                 }
                        ?>
                    </table>
                </div>
            <div>
        </div>
    </body>
</html>