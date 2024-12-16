<?php
    include 'database.php';
	$id = $_GET['employee_id'];
    
    $sql= "SELECT * FROM employee WHERE employee_id=$id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

	if(isset($_POST['backToEmployees'])){
        header("Location: employees.php");
    }
?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update Employee</title>
	
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="dashboard.php">DEAK</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="dashboard.php">Dashboard</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="employees.php">Employees</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="departments.php">Departments</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="shifts.php">Shifts</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="attendance.php">Attendance</a>
				</li>
			</ul>
		</div>
	</nav>
    <main class="container-fluid py-3">
		<div class="row">
			<div class="col-md-12">
				<div class="addEmployeeMain">
                    <div class="formTitle">
                        <form method="post">
                            <button name="backToEmployees"><i class="fas fa-arrow-left"></i>Back</button>
                        </form>
                        <h4>Update Employee</h4>
                    </div>
                    <div class="addEmployeeForm">
                        <form method="post">
                            <div>
                                <label for="firstname">First Name:</label>
                                <input class="addEmployeeItem" name="firstname" value="<?php echo $row["employee_firstName"]; ?>" placeholder="Ex. John"><br>
                                <label for="lastname">Last Name:</label>
                                <input class="addEmployeeItem" name="lastname" value="<?php echo $row["employee_lastName"]; ?>" placeholder="Ex. Doe"><br>
                                <label for="position">Position:</label><br>
                                <input class="addEmployeeItem" name="position" value="<?php echo $row["employee_position"]; ?>" placeholder="Ex. Employee"><br>
                                <label for="empPW">Password:</label>
                                <input type="password" name="empPW" placeholder="●●●●●">
                            </div>
                            <div>
                                <!--
                                <label for="image">Upload an Image:</label>
                                <input class="addEmployeeItem" name="empImage" type="file" placeholder="Employee"><br>-->
                                <label for="department">Department:</label>
                                <select class="addEmployeeItem" name="department">
                                    <?php
                                        include "database.php";
                                    
                                        $queryDept = "SELECT * FROM department";
                                        $resultDept = mysqli_query($conn, $queryDept);

                                        echo '<option value="' . $row['employee_department'] . '">' . $row['employee_department'] . '</option>';

                                        while ($optionDept = mysqli_fetch_array($resultDept)) {
                                            echo '<option value="' . $optionDept['dept_name'] . '">' . $optionDept['dept_name'] . '</option>';
                                        }
                                    ?>
                                </select><br>
                                <label for="shift">Shift:</label>
                                <select class="addEmployeeItem" name="shift">
                                    <?php
                                        include "database.php";
                                    
                                        $resultShift = mysqli_query($conn, "SELECT CONCAT(shift_start, ' - ', shift_end) AS shift_time FROM shift");

                                        echo '<option value="' . $row['employee_shift'] . '">' . $row['employee_shift'] . '</option>';

                                        while ($optionShift = mysqli_fetch_array($resultShift)) {
                                            echo '<option value="' . $optionShift['shift_time'] . '">' . $optionShift['shift_time'] . '</option>';
                                        }
                                    ?>
                                </select>
                                <?php
                                    if(isset ($_POST['update'])){
                                        if($_POST["firstname"] && $_POST["lastname"] && $_POST["position"] && $_POST["department"] && $_POST["shift"] && $_POST["empPW"]){
                                            $firstname = $_POST["firstname"];
                                            $lastname = $_POST["lastname"];
                                            $position = $_POST["position"];
                                    
                                            $department = $_POST["department"];
                                            $shift = $_POST["shift"];
                                            $empPW = $_POST["empPW"];
                                    
                                            $sql = "UPDATE `employee` SET `employee_firstName`='$firstname',`employee_lastName`='$lastname',`employee_position`='$position',
                                            `employee_department`='$department',`employee_shift`='$shift',`employee_password`='$empPW' WHERE employee_id='$id'";
                                            mysqli_query($conn, $sql);
                                            
                                            $queryForDeptCode = "SELECT dept_code FROM department WHERE dept_name = '$department'";
                                            $resultForDeptCode = mysqli_query($conn, $queryForDeptCode);
                                            $deptCode = mysqli_fetch_assoc($resultForDeptCode);
                                            $deptCodeValue = $deptCode['dept_code'];
                                    
                                            $sqlForEmpDept = "UPDATE `employee_department` SET `dept_code`='$deptCodeValue' WHERE employee_id='$id'";
                                            mysqli_query($conn, $sqlForEmpDept);
                                    
                                            //
                                    
                                            $queryForShiftTime =  "SELECT employee_shift FROM employee WHERE employee_id = '$id'";
                                            $resultForShiftTime = mysqli_query($conn, $queryForShiftTime);
                                            $shiftTime = mysqli_fetch_assoc($resultForShiftTime);
                                            $shiftTimeValue = $shiftTime['employee_shift'];
                                    
                                            $timeArray = explode(" - ", $shiftTimeValue);
                                            $startTimeValue = $timeArray[0];
                                            $endTimeValue = $timeArray[1];
                                    
                                            $sqlForEmpShift = "UPDATE `employee_shift` SET `shift_time`='$shiftTimeValue',`shift_start`='$startTimeValue',`shift_end`='$endTimeValue' WHERE employee_id='$id'";
                                            mysqli_query($conn, $sqlForEmpShift);
                                            
                                            echo "<div style='padding: 10px; border: 1px solid green; width: 200px;text-align: center; border-radius: 5px;'>
                                            <p style='color: green; font-weight: 700; font-size: 13px; margin: 0;'>
                                            <i class='fas fa-check'></i>Employee updated</p></div>";

                                            echo '<script>
                                                    setTimeout(function() {
                                                        window.location.href = "employees.php";
                                                    }, 500);
											    </script>';
                                        }
                                        else{
                                            echo "<div style='padding: 10px; border: 1px solid #B54B46; width: 200px; text-align: center; border-radius: 5px;'>
                                            <p style='color: #B54B46; font-weight: 700; font-size: 13px; margin: 0;'><i class='fas fa-exclamation-circle'>
                                            </i>Please fill out all the data</p></div>";
                                        }
                                    }
                                ?>
                                <div>
                                    <button name="update"><i class="fas fa-sync-alt"></i>Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
			</div>
		</div>
	</main>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
	<script type="text/javascript" src="script.js"></script>
</body>