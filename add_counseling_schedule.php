<?php
session_start();
if(empty($_SESSION['username'])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<head>

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
    <li id="activeone"><a href="add_counseling_schedule.php" >Edit Counseling Schedule</a></li>
    <li><a href="teacher_appointments.php">My Appointments</a></li>
    <li style="float: right;color: white;border-left: 2px solid #bbb;"><a href="logout.php">Logout</a></li>

</ul>

</head>
<body>
<br>
<form method="post" action="add_counseling_schedule.php">
    <label style="margin-left: 20px;"><b>Day:</b></label>
    <select name="day">
        <option value="Sat">Saturday</option>
        <option value="Sun">Sunday</option>
        <option value="Tue">Tuesday</option>
        <option value="Wed">Wednesday</option>
    </select>
    <label style="margin-left: 20px;"><b>Start Time:</b></label>
    <input type="time" name="starttime">
    <label style="margin-left: 20px;"><b>End Time:</b></label>
    <input type="time" name="endtime">
    <input type="submit"  name="update" value="Update" style="margin-left: 25px;">
</form>


<?php
/// delete

if(isset($_GET['delete'])){
    $id=$_GET['delete'];

    try{
        $conn=new PDO("mysql:host=localhost;dbname=counselingTimeBooking;",'root','');

        $delquery="DELETE FROM counseling_hours WHERE id=$id";
        $conn->exec($delquery);
        echo "<script>window.alert('deletion successful');</script>";
    }
    catch(PDOException $ex1){
        echo "<script>window.alert('deletion error');</script>";
    }
}


if($_SERVER['REQUEST_METHOD']=="GET"){
    /// nothing to do
}
else if($_SERVER['REQUEST_METHOD']=="POST"){
    $day=$starttime=$endtime="";

    if(isset($_POST['day'])) $day=$_POST['day'];
    if(isset($_POST['starttime'])) $starttime=$_POST['starttime'];
    if(isset($_POST['endtime'])) $endtime=$_POST['endtime'];


    try{
        $conn=new PDO("mysql:host=localhost;dbname=counselingTimeBooking;",'root','');
        echo "<script>console.log('connection successful');</script>";

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




    }
    catch(PDOException $e){
        echo "<script>window.alert('connection error');</script>";
    }

    try{
        $uname=$_SESSION['username'];
        $sqlquery="INSERT INTO `counseling_hours`(`teacher_id`, `day`, `start_time`, `end_time`) VALUES ('$uname','$day','$starttime','$endtime')";

        $conn->exec($sqlquery);
        echo "<script>window.alert('insertion successful');</script>";
        //header('Location: add_counseling_schedule.php');
    }
    catch(PDOException $e){
        echo "<script>window.alert('insertion error');</script>";
    }
}

?>
<br>

<table style="width:50%;">
    <thead>
    <tr style="height: 35px;">
        <th>Day</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    try{
        $conn=new PDO("mysql:host=localhost;dbname=counselingTimeBooking;",'root','');
        $uname=$_SESSION['username'];

        $sqlquery="SELECT * FROM counseling_hours where teacher_id='$uname' order by day,start_time";


    $object=$conn->query($sqlquery);

    if($object->rowCount() == 0){ /// 0 meaning no data exists in the database
        ///

    ?>
    <tr>
        <td colspan="6" style="text-align:center;">
            No Data Found!!!
        </td>
    </tr>
    <?php
                    }
                    else{
                        ///meaning data exists in the database table
                        $table=$object->fetchAll();
                        foreach($table as $row){
                            ?>
    <tr>
        <td><?php echo  $row[2] ?></td>
        <td><?php echo date("g:i a", strtotime("$row[3]"));  ?></td>
        <td><?php echo date("g:i a", strtotime("$row[4]"));  ?></td>
        <td>
            <!-- dynamically creating events for each button with different paramenters -->

            <input type="button" style="background-color: white;color: #fa0000;" value="Delete" onclick="deleterow(<?php echo $row[0]  ?>);">
        </td>
    </tr>
    <?php
                        }
                    }

                }
                catch(PDOException $e){
                    echo "<script>window.alert('table show error');</script>";
                }
                ?>
    </tbody>
</table>

</body>
<script>
    function deleterow(id){
        ///reloading this page again with an extra parameter passed through get method named "delete"
        location.assign('add_counseling_schedule.php?delete='+id);
    }

</script>


<div class="footer">
    <p>Counseling Time Booking</p>
</div>

</html>