<!DOCTYPE html>

<html>
<body>
<link rel="stylesheet" type="text/css" href="header.css">

<div class="header">
    <h1>Student Sign up</h1>
</div>
<br> <br>

    <form action="student_signup.php" method="post">
        <br>
        Id: <input type="text" name="sid"><br/>
        <br>
        Name: <input type="text" name="sname"><br/>
        <br>
        Email: <input type="email" name="semail"><br/>
        <br>
        Password: <input type="text" name="spass"><br/>

        <br>
        <input type="submit" value="Submit">
    </form>
    
    <?php
        if($_SERVER['REQUEST_METHOD']=="GET"){
            /// nothing to do
        }
        else if($_SERVER['REQUEST_METHOD']=="POST"){
            $sid=$sname=$semail=$spass="";
            
            if(isset($_POST['sid'])) $sid=$_POST['sid'];
            if(isset($_POST['sname'])) $sname=$_POST['sname'];
            if(isset($_POST['semail'])) $semail=$_POST['semail'];
            if(isset($_POST['spass'])) $spass=$_POST['spass'];


            try{
                $conn=new PDO("mysql:host=localhost;dbname=counselingTimeBooking;",'root','');
                echo "<script>console.log('connection successful');</script>";
                
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                echo "<script>window.alert('connection error');</script>";
            }
            
            try{
                $sqlquery="INSERT INTO students VALUES ('$sid', '$sname', '$semail','$spass',0)";

                $conn->exec($sqlquery);
                echo "<script>window.alert('insertion successful');</script>";
                header('Location: student_signin.php');
            }
            catch(PDOException $e){
                echo "<script>window.alert('insertion error');</script>";
            }
            
            
        }
    
    ?>
<div class="footer">
    <p>Counseling Time Booking</p>
</div>
</body>

</html>