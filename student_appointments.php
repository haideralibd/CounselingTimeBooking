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
    <li ><a href="student_book_counseling.php" >Book Counseling Time</a></li>
    <li id="activeone"><a href="student_appointments.php">My Appointments</a></li>
    <li style="float: right;color: white;border-left: 2px solid #bbb;"><a href="logout.php">Logout</a></li>

</ul>

</head>
<body>


<br>

<table style="width:50%;">
    <thead>
    <tr style="height: 35px;">
        <th>Day</th>
        <th>Start Time</th>
        <th>Teacher ID</th>
        <th>Teacher Name</th>
        <th>Room</th>
        <th>Course</th>
        <th>Section</th>
        <th>Topic</th>
    </tr>
    </thead>
    <tbody>
    <?php
    try{
        $uname=$_SESSION['username'];
        $conn=new PDO("mysql:host=localhost;dbname=counselingTimeBooking;",'root','');

        $sqlquery="SELECT * FROM appointments where student_id='$uname'order by day,start_time";


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
                    <td><?php echo  $row[7] ?></td>
                    <td><?php echo date("g:i a", strtotime("$row[8]"));  ?></td>
                    <td><?php echo  $row[6] ?></td>
                    <td><?php

                        $conn=new PDO("mysql:host=localhost;dbname=counselingTimeBooking;",'root','');
                        $sqlquery="SELECT name FROM teachers where id='$row[6]'";
                        $object=$conn->query($sqlquery);
                        $table=$object->fetchAll();
                        foreach($table as $r){
                        echo  $r[0]; }?></td>

                    <td><?php
                    $conn=new PDO("mysql:host=localhost;dbname=counselingTimeBooking;",'root','');
                    $sqlquery="SELECT room FROM teachers where id='$row[6]'";
                    $object=$conn->query($sqlquery);
                    $table=$object->fetchAll();
                    foreach($table as $r){
                        echo  $r[0]; }?></td>
                    <td><?php echo  $row[3] ?></td>
                    <td><?php echo  $row[4] ?></td>
                    <td><?php echo  $row[5] ?></td>
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



<div class="footer">
    <p>Counseling Time Booking</p>
</div>

</html>