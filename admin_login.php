<?php
session_start();
?>
<!DOCTYPE html>

<html>

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
    <li><a href="teacher_signin.php">Teacher</a></li>
    <li><a href="admin_login.php" id="activeone">Admin</a></li>

</ul>
<br><br>
<form action="admin_login.php" method="post">
    <div align="middle" style="margin-top: 120px;background-color: #003f54;max-width: 450px;margin-left: 420px;min-height: 220px;">
        <br></br>

        <label style="text-align: left; color: white;">Login ID:</label>
    <br>
        <input type="text" name="admin_id"><br/>
    <br>
        <label style="color: white;">Password:</label>
    <br>
        <input type="password" name="admin_pass"><br/>

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

    $qry = $conn->prepare("Select * from admin where admin_id= ? and password= ?;");
    $admin_id = $_POST['admin_id'];
    $admin_pass = $_POST['admin_pass'];

    $qry->execute(array($admin_id,$admin_pass));
    $count = $qry->rowCount();
    if($count>0){
		        $_SESSION['username']="$admin_id";

        header('location:student_approval.php');
    }else {

        echo "<script>window.alert('Id / Password Incorrect!');</script>";
    }

}





?>