<!DOCTYPE html>
<html>
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

    </style>
</head>
<body id="welcome">


<ul >
    <li id="activeone"><a href="index.php">Home</a></li>
    <li><a href="student_signin.php">Student</a></li>
    <li><a href="teacher_signin.php">Teacher</a></li>
    <li><a href="admin_login.php">Admin</a></li>
</ul>
<br>
	<h1 align="center"><i>Welcome to counseling time booking.</i></h1>


</body>
<div class="footer">
    <p>Counseling Time Booking</p>
</div>
</html>
