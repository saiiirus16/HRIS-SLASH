
<?php
    session_start();
    if(isset($_SESSION['alert_msg'])){
        $alert_msg = $_SESSION['alert_msg'];
        echo "<script>alert('$alert_msg');</script>";
        unset($_SESSION['alert_msg']);
    }

    
    if(!isset($_SESSION['username'])){
        header("Location: login.php"); 
    } else {
        // Check if the user's role is not "admin"
        if($_SESSION['role'] != 'admin'){
            // If the user's role is not "admin", log them out and redirect to the logout page
            session_unset();
            session_destroy();
            header("Location: logout.php");
            exit();
        }
    }

 
    $server = "localhost";
    $user = "root";
    $pass ="";
    $database = "hris_db";

    $db = mysqli_connect($server, $user, $pass, $database);


    if(!empty($_GET['status'])){
        switch($_GET['status']){
            case 'succ':
                $statusType = 'alert-success';
                $statusMsg = 'Members data has been imported successfully.';
                break;
            case 'err':
                $statusType = 'alert-danger';
                $statusMsg = 'Some problem occurred, please try again.';
                break;
            case 'invalid_file':
                $statusType = 'alert-danger';
                $statusMsg = 'Please upload a valid CSV file.';
                break;
            default:
                $statusType = '';
                $statusMsg = '';
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">

        <!-- skydash -->

    <link rel="stylesheet" href="skydash/feather.css">
    <link rel="stylesheet" href="skydash/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="skydash/vendor.bundle.base.css">

    <link rel="stylesheet" href="skydash/style.css">

    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
   

    <link rel="stylesheet" href="css/try.css">
    <link rel="stylesheet" href="css/styles.css">
    
   
    
    
    <title>HRIS | Employee List</title>
</head>
<script>
      // Function to display the current date in the specified format
      function displayCurrentDate() {
        // Get the current date
        const today = new Date();

        // Define the date format as "MM/DD/YYYY"
        const dateFormat = `${today.getMonth() + 1}/${today.getDate()}/${today.getFullYear()}`;

        // Update the content of the h1 element with the current date
        document.getElementById("current-date").innerHTML = `Today's date is <strong style=" color: #C37700">${dateFormat}</strong>`;
      }
    </script>


<body onload="displayCurrentDate()">

<header>
        <?php include("header.php")?>
    </header>

<style>
    body{
        overflow: hidden;
        background-color: #f4f4f4;
    }

    .email-col {
        width: 25% !important; /* adjust the width as needed */
    }
    #order-listing th.email-col,
    #order-listing td.email-col {
        text-align: left; /* optional, aligns text to the left */
    }
    
    html{
        background-color: #fff !important;
    }

    .pagination{
        margin-right: 63px !important;
        
    }

    .pagination li a{
        color: #c37700;
    }

        .page-item.active .page-link, .jsgrid .jsgrid-pager .active.jsgrid-pager-nav-button .page-link, .jsgrid .jsgrid-pager .active.jsgrid-pager-page .page-link, .page-item.active .jsgrid .jsgrid-pager .jsgrid-pager-nav-button a, .jsgrid .jsgrid-pager .jsgrid-pager-nav-button .page-item.active a, .jsgrid .jsgrid-pager .active.jsgrid-pager-nav-button a, .page-item.active .jsgrid .jsgrid-pager .jsgrid-pager-page a, .jsgrid .jsgrid-pager .jsgrid-pager-page .page-item.active a, .jsgrid .jsgrid-pager .active.jsgrid-pager-page a {
        z-index: 3;
        color: #C37700;
        background-color: #000;
        border-color: #000;
    }

    
    
    #order-listing_next{
        margin-right:14px !important;
        margin-bottom: -16px !important;

    }

    @media(max-width: 1350px){
        html{
            background-color: #fff !important;
            
        }
        
        .header-user{
           
            margin-right: 10px !important;
            width: 400px !important;
        }

        .header-notif{
            margin-right: 30px !important;
        }
        .header-head{
            margin-right: 25px !important;
        }


       .attendace-container{
        background-color: #fff !important;
        width: 970px !important;
        margin-right: -25px !important;
        transition: ease-in-out 1s !important;
       }

       .attendance-input{
        
        width: 95%;
        margin: auto !important;
       }

       .attendance-input select{
        width: 200px !important;
       }

       .attendance-input input{
        width: 200px !important;
       }

       .att-emp{
        
        width: 350px;
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between;
       }

       .att-emp label{
        font-size: 14px;
       }

       .att-emp select{
        margin-right: 30px;
        background-color: #fff !important;
       }

       .att-stat{
        
        width: 350px;
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between;
       }

       .att-stat label{
        font-size: 14px;
       }

       .att-stat select{
        margin-right: 30px;
        background-color: #fff !important;
       }

       .att-range{
       
        width: 350px;
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between;
       }

       .att-rang label{
        font-size: 14px;
       }

       .att-range input{
        margin-right: 30px;
        background-color: #fff !important;
       }

       .att-end{
       
        width: 350px;
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between;
       }

       .att-end label{
        font-size: 14px;
       }

       .att-end input{
        margin-right: 30px;
        background-color: #fff !important;
       }

       .att-excel-input{
        margin-top: 0px !important;
        
        width: 300px !important;
        margin-right: -83px !important;
       }

       .att-excel-input input{
        width: 300px !important;
       }

       .att-excel-input input:nth-child(2){
        margin-top: 20px !important;
        width: 100px !important;
        margin-left: 50px !important;
       }

       #table-responsiveness{
        width: 95% !important;
       }

       thead th:nth-child(1){
        width: 70px !important;
       }

       tr td:nth-child(1){
        width: 70px !important;
       }

       thead th:nth-child(2){
        width: 85px !important;
       }

       tr td:nth-child(2){
        width: 85px !important;
       }

       thead th:nth-child(3){
        width: 120px !important;
       }

       tr td:nth-child(3){
        width: 120px !important;
       }

       thead th:nth-child(4){
        width: 70px !important;
       }

       tr td:nth-child(4){
        width: 85px !important;
       }

       thead th:nth-child(5){
        width: 85px !important;
       }

       tr td:nth-child(5){
        width: 85px !important;
       }

       thead th:nth-child(6){
        width: 85px !important;
       }

       tr td:nth-child(6){
        width: 85px !important;
       }

       thead th:nth-child(7){
        width: 85px !important;
       }

       tr td:nth-child(7){
        width: 100px !important;
       }

       thead th:nth-child(8){
        width: 85px !important;
       }

       tr td:nth-child(8){
        width: 85px !important;
       }

       thead th:nth-child(9){
        width: 85px !important;
       }

       tr td:nth-child(9){
        width: 95px !important;
       }

       thead th:nth-child(10){
        width: 85px !important;
       }

       tr td:nth-child(10){
        width: 85px !important;
       }

       thead th:nth-child(11){
        width: 85px !important;
       }

       tr td:nth-child(11){
        width: 85px !important;
       }
       thead th:nth-child(12){
        width: 85px !important;
       }

       tr td:nth-child(12){
        width: 85px !important;
       }
       .pagination{
        margin-right: 65px !important;
       }

       #table-responsiveness{
        overflow-y: hidden !important;
       }
       .show{
            display: none !important;
        }
    }

