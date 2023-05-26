<?php

   $empid = $_POST['empid'];
   $schedule_name = $_POST['schedule_name'];
   $sched_from = $_POST['sched_from'];
   $sched_to = $_POST['sched_to'];

   $conn = new mysqli('localhost', 'root', '', 'hris_db');
   if($conn->connect_error){
    die('Connection Failed: ' .$conn->connect_error);
   }

   $stmt = $conn->prepare("INSERT INTO empschedule_tb (empid,schedule_name, sched_from, sched_to)
                           VALUES (?, ?, ?, ?)
                           ON DUPLICATE KEY UPDATE 
                               schedule_name = VALUES(schedule_name), 
                               sched_from = VALUES(sched_from), 
                               sched_to = VALUES(sched_to)");
   $stmt->bind_param("ssss", $empid, $schedule_name, $sched_from, $sched_to);
   $stmt->execute();
   header("Location: ../../Schedules.php");
   $stmt->close();
   $conn->close();
?>