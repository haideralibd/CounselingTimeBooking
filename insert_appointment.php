<?php
session_start();
if(empty($_SESSION['username'])){
    header("Location: index.php");
}
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

    table, th, td {
        border: 2px solid blue;
        border-collapse: collapse;
        text-align: center;
    }
</style>
</>

<ul >
    <li id="activeone"><a href="student_book_counseling.php" >Book Counseling Time</a></li>
    <li><a href="student_appointments.php">My Appointments</a></li>
    <li style="float: right;color: white;border-left: 2px solid #bbb;"><a href="logout.php">Logout</a></li>

</ul>
<br> <br>
<?php
try{
    $stime= date("g:i a", $_REQUEST['time']);
    $day= $_REQUEST['day'];
    $teacher= $_REQUEST['teacher'];
}
catch(PDOException $e){

}
?>




<form method="post" action="insert_appointment.php" >
<!-- Just to handel the Errors -->
    <input type="hidden" id="stime" name="time" value=0>
    <input type="hidden" id="stime" name="day" value="">
    <input type="hidden" id="stime" name="teacher" value="">


    <input type="hidden" id="stime" name="stime" value="<?php echo $stime ?>">
    <input type="hidden" id="day" name="sday" value="<?php echo $day?>">
    <input type="hidden" id="teacher" name="steacher" value="<?php echo $teacher?>">

    Name: <input type="text" name="sname"><br/>
    <br>
    Course Name: <input type="text" name="cname"><br/>
    <br>
    Section: <input type="text" name="sec"><br/>
    <br>
    Topic: <input type="text" name="topic"><br/>


    <br>
    <input type="submit" value="Submit">
</form>

<?php
if($_SERVER['REQUEST_METHOD']=="GET"){
    /// nothing to do
}
else if($_SERVER['REQUEST_METHOD']=="POST"){
    $sname=$cname=$sec=$topic=$starttime=$sday=$steacher="";
    if(isset($_POST['stime'])) $starttime=$_POST['stime'];
    if(isset($_POST['sday'])) $sday=$_POST['sday'];
    if(isset($_POST['steacher'])) $steacher=$_POST['steacher'];
    if(isset($_POST['sname'])) $sname=$_POST['sname'];
    if(isset($_POST['cname'])) $cname=$_POST['cname'];
    if(isset($_POST['sec'])) $sec=$_POST['sec'];
    if(isset($_POST['topic'])) $topic=$_POST['topic'];


    $date = DateTime::createFromFormat( 'H:i A', $starttime);
    $testtime = $date->format( 'H:i:s');

    try{
        $conn=new PDO("mysql:host=localhost;dbname=counselingTimeBooking;",'root','');
        echo "<script>console.log('connection successful');</script>";

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




    }
    catch(PDOException $e){
        echo "<script>window.alert('connection error');</script>";
    }

    try{
        $conn=new PDO("mysql:host=localhost;dbname=counselingTimeBooking;",'root','');
        $uname=$_SESSION['username'];
        //$sqlquery="INSERT INTO `counseling_hours`(`teacher_id`, `day`, `start_time`, `end_time`) VALUES ('MIHn','$sday','$testtime','$testtime')";
        $sqlquery="INSERT INTO `appointments`(`student_id`, `student_name`, `course_name`, `section`, `topic`, `teacher_id`, `day`, `start_time`) VALUES ('$uname','$sname','$cname','$sec','$topic','$steacher','$sday','$testtime')";
        $conn->exec($sqlquery);
        echo "<script>window.alert('insertion successful');</script>";
        header('Location: student_appointments.php');
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