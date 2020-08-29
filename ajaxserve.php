<?php

$searchval="";
if(isset($_GET['search'])) $searchval=$_GET['search'];

try{
    $conn=new PDO("mysql:host=localhost;dbname=counselingTimeBooking;",'root','');

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo "<script>window.alert('db connection errror')</script>";
}

$searchquery="SELECT * FROM teachers WHERE name LIKE '%$searchval%'";
try{
    $object=$conn->query($searchquery);
    if($object->rowCount() == 0){
        echo "<tr><td colspan='5' style='text-align:center;'>No Data Found</td></tr>";
    }
    else{
        $tablecode="";
        $table=$object->fetchAll();
        foreach($table as $row){
            $tablecode.="<tr><td><form action=\"student_book_appointment.php\" method=\"post\">
                        <input type=\"hidden\" name=\"data\" value=\"$row[0]\" />
                        <button>$row[2]</button>
                    </form></td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td></tr>";

        }
        
        echo $tablecode;
    }
}
catch(PDOException $ex1){
    echo "<script>console.log('search error')</script>";
}



?>