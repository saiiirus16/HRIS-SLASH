
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">


</head>
<body>
    <!-- UPPER NAV -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row custom-navbar" id="upper-nav"> <!-- UPPER NAV MOTHER -->
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start" id="logo-upper-nav" >
        <a class="navbar-brand brand-logo me-5" href="dashboard.php" ><img src="img/Slash Tech Solutions.png" class="me-2" alt="logo" style="margin-left: 25px;"/></a>
        <a class="navbar-brand brand-logo-mini" href="dashboard.php" style="width: 100px;"><img src="img/header-logo-small.jpg" alt="logo" style="width: 100px; " /></a>
      </div>
      
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end" id="upper-nav-container" >
        <button class="navbar-toggler navbar-toggler align-self-center" id="navbar-toggler" type="button" data-toggle="minimize">
            <span class="fa-solid fa-bars" style="color:white;"></span>
          </button> 
          <button id="sidebarToggle" class="responsive-bars-btn">
            <span class="fa-solid fa-bars" style="color:white;"></span>
          </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          
        <div class="header-user">
                <div class="header-notif">
                    <span class="fa-regular fa-bell" style="color: white;"></span>
                </div>
                <div class="header-head">
                    <img src="img/user.jpg" alt="" srcset="">
                </div>
                <div class="header-type">
                    <h1 style="color: white;margin-top: 15px; margin-bottom: 20px;"><?php if(empty($_SESSION['role'])){
                                echo "no user!";
                            }else{
                                echo $_SESSION['role'];
                            }
                            ?></h1>
                    <p class="user-name" style="color: white; margin-top: 10px;"><?php if(empty($_SESSION['username'])){
                                echo "";
                            }else{
                                echo $_SESSION['username'];
                            }
                            ?></p>
                </div>
                <div class="header-dropdown" >
                    <button class="header-dropdown-btn" style="color: white"><span class="fa-solid fa-chevron-down"></span></button>
                    <div class="header-dropdown-menu" style="background-color: #000">
                        <a href="logout.php" class="header-dd-btn" style="text-decoration: none;color: white">Logout</a>
                        <a href="#" style="text-decoration:none; color: white">User Profile</a>
                    </div>
                </div>
            </div>
          <!-- <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
              <img src="../../../../images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li> -->
        </ul>
        <!-- <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button> -->
      </div>
    </nav> <!-- END UPPER NAV -->
    
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        
      </div>
      <div id="right-sidebar" class="settings-panel">
        
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              
                <div class="form-group d-flex">
                  
                </div>
             
            </div>
            <div class="list-wrapper px-3">
              
            </div>
           
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                
              </div>
             
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                
              </div>
          
            </div>
          </div>
       
        </div>
      </div>

<!-- sidebar -->      
<nav class="sidebar sidebar-offcanvas custom-nav" id="sidebar" style="margin-top: 20px; position:fixed;">
        <ul class="nav" style="margin-top: 50px; color:red;">
          <li class="nav-item" style="color: black">
            <a class="nav-link" href="dashboard.php" style="color: white;">
              <i class="icon-grid fa-solid fa-tv" style=""></i>
              <span class="nav-title" style="font-size: 21px; margin-left: 15px; font-family: Arial, sans-serif; font-weight: 500">DASHBOARD</span>
            </a>
          </li>

          <li class="nav-item" style="color: black">
            <a class="nav-link" href="attendance_visor.php" style="color: white;">
              <i class="icon-grid fa-solid fa-tv" style=""></i>
              <span class="nav-title" style="font-size: 21px; margin-left: 15px; font-family: Arial, sans-serif; font-weight: 500">ATTENDANCE</span>
            </a>
          </li>
        
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-payroll" aria-expanded="false" aria-controls="ui-payroll" style="margin-top: 5px; color:white">
              <i class="fa-regular fa-credit-card" ></i>
              <span class="nav-title"  style="font-size: 21px; margin-left: 15px; font-family: Arial, sans-serif; font-weight: 400; height: 35px" >REQUEST</span>
              <i class="menu-arrow" style="color: white"></i>
            </a>
            <div class="collapse" id="ui-payroll">
              <ul class="nav flex-column sub-menu" style=" width: 100%;">
                <li class="nav-item"> <a class="nav-link" href="overtime_req.php">OVERTIME REQUEST</a></li>
                <li class="nav-item"> <a class="nav-link" href="undertime_req.php">UNDERTIME REQUEST</a></li>
                <li class="nav-item"> <a class="nav-link" href="leaveReq.php">LEAVE REQUEST</a></li>
                <li class="nav-item"> <a class="nav-link" href="wfh_request.php">WFH REQUEST</a></li>
              </ul>
            </div>
          </li>

         
          <li class="nav-item" style="color: black">
            <a class="nav-link" href="employee_list.php" style="color: white;">
              <i class="icon-grid fa-solid fa-tv" style=""></i>
              <span class="nav-title" style="font-size: 21px; margin-left: 15px; font-family: Arial, sans-serif; font-weight: 500">EMPLOYEES</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-reports" aria-expanded="false" aria-controls="ui-reports" style="margin-top: 5px; color:white">
              <i class="fa-regular fa-clipboard"></i>
              <span class="nav-title"  style="font-size: 21px; margin-left: 15px; font-family: Arial, sans-serif; font-weight: 400; height: 35px" >REPORTS</span>
              <i class="menu-arrow" style="color: white"></i>
            </a>
            <div class="collapse" id="ui-reports">
              <ul class="nav flex-column sub-menu" style=" width: 100%;">
                <li class="nav-item"> <a class="nav-link" href="attendance_report.php">ATTENDANCE</a></li>
                <li class="nav-item"> <a class="nav-link" href="payroll_report.php">PERFROMANCE</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-develop" aria-expanded="false" aria-controls="ui-develop" style="margin-top: 5px; color:white"  >
              <i class="fa-regular fa-lightbulb"></i>
              <span class="nav-title"  style="font-size: 21px; margin-left: 15px; font-family: Arial, sans-serif; font-weight: 400; height: 35px" >PERFROMANCE</span>
              <i class="menu-arrow" style="color: white"></i>
            </a>
            <div class="collapse" id="ui-develop">
              <ul class="nav flex-column sub-menu" style=" width: 100%;">
                <li class="nav-item" style="color: white"> <a class="nav-link" href="#">TRAINING PROGRAM</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-perf" aria-expanded="false" aria-controls="ui-perf" style="margin-top: 5px; color:white">
              <i class="fa-solid fa-person-running"></i>
              <span class="nav-title"  style="font-size: 21px; margin-left: 15px; font-family: Arial, sans-serif; font-weight: 400; height: 35px" >MANPOWER</span>
              <i class="menu-arrow" style="color: white"></i>
            </a>
            <div class="collapse" id="ui-perf">
              <ul class="nav flex-column sub-menu" style=" width: 100%;">
                <li class="nav-item"> <a class="nav-link" href="#">EVALUATION</a></li>
                <li class="nav-item"> <a class="nav-link" href="#">PERFORMANCE RATE</a></li>
              </ul>
            </div>
          </li>

          

        </ul>
      </nav>

 
</body>
</html>