@media(max-width: 500px){

html{
    overflow-x: hidden !important;
    background-color: white !important;
    
    
}
body{
    overflow-y: hidden !important;
    background-color: #fff !important;
    width: 500px !important;
    height: 1350px !important;
}
#upper-nav{
    background-color: black !important; 
    width: 500px !important;
    height: 75px;
    position: fixed !important;
}

.navbar-menu-wrapper{
    background-color: black !important;
    width: 390px !important;
    height: 60px !important;
    position: fixed !important;
   
    margin-left: 70px !important;
    
    
}

.navbar-brand-wrapper{
    background-color: black !important;
    position: absolute !important;
    width: 100px !important;
    box-shadow: none;
    height: 60px !important;
    z-index: 100;
}

.navbar-brand-wrapper img{
    height: 40px !important;
    width: 50px !important;
    margin-left: -20px !important;
}

.sidebar{
    position: fixed !important;
    left: 0;
    width: 85px;
    margin-top: 0 !important;
    height: 130vh !important;
    display: none !important;
    transition: ease-in-out 1s !important;
    
}

#sidebar.active-sidebar {
display: block !important;
} 


.navbar-toggler{
    display: none !important;
}

.responsive-bars-btn{
    display: block !important;
    margin-right: 105px !important;
    border: none !important;
    background-color: black !important;
    
}

