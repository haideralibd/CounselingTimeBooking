<?php
session_start();
if(empty($_SESSION['username'])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>

</head>

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
</style>

<ul >
    <li id="activeone"><a href="student_book_counseling.php">Book Counseling Time</a></li>
    <li><a href="student_appointments.php">My Appointments</a></li>
    <li style="float: right;color: white;border-left: 2px solid #bbb;"><a href="logout.php">Logout</a></li>

</ul>
<br>
<div>
    <input type="search" id="search" name="search" placeholder="Search Here">
    <input type="button" id="searchbtn" value="Search">
</div>
    <br>
    <div class="container">

<table class="table table-dark table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Room</th>
    </tr>
    </thead>
    <tbody id="tablebody">
    <?php
    try{
        $conn=new PDO("mysql:host=localhost;dbname=counselingTimeBooking;",'root','');

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $ex){
        echo "<script>window.alert('db connection errror')</script>";
    }

    $sqlquery="Select * from teachers";
    try{
        $object=$conn->query($sqlquery);
        $table=$object->fetchAll();

        foreach($table as $row){
            ?>
            <tr>
                <td>
                    <form action="student_book_appointment.php" method="post">
                        <input type="hidden" name="data" value="<?php echo $row[0] ?>" />
                        <button><?php echo $row[2] ?></button>
                    </form>


                </td>
                <td><?php echo $row[3] ?></td>
                <td><?php echo $row[4] ?></td>
                <td><?php echo $row[5] ?></td>
            </tr>
            <?php
        }

    }
    catch(PDOException $e){
        echo "<script>window.alert('query errror')</script>";
    }
    ?>
    </tbody>
</table>
</div>



<script>
    var searchdata=document.getElementById('search');

    var searchbtn=document.getElementById('searchbtn');
    searchbtn.addEventListener('click',ajaxfn);

    function ajaxfn(){
        var ajaxreq=new XMLHttpRequest();
        ajaxreq.open('GET','ajaxserve.php?search='+searchdata.value);

        ajaxreq.onreadystatechange=function (){

            if(this.readyState===XMLHttpRequest.DONE && this.status==200){
                var tablebody=document.getElementById('tablebody');
                tablebody.innerHTML=ajaxreq.responseText;
            }
        };


        ajaxreq.send();

    }




</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


<div class="footer">
    <p>Counseling Time Booking</p>
</div>
</body>
</html>