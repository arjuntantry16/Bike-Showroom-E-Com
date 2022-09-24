<?php
    if(isset($_COOKIE['username'])){
        print_r($_COOKIE);
       echo "<br>". count($_COOKIE);
    }else{
        echo "No Cookie";
    }
?>