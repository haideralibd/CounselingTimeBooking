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
    <li><a href="student_signin.php" id="activeone">Student</a></li>
    <li><a href="teacher_signin.php" >Teacher</a></li>
    <li><a href="admin_login.php">Admin</a></li>

</ul>
<br><br>
<form action="student_signin.php" method="post">
    <div align="middle" style="margin-top: 120px;background-color: #003f54;max-width: 450px;margin-left: 420px;min-height: 220px;">

        <br></br>
    <label style="text-align: left; color: white;">Login ID:</label>
        <br>
        <input type="text" name="sid"><br/>
    <br>
        <label style="color: white;">Password:</label>
        <br>
        <input type="password" name="spass"><br/>

    <br>
        <input type="button" style="margin:15px" onclick="location.href = 'student_signup.php';" value="Sign up">
    <input type="submit" style="margin:15px" value="Login">
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

    $qry = $conn->prepare("Select * from students where id= ? and password= ? and approved=1;");
    $sid = $_POST['sid'];
    $spass = $_POST['spass'];

    $qry->execute(array($sid,$spass));
    $count = $qry->rowCount();
    if($count>0){
        $_SESSION['username']="$sid";
        header('location:student_book_counseling.php');
    }else {
        echo "<script>window.alert('Id / Password Incorrect! or Waiting for Admin's approval);</script>";
    }

}

?>