.responsive-bars-btn span{
    color: white !important;
    font-size: 18px !important;
}

.header-user{
   width: 200px !important;
   transition: ease-in-out 1s;
   background-color: black !important;
   margin-right: 25px !important;
   
}
.header-notif span{
    font-size: 20px !important;
    margin-right: -10px;
    margin-left: 30px !important;
}
.header-head img{
    height: 40px !important;
}
.header-type h1{    
    font-size: 19px !important;
}
.header-type p{
    font-size: 14px !important;
    margin-top: -25px !important;
}
.header-dropdown{
    margin-left: 30px !important;
}
.header-dropdown-menu{
    width: 130px !important;
    margin-left: -55px !important;
   
}

.nav-title,.menu-arrow{
    display: none !important;
}

.nav-item{
    margin-bottom: 15px !important;
}

.collapse{
    width: 250px !important;
    position: fixed !important;
    left: 85px !important;
}

#sub-menu{
    display: block !important;
    /* position: absolute !important; */
    z-index: 100;
}

.attendace-container{
    width: 460px !important;
    margin-right: -45px !important;
    height: 1200px !important;
    margin-bottom: -380px !important;
    
}

.attendance-input{
    display: flex !important;
    height: 400px !important;
    flex-direction: column !important;

}

.att-emp-stat-container{
   padding: 10px !important;
}

.attendance-input select{
    width: 300px !important;
}

.attendance-input input{
    width: 300px !important;
}

.att-emp{
   width: 100% !important;

    
}

.att-emp select{
    width: 330px !important;
}

.att-stat{
    width: 100% !important;
}

.att-stat select{
    margin-right: 16px !important;
}

.att-range-container{
    
    display: flex !important;
    flex-direction: column !important;
    width: 100% !important;
    padding: 10px !important;
}

.att-range{

    width: 100% !important;
   
    height: 50px !important;
        
}

.att-range label{
    font-size: 14px !important;
   
   width: 100%;
   padding: 0;
}
.att-range input{
    margin-left: 100px !important;
}

.att-range label span{
    display: flex !important;

    width: 50px !important;
    position: absolute !important;
}


.att-end{
    margin-left: 102px !important;
}

.att-excel-input{
    margin-top: 20px !important;
    width: 100% !important;
    margin-bottom: 20px !important;
    
} 

.att-excel-input form{
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important; 
    
}

.att-excel-input form input:nth-child(1){
    margin-left: 100px !important;
}

.att-excel-input form input:nth-child(2){
    margin-left: -5px !important;
}

.att-date{
    margin-left: 13px !important;
    height: 40px !important;
}

.att-date h1{
    font-size: 20px !important;
}

.pagination {
  display: flex !important;
  position: inherit !important;
  margin-top: 40px !important;
  border: none !important;
  padding: 0; /* Remove default padding */
  width: 100% !important;
}

.pagination li {
  width: 40px !important;
  text-align: center;
  border: none !important;

}

.pagination li a{
    border: none !important;
    
}



