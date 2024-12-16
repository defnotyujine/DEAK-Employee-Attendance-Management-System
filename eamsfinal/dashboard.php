<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Dashboard</title>
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
					<a class="nav-link active" href="dashboard.php">Dashboard</a>
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
				<li class="nav-item-sign-out">
					<a class="nav-link" href="login.php"><i class="fas fa-door-open"></i>Sign Out</a>
				</li>
			</ul>
		</div>
	</nav>
    <main class="container-fluid py-3">
		<div class="row">
			<div class="col-md-12">

				<div class="dataCountContainer">
					<div class="dataCount" id="dataCountE">
						<div>
							<i class="fas fa-id-badge fa-3x"></i>
						</div>
						<div>
							<?php
								include "database.php";
								$queryE = "SELECT * FROM employee";
								$resultE = mysqli_query($conn, $queryE);
								$empCount = mysqli_num_rows($resultE);
								echo $empCount;
							?>
							Employees
						</div>
					</div>
					<div class="dataCount" id="dataCountD">
						<div>
							<i class="fas fa-building fa-3x"></i>
						</div>
						<div>
							<?php
								include "database.php";
								$queryD = "SELECT * FROM department";
								$resultD = mysqli_query($conn, $queryD);
								$deptCount = mysqli_num_rows($resultD);
								echo $deptCount;
							?>
							Departments
						</div>
					</div>
					<div class="dataCount" id="dataCountS">
						<div>
							<i class="fas fa-clock fa-3x"></i>
						</div>
						<div>
							<?php
								include "database.php";
								$queryS = "SELECT * FROM shift";
								$resultS = mysqli_query($conn, $queryS);
								$shiftCount = mysqli_num_rows($resultS);
								echo $shiftCount;
							?>
							Shifts
						</div>
					</div>
					<div class="dataCount" id="dataCountA">
						<div>
							<i class="fas fa-file fa-3x"></i>
						</div>
						<div>
							<?php
								include "database.php";
								$queryA = "SELECT * FROM attendance";
								$resultA = mysqli_query($conn, $queryA);
								$attendanceCount = mysqli_num_rows($resultA);
								echo $attendanceCount;
							?>
							Attendance <br> Records
						</div>
					</div>
					<div id="clockContainer">
						<div id="clock">
							<div class="number number-12">12</div>
							<div class="number number-3">3</div>
							<div class="number number-6">6</div>
							<div class="number number-9">9</div>
							<div id="hour-hand" class="hand"></div>
							<div id="minute-hand" class="hand"></div>
							<div id="second-hand" class="hand"></div>
						</div>
					</div>
				</div>

				<div class="row-2">
					<div class="tableContainer">
						<div class="tableForDeptEmps">
							<h6>Departments' Employees</h6>
							<table class="dashboardTable">
								<thead>
									<tr>
										<th>Dept. Code</th>
										<th>Employees <br> Assigned</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									include "database.php";
									$queryForDeptEmpsTable = "SELECT dept_code, COUNT(employee_id) AS employee_count FROM employee_department GROUP BY dept_code";
									$resultForDeptEmpsTable = mysqli_query($conn, $queryForDeptEmpsTable);
									while ($rowForDeptEmpsTable = mysqli_fetch_assoc($resultForDeptEmpsTable)):
									?>
									<tr>
										<td> <?php echo $rowForDeptEmpsTable['dept_code']?> </td>
										<td> <?php echo $rowForDeptEmpsTable['employee_count']?> </td>
									</tr>
									<?php endwhile; ?>
								</tbody>
							</table>
						</div>
						<div class="tableForEmpForShift">
							<h6>Employees per Shift</h6>
							<table class="dashboardTable">
								<thead>
									<tr>
										<th>Shift Time</th>
										<th>Employees <br> Assigned</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									include "database.php";
									$queryForEmpShiftTable = "SELECT shift_time, COUNT(employee_id) AS employee_count_s FROM employee_shift GROUP BY shift_time";
									$resultForEmpShiftTable = mysqli_query($conn, $queryForEmpShiftTable);
									while ($rowForEmpShiftTable = mysqli_fetch_assoc($resultForEmpShiftTable)):
									?>
									<tr>
										<td> <?php echo $rowForEmpShiftTable['shift_time']?> </td>
										<td> <?php echo $rowForEmpShiftTable['employee_count_s']?> </td>
									</tr>
									<?php endwhile; ?>
								</tbody>
							</table>
						</div>

						<div class="calendar-container">
							<div class="calendar-header" id="month-year"></div>
							<div class="calendar" id="calendar"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
	<script src="clock.js"></script>
	<script src="calendar.js"></script>
</body>