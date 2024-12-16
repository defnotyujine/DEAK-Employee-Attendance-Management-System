<?php
    include "database.php";

    if(isset($_POST['backToEmployee'])){
        header("Location: employees.php");
    }
?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Employee</title>

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
                            <button name="backToEmployee"><i class="fas fa-arrow-left"></i>Back</button>
                        </form>
                        <h4>Add an Employee</h4>
                    </div>
                    <div class="addEmployeeForm">
                        <form method="post" enctype="multipart/form-data">
                            <div>
                                <label for="firstname">First Name:</label>
                                <input class="addEmployeeItem" name="firstname" placeholder="Ex. John"><br>
                                <label for="lastname">Last Name:</label>
                                <input class="addEmployeeItem" name="lastname" placeholder="Ex. Doe"><br>
                                <label for="position">Position:</label>
                                <input class="addEmployeeItem" name="position" placeholder="Ex. Employee"><br>
                                <label for="empPW">Password:</label>
                                <input type="password" name="empPW" placeholder="●●●●●">
                            </div>
                            <div>
                                <label for="image">Upload an Image:</label>
                                <input class="addEmployeeItem" name="empImage" type="file" placeholder="Employee"><br>
                                <label for="department">Department:</label>
                                <select class="addEmployeeItem" name="department">
                                    <?php
                                        $queryDept = "SELECT * FROM department";
                                        $resultDept = mysqli_query($conn, $queryDept);

                                        while ($optionDept = mysqli_fetch_array($resultDept)) {
                                            echo '<option value="' . $optionDept['dept_name'] . '">' . $optionDept['dept_name'] . '</option>';
                                        }
                                    ?>
                                </select><br>
                                <label for="shift">Shift:</label>
                                <select class="addEmployeeItem" name="shift">
                                    <?php
                                        $resultShift = mysqli_query($conn, "SELECT CONCAT(shift_start, ' - ', shift_end) AS shift_time FROM shift");
                                        
                                        while ($optionShift = mysqli_fetch_array($resultShift)) {
                                            echo '<option value="' . $optionShift['shift_time'] . '">' . $optionShift['shift_time'] . '</option>';
                                        }
                                    ?>
                                </select>
                                <?php
                                    if(isset($_POST['addEmployee'])){
                                        if($_POST["firstname"] && $_POST["lastname"] && $_POST["position"] && $_POST["empPW"] && $_POST["department"] && $_POST["shift"]){
                                            $idRand = random_int(10000,99999);

                                            $id = $idRand;

                                            $firstname = $_POST["firstname"];
                                            $lastname = $_POST["lastname"];
                                            $position = $_POST["position"];
                                            $empPW = $_POST["empPW"];
                                    
                                            //for image
                                            $file = $_FILES['empImage'];
                                            $fileName = $file['name'];
                                            $fileTmpName = $file['tmp_name'];
                                            $fileSize = $file['size'];
                                            $fileError = $file['error'];
                                            $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
                                            $uniqueFileName = uniqid().'.'.$fileExt;
                                            $targetDir = 'uploads/';
                                            $targetPath = $targetDir . $uniqueFileName;
                                            move_uploaded_file($fileTmpName, $targetPath);
                                            //
                                            
                                            $department = $_POST["department"];
                                            $shift = $_POST["shift"];
                                            
                                            $sql = "INSERT INTO employee(employee_id, employee_firstName, employee_lastName, employee_position, employee_image, employee_department, employee_shift, employee_password) 
                                            VALUES('$id', '$firstname', '$lastname', '$position', '$uniqueFileName', '$department', '$shift', '$empPW')";
                                            $result = mysqli_query($conn, $sql);
                                            
                                            if($result){
                                                $queryForDeptCode = "SELECT dept_code FROM department WHERE dept_name = '$department'";
                                                $resultForDeptCode = mysqli_query($conn, $queryForDeptCode);
                                                $deptCode = mysqli_fetch_assoc($resultForDeptCode);
                                                $deptCodeValue = $deptCode['dept_code'];
                                                
                                                $queryForEmpID = "SELECT employee_id FROM employee WHERE employee_firstName = '$firstname'";
                                                $resultForEmpID = mysqli_query($conn, $queryForEmpID);
                                                $empID = mysqli_fetch_assoc($resultForEmpID);
                                                $empIDValue = $empID['employee_id'];
                                
                                                //for employee_department
                                                $sqlForEmpDept = "INSERT INTO employee_department(employee_id, dept_code) VALUES('$empIDValue','$deptCodeValue')";
                                                $resultForEmpDept = mysqli_query($conn, $sqlForEmpDept);
                                
                                                $queryForShiftTime = "SELECT employee_shift FROM employee WHERE employee_id = '$id'";
                                                $resultForShiftTime = mysqli_query($conn, $queryForShiftTime);
                                                $shiftTime = mysqli_fetch_assoc($resultForShiftTime);
                                                $shiftTimeValue = $shiftTime['employee_shift'];
                                
                                                //for employee_shift
                                                $timeArray = explode(" - ", $shiftTimeValue);
                                                $startTimeValue = $timeArray[0];
                                                $endTimeValue = $timeArray[1];
                                                
                                                $queryForEmpIDt = "SELECT employee_id FROM employee WHERE employee_firstName = '$firstname'";
                                                $resultForEmpIDt = mysqli_query($conn, $queryForEmpIDt);
                                                $empIDt = mysqli_fetch_assoc($resultForEmpIDt);
                                                $empIDValuet = $empIDt['employee_id'];
                                
                                                $sqlForEmpShift = "INSERT INTO employee_shift(employee_id, shift_time, shift_start, shift_end) VALUES('$empIDValuet','$shiftTimeValue','$startTimeValue','$endTimeValue')";
                                                $resultForEmpShift = mysqli_query($conn, $sqlForEmpShift);

                                                echo "<div style='padding: 10px; border: 1px solid green; width: 200px;text-align: center; border-radius: 5px;'>
                                                <p style='color: green; font-weight: 700; font-size: 13px; margin: 0;'>
                                                <i class='fas fa-check'></i>Employee added</p></div>";
                                            }
                                        }
                                        else{
                                            echo "<div style='padding: 10px; border: 1px solid #B54B46; width: 200px; text-align: center; border-radius: 5px;'>
                                            <p style='color: #B54B46; font-weight: 700; font-size: 13px; margin: 0;'><i class='fas fa-exclamation-circle'>
                                            </i>Please fill out all the data</p></div>";
                                        }
                                    }
                                ?>
                                <div>
                                    <button name="addEmployee"><i class="fas fa-plus"></i>Add</button>
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