.pagination li:nth-child(1) {
  width: 80px !important;
  text-align: center;
  position: absolute !important;
  left: 10px !important;
  border: 1px #ccc !important;
}

.pagination #order-listing_next{
  width: 80px !important;
  text-align: center;
  position: absolute !important;
  margin-right: 0px !important;
  bottom: -4px !important;
  border: 1px #ccc !important;
}

.pagination .paginate_button {
  margin: 0 5px !important;
}

.pagination #order-listing_next {
  margin-inline-start: 10px !important;
}

.att-export-btn{
    margin-left: -20px !important;
}

.att-export-btn a,button{
    font-weight: 500 !important;
}

.att-export-btn p,a,i,span,button{
    font-size: 14px !important;
}

}   





@media(max-width: 390px){

html{
    overflow-x: hidden !important;
    background-color: white !important;
    width:390px !important;
    
    
}
body{
    overflow-y: hidden !important;
    background-color: #fff !important;
    width: 390px !important;
    height: 1350px !important;
}
#upper-nav{
    background-color: black !important; 
    width: 390px !important;
    height: 75px;
    position: fixed !important;
}

.navbar-menu-wrapper{
    background-color: black !important;
    width: 300px !important;
    height: 60px !important;
    position: fixed !important;
   
    margin-left: 80px !important;
    
    
}

.navbar-brand-wrapper{
    background-color: black !important;
    position: absolute !important;
    width: 90px !important;
    box-shadow: none;
    height: 60px !important;
    z-index: 100;
}

.navbar-brand-wrapper img{
    height: 40px !important;
    width: 50px !important;
    margin-left: -20px !important;
}

.sidebar{
    position: fixed !important;
    left: 0;
    width: 85px;
    margin-top: 0 !important;
    height: 130vh !important;
    display: none !important;
    transition: ease-in-out 1s !important;
    
}

#sidebar.active-sidebars {
display: block !important;
} 


.navbar-toggler{
    display: none !important;
}

.responsive-bars-btn{
    display: block !important;
    margin-right: 30px !important;
    border: none !important;
    background-color: black !important;
    
}

.responsive-bars-btn span{
    color: white !important;
    font-size: 18px !important;
}

.header-user{
   width: 200px !important;
   transition: ease-in-out 1s;
   background-color: black !important;
   margin-right: 25px !important;
   
}
.header-notif span{
    font-size: 20px !important;
    margin-right: -10px;
    margin-left: 30px !important;
}
.header-head img{
    height: 40px !important;
}
.header-type h1{    
    font-size: 19px !important;
}
.header-type p{
    font-size: 14px !important;
    margin-top: -25px !important;
}
.header-dropdown{
    margin-left: 30px !important;
}
.header-dropdown-menu{
    width: 130px !important;
    margin-left: -55px !important;
   
}

.nav-title,.menu-arrow{
    display: none !important;
}

.nav-item{
    margin-bottom: 15px !important;
}

.collapse{
    width: 250px !important;
    position: fixed !important;
    left: 85px !important;
}

#sub-menu{
    display: block !important;
    /* position: absolute !important; */
    z-index: 100;
}

.attendace-container{
    width: 360px !important;
    margin-right: -45px !important;
    height: 1200px !important;
    margin-bottom: -455px !important;
    
}

.attendance-input{
    display: flex !important;
    height: 450px !important;
    flex-direction: column !important;

}

.att-emp-stat-container{
   padding: 10px !important;
}

.attendance-input select{
    width: 220px !important;
}

.attendance-input input{
    width: 220px !important;
}

.att-emp{
   width: 100% !important;

    
}

.att-emp select{
    width: 250px !important;
}

.att-stat{
    width: 100% !important;
}

.att-stat select{
    margin-right: 2px !important;
}

.att-range-container{
    
    display: flex !important;
    flex-direction: column !important;
    width: 100% !important;
    padding: 10px !important;
}

