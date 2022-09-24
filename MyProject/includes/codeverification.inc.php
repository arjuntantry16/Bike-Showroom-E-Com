<?php
            if(isset($_POST['code-submit'])){
            session_start();

             $code = $_SESSION['code'];
            $enteredcode = (int)$_POST['code'];
            if(empty($enteredcode)){
                header("location:../codeverification.php?error=emptyfields");
            }else{
                if($enteredcode === $code){
                    header("location:../changepassword.php");
                }else{
                    header("location:../codeverification.php?error=wrongcode");
                }
            }
        }else{
            header("location:../codeverification.php?pagenotaccessible");
        }
        ?>