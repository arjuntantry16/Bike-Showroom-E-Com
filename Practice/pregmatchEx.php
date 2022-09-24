<?php
    $preg=$_POST['password'];
    if(preg_match('/[0-9]+(\.*[a-zA-Z]+)*(\@manipal.edu){1}/',$preg)){
        echo "Matched!";
    }else{
        echo "Not Matched";
    }
?>