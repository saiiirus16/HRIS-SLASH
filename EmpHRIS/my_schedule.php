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
       
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="bootstrap/vertical-layout-light/style.css">

    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">


    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>



<!-- skydash -->

<link rel="stylesheet" href="skydash/feather.css">
    <link rel="stylesheet" href="skydash/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="skydash/vendor.bundle.base.css">

    <link rel="stylesheet" href="skydash/style.css">

    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">

    <link rel="stylesheet" href="css/try.css">
    <link rel="stylesheet" href="css/myschedule.css"/>
    <link rel="stylesheet" href="css/styles.css">
    <title>My Schedule - Employee</title>
</head>
<body>
<header>
     <?php
         include 'header.php';
     ?>
</header>

<style>
    html{
        background-color: #f4f4f4 !important;
        overflow: hidden;
       
    }
    body{
        overflow: hidden;
        background-color: #F4F4F4 !important;
    }

    .pagination{
        margin-right: 63px !important;

        
    }

    .pagination li a{
        color: #c37700;
    }

        .page-item.active .page-link, .jsgrid .jsgrid-pager .active.jsgrid-pager-nav-button .page-link, .jsgrid .jsgrid-pager .active.jsgrid-pager-page .page-link, .page-item.active .jsgrid .jsgrid-pager .jsgrid-pager-nav-button a, .jsgrid .jsgrid-pager .jsgrid-pager-nav-button .page-item.active a, .jsgrid .jsgrid-pager .active.jsgrid-pager-nav-button a, .page-item.active .jsgrid .jsgrid-pager .jsgrid-pager-page a, .jsgrid .jsgrid-pager .jsgrid-pager-page .page-item.active a, .jsgrid .jsgrid-pager .active.jsgrid-pager-page a {
        z-index: 3;
        color: #fff;
        background-color: #000;
        border-color: #000;
    }

    
    
    #order-listing_previous{
        margin-right: 0px !important;
        margin-top: 0px !important;
        width: 80px !important;

    }

    .table-responsive{
        overflow-x: hidden !important;
    }

</style>


<!------------------------------------Header and Button------------------------------------------------->
    <div class="main-panel mt-5" style="margin-left: 19%; position: absolute; top: 70px;">
        <div class=" mt-1">
          <div class="card" style="box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17); width:1500px; height:800px; border-radius:20px;">
            <div class="card-body">
                <div class="row">
                        <div class="col-6">
                            <h2>Schedule</h2>
                        </div>
                        </div>  
<!------------------------------------Header, Dropdown and Button------------------------------------------------->




<!----------------------------------Syntax for Dropdown button------------------------------------------>
    <div class="official_panel">
            <div class="child_panel">
              <p class="empo_date_text">Date From</p>
              <input class="select_custom" type="date" name="" id="datestart" required>
            </div>
            <div class="child_panel">
              <div class="notif">
              <p class="empo_date_text">Date To</p>
              <p id="validate" class="validation">End date must beyond the start date</p>
            </div>
              <input class="select_custom" type="date" id="enddate" onchange="datefunct()" required>
            </div>
            <button class="btn_go" id="id_btngo">Go</button>
          </div>
<!------------------------------End Syntax for Dropdown button------------------------------------------------->
            

