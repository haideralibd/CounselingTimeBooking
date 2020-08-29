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
	table, th, td {
            border: 2px solid blue;
            border-collapse: collapse;
            text-align: center;
        }
</style>

<ul >
    <li id="activeone"><a href="#">Student Approval</a></li>
    <li style="float: right;color: white;border-left: 2px solid #bbb;"><a href="logout.php">Logout</a></li>

</ul>

	<br>

<table style="width:50%;">
    <thead>
    <tr style="height: 35px;">
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Approval Status</th>
    </tr>
    </thead>
    <tbody>
    <?php
		
/// approve

if(isset($_GET['data'])){
    $id=$_GET['data'];
    try{
        $conn=new PDO("mysql:host=localhost;dbname=counselingTimeBooking;",'root','');
        $apprqlquery="UPDATE students SET approved=1 WHERE id=$id";
        $conn->exec($apprqlquery);
        echo "<script>window.alert('approved successful');</script>";
    }
    catch(PDOException $ex1){
        echo "<script>window.alert('insertion error');</script>";
    }
}

		
		
		
    try{
        $conn=new PDO("mysql:host=localhost;dbname=counselingTimeBooking;",'root','');
        $uname=$_SESSION['username'];

        $sqlquery="SELECT * FROM students where approved=0";


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
        <td><?php echo  $row[0] ?></td>
        <td><?php echo $row[1]  ?></td>
        <td><?php echo $row[2]  ?></td>
        <td>
            <!-- dynamically creating events for each button with different paramenters -->

            <input type="button" style="background-color: white;color: #fa0000;" value="Approve" onclick="approve('<?=$row[0]?>','#F0F');">
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
    function approve(id){
		window.alert(id);
        ///reloading this page again with an extra parameter passed through get method named "delete"
        location.assign('student_approval.php?data='+id);
    }

</script>

	
<div class="footer">
    <p>Counseling Time Booking</p>
</div>
</body>
</html>