.att-range{

    width: 100% !important;
   
    height: 50px !important;
        
}

.att-range label{
    font-size: 14px !important;
   
   width: 100%;
   padding: 0;
}
.att-range input{
    margin-left: 100px !important;
}

.att-range label span{
    display: flex !important;

    width: 50px !important;
    position: absolute !important;
}


.att-end{
    margin-left: 102px !important;
}

.att-excel-input{
    margin-top: 20px !important;
    width: 100% !important;
    margin-bottom: 20px !important;
    
} 

.att-excel-input form{
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important; 
    
}

.att-excel-input form input:nth-child(1){
    margin-left: 50px !important;
    font-size: 13px !important;
}

.att-excel-input form input:nth-child(2){
    margin-left: -5px !important;
    height: 45px !important;
    width: 100px !important;
}

.att-date{
    margin-left: 13px !important;
    height: 40px !important;
}

.att-date h1{
    font-size: 20px !important;
}



.pagination {
  display: flex !important;
  position: inherit !important;
  margin-top: 20px !important;
  border: none !important;
  padding: 0; /* Remove default padding */
  width: 100% !important;
}

.pagination li {
  width: 40px !important;
  text-align: center;
  border: none !important;

}

.pagination li a{
    border: none !important;
    
}



.pagination li:nth-child(1) {
  width: 80px !important;
  text-align: center;
  position: absolute !important;
  left: 10px !important;
  border: 1px #ccc !important;
}

.pagination #order-listing_next{
  width: 80px !important;
  text-align: center;
  position: absolute !important;
  margin-right: 0px !important;
  bottom: -4px !important;
  border: 1px #ccc !important;
}

.pagination .paginate_button {
  margin: 0 5px !important;
}

.pagination #order-listing_next {
  margin-inline-start: 10px !important;
}


.att-export-btn{
    margin-left: -30px !important;
    margin-bottom: -20px !important;
   
}

.att-export-btn a,button{
    font-weight: 500 !important;
}

.att-export-btn p,a,i,span,button{
    font-size: 12px !important;
}

}   


