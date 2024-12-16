<?php
    include 'database.php';
	$id = $_GET['shift_id'];
	
	$sql= "SELECT * FROM shift WHERE shift_id=$id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	if(isset($_POST['backToShifts'])){
        header("Location: shifts.php");
    }
?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Update Shift</title>
	
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
                            <button name="backToShifts"><i class="fas fa-arrow-left"></i>Back</button>
                        </form>
                        <h4>Update Shift</h4>
                    </div>
                    <div class="addShiftForm">
                        <form method="post">
                            <div>
                                <label for="start">Start of Shift:</label>
                                <input class="addShiftItem" type="time" value=<?php echo $row["shift_start"]?> name="start">
                                <label for="end">End of Shift:</label>
                                <input class="addShiftItem" type="time" value=<?php echo $row["shift_end"]?> name="end">

								<?php
								if(isset ($_POST['update'])){
									if($_POST["start"] && $_POST["end"]){
										$start = $_POST["start"];
										$end = $_POST["end"];

										$sql = "UPDATE `shift` SET `shift_start`='$start',`shift_end`='$end' WHERE shift_id='$id'";
										mysqli_query($conn, $sql);

										echo "<div style='padding: 10px; border: 1px solid green; width: 200px;text-align: center; border-radius: 5px;'>
										<p style='color: green; font-weight: 700; font-size: 13px; margin: 0;'>
										<i class='fas fa-check'></i>Shift updated</p></div>";

										echo '<script>
												setTimeout(function() {
													window.location.href = "shifts.php";
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
                            </div>
                            <div>
                                <button name="update"><i class="fas fa-sync-alt"></i>Update</button>
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