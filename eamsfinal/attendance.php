<?php
	if(isset($_POST['search'])){
		$s = $_POST['valueToSearch'];
		$query = "SELECT * FROM attendance WHERE attendance_id LIKE '%$s%' OR employee_id LIKE '%$s%' OR employee_firstName LIKE '%$s%' OR employee_lastName LIKE '%$s%' OR attendance_status LIKE '%$s%' OR attendance_date LIKE '%$s%'";
		$search_result = filterTable($query);
	}
	else{
		$query = "SELECT * FROM attendance ORDER BY attendance_date ASC";
		$search_result = filterTable($query);
	}

	function filterTable($query){
		include 'database.php';
		$filter_Result = mysqli_query($conn, $query);
		return $filter_Result;
	}

	if(isset($_POST['toPDF'])){
		header("Location: toPDF.php");
	}

	if(isset($_POST['clearAll'])){
		include "database.php";
		$sqlDel = "DELETE FROM attendance";
		$resultDel = mysqli_query($conn, $sqlDel);
		header("Location: attendance.php");
	}
?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Attendance</title>
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
					<a class="nav-link active" href="attendance.php">Attendance</a>
				</li>
			</ul>
		</div>
	</nav>
    <main class="container-fluid py-3">
		<div class="row">
			<div class="col-md-12">
				<div class="employeesMain">
                    <h4>Attendance</h4>
                    <div class="employeesTable">
                        <form class="attendanceForm" method="post">
                            <input name="valueToSearch" placeholder="Search">
                            <button name="search"><i class="fas fa-search"></i>Search</button>
							<button name="toPDF" class="toPDFButton"><i class="far fa-file-pdf"></i>Export as PDF</button>
							<button name="clearAll" class="clearAll"><i class="fas fa-trash"></i>Clear all records</button>
                        </form>
                        <table>
                            <thead>
                            <tr>
                                <th>Registered Shift</th>
                                <th>Date</th>
                                <th>Time-In</th>
                                <th>Time-Out</th>
                                <th>Status</th>
                                <th>First Name</th>
                                <th>Last Name</th>
								<th>Employee ID</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($search_result)): ?>
                                <tr>
                                    <td><?php echo $row['employee_shift']?></td>
                                    <td><?php echo $row['attendance_date']?></td>
                                    <td><?php echo $row['attendance_timeIn']?></td>
                                    <td><?php echo $row['attendance_timeOut']?></td>
									<td><?php echo $row['attendance_status']?></td>
                                    <td><?php echo $row['employee_firstName']?></td>
									<td><?php echo $row['employee_lastName']?></td>
                                    <td><?php echo $row['employee_id']?></td>
                                </tr>
                                <?php endwhile;?>
                            </tbody>
                        </table>
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