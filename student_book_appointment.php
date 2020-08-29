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
        margin:0px;
        padding: 0;
        overflow: hidden;
        background-color: #1e425d;
        horiz-align: center;
    }

    li {
        float:left;
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
    button {
        border: 0;
        padding: 0;
        display: inline;
        background: none;
        text-decoration: underline;
        color: blue;
    }
    button:hover {
        cursor: pointer;
    }
    table, th, td {
        border: 2px solid black;
        border-collapse: collapse;
        text-align: center;
    }
</style>

<ul >
    <li id="activeone"><a href="student_book_counseling.php">Book Counseling Time</a></li>
    <li><a href="student_appointments.php">My Appointments</a></li>
    <li style="float: right;color: white;border-left: 2px solid #bbb;"><a href="logout.php">Logout</a></li>

</ul>
<br>
<table style="width:50%;margin-bottom: 70px;">
    <thead>
    <tr style="height: 35px;">
        <th>Day</th>
        <th>Start Time</th>
        <th>Book Time</th>
    </tr>
    </thead>
    <tbody>
<?php
// Teacher User NAME //
$t_name=$_POST['data'];


    try{
        $conn=new PDO("mysql:host=localhost;dbname=counselingTimeBooking;",'root','');

        $sqlquery="SELECT * FROM counseling_hours where teacher_id='$t_name' order by day,start_time";


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
foreach($table as $row) {


    $stime=strtotime($row[3]);
    $etime=strtotime($row[4]);
        while ($stime < $etime) {


            ?>
            <tr>
                <td><?php echo $row[2] ?></td>
                <td><?php echo date("g:i a", $stime); ?></td>
                <td>
                    <!-- dynamically creating events for each button with different paramenters -->

                    <!--   <input type="button" value="Select" href="insert_appointment.php" ng-click="return theFunction();"> -->

                    <a href="insert_appointment.php?time=<?php echo $stime ?>&day=<?php echo $row[2] ?>&teacher=<?php echo $t_name ?>"
                       ng-click="return theFunction();">Select</a>

                </td>
            </tr>
            <?php
            $stime = $stime + 900;

        }


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
</html>