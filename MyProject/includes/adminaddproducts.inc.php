<?php 
    include_once 'dbh.inc.php';

    if(isset($_POST['product-submit'])){
        $bikename = strtolower($_POST['bikename']);
        $bikebrand = strtolower($_POST['bikebrand']);
        $bikeprdno = strtolower($_POST['bikeprdno']);
        $bikeprice = strtolower($_POST['bikeprice']);
        $bikeqty = $_POST['bikeqty'];
        $bikemileage = strtolower($_POST['bikemileage']);
        $bikeengine = strtolower($_POST['bikeengine']);
        $bikepower = strtolower($_POST['bikepower']);
        $bikekerbweight = strtolower($_POST['bikekerbweight']);
        $bikeabs = strtolower($_POST['bikeabs']);
        $file = $_FILES['file'];
        $file2 = $_FILES['file1'];
        $file3 = $_FILES['file2'];
        $file4 = $_FILES['file3'];
        $brandlogo = $_FILES['brandlogo'];
        
        if($file['error'] == 1 || $file2['error'] == 1 || $file3['error'] == 1 || $file4['error'] == 1 || $brandlogo['error'] == 1){
            header("Location:../adminadd.php?error=fileerror");
        }else {
            if(!empty($bikename) && !empty($bikebrand) && !empty($file) && !empty($file2) && !empty($file3) && !empty($file4) && !empty($brandlogo) &&!empty($bikeengine) && !empty($bikemileage) && !empty($bikepower) && !empty($bikeprdno) && !empty($bikeprice) && !empty($bikeqty) && !empty($bikekerbweight) && !empty($bikeabs)){
                //image 1 changing the name
                $filetmpname = $file['tmp_name'];
                $fileext = explode(".",$file['name']);
                $fileactualext = strtolower(end($fileext));
                $filenewname = $bikebrand."-".$bikename."image1.".$fileactualext;
                $filedest = "../productimages/".$filenewname;
                move_uploaded_file($filetmpname,$filedest);
                //end image 1

                //image 2 changing the name
                $filetmpname1 = $file2['tmp_name'];
                $fileext1 = explode(".",$file2['name']);
                $fileactualext1 = strtolower(end($fileext1));
                $filenewname1 = $bikebrand."-".$bikename."image2.".$fileactualext1;
                $filedest1 = "../productimages/".$filenewname1;
                move_uploaded_file($filetmpname1,$filedest1);
                //end image 2

                //image 3 changing name
       
                $filetmpname2 = $file3['tmp_name'];
                $fileext2 = explode(".",$file3['name']);
                $fileactualext2 = strtolower(end($fileext2));
                $filenewname2 = $bikebrand."-".$bikename."image3.".$fileactualext2;
                $filedest2 = "../productimages/".$filenewname2;
                move_uploaded_file($filetmpname2,$filedest2);
                //end image 3

                //image 4 changing name
       
                $filetmpname3 = $file4['tmp_name'];
                $fileext3 = explode(".",$file4['name']);
                $fileactualext3 = strtolower(end($fileext3));
                $filenewname3 = $bikebrand."-".$bikename."image4.".$fileactualext3;
                $filedest3 = "../productimages/".$filenewname3;
                move_uploaded_file($filetmpname3,$filedest3);
                //end image 4

                //brandlogo

                $brandtmpname = $brandlogo['tmp_name'];
                $brandext = explode(".",$brandlogo['name']);
                $brandactualext = strtolower(end($brandext));
                $brandnewname = $bikebrand."-".$bikename."logo.".$brandactualext;
                $branddest = "../productimages/brandslogo/".$brandnewname;
                move_uploaded_file($brandtmpname,$branddest);

                //brandlogo ends

                $sql = "insert into stock (bikename,bikebrand,bikeimage1,bikeimage2,bikeimage3,bikeimage4,bikeprdno,bikeprice,bikeqty,bikemileage,bikeengine,bikepower,bikekerbweight,bikeabs,bikeqtystatus,brandlogo) values ('$bikename','$bikebrand','$filenewname','$filenewname1','$filenewname2','$filenewname3','$bikeprdno','$bikeprice','$bikeqty
                ','$bikemileage','$bikeengine','$bikepower','$bikekerbweight','$bikeabs',0,'$brandnewname');";
                $result = mysqli_query($conn,$sql);
                header("Location:../adminadd.php?insertion=success");
                }else {
                header("Location:../adminadd.php?error=emptyfields");
                }
            }
        }else {
        header("Location:../adminadd.php?notsuccessful");
    }
?>