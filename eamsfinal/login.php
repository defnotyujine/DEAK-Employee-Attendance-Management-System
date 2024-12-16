<?php
    include 'database.php';

    if(isset($_POST['goToEmpLogin'])){
        sleep(1);
        header("Location: employeeLogin.php");
    }
?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="mainLogin">
        <div class="empLoginButtonContainer">
            <form method="post">
                <button name="goToEmpLogin"><i class="fa fa-clock"></i>Employee Attendance</button>
            </form>
        </div> 
        <div class="mainLoginForm">
            <form class="loginForm" method="post">
                <span> DEAK Administrator Login </span>
                <hr>
                <label for="username">Username:</label>
                <input name="username">
                <label for="password">Password:</label>
                <input name="password" type="password">
                <?php
                    if(isset($_POST['submit'])){
                        $user = $_POST['username'];
                        $pw = $_POST['password'];

                        $sql = "SELECT * FROM admin WHERE admin_username = '$user' AND admin_password ='$pw'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $count = mysqli_num_rows($result);

                        if($count == 1){
                            sleep(1);
                            header("Location: dashboard.php");
                        }else{
                            echo "<p style='color: #B54B46; font-weight: 700; font-size: 13px;'><i class='fas fa-exclamation-circle'></i>Admin access only</p>";
                        }
                    }
                ?>
                <div>
                    <button name="submit"><i class="fa fa-user"></i>Login</button>
                </div>
            </form>
        </div>           
    </div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</body>