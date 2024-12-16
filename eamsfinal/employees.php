<?php
	if(isset($_POST['search'])){
		$s = $_POST['valueToSearch'];
		$query = "SELECT * FROM employee WHERE employee_firstName LIKE '%$s%' OR employee_lastName LIKE '%$s%' OR employee_position LIKE '%$s%' 
		OR employee_department LIKE '%$s%' OR employee_shift LIKE '%$s%' OR employee_id LIKE '%$s%'";
		$search_result = filterTable($query);
	}
	else{
		$query = "SELECT * FROM employee ORDER BY employee_id ASC";
		$search_result = filterTable($query);
	}

    if(isset($_POST['goToAddEmployee'])){
        header("Location: addEmployee.php");
    }

	function filterTable($query){
		include 'database.php';
		$filter_Result = mysqli_query($conn, $query);
		return $filter_Result;
	}
?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Employees</title>
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
				<li class="nav-item active">
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
				<div class="employeesMain">
                    <h4>Employees</h4>
                    <div class="employeesTable">
                        <form method="post">
                            <input name="valueToSearch" placeholder="Search">
                            <button name="search"><i class="fas fa-search"></i>Search</button>
                            <button name="goToAddEmployee"><i class="fas fa-plus"></i>Add Employee</button>
                        </form>
                        <table>
                            <thead>
                            <tr>
                                <th>Employee ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Position</th>
                                <th>Image</th>
                                <th>Department</th>
                                <th>Shift</th>
								<th></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($search_result)): ?>
                                <tr>
                                    <td><?php echo $row['employee_id']?></td>
                                    <td><?php echo $row['employee_firstName']?></td>
                                    <td><?php echo $row['employee_lastName']?></td>
                                    <td><?php echo $row['employee_position']?></td>
                                    <td>
                                        <?php
                                        if($row['employee_image']) {
											$fileName = $row['employee_image'];
  											$imagePath = 'uploads/' . $fileName;
											echo "<img class='employeeImage' src='$imagePath'>";
                                        }else if($row['employee_image'] == NULL){
											$imagePath = 'uploads/' . 'default.png';
											echo "<img class='employeeImage' src='$imagePath'>";
										}
										
                                        ?>
                                    </td>
									<td><?php echo $row['employee_department']?></td>
									<td><?php echo $row['employee_shift']?></td>
									<td class="operationsTd">
										<a href="delete.php?employee_id=<?php echo $row["employee_id"]?>"><i class="fas fa-trash"></i></a>
										<a href="editEmployee.php?employee_id=<?php echo $row["employee_id"]?>"><i class="fas fa-pencil-alt"></i></a>
									</td>
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