<!------------------------------------------Syntax ng Table-------------------------------------------------->
        <div class="row" >
            <div class="col-12 mt-2">
                    <div class="table-responsive">
                     <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th style="display: none;">ID</th>
                                <th style="display: none;">Employee ID</th>
                                <th>Work Date</th>
                                <th>Work Day</th>
                                <th>Start Time</th> 
                                <th>End Time</th>
                                <th>Work Setup</th>
                                <th>Working Hours</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $employeeid = $_SESSION['empid'];
                            include 'config.php';
                            date_default_timezone_set('Asia/Manila'); // set the timezone to Manila

                            $today = new DateTime(); // create a new DateTime object for today
                            $today->modify('this week'); // navigate to the beginning of the week

                            $week_dates = array(); // create an empty array to store the week dates

                            for ($i = 0; $i < 7; $i++) {
                                $week_dates[] = $today->format('Y-m-d'); // add the current date to the array
                                $today->modify('+1 day'); // navigate to the next day
                            }
                            $query = "SELECT empschedule_tb.id, employee_tb.empid, empschedule_tb.sched_from, empschedule_tb.sched_to, empschedule_tb.schedule_name, schedule_tb.mon_timein, schedule_tb.mon_timeout,
                            schedule_tb.tues_timein, schedule_tb.tues_timeout,
                            schedule_tb.wed_timein, schedule_tb.wed_timeout,
                            schedule_tb.thurs_timein, schedule_tb.thurs_timeout,
                            schedule_tb.fri_timein, schedule_tb.fri_timeout,
                            schedule_tb.sat_timein, schedule_tb.sat_timeout,
                            schedule_tb.sun_timein, schedule_tb.sun_timeout
                            FROM
                            empschedule_tb
                            INNER JOIN schedule_tb ON empschedule_tb.schedule_name = schedule_tb.schedule_name
                            INNER JOIN employee_tb ON empschedule_tb.empid = employee_tb.empid WHERE employee_tb.empid = '$employeeid';";

                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                $schedFrom = $row['sched_from'];
                                $schedTo = $row['sched_to'];
                                $dateRange = "";
                                $currDate = $week_dates[0]; // start from the first date in the week
                                while ($currDate <= $schedTo && in_array($currDate, $week_dates)) {
                                    $date = $currDate;
                                    $dayOfWeek = date("l", strtotime($date));
                                    $startTime = '';
                                    $endTime = '';
                                    switch ($dayOfWeek) {
                                    case 'Monday':
                                        $startTime = $row['mon_timein'];
                                        $endTime = $row['mon_timeout'];
                                        break;
                                    case 'Tuesday':
                                        $startTime = $row['tues_timein'];
                                        $endTime = $row['tues_timeout'];
                                        break;
                                    case 'Wednesday':
                                        $startTime = $row['wed_timein'];
                                        $endTime = $row['wed_timeout'];
                                        break;
                                    case 'Thursday':
                                        $startTime = $row['thurs_timein'];
                                        $endTime = $row['thurs_timeout'];
                                        break;
                                    case 'Friday':
                                        $startTime = $row['fri_timein'];
                                        $endTime = $row['fri_timeout'];
                                        break;
                                    case 'Saturday':
                                        $startTime = $row['sat_timein'];
                                        $endTime = $row['sat_timeout'];
                                        break;
                                    case 'Sunday':
                                        $startTime = $row['sun_timein'];
                                        $endTime = $row['sun_timeout'];
                                        break;
                                    }
                                    $dateRange .= $date . " ";
                                    // Calculate working hours
                                    $workingHours = "";
                                    if (($startTime == 'NULL') && ($endTime == 'NULL')) {
                                        $startTime = '-';
                                        $endTime = '-';
                                        $row['schedule_name'] = 'Restday';  
                                        $workingHours = '0.00';                                 
                                    } else if (!empty($startTime) && !empty($endTime)) {
                                        $startTimestamp = strtotime($startTime);
                                        $endTimestamp = strtotime($endTime);
                                        $workingSeconds = $endTimestamp - $startTimestamp - 3600; // subtract 1 hour for lunchtime
                                        $workingSeconds = abs($workingSeconds); // Get the absolute value
                                        $workingHours = number_format($workingSeconds / 3600, 2); // format as 0.00
                                    }                                    
                                ?>
                                    <tr>
                                        <td style="display: none;"><?php echo $row['id']?></td>
                                        <td style="display: none;"><?php echo $row['empid']?></td>
                                        <td><?php echo $date?></td>
                                        <td><?php echo $dayOfWeek?></td>
                                        <?php if (($startTime === null || $startTime === '') && ($endTime === null || $endTime === '')): ?>
                                        <td>-</td> 
                                        <td>-</td>
                                        <td>Restday</td>  
                                        <td>0.00</td>
                                    <?php else: ?>
                                        <td><?php echo !is_null($startTime) ? date("h:i A", strtotime($startTime)) : '-'?></td> 
                                        <td><?php echo !is_null($endTime) ? date("h:i A", strtotime($endTime)) : '-'?></td>
                                        <td><?php echo $row['schedule_name']?></td>  
                                        <td><?php echo $workingHours?></td> 
                                    <?php endif; ?>
                                    </tr>
                                <?php
                                    $currDate = date('Y-m-d', strtotime($currDate . ' +1 day'));
                                }
                              } 
                            ?>
                        </tbody>
                    </table>


<!------------------------------------End Syntax ng Table------------------------------------------------->    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script> 
     $('.header-dropdown-btn').click(function(){
        $('.header-dropdown .header-dropdown-menu').toggleClass("show-header-dd");
    });

//     $(document).ready(function() {
//     $('.navbar-toggler').click(function() {
//     $('.nav-title').toggleClass('hide-title');
//     $('.dashboard-container').toggleClass('move-content');
  
//   });
// });
 $(document).ready(function() {
    var isHamburgerClicked = false;

    $('.navbar-toggler').click(function() {
    $('.nav-title').toggleClass('hide-title');
    // $('.dashboard-container').toggleClass('move-content');
    isHamburgerClicked = !isHamburgerClicked;

    if (isHamburgerClicked) {
      $('#dashboard-container').addClass('move-content');
    } else {
      $('#dashboard-container').removeClass('move-content');

      // Add class for transition
      $('#dashboard-container').addClass('move-content-transition');
      // Wait for transition to complete before removing the class
      setTimeout(function() {
        $('#dashboard-container').removeClass('move-content-transition');
      }, 800); // Adjust the timeout to match the transition duration
    }
  });
});
 

//     $(document).ready(function() {
//   $('.navbar-toggler').click(function() {
//     $('.nav-title').toggleClass('hide-title');
//   });
// });


    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  // Toggle the submenu visibility on click (for mobile devices)
//   $('.nav-link').on('click', function(e) {
//     if ($(window).width() <= 390) {
//       e.preventDefault();
//       $(this).siblings('.sub-menu').slideToggle();
//     }
//   });

  // Hamburger button functionality
  $('.responsive-bars-btn').on('click', function() {
    if ($(window).width() <= 390) {
      $('#sidebar').toggleClass('active-sidebars');
    }
  });
});


$(document).ready(function() {
  // Toggle the submenu visibility on click (for mobile devices)
//   $('.nav-link').on('click', function(e) {
//     if ($(window).width() <= 500) {
//       e.preventDefault();
//       $(this).siblings('.sub-menu').slideToggle();
//     }
//   });

  // Hamburger button functionality
  $('.responsive-bars-btn').on('click', function() {
    if ($(window).width() <= 500) {
      $('#sidebar').toggleClass('active-sidebar');
    }
  });
});


</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>





    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    
    <!--skydash-->
    <script src="skydash/vendor.bundle.base.js"></script>
    <script src="skydash/off-canvas.js"></script>
    <script src="skydash/hoverable-collapse.js"></script>
    <script src="skydash/template.js"></script>
    <script src="skydash/settings.js"></script>
    <script src="skydash/todolist.js"></script>
    <script src="main.js"></script>
    <script src="bootstrap js/data-table.js"></script>
    

    <script src="vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
</body>
</html>