<?php
    include 'database.php';
   
    if(isset($_POST['goToAdminLogin'])){
        sleep(1);
        header("Location: login.php");
    }
?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Employee Attendance</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="mainLogin">
        <div class="adminLoginButtonContainer">
            <form method="post">
                <button name="goToAdminLogin"><i class="fas fa-user-tie"></i>Admin Login</button>
            </form>
        </div> 
        <div class="mainLoginForm">
            <form class="loginForm" method="post">
                <span> DEAK Employee Attendance </span>
                <hr>
                <label for="empID">Employee ID:</label>
                <input name="empID">
                <label for="password">Password:</label>
                <input name="password" type="password">
                <?php 
                    include "database.php";
                    if(isset($_POST['timeIn'])){
                        $empID = $_POST['empID'];
                        $pw = $_POST['password'];

                        $queryForEmpPW = "SELECT * FROM employee WHERE employee_id = '$empID' AND employee_password = '$pw'";
                        $result = mysqli_query($conn, $queryForEmpPW);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $count = mysqli_num_rows($result);
                        if($count){
                            $id = $empID;
                            include "timeIn.php";
                        }else{
                            echo "<p style='color: #B54B46; font-weight: 700; font-size: 13px;'><i class='fas fa-exclamation-circle'></i>Employee not found</p>";
                        }

                    }

                    if(isset($_POST['timeOut'])){
                        $empID = $_POST['empID'];
                        $pw = $_POST['password'];

                        $queryForEmpPW = "SELECT * FROM employee WHERE employee_id = '$empID' AND employee_password = '$pw'";
                        $result = mysqli_query($conn, $queryForEmpPW);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $count = mysqli_num_rows($result);

                        if($count){
                            $id = $empID;
                            include "timeOut.php";
                        }else{
                            echo "<p style='color: #B54B46; font-weight: 700; font-size: 13px;'><i class='fas fa-exclamation-circle'></i>Employee not found</p>";
                        }
                    }
                ?>
                <?php
                    if(isset($_GET['message'])){
                        $message = ($_GET['message']);
                        echo "<p style='color: #B54B46; font-weight: 700; font-size: 13px;'><i class='fas fa-exclamation-circle'></i> $message </p>";
                    }
                    else if(isset($_GET['message2'])){
                        $message2 = ($_GET['message2']);
                        echo "<p style='color: green; font-weight: 700; font-size: 13px;'><i class='fas fa-check'></i> $message2 </p>";
                    }
                    else if(isset($_GET['message3'])){
                        $message3 = ($_GET['message3']);
                        echo "<p style='color: #B54B46; font-weight: 700; font-size: 13px;'><i class='fas fa-exclamation-circle'></i> $message3 </p>";
                    }
                    else if(isset($_GET['message4'])){
                        $message4 = ($_GET['message4']);
                        echo "<p style='color: green; font-weight: 700; font-size: 13px;'><i class='fas fa-check'></i> $message4 </p>";
                    }
                    else if(isset($_GET['message5'])){
                        $message5 = ($_GET['message5']);
                        echo "<p style='color: #B54B46; font-weight: 700; font-size: 13px;'><i class='fas fa-exclamation-circle'></i> $message5 </p>";
                    }
                ?>
                <div>
                    <button name="timeIn"><i class="fa fa-clock"></i>Time In</button>
                    <button name="timeOut" class="timeOut"><i class="fa fa-sign-out-alt"></i>Time Out</button>
                </div>
            </form>
        </div>
    </div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</body>