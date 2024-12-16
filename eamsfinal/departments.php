<?php
	if(isset($_POST['search'])){
		$s = $_POST['valueToSearch'];
		$query = "SELECT * FROM department WHERE dept_id LIKE '%$s%' OR dept_name LIKE '%$s%' OR dept_code LIKE '%$s%' OR dept_id LIKE '%$s%'";
		$search_result = filterTable($query);
	}
	else{
		$query = "SELECT * FROM department ORDER BY dept_id ASC";
		$search_result = filterTable($query);
	}

    if(isset($_POST['goToAddDept'])){
        header("Location: addDept.php");
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
	<title>Departments</title>

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
				<li class="nav-item active">
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
                    <h4>Departments</h4>
                    <div class="employeesTable">
                        <form method="post">
                            <input name="valueToSearch" placeholder="Search">
                            <button name="search"><i class="fas fa-search"></i>Search</button>
                            <button name="goToAddDept"><i class="fas fa-plus"></i>Add Department</button>
                        </form>
                        <table>
                            <thead>
                            <tr>
                                <th>Dept. ID</th>
                                <th>Dept. Code</th>
                                <th>Dept. Name</th>
								<th></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_array($search_result)): ?>
                                <tr>
                                    <td><?php echo $row['dept_id']?></td>
                                    <td><?php echo $row['dept_code']?></td>
                                    <td><?php echo $row['dept_name']?></td>
									<td class="operationsTd">
                                        <a href="delete.php?dept_id=<?php echo $row["dept_id"]?>"><i class="fas fa-trash"></i></a>
										<a href="editDept.php?dept_id=<?php echo $row["dept_id"]?>"><i class="fas fa-pencil-alt"></i></a>
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