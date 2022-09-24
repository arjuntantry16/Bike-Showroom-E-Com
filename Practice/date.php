<?php
    date_default_timezone_set("Asia/kolkata");
    $date1=new DateTime();
    $agedate=$_GET['age'];
    print_r ($agedate);
    $today=date('Y-m-d');
    echo '<br>';
    echo $today;
    echo "<br>";
    $age=date_diff(date_create($today),date_create($agedate));
    echo $age->format("%y years %m months %d days");
    echo "<br>";
    $d=(getdate());
    echo $d['month']." ".$d['mday']." ".$d['weekday']." ".$d['year']." ".$d['seconds']." ".$d['minutes']."<br>";
    echo date('d/m/Y h:i:s a', time());
?>

<html>
    <form action="" method="get">
            <input type="date" name="age">
            <input type="submit" value="submit">
    </form>
</html>