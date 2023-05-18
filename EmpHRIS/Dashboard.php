<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php"); 
    }
 
    $server = "localhost";
    $user = "root";
    $pass ="";
    $database = "hris_db";

    $db = mysqli_connect($server, $user, $pass, $database);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudfare.com/ajax/libs/font-awesome/5.15.1/css/all.min.js" integrity="sha512-+4CK9k+qNFUR5X+cKL9EIR+Z0htIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous"/>
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <title>HRIS | Dashboard</title>

</head>
<body>
    <style>
        body {
            overflow-X: hidden;
        }
    </style>
    <header>
        <?php include("header.php")?>
    </header>
    <div class="emp-dashboard-container">
            <div class="emp-dashboard-content">
                <div class="emp-dash-card">
                    <div class="dash-schedule-card">
                        <div class="container">
                    <?php
                        $username = $_SESSION['username'];
                        $conn = mysqli_connect("localhost","root","","hris_db");
                        date_default_timezone_set("Asia/Manila"); // set the timezone to Manila
                        $current_date = date("Y-m-d"); // format the date as YYYY-MM-DD

                        $timein_attendance = "";
                        $timeout_attendance = "";
                        $attendance_query = mysqli_query($conn, "SELECT * FROM attendances WHERE `date` = '$current_date'");
                        if(mysqli_num_rows($attendance_query) > 0) {
                            $row_attendances = mysqli_fetch_assoc($attendance_query);
                            $timein_attendance = $row_attendances['time_in'];
                            $timeout_attendance = $row_attendances['time_out']; 
                         }
                         else{
                            $timein_attendance = 'NO TIME IN';
                            $timeout_attendance = 'NO TIME OUT';
                         } 
                    ?>
                    
                    <div>
                        <span class="schedule-for">Schedule For:</span>
                        <span id="current_date"></span>
                    </div>
                    <?php 
                            $username = $_SESSION['username'];
                            $conn = mysqli_connect("localhost","root","","hris_db");
                            date_default_timezone_set('Asia/Manila'); // set the timezone to Manila

                            $today = new DateTime(); // create a new DateTime object for today
                            $today->modify('this week'); // navigate to the beginning of the week

                            $week_dates = array(); // create an empty array to store the week dates

                            for ($i = 0; $i < 7; $i++) {
                                $week_dates[] = $today->format('Y-m-d'); // add the current date to the array
                                $today->modify('+1 day'); // navigate to the next day
                            }
                            
                            $query = "SELECT empschedule_tb.id, empschedule_tb.empid, empschedule_tb.sched_from, empschedule_tb.sched_to, empschedule_tb.schedule_name, 
                                    schedule_tb.mon_timein, schedule_tb.mon_timeout,
                                    schedule_tb.tues_timein, schedule_tb.tues_timeout,
                                    schedule_tb.wed_timein, schedule_tb.wed_timeout,
                                    schedule_tb.thurs_timein, schedule_tb.thurs_timeout,
                                    schedule_tb.fri_timein, schedule_tb.fri_timeout,
                                    schedule_tb.sat_timein, schedule_tb.sat_timeout,
                                    schedule_tb.sun_timein, schedule_tb.sun_timeout
                                    FROM empschedule_tb
                                    INNER JOIN schedule_tb ON empschedule_tb.schedule_name = schedule_tb.schedule_name
                                    INNER JOIN employee_tb ON empschedule_tb.empid = employee_tb.empid 
                                    WHERE employee_tb.username = '$username'
                                    AND (sched_from <= CURDATE() AND sched_to >= CURDATE());";
                                    
                            $result = mysqli_query($conn, $query);

                            if(mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    $time_in = '';
                                    $time_out = '';
                                    $day_of_week = date('D');
                                    switch ($day_of_week) {
                                        case 'Mon':
                                            $time_in =  date('h:i A', strtotime($row['mon_timein']));
                                            $time_out = date('h:i A', strtotime($row['mon_timeout']));
                                            break;
                                        case 'Tue':
                                            $time_in =  date('h:i A', strtotime($row['tues_timein']));
                                            $time_out = date('h:i A', strtotime($row['tues_timeout']));
                                            break;
                                        case 'Wed':
                                            $time_in =  date('h:i A', strtotime($row['wed_timein']));
                                            $time_out = date('h:i A', strtotime($row['wed_timeout']));
                                            break;
                                        case 'Thu':
                                            $time_in =  date('h:i A', strtotime($row['thurs_timein']));
                                            $time_out = date('h:i A', strtotime($row['thurs_timeout']));
                                            break;
                                        case 'Fri':
                                            $time_in =  date('h:i A', strtotime($row['fri_timein']));
                                            $time_out = date('h:i A', strtotime($row['fri_timeout']));
                                            break;
                                        case 'Sat':
                                            $time_in =  date('h:i A', strtotime($row['sat_timein']));
                                            $time_out = date('h:i A', strtotime($row['sat_timeout']));
                                            break;
                                        case 'Sun':
                                            $time_in =  date('h:i A', strtotime($row['sun_timein']));
                                            $time_out = date('h:i A', strtotime($row['sun_timeout']));
                                            break;
                                    }
                                    echo "<div style='text-align: right; margin-top: -22px; color: black;'> <strong>Schedule Time: </strong>" . $time_in . "-" . $time_out . "</div>";
                                    echo $row['schedule_name'];
                                    
                                }
                            } else {
                                echo "No schedule found for this week.";
                            }
                        ?>
                    <div class="progress-container">
                        <div>
                            <span id="current_time"></span>
                        </div>
                        <div class="steps">
                            <span class="circle"></span>
                            <div class="progress-bar">
                                <span class="indicator"></span>
                            </div>
                        </div>
                        <div class="buttons">
                            <div class="first-button">
                                <div class="button-panel">
                            <button class="prev" id="prev_time_in">Time In</button>
                                </div>
                                <div class="firstbtn_content">
                                    <?php 
                                        if ($timein_attendance === '00:00:00') {
                                            echo "No time in";
                                        } else {
                                            echo $timein_attendance;
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="second-button">
                                <div class="secondbtn_panel">
                            <button class="next" id="next_time_out">Time Out</button>
                                </div>
                                <div class="secondbtn_content">
                                    <?php 
                                        if ($timeout_attendance === '00:00:00') {
                                            echo "No time out";
                                        } else {
                                            echo $timeout_attendance;
                                        }
                                    ?>
                                </div>
                            </div>
                        </div><!---Button close tag--->

                     </div>
                 </div>   
              </div>
                    <div class="dash-schedule-content">
                                        <div style="">
                                            <h1>Yesterday</h1>
                                            <h1>8:00AM - 5:00PM</h1>
                                        </div>
                                        <div class="dash-barrier" style="margin-left: 70px;">

                                        </div>
                                        <div style="margin-right: 165px;">
                                            <h1>Tommorow</h1>
                                            <h1>Restday</h1>
                                        </div>
                                    </div>
                                    <div class="dash-employment-container">
                                        <div>
                                            <div class="dash-employment-content">
                                                <div class="dash-emp-icon" style="background: rgb(87,44,198);
                    background: linear-gradient(36deg, rgba(87,44,198,1) 22%, rgba(0,212,255,1) 90%, rgba(2,0,36,1) 100%);">
                                                    <i class="fa-regular fa-clock"></i>
                                                </div>
                                                <div>
                                                    <h1>5</h1>
                                                    <p>Total Tardiness</p>
                                                </div>
                                            </div>
                                            <div class="dash-employment-content">
                                                <div class="dash-emp-icon" style="background: rgb(34,193,195);
                    background: linear-gradient(36deg, rgba(34,193,195,1) 0%, rgba(189,189,89,1) 35%, rgba(253,187,45,1) 100%);">
                                                    <i class="fa-solid fa-bed"></i>
                                                </div>
                                                <div>
                                                    <h1>2</h1>
                                                    <p>Total Absent</p>
                                                </div>
                                            </div>
                                            <div class="dash-employment-content">
                                                <div class="dash-emp-icon" style="background: rgb(131,58,180);
                    background: linear-gradient(36deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%);">
                                                    <i class="fa-solid fa-plane-departure"></i>
                                                </div>
                                                <div>
                                                    <h1 >2</h1>
                                                    <p>Vacation Leave Balance</p>
                                                </div>
                                            </div>
                                        </div>   
                                        <div> 
                                            <div class="dash-employment-content">
                                                <div class="dash-emp-icon" style="background: rgb(122,106,106);
                    background: linear-gradient(65deg, rgba(122,106,106,1) 0%, rgba(230,230,47,1) 67%, rgba(253,187,45,1) 100%);">
                                                    <i class="fa-solid fa-stopwatch-20"></i>
                                                </div>
                                                <div>
                                                    <h1>3hr(s) 30mn(s)</h1>
                                                    <p>Total Overtime</p>
                                                </div>
                                            </div>
                                            <div class="dash-employment-content">
                                                <div class="dash-emp-icon" style="background: rgb(122,106,106);
                    background: linear-gradient(65deg, rgba(122,106,106,1) 0%, rgba(214,214,201,1) 67%, rgba(168,151,113,1) 100%);">
                                                    <i class="fa-solid fa-hourglass-half"></i>
                                                </div>
                                                <div>
                                                    <h1>2 hr(s)</h1>
                                                    <p>Total Undertime</p>
                                                </div>
                                            </div>
                                            <div class="dash-employment-content">
                                                <div class="dash-emp-icon" style="background: rgb(246,164,164);
                    background: linear-gradient(65deg, rgba(246,164,164,1) 0%, rgba(214,214,201,1) 67%, rgba(245,220,165,1) 100%);">
                                                    <i class="fa-solid fa-laptop-medical"></i>
                                                </div>
                                                <div>
                                                    <h1>0</h1>
                                                    <p>Sick Leave Balance</p>
                                                </div>
                                            </div> 
                                        </div> 
                                    </div>
                                </div>
                                <div class="emp-dash-card2">
                                    <div class="emp-dash2-announcement"> 
                                        <div class="emp-dash2-announcement-title">
                                            <h1>Events and Announcement</h1>

                                        </div>
                                        <div class="emp-dash2-announcement-content">
                                        <?php
                                            include 'config.php';

                                            $query = "SELECT announcement_tb.id,
                                                        announcement_tb.announce_title,
                                                        employee_tb.empid,
                                                        CONCAT(employee_tb.`fname`, ' ', employee_tb.`lname`) AS `full_name`,
                                                        announcement_tb.announce_date,
                                                        announcement_tb.description,
                                                        announcement_tb.file_attachment 
                                                    FROM announcement_tb 
                                                    INNER JOIN employee_tb ON announcement_tb.empid = employee_tb.empid;";
                                            $result = mysqli_query($conn, $query);
                                            $slideIndex = 0;

                                            while ($row = mysqli_fetch_assoc($result)) {
                                                if ($slideIndex % 1 === 0) {
                                                    echo "<div class='announcement-slide'>";
                                                }
                                            ?>
                                                <h4 class="mt-2 ml-2"><?php echo $row['announce_title'] ?></h4>
                                                <p class="ml-2"><span style="color: #7F7FDD; font-style: Italic;"><?php echo $row['full_name'] ?></span> - <?php echo $row['announce_date'] ?></p>
                                                <p class="ml-2"><?php echo $row['description'] ?></p>
                                            <?php
                                                if (($slideIndex + 1) % 1 === 0) {
                                                    echo "</div>";
                                                }
                                                $slideIndex++;
                                            }
                                            if ($slideIndex % 1 !== 0) {
                                                echo "</div>";
                                            }
                                            ?>
                                        <div class="prev-next_btn">
                                            <button class="previous" onclick="prevSlide()">&#10094;</button>
                                            <button class="next-step" onclick="nextSlide()">&#10095;</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="emp-dash2-chart">
                                        <p>Chart</p>
                                    </div>
                                    <div class="emp-dash2-shortcut">
                                        <div class="emp-dash2-shortcut-title">
                                            <h1>Shortcut Link</h1>
                                        </div>
                                        <div class="emp-dash2-shortcut-card">
                                            <div class="emp-dash2-shortcut-icon">
                                            <i class="fa-solid fa-chevron-right"></i>
                                            </div>
                                            <div>
                                                <p>View Attendance</p>
                                            </div>
                                        </div>
                                        <div class="emp-dash2-shortcut-card"> 
                                            <div class="emp-dash2-shortcut-icon">
                                            <i class="fa-solid fa-chevron-right"></i>
                                            </div>
                                            <div>
                                                <p>File Overtime</p>
                                            </div>
                                        </div>
                                        <div class="emp-dash2-shortcut-card">
                                            <div class="emp-dash2-shortcut-icon">
                                            <i class="fa-solid fa-chevron-right"></i>
                                            </div>
                                            <div>
                                                <p>Request Vacation Leave</p>
                                            </div>
                                        </div>
                                        <div class="emp-dash2-shortcut-card">
                                            <div class="emp-dash2-shortcut-icon">
                                            <i class="fa-solid fa-chevron-right"></i>
                                            </div>
                                            <div>
                                                <p>View Payslip</p>
                                            </div>
                                        </div>
                                        <div class="emp-dash2-shortcut-card">
                                            <div class="emp-dash2-shortcut-icon">
                                            <i class="fa-solid fa-chevron-right"></i>
                                            </div>
                                            <div>
                                                <p>Schedule</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
     
<!------------------------Script sa function ng Previous and Next Button--------------------------------------->    
<script>
    var currentSlide = 0;
    var slides = document.getElementsByClassName("announcement-slide");

    function showSlide(n) {
        for (var i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slides[n].style.display = "block";
        currentSlide = n;
    }

    function prevSlide() {
        if (currentSlide > 0) {
            showSlide(currentSlide - 1);
        }
    }

    function nextSlide() {
        if (currentSlide < slides.length - 1) {
            showSlide(currentSlide + 1);
        }
    }

    showSlide(0); // Show the first slide initially
</script>
<!------------------------End Script sa function ng Previous and Next Button--------------------------------------->
    <script src="js/dashboard.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="main.js"></script>
</body>
</html>