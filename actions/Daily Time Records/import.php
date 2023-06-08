<?php
// Load the database configuration file
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hris_db";


$conn = mysqli_connect($servername, $username,  $password, $dbname);

if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 
    'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $employee_id = $line[0];
                $name  = $line[1];
                $date_dtrecords = $line [2];
                $department  = $line[3];
                $schedule_type = $line[4];
                $time_entry = $line[5];
                $time_out = $line[6];
                $total_hours = '';
                $tardiness = '';
                $undertime = '';
                $overtime = '';


                $result_emp_sched = mysqli_query($conn, "SELECT schedule_name FROM empschedule_tb WHERE empid = '$employee_id'");
                if(mysqli_num_rows($result_emp_sched) > 0) {
                $row_emp_sched = mysqli_fetch_assoc($result_emp_sched);
                $schedID = $row_emp_sched['schedule_name'];
    
                $result_sched_tb = mysqli_query($conn, "SELECT * FROM `schedule_tb` WHERE `schedule_name` = '$schedID'");
                    if(mysqli_num_rows($result_sched_tb) > 0) {
                        $row_sched_tb = mysqli_fetch_assoc($result_sched_tb);
                        $sched_name =  $row_sched_tb['schedule_name'];
                        $col_monday_timein =  $row_sched_tb['mon_timein'];
                        $col_tuesday_timein =  $row_sched_tb['tues_timein'];
                        $col_wednesday_timein =  $row_sched_tb['wed_timein'];
                        $col_thursday_timein =  $row_sched_tb['thurs_timein'];
                        $col_friday_timein =  $row_sched_tb['fri_timein'];
                        $col_saturday_timein =  $row_sched_tb['sat_timein'];
                        $col_sunday_timein =  $row_sched_tb['sun_timein'];
                        $col_monday_timeout =  $row_sched_tb['mon_timeout'];
                        $col_tuesday_timeout =  $row_sched_tb['tues_timeout'];
                        $col_wednesday_timeout =  $row_sched_tb['wed_timeout'];
                        $col_thursday_timeout =  $row_sched_tb['thurs_timeout'];
                        $col_friday_timeout =  $row_sched_tb['fri_timeout'];
                        $col_saturday_timeout =  $row_sched_tb['sat_timeout'];
                        $col_sunday_timeout =  $row_sched_tb['sun_timeout'];
    
                        $day_of_week = date('l', strtotime($date_dtrecords)); // get the day of the week using the "l" format specifier 

                        if($day_of_week === 'Monday'){
                            $total_hours = strtotime($time_out) - strtotime($time_entry) - 7200;
                            $total_hours = date('H:i:s', $total_hours);

                            if($time_entry > $col_monday_timein){
                                $time_in_datetime = new DateTime($time_entry);
                                $scheduled_time = new DateTime($col_monday_timein);
                                $interval = $time_in_datetime->diff($scheduled_time);
                                $tardiness = $interval->format('%h:%i:%s');

                            }                           
                            if($time_out < $col_monday_timeout){
                                $time_out_datetime1 = new DateTime($time_out);
                                $scheduled_outs = new DateTime($col_monday_timeout);
                                $early_interval = $scheduled_outs->diff($time_out_datetime1);
                                $undertime = $early_interval->format('%h:%i:%s');

                            } else { 
                                $undertime = '00:00:00';
                            }
                            if ($time_out > $col_monday_timeout) {
                                $time_out_datetime = new DateTime($time_out);
                                $scheduled_timeout = new DateTime( $col_monday_timeout);
                                $intervals = $time_out_datetime->diff($scheduled_timeout);
                                $overtime = $intervals->format('%h:%i:%s');
                            } else {
                                $overtime = '00:00:00';
                            }
                        } //Close bracket Monday

                        else if($day_of_week === 'Tuesday'){
                            $total_hours = strtotime($time_out) - strtotime($time_entry) - 7200;
                            $total_hours = date('H:i:s', $total_hours);

                            if($time_entry > $col_tuesday_timein){
                                $time_in_datetime = new DateTime($time_entry);
                                $scheduled_time = new DateTime($col_tuesday_timein);
                                $interval = $time_in_datetime->diff($scheduled_time);
                                $tardiness = $interval->format('%h:%i:%s');

                            }                            
                            if($time_out < $col_tuesday_timeout){
                                $time_out_datetime1 = new DateTime($time_out);
                                $scheduled_outs = new DateTime($col_tuesday_timeout);
                                $early_interval = $scheduled_outs->diff($time_out_datetime1);
                                $undertime = $early_interval->format('%h:%i:%s');

                            } else { 
                                $undertime = '00:00:00';
                            }
                            if ($time_out > $col_tuesday_timeout) {
                                $time_out_datetime = new DateTime($time_out);
                                $scheduled_timeout = new DateTime( $col_tuesday_timeout);
                                $intervals = $time_out_datetime->diff($scheduled_timeout);
                                $overtime = $intervals->format('%h:%i:%s');

                            } else {
                                $overtime = '00:00:00';
                            }
                        } //Close bracket Tuesday

                                else if($day_of_week === 'Wednesday'){
                                    // Calculate the total work hours
                                    $total_hours = strtotime($time_out) - strtotime($time_entry) - 7200;
                                    $total_hours = date('H:i:s', $total_hours);

                                    // Check if the employee is late
                                    if($time_entry > $col_wednesday_timein){
                                        // Calculate the amount of late
                                        $time_in_datetime = new DateTime($time_entry);
                                        $scheduled_time = new DateTime($col_wednesday_timein);
                                        $interval = $time_in_datetime->diff($scheduled_time);
                                        $tardiness = $interval->format('%h:%i:%s');

                                    }
                                    
                                    if($time_out < $col_wednesday_timeout){
                                        $time_out_datetime1 = new DateTime($time_out);
                                        $scheduled_outs = new DateTime($col_wednesday_timeout);
                                        $early_interval = $scheduled_outs->diff($time_out_datetime1);
                                        $undertime = $early_interval->format('%h:%i:%s');

                                    } else { 
                                        $undertime = '00:00:00';
                                    }

                                    if ($time_out > $col_wednesday_timeout) {
                                        // Calculate overtime
                                        $time_out_datetime = new DateTime($time_out);
                                        $scheduled_timeout = new DateTime( $col_wednesday_timeout);
                                        $intervals = $time_out_datetime->diff($scheduled_timeout);
                                        $overtime = $intervals->format('%h:%i:%s');

                                    } else {
                                        $overtime = '00:00:00';
                                    }

                                } //Close bracket Wednesday

                                    else if($day_of_week === 'Thursday'){
                                        // Calculate the total work hours
                                        $total_hours = strtotime($time_out) - strtotime($time_entry) - 7200;
                                        $total_hours = date('H:i:s', $total_hours);

                                        // Check if the employee is late
                                        if($time_entry > $col_thursday_timein){
                                            // Calculate the amount of late
                                            $time_in_datetime = new DateTime($time_entry);
                                            $scheduled_time = new DateTime($col_thursday_timein);
                                            $interval = $time_in_datetime->diff($scheduled_time);
                                            $tardiness = $interval->format('%h:%i:%s');

                                        }
                                        
                                        if($time_out < $col_thursday_timeout){
                                            $time_out_datetime1 = new DateTime($time_out);
                                            $scheduled_outs = new DateTime($col_thursday_timeout);
                                            $early_interval = $scheduled_outs->diff($time_out_datetime1);
                                            $undertime = $early_interval->format('%h:%i:%s');

                                        } else { 
                                            $undertime = '00:00:00';
                                        }

                                        if ($time_out > $col_thursday_timeout) {
                                            // Calculate overtime
                                            $time_out_datetime = new DateTime($time_out);
                                            $scheduled_timeout = new DateTime( $col_thursday_timeout);
                                            $intervals = $time_out_datetime->diff($scheduled_timeout);
                                            $overtime = $intervals->format('%h:%i:%s');

                                        } else {
                                            $overtime = '00:00:00';
                                        }

                                    } //Close bracket Thursday

                                    else if($day_of_week === 'Friday'){
                                        // Calculate the total work hours
                                        $total_hours = strtotime($time_out) - strtotime($time_entry) - 7200;
                                        $total_hours = date('H:i:s', $total_hours);

                                        // Check if the employee is late
                                        if($time_entry > $col_friday_timein){
                                            // Calculate the amount of late
                                            $time_in_datetime = new DateTime($time_entry);
                                            $scheduled_time = new DateTime($col_friday_timein);
                                            $interval = $time_in_datetime->diff($scheduled_time);
                                            $tardiness = $interval->format('%h:%i:%s');

                                        }
                                        
                                        if($time_out < $col_friday_timeout){
                                            $time_out_datetime1 = new DateTime($time_out);
                                            $scheduled_outs = new DateTime($col_friday_timeout);
                                            $early_interval = $scheduled_outs->diff($time_out_datetime1);
                                            $undertime = $early_interval->format('%h:%i:%s');

                                        } else { 
                                            $undertime = '00:00:00';
                                        }

                                        if ($time_out > $col_friday_timeout) {
                                            // Calculate overtime
                                            $time_out_datetime = new DateTime($time_out);
                                            $scheduled_timeout = new DateTime( $col_friday_timeout);
                                            $intervals = $time_out_datetime->diff($scheduled_timeout);
                                            $overtime = $intervals->format('%h:%i:%s');

                                        } else {
                                            $overtime = '00:00:00';
                                        }

                                    } //Close bracket Friday

                                    else if($day_of_week === 'Saturday'){
                                        // Calculate the total work hours
                                        $total_hours = strtotime($time_out) - strtotime($time_entry) - 7200;
                                        $total_hours = date('H:i:s', $total_hours);

                                        // Check if the employee is late
                                        if($time_entry > $col_saturday_timein){
                                            // Calculate the amount of late
                                            $time_in_datetime = new DateTime($time_entry);
                                            $scheduled_time = new DateTime($col_saturday_timein);
                                            $interval = $time_in_datetime->diff($scheduled_time);
                                            $tardiness = $interval->format('%h:%i:%s');

                                        }
                                        
                                        if($time_out < $col_saturday_timeout){
                                            $time_out_datetime1 = new DateTime($time_out);
                                            $scheduled_outs = new DateTime($col_saturday_timeout);
                                            $early_interval = $scheduled_outs->diff($time_out_datetime1);
                                            $undertime = $early_interval->format('%h:%i:%s');

                                        } else { 
                                            $undertime = '00:00:00';
                                        }

                                        if ($time_out > $col_saturday_timeout) {
                                            // Calculate overtime
                                            $time_out_datetime = new DateTime($time_out);
                                            $scheduled_timeout = new DateTime($col_saturday_timeout);
                                            $intervals = $time_out_datetime->diff($scheduled_timeout);
                                            $overtime = $intervals->format('%h:%i:%s');

                                        } else {
                                            $overtime = '00:00:00';
                                        }

                                    } //Close bracket Saturday

                                    else if($day_of_week === 'Sunday'){
                                        // Calculate the total work hours
                                        $total_hours = strtotime($time_out) - strtotime($time_entry) - 7200;
                                        $total_hours = date('H:i:s', $total_hours);

                                        // Check if the employee is late
                                        if($time_entry > $col_sunday_timein){
                                            // Calculate the amount of late
                                            $time_in_datetime = new DateTime($time_entry);
                                            $scheduled_time = new DateTime($col_sunday_timein);
                                            $interval = $time_in_datetime->diff($scheduled_time);
                                            $tardiness = $interval->format('%h:%i:%s');

                                        }
                                        
                                        if($time_out < $col_sunday_timeout){
                                            $time_out_datetime1 = new DateTime($time_out);
                                            $scheduled_outs = new DateTime($col_sunday_timeout);
                                            $early_interval = $scheduled_outs->diff($time_out_datetime1);
                                            $undertime = $early_interval->format('%h:%i:%s');

                                        } else { 
                                            $undertime = '00:00:00';
                                        }

                                        if ($time_out > $col_sunday_timeout) {
                                            // Calculate overtime
                                            $time_out_datetime = new DateTime($time_out);
                                            $scheduled_timeout = new DateTime($col_sunday_timeout);
                                            $intervals = $time_out_datetime->diff($scheduled_timeout);
                                            $overtime = $intervals->format('%h:%i:%s');

                                        } else {
                                            $overtime = '00:00:00';
                                        }

                                    } //Close bracket Sunday
                
                        //Check whether member already exists in the database with the same email
                        $prevQuery = "SELECT id FROM daily_time_records_tb WHERE employee_id = '".$line[0]."'";
                        $prevResult = $conn->query($prevQuery);
                        
                        $query = "";
                        if($prevResult->num_rows > 0){
                            // Update member data in the database
                            $query = "INSERT INTO daily_time_records_tb (`employee_id`, `name`, `date_records`, `department`, `schedule_type`, `time_entry`, `time_out`, `total_hours`, `tardiness`, `undertime`, `overtime`) 
                            VALUES ('".$employee_id."', '".$name."', '".$date_dtrecords."', '".$department."', '".$schedule_type."', '".$time_entry."', '".$time_out."', '".$total_hours."', '".$tardiness."', '".$undertime."', '".$overtime."')";
                        }else{
                            // Insert member data in the database
                            $query = "INSERT INTO daily_time_records_tb (`employee_id`, `name`, `date_records`, `department`, `schedule_type`, `time_entry`, `time_out`, `total_hours`, `tardiness`, `undertime`, `overtime`) 
                            VALUES ('".$employee_id."', '".$name."', '".$date_dtrecords."', '".$department."', '".$schedule_type."', '".$time_entry."', '".$time_out."', '".$total_hours."', '".$tardiness."', '".$undertime."', '".$overtime."')";
                        }
                        //echo $query;

                        $conn->query($query);
          }
        }
      }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: ../../dtRecords.php".$qstring);