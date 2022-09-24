<?php 
    include_once 'header.php';
 
    include_once 'includes/dbh.inc.php';
    
?>

<html>

    <head>
      <link rel = "stylesheet" href = "cssfiles/index.css">
      <script src="https://kit.fontawesome.com/9edcdd8d08.js" crossorigin="anonymous"></script>
    </head>
 
    <body>
    
        <div class="info-section">
            <?php 
            if(isset($_SESSION['username'])){
                if(isset($_GET['booking'])){
                    $bookingvalue = $_GET['booking'];
                    if($bookingvalue === "considered"){
                        $username = $_SESSION['username'];
                        $sql4 = "select * from prebooking1 where clientusername='$username';";
                        $result4 = mysqli_query($conn,$sql4);
                        if(mysqli_num_rows($result4)>0){
                            echo "<div class='sold-info-wrapper considered-info-wrapper'><p id='considered-info'>Your booking has been considered and will be confirmed once you pay the advance amount.<br></p>
                            <p id='ty'><strong>Thank You!</strong></p>
                            <br><div id='ok'>OK</div></div>";
                        }
                    }
                }elseif(isset($_GET['error'])){
                    $error=$_GET['error'];
                    if($error==="emptyfields"){
                        echo "<div class='cart-info-wrapper1 considered-info-wrapper'><p id='considered-info'>Search Field Is Empty!<br></p>
                        
                            <br><div id='ok'>OK</div></div>";
                    }
                }
                elseif (isset($_GET['sales'])) {
                    $salesvalue=$_GET['sales'];
                    if($salesvalue === 'considered'){
                        $username = $_SESSION['username'];
                        $bukingid=$_GET['bookingid'];
                        $sql4 = "select * from booking where bookingid='$bukingid';";
                        $result4 = mysqli_query($conn,$sql4);
                        if(mysqli_num_rows($result4)>0){
                            $row5 = mysqli_fetch_assoc($result4);
                            $bdate = $row5['bookingdate'];
                            $duedate1 = date('Y-m-d',strtotime($bdate.' + 54 days'));
                            $timestamp=strtotime($duedate1);
                            $duedate = date("d-m-Y",$timestamp);
                            echo "<div class='sold-info-wrapper considered-info-wrapper'><p id='considered-info'>Your payment information has been considered and will be confirmed once you pay the total amount due date is: ".$duedate.".<br></p>
                            <p id='ty'><strong>Thank You!</strong></p><div id='ok'>OK</div></div>";
                        }
                    }
                }
                if(isset($_GET['operation'])){
                    $cartinfo=$_GET['operation'];
                    if($cartinfo === "added"){
                        echo "<div class='cart-info-wrapper sold-info-wrapper considered-info-wrapper'><p id='considered-info'>Added To Cart!<br></p>
                            <div id='ok'>OK</div></div>";
                    }elseif($cartinfo === "removed"){
                        echo "<div class='cart-info-wrapper sold-info-wrapper considered-info-wrapper'><p id='considered-info'>Removed From Cart<br></p>
                           <div id='ok'>OK</div></div>";
                    }
                }
                $username = $_SESSION['username'];
                $sql10 = "select * from prebooking2 where clientusername='$username';";
                $result10 = mysqli_query($conn,$sql10);
                if(mysqli_num_rows($result10)>0){
                    $row10 = mysqli_fetch_assoc($result10);
                    $bid1 = $row10['bookingid'];
                    $sqlbooking = "select * from booking where bookingid='$bid1';";
                    $resultsql =mysqli_query($conn,$sqlbooking);
                    if(mysqli_num_rows($resultsql)>0){
                        $rowbooking = mysqli_fetch_assoc($resultsql);
                        $bdate = $rowbooking['bookingdate'];
                       
                        $duedate2 = date('Y-m-d',strtotime($bdate.' + 54 days'));
                        $timestamp3=strtotime($duedate2);
                        $duedate = date("d-m-Y",$timestamp3);
                        echo "<div class='booked-info-wrapper considered-info-wrapper'><i class='fas fa-times close'></i><p id='considered-info'>Your booking has been confirmed and has been placed in your Bookings.<br>Please pay the full amount on or before the due date: ".$duedate.".If you failed to pay the full amount your booking will be <strong>Cancelled!</strong><br></p>
                        <p id='ty'><strong>Thank You!</strong></p><div id='ok'>OK</div></div>";
                    }
                }
                $sql9 = "select * from validation3 where clientusername='$username';";
                $result9 = mysqli_query($conn,$sql9);
                if(mysqli_num_rows($result9)>0){
                    $row9 = mysqli_fetch_assoc($result9);
                    $bid1 = $row9['bookingid'];
                    $sqlbooking = "select * from booking where bookingid='$bid1';";
                    $resultsql =mysqli_query($conn,$sqlbooking);
                    if(mysqli_num_rows($resultsql)>0){
                        $rowbooking = mysqli_fetch_assoc($resultsql);
                        $bdate = $rowbooking['bookingdate'];
                        $deliverydate1 = date('Y-m-d',strtotime($bdate.' + 60 days'));
                        $timestamp = strtotime($deliverydate1);
                        $deliverydate = date("d-m-Y",$timestamp);
                        echo "<div class='sold-info-wrapper considered-info-wrapper'><i class='fas fa-times close'></i><p id='considered-info'>You have successfuly purchased the bike and it will be delivered to you on: ".$deliverydate.".<br></p>
                        <p id='ty'><strong>Thank You!</strong></p><div id='ok'>OK</div></div>";
                    }
                }
            }
        ?>
            <div class="info-wrapper">
                
                <div class="paragraph-wrapper">
                    <p class = "quote">“You don’t stop riding when you get old,<br> you get old when you stop riding.”</p> 
                    
                </div>
                <hr>
                <div class="smalltext-wrapper">
                    <p class="smalltext">The Best Bike Selling Website Is Here</p>
                </div>
                <div class="bigtext-wrapper">
                <p class="bigtext">Buy Your Favorite Bike Now!</p>
                </div>
            </div>
        </div>

        <div class="latest-bikes-container">
            <div class="latest-bikes-wrapper">
                <div class="latest-bikes-header-wrapper">
                    <p class="bg-latest-header">L A T E S T </p>
                    <h1 class="latest-bikes-header">LATEST BIKES</h1>
                </div>

                <div class="bikes-products-container">
                    <div class="bikes-products-wrapper">
                        <!--php goes here-->
                        <?php
                            $sql = "select * from stock;";
                            $result = mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result) > 0){
                                $i=0;
                                while($row = mysqli_fetch_assoc($result)){
                                    $i++; 
                                    if($i <= 3){
                                        $image = $row['bikeimage1'];
                                        echo "
                                        <div class='products-container'>";
                                        if(isset($_SESSION['username'])){
                                            $username = $_SESSION['username'];
                                            $bike=$row['bikeid'];       
                                            $query = "select * from cart where bikeid='$bike' AND clientusername='$username';";
                                            $result1=mysqli_query($conn,$query);
                                            if(mysqli_num_rows($result1) < 1){                                          
                                               echo "
                                            <div class='add-tocart-wrapper'>
                                            <a href='includes/add-to-cart.inc.php?bikeid=".$row['bikeid']."&pagename=index' id='add-cart-a1'><i class='fas fa-shopping-cart'></i>Add To Cart</a>
                                            </div>";
                                        }else{
                                            echo "<div class='remove-fromcart-wrapper'>
                                            <a href='includes/remove-from-cart.inc.php?bikeid=".$row['bikeid']."&pagename=index' id='remove-cart-a1'><i class='fas fa-shopping-cart'></i>Remove From Cart</a>
                                            </div>";
                                        }
                                    }else {
                                       echo "<div class='add-tocart-wrapper'>
                                        <a href='includes/add-to-cart.inc.php?bikeid=".$row['bikeid']."&pagename=index' id='add-cart-a1'><i class='fas fa-shopping-cart'></i>Add To Cart</a>
                                        </div>";
                                    }
                                           echo "<a href='selectedbrand.php?name=".$row['bikebrand']."' id='atag'><img src='productimages/brandslogo/".$row['brandlogo']."' alt='no-iamge' id='img1'></a>
                                                <a href='selectedbike.php?bikeid=".$row['bikeid']."' id='atag'>
                                                <div class='image-container'>
                                                    <img src='productimages/".$image."' alt='bikeimage' class='image'>
                                                </div>
                                                <div class='product-info-container'>
                        
                                                    <div class='name-container'>
                                                       <p id='name'>".strtoupper($row['bikename'])."</p> 
                                                    </div>
                                                    <div class='specs-container'>
                                                        <div class='specs-wrapper'>
                                                            <span id='specs'>".$row['bikeengine']."cc</span>
                                                            <span id='specs'>".$row['bikepower']."</span>
                                                            <span id='specs'>".$row['bikemileage']."</span>
                                                        </div>
                                                    </div>
                                                    <div class='ex-showroom-text'>
                                                        <p id='ex-showroom'>Avg. Ex-Showroom Price</p>
                                                    </div>
                                                    <div class='price-container'>
                                                        <div class='price-wrapper'>
                                                            <span><i class='fas fa-rupee-sign' aria-hidden='true'></i></span>
                                                            <span id='price'>".$row['bikeprice']."<span id='onwards'> onwards</span></span>
                                                        </div>
                                                    </div>
                                                    <div class='moredetails-button-container'>
                                                        <div class='moredetails-button'>
                                                            More Details
                                                        </div>
                                                    </div>
                                                </div> 
                                            </a>                                                
                                        </div>";
                                    }
                                }
                            }else {
                                echo "No Results Found";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="popular-brands-container">
            <div class="popular-brands-header-wrapper">
                    <p class="bg-popular-header">P O P U L A R </p>
                    <h1 class="popular-brands-header">POPULAR BRANDS</h1>
            </div>
            <div class="popular-brands-wrapper">
                <div class="brands-products-container">
                    <div class="brands-products-wrapper">
                        <a href="selectedbrand.php?name=royal enfield" id="atag">
                            <div class="brand-images-container">
                                <img src="productimages/brandslogo/royal enfield logo.png" alt="logo" id="brand-image">
                                <p id="brand-text">Royal Enfield</p>
                            </div>
                        </a>
                    </div>
                    <div class="brands-products-wrapper">
                        <a href="selectedbrand.php?name=yamaha" id="atag">
                            <div class="brand-images-container">
                                <img src="productimages/brandslogo/yamaha logo.png" alt="logo" id="brand-image">
                                <p id="brand-text">Yamaha</p>
                            </div>
                        </a>
                    </div>
                    <div class="brands-products-wrapper">
                        <a href="selectedbrand.php?name=suzuki" id="atagbrand">
                            <div class="brand-images-container">
                                <img src="productimages/brandslogo/suzuki logo.png" alt="logo" id="brand-image">
                                <p id="brand-text">Suzuki</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--About Us Section -->
                    
        <div class="about-us-container">
            <div class="about-us-wrapper">
                <div class="about-us-header-wrapper">
                        <h2 id="about-us-header">About Us</h2>
                </div>

                <div class="about-us-contents-container">
                    <div class="about-us-image-container">
                        <img src="productimages/showroom-image.jpg" alt="img" id="showroom-image">
                    </div>

                    <div class="about-us-info-container">
                        <p id="info">About Us
Section is a web portal under the renowned GirnarSoft group. We are a team who believe that the customer is king and strive to make sure you are treated like a king. Our efforts and drive doesn’t just come from one person but from all of our partners and employees. We believe that together we can make your experience one that you never forget. That’s why our website is your one stop shop for two wheelers.<br>

On our site, you can sell your old bike, buy a used bike, compare bikes, find dealers and even get the on-road price of the bike you’re looking for. We pride ourselves on giving you everything that you need to make a decision while buying a bike. So on our site, you can also calculate your EMI(easy monthly instalment) options, find tyres for your bike and also write your own personal review of a bike.<br>

Besides all this, we also have an editorial section where you can check out the latest news in the two-wheeler industry; find feature stories and great advisory stories that will help you become a better rider and help you maintain your bike as well. Sounds like we’ve given you everything you need right? Well there’s one more section that plays a vital role in helping you finalise which bike to buy: The Expert Reviews section. It contains detailed analysis of bikes by biking and industry professionals with years of experience. They test the bikes and give their honest opinions on the positives and negatives while also giving you an unbiased verdict of the bike. If you’d rather watch a video review of a new bike, you can do that too in our video review section.<br>

We love what we do and our passion for motorcycles and people is what drives us to constantly better ourselves to help you. Innovation, Reliability and Client-friendliness are the key values that we hold dear. BikeDekho provides you with all the information you need to make a well informed buying decision.<br>

Our reach is not limited to Indian motor market only but extends further to South East Asian countries like the Philippines, Malaysia, and Indonesia. We are operating under the following websites - Zigwheels.ph, Zigwheels.my, and Oto.com respectively. We also have a presence in the UAE with Zigwheels.ae<br>
                        </p>
                    </div>
                </div>

            </div>
        </div>
         <!--About Us Section Ends-->

         <!--Contact Us-->

        <div class="contact-us-container">
            <div class="contact-us-wrapper">
                    <div class="contact-us-header-wrapper">
                        <h1 id="contact-us-header">Contact Us</h1>
                    </div>

                    <div class="contact-form-container">
                        <form action="includes/contact-us.inc.php" method="post" id="contact-form">
                            <label id="contact-label1">Name:</label>
                            <input type="text" placeholder="Name" id="contact-name">
                            <label id="contact-label2">Email:</label>
                            <input type="text" placeholder="Email" id="contact-email" name="email">
                            <label id="contact-label3">Subject:</label>
                            <input type="text" placeholder="Subject" id="contact-subject" name="subject">
                            <label id="contact-label4">Message:</label>
                            <textarea rows="4" cols="25" placeholder="Message" id="contact-textarea" name="message"></textarea>
                            <button type="submit" id="contact-us-btn" name="contact-us-btn">Send Message</button>
                        </form>
                    </div>
            </div>
        </div>

         <!--Contact Us Ends-->

        <?php
        if(isset($_SESSION["username"])){
            if(isset($_GET['booking'])){
                $bookingvalue = $_GET['booking'];
                if($bookingvalue === "considered"){
                    $username = $_SESSION['username'];
                    $sql4 = "select * from prebooking1 where clientusername='$username';";
                    $result4 = mysqli_query($conn,$sql4);
                    if(mysqli_num_rows($result4)>0){
                        $sqldelete = "delete from prebooking1 where clientusername='$username';";
                        $result5 = mysqli_query($conn,$sqldelete);
                    }
                }
            }
            $username = $_SESSION['username'];
            $sql10 = "select * from prebooking2 where clientusername='$username';";
            $result10 = mysqli_query($conn,$sql10);
            if(mysqli_num_rows($result10)>0){
                $sqldel = "delete from prebooking2 where clientusername='$username';";
                mysqli_query($conn,$sqldel);
            }
            $sqlvalid = "select * from validation3 where clientusername = '$username';";
            $resultvalid = mysqli_query($conn,$sqlvalid);
            if(mysqli_num_rows($resultvalid)>0){
                $sqldel1 = "delete from validation3 where clientusername='$username';";
                mysqli_query($conn,$sqldel1);
            }
        }
            include_once 'footer.php';
         ?>
         <script src="jsfiles/index.js"></script>
    </body>

</html>
 