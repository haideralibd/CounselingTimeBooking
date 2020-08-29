<?php
session_start();
?>
<!DOCTYPE html>

<html>
<body>

<link rel="stylesheet" type="text/css" href="header.css">

<style>
    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #1e425d;
    }

    li {
        float: left;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    li a:hover {
        background-color: #000000;
    }
    #activeone {
        background-color: #008cba;
        color: white;
    }
</style>

<ul >
    <li><a href="index.php">Home</a></li>
    <li><a href="student_signin.php">Student</a></li>
    <li><a href="teacher_signin.php" id="activeone">Teacher</a></li>
    <li><a href="admin_login.php">Admin</a></li>

</ul>
<br><br>
<form action="teacher_signin.php" method="post">
    <div align="middle" style="margin-top: 120px;background-color: #003f54;max-width: 450px;margin-left: 420px;min-height: 220px;">

        <br></br>
        <label style="text-align: left; color: white;">Login ID:</label>
        <br>
        <input type="text" name="tid"><br/>
        <br>
        <label style="color: white;">Password:</label>
        <br>
        <input type="password" name="tpass"><br/>

        <br>
        <input type="submit" value="Login">
    </div>
</form>
<div class="footer">
    <p>Counseling Time Booking</p>
</div>
</body>

</html>
<?php

// testing tutorial
if($_SERVER['REQUEST_METHOD']=="POST") {
    $conn = new PDO("mysql:host=localhost;dbname=counselingTimeBooking;", 'root', '');

    $qry = $conn->prepare("Select * from teachers where id= ? and password= ?;");
    $sid = $_POST['tid'];
    $spass = $_POST['tpass'];

    $qry->execute(array($sid,$spass));
    $count = $qry->rowCount();
    if($count>0){
        $_SESSION['username']="$sid";

        header('location:teacher_appointments.php');
    }else {
        echo "<script>window.alert('Id / Password Incorrect!');</script>";
    }

}
?>