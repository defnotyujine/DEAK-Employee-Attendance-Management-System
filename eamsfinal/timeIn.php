<?php
    include "database.php";

    //$id = $_GET['employee_id'];
    date_default_timezone_set('Asia/Manila');
    $currentDate = date('Y-m-d');

    $queryForDouble = "SELECT * FROM attendance WHERE employee_id = '$id' AND attendance_date = '$currentDate'";
    $resultForDouble = mysqli_query($conn, $queryForDouble);

    if(mysqli_num_rows($resultForDouble) > 0){
        //echo "<script> alert('You have already timed-in today') </script>";
        $message = "You have already timed-in today";
        header("Location: employeeLogin.php?message=" . urlencode($message));
    }
    else{
        $attendanceDate = date('Y-m-d');
        $attendanceTime = date('H:i:s');

        $queryForShiftTime = "SELECT employee_shift, employee_firstName, employee_lastName FROM employee WHERE employee_id = '$id'";
        $resultForShiftTime = mysqli_query($conn, $queryForShiftTime);
        $rowForShiftTime = mysqli_fetch_assoc($resultForShiftTime);
        $empShiftValue = $rowForShiftTime['employee_shift'];
        $empFnValue = $rowForShiftTime['employee_firstName'];
        $empLnValue = $rowForShiftTime['employee_lastName'];

        $queryForShiftStart = "SELECT shift_start FROM employee_shift WHERE employee_id = '$id'";
        $resultForShiftStart = mysqli_query($conn, $queryForShiftStart);
        if($resultForShiftStart && mysqli_num_rows($resultForShiftStart) > 0) {
            $rowForShiftStart = mysqli_fetch_assoc($resultForShiftStart);
            $shiftStart = $rowForShiftStart['shift_start'];
        }else{
            $shiftStart = '09:00:00'; //Default
        }

        if($attendanceTime <= $shiftStart) {
            $attendanceStatus = "Present";
        }else{
            $attendanceStatus = "Late";
        }

        $query = "INSERT INTO attendance(employee_shift, attendance_date, attendance_timeIn, attendance_timeOut, attendance_status, employee_id, employee_firstName, employee_lastName)
        VALUES ('$empShiftValue', '$attendanceDate', '$attendanceTime', NULL, '$attendanceStatus', '$id', '$empFnValue', '$empLnValue')";
        $result = mysqli_query($conn, $query);

        $message2 = "You are now timed-in";
        header("Location: employeeLogin.php?message2=" . urlencode($message2));
    }
?>