</style>


    <div class="attendace-container" id="attendace-container">
        <div class="attendance-title">
            <h1>Attendance</h1>
        </div>

        <div class="attendance-input">
            <div class="att-emp-stat-container">
                <div class="att-emp">
                <?php
                        $server = "localhost";
                        $user = "root";
                        $pass ="";
                        $database = "hris_db";

                        $conn = mysqli_connect($server, $user, $pass, $database);
                        $sql = "SELECT empid, fname, lname FROM employee_tb";
                        $result = mysqli_query($conn, $sql);

                        $options = "";
                        while ($row = mysqli_fetch_assoc($result)) {
                            $options .= "<option value=' ". $row['empid'] . "'>". $row['empid'] . " ". " - ". " " .$row['fname']. " ".$row['lname']. "</option>";
                        }
                        ?>

                        <label for="emp">Select Employee
                        <select name="empname" id="" class="stat">
                            <option value disabled selected>Select Employee</option>
                            <?php echo $options; ?>
                        </select>
                        </label>
                </div>
              
                <div class="att-stat" >
                    <label for="Employee" >Status
                    <select name="" id="" class="" >
                        <option value="">All Status</option>
                    </select>   
                    </label>
                </div>
                

            </div>

            <div class="att-range-container">
                <div class="att-range">                   
                        <label for="Employee"><span>Date Range</span> 
                        <input type="date" name="" id="" placeholder="Start Date" style="padding:10px; ">
                        </label>
                </div>

                
                <input class="att-end" type="date" name="" id="" placeholder="End Date" style="padding:10px; ">
            </div>

            
                <div class="att-excel-input">   
                    <form action="Data Controller/Attendance/attendanceController.php"  enctype="multipart/form-data" method="POST">
                            <input type="file" name="file" />
                            <input type="submit" value="Submit" name="importSubmit" class="btn btn-primary" style="background-color: black;">
                    </form>
                </div>
          

        </div>

        <div id="att-listing" class="att-date">
            <h1 id="current-date"></h1>
        </div>
        

        <style>
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
                max-height: 320px;
                
                
                
            }
            tbody {
                display: table;
                width: 100%;    
            }
            tr {
                width: 100% !important;
                display: table !important;
                table-layout: fixed !important;
            }
            th, td {
                text-align: left !important;
                width: 14.28% !important;
            }

            .empid-width{
                width: 20% !important;
            }
        </style>
      
        <div class="table-responsive" id="table-responsiveness" style="width: 95%; margin:auto; margin-top: 30px; overflow-y: hidden;">
            <table id="order-listing" class="table table-responsive" style="width: 100%;">
                <thead>
                        <th>Status</th>
                        <th class="empid-width">Employee ID</th>
                        <th class="email-col">Name</th>
                        <th>Date</th>
                        <th>Time in</th>
                        <th>Time out</th>
                        <th>Late</th>
                        <th>Undertime</th>
                        <th>Overtime</th>
                        <th>Total Work</th>
                        <th>Total Rest</th>
                        <th>Remarks</th>                  
                </thead>
             <tbody >
             <?php

            date_default_timezone_set('Asia/Manila');
            $currentMonth = date('m');
             $result = $db->query("SELECT attendances.status, 
             attendances.empid,
             attendances.date,
             attendances.time_in,
             attendances.time_out,
             attendances.late,
             attendances.early_out,
             attendances.overtime,
             attendances.total_work,
             attendances.total_rest, 
             CONCAT(employee_tb.fname, ' ', employee_tb.lname) AS full_name  
         FROM attendances
         INNER JOIN employee_tb ON employee_tb.empid = attendances.empid
         WHERE DATE_FORMAT(attendances.date, '%m') = '$currentMonth'
         ORDER BY attendances.date ASC");

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                ?>
                <tr>
                    <td style="font-weight: 400;"><?php echo $row['status']; ?></td>
                    <td class="empid-width" style="font-weight: 400;"><?php echo $row['empid']?></td>
                    <td class="email-col" style="font-weight: 400;"><?php echo $row['full_name']; ?> </td>
                    <td style="font-weight: 400;"><?php echo $row['date']; ?></td>
                            <!-------- td  for time out ----------->
                    <td 
                        <?php 
                            if ($row['status'] === 'LWOP'){
                                echo 'style="font-weight: 400; text-align: center;"';
                            }
                            else{
                                if($row['time_in'] === '00:00:00')
                                {
                                    echo 'style="color: #FF5D5E;" ';
                                }
                                else
                                {
                                    echo 'style="font-weight: 400;"';
                                }
                                
                            }
                        ?>
                    > <!--close td -->
                        <?php 
                            echo $row['time_in']; 
                        ?>
                    </td>
                            <!-------- td  for time out ----------->
                    <td  
                        <?php 

                            if ($row['status'] === 'LWOP'){
                                echo 'style="font-weight: 400; text-align: center;"';
                            }
                            else{
                                if($row['time_out'] === '00:00:00')
                                {
                                    echo 'style="color: #FF5D5E;" ';
                                }
                                else
                                {
                                    echo 'style="font-weight: 400;"';
                                }
                                
                            }
                           
                        ?>
                    > <!--close td -->
                        <?php 
                            echo $row['time_out']; 
                        ?>
                    </td>
                    
                    <td style="font-weight: 400; color:red;"><?php echo $row['late']; ?></td>
                    <td style="font-weight: 400; color: blue"><?php echo $row['early_out']; ?></td>
                    <td style="font-weight: 400; color: orange;"><?php echo $row['overtime']; ?></td>
                    <td style="font-weight: 400; color:green;"><?php echo $row['total_work']; ?></td>
                    <td style="font-weight: 400; color:gray;"><?php echo $row['total_rest']; ?></td>
                    <td 
                        <?php 
                        if ($row['status'] === 'LWOP'){
                            echo 'style="font-weight: 400; text-align: center;"';
                        }
                        else{
                            if($row['time_in'] === '00:00:00' || $row['time_out'] === '00:00:00')
                            {
                                echo 'style="color: #FF5D5E;  text-align: center;"';
                            } 
                            else{
                                echo 'style="font-weight: 400; text-align: center;"';
                            }
                            
                        }
                            
                            
                        ?> 
                    > <!--close td -->
                        <?php
                            if($row['status'] === 'LWOP'){
                                echo 'N/A';
                            }else{
                                if($row['time_in'] === '00:00:00')
                                {
                                    echo 'NO TIME IN';
                                }
                            else if($row['time_out'] === '00:00:00')
                                {
                                    echo 'NO TIME OUT';
                                }
                            else
                                {
                                    echo 'N/A';
                                }
                            }
                            
                         ?>
                    </td>
                </tr> 
                <?php        
            }
        } else{
            ?>
            <tr>
                <td colspan="12">No attendance found...</td>
            </tr>

        <?php
        }
        ?>
    </tbody>
