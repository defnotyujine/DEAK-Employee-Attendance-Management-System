<?php
	include "database.php";
	
	if(isset($_GET['employee_id'])){
		$idE = $_GET['employee_id'];
		$sqlE = "DELETE FROM employee WHERE `employee_id` = $idE";
		$resultE = mysqli_query($conn, $sqlE);

		$sqlEforEmpDept = "DELETE FROM employee_department WHERE `employee_id` = $idE";
		$resultEforEmpDept = mysqli_query($conn, $sqlEforEmpDept);

		$sqlEforEmpShift = "DELETE FROM employee_shift WHERE `employee_id` = $idE";
		$resultEforEmpShift = mysqli_query($conn, $sqlEforEmpShift);
	}
	else if(isset($_GET['dept_id'])){
		$idD = $_GET['dept_id'];
		$sqlD = "DELETE FROM department WHERE `dept_id` = $idD";
		$resultD = mysqli_query($conn, $sqlD);
	}
	else{
		$idS = $_GET['shift_id'];
		$sqlS = "DELETE FROM shift WHERE `shift_id` = $idS";
		$resultS = mysqli_query($conn, $sqlS);
	}
	
	if($resultE){
		header("Location: employees.php");
	}
	else if($resultD){
		header("Location: departments.php");
	}
	else if($resultS){
		header("Location: shifts.php");
	}
?>