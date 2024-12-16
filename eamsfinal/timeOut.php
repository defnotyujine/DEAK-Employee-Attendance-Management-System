<?php
    include "database.php";
    
    //$id = $_GET['employee_id'];
    date_default_timezone_set('Asia/Manila');
    $currentDate = date('Y-m-d');

    $queryForDouble = "SELECT * FROM attendance WHERE employee_id = '$id' AND attendance_date = '$currentDate'";
    $resultForDouble = mysqli_query($conn, $queryForDouble);

    if(mysqli_num_rows($resultForDouble) > 0){
        $row = mysqli_fetch_assoc($resultForDouble);

        if ($row['attendance_timeOut'] !== null) {
            $message3 = "You have already timed-out today";
            header("Location: employeeLogin.php?message3=" . urlencode($message3));
        }
        else{
            date_default_timezone_set('Asia/Manila');
            $attendanceDate = date('Y-m-d');
            $attendanceTime = date('H:i:s');
    
            $query = "UPDATE `attendance` SET `attendance_timeOut`='$attendanceTime' 
            WHERE employee_id = '$id' AND attendance_date = '$attendanceDate'";
            $result = mysqli_query($conn, $query);

            $message4 = "You are now timed-out";
            header("Location: employeeLogin.php?message4=" . urlencode($message4));
        }
    }
    else{
        $message5 = "You have not timed-in today";
        header("Location: employeeLogin.php?message5=" . urlencode($message5));
    }
?>