</table>
    </div>

    <!-- <table id="order-listing">
        <thead>
            <th>hehe</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    haha
                </td>
            </tr>
        </tbody>
    </table> -->

    
        <div class="att-export-btn">
         <p>Export options: <a href="excel-att.php" class="" style="color:green"></i>Excel</a><span> |</span> <button id="btnExport" style="background-color: inherit; border:none; color: red">Export to PDF</button></p>
         
        </div>
   
    </div>
    


    <script>
$(document).ready(function () {
    $("#btnExport").click(function () {
        $.ajax({
            url: "att-pdf.php",
            method: "POST",
            data: {format: 'pdf'},
            success: function(response){
                // Create a blob object from the PDF data returned by the server
                var blob = new Blob([response], {type: 'application/pdf'});
                // Generate a URL for the PDF blob object
                var url = URL.createObjectURL(blob);
                // Create a link element to download the PDF
                var link = document.createElement('a');
                link.href = url;
                link.download = "attendances.pdf";
                // Trigger the click event of the link element to start the download
                link.click();
            },
            error: function(){
                alert('Error generating PDF!');
            }
        });
    });
});
</script>

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
      $('#attendace-container').addClass('move-content');
    } else {
      $('#attendace-container').removeClass('move-content');

      // Add class for transition
      $('#attendace-container').addClass('move-content-transition');
      // Wait for transition to complete before removing the class
      setTimeout(function() {
        $('#attendace-container').removeClass('move-content-transition');
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

<script>
 //HEADER RESPONSIVENESS SCRIPT
 
 
$(document).ready(function() {
  // Toggle the submenu visibility on click (for mobile devices)
  $('.nav-link').on('click', function(e) {
    if ($(window).width() <= 390) {
      e.preventDefault();
      $(this).siblings('.sub-menu').slideToggle();
    }
  });

  // Hamburger button functionality
  $('.responsive-bars-btn').on('click', function() {
    if ($(window).width() <= 390) {
      $('#sidebar').toggleClass('active-sidebars');
    }
  });
});


$(document).ready(function() {
  // Toggle the submenu visibility on click (for mobile devices)
  $('.nav-links').on('click', function(e) {
    if ($(window).width() <= 500) {
      e.preventDefault();
      $(this).siblings('.sub-menu').slideToggle();
    }
  });

  // Hamburger button functionality
  $('.responsive-bars-btn').on('click', function() {
    if ($(window).width() <= 500) {
      $('#sidebar').toggleClass('active-sidebar');
    }
  });
});


</script>





    

    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>

    <script src="vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>

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
 

    <!-- PDF -->
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>



    
</body>
</html>