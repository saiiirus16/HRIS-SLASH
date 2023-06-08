
<?php
  session_start();
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
    <title>HRIS | Schedule</title>
</head>
<body>
    <header>
        <?php include("header.php")?>
    </header>

    <style>
    html{
        background-color: #f4f4f4 !important;
    }
    

    body{
        overflow: hidden;
        background-color: #f4f4f4;
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

    
    
    #order-listing_next{
        margin-right: 28px !important;
        margin-bottom: -16px !important;

    }

    @media(max-width: 1350px){
        html{
            background-color: #f4f4f4 !important;
            
        }
        body{
            background-color: #f4f4f4 !important;
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

        .empList-container{
            width: 980px !important;
            margin-right: -28px !important;
        }


        .empList-title h1{
            font-size: 33px !important;
            margin-left: 30px !important; 
            
        }

        .empList-title button{
            width: 160px !important;
           
        }

        .empList-title button a{
            font-size: 16px !important;
        }
       
        .empList-create-search{
            width: 100% !important;
        }

        .empList-create-search select{
            width: 210px !important;
            padding: 5px !important;
        }

        .empList-create-search label{
            font-size: 16px !important;
            margin-right: 20px !important;
        }

        .empList-create-search button{
            margin-bottom: 20px !important;
        }

        .pagination{
        margin-right: 79px !important;
       }
       
    }


    @media(max-width: 500px){

html{
    overflow-x: hidden !important;
    background-color: white !important;
    
    
}
body{
    overflow-y: hidden !important;
    background-color: #f4f4f4 !important;
    width: 500px !important;
    height: 1200px !important;
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

.empList-container{
    width: 430px !important;
    margin-right: -30px !important;
    height: 1050px !important;
    margin-bottom: -230px !important;
}

.empList-title{
  
}

.empList-title h1{
    font-size: 28px !important;
    margin-left: 20px !important;
    color: #C37700 !important;
}

.empList-title button{
    width: 120px !important;
    margin-right: 20px !important;
}

.empList-title button a{
    font-size: 14px !important;
}

.empList-create-search{
    margin-left: 0px !important;
    padding: 10px !important;
    width: 100% !important;
    height: 250px !important;
    display: flex;
    flex-direction: column !important;
    align-items: center !important;
    margin-top: 10px !important; 
    
}


.empList-create-search select{
    width: 220px !important;
}


.empList-create-search div:nth-child(1){
    margin-left: 30px !important;
    width: 100% !important;
}


.empList-create-search div:nth-child(2){
    margin-left: 30px !important;
    width: 100% !important;
}


.empList-create-search div:nth-child(2) label{
    margin-right: 34px !important;
}

.empList-create-search button{
    margin-left: 90px !important;
}

.table-responsive{
    margin-top: -20px !important;
}
thead th:nth-child(1){
        width: 120px !important;
       }

       tr td:nth-child(1){
        width: 125px !important;
       }

       thead th:nth-child(2){
        width: 85px !important;
       }

       tr td:nth-child(2){
        width: 88px !important;
       }

       thead th:nth-child(3){
        width: 85px !important;
       }

       tr td:nth-child(3){
        width: 85px !important;
       }

       thead th:nth-child(4){
        width: 85px !important;
       }

       tr td:nth-child(4){
        width: 93px !important;
       }

       thead th:nth-child(5){
        width: 85px !important;
       }

       tr td:nth-child(5){
        width: 88px !important;
       }

       thead th:nth-child(6){
        width: 95px !important;
       }

       tr td:nth-child(6){
        width: 90px !important;
       }

       thead th:nth-child(7){
        width: 85px !important;
       }

       tr td:nth-child(7){
        width: 100px !important;
       }

       thead th:nth-child(8){
        width: 75px !important;
       }

       tr td:nth-child(8){
        width: 75px !important;
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



}   


    @media(max-width: 500px){

html{
    overflow-x: hidden !important;
    background-color: white !important;
    
    
}
body{
    overflow-y: hidden !important;
    background-color: #f4f4f4 !important;
    width: 500px !important;
    height: 1200px !important;
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

.empList-container{
    width: 430px !important;
    margin-right: -30px !important;
    height: 1050px !important;
    margin-bottom: -230px !important;
}

.empList-title{
  
}

.empList-title h1{
    font-size: 28px !important;
    margin-left: 20px !important;
    color: #C37700 !important;
}

.empList-title button{
    width: 120px !important;
    margin-right: 20px !important;
}

.empList-title button a{
    font-size: 14px !important;
}

.empList-create-search{
    margin-left: 0px !important;
    padding: 10px !important;
    width: 100% !important;
    height: 250px !important;
    display: flex;
    flex-direction: column !important;
    align-items: center !important;
    margin-top: 10px !important; 
    
}


.empList-create-search select{
    width: 220px !important;
}


.empList-create-search div:nth-child(1){
    margin-left: 30px !important;
    width: 100% !important;
}


.empList-create-search div:nth-child(2){
    margin-left: 30px !important;
    width: 100% !important;
}


.empList-create-search div:nth-child(2) label{
    margin-right: 34px !important;
}

.empList-create-search button{
    margin-left: 90px !important;
}

.table-responsive{
    margin-top: -20px !important;
}
thead th:nth-child(1){
        width: 120px !important;
       }

       tr td:nth-child(1){
        width: 125px !important;
       }

       thead th:nth-child(2){
        width: 85px !important;
       }

       tr td:nth-child(2){
        width: 88px !important;
       }

       thead th:nth-child(3){
        width: 85px !important;
       }

       tr td:nth-child(3){
        width: 85px !important;
       }

       thead th:nth-child(4){
        width: 85px !important;
       }

       tr td:nth-child(4){
        width: 93px !important;
       }

       thead th:nth-child(5){
        width: 85px !important;
       }

       tr td:nth-child(5){
        width: 88px !important;
       }

       thead th:nth-child(6){
        width: 95px !important;
       }

       tr td:nth-child(6){
        width: 90px !important;
       }

       thead th:nth-child(7){
        width: 85px !important;
       }

       tr td:nth-child(7){
        width: 100px !important;
       }

       thead th:nth-child(8){
        width: 75px !important;
       }

       tr td:nth-child(8){
        width: 75px !important;
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
    height: 1230px !important;
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

.empList-container{
    width: 330px !important;
    margin-right: -30px !important;
    height: 1080px !important;
    margin-bottom: -340px !important;
}

.empList-title{
  
}

.empList-title h1{
    font-size: 20px !important;
    margin-left: 20px !important;
    color: #C37700 !important;
}

.empList-title button{
    width: 100px !important;
    margin-right: 30px !important;
    height: 40px !important;
}

.empList-title button a{
    font-size: 12px !important;
    display: flex !important;
    align-items: center !important;
}

.empList-create-search{
    margin-left: 0px !important;
    padding: 10px !important;
    width: 100% !important;
    height: 300px !important;
    display: flex;
    flex-direction: column !important;
    align-items: center !important;
    margin-top: 10px !important; 
    
    
}


.empList-create-search select{
    width: 280px !important;
    font-size: 14px !important;
}

.empList-create-search label{
    font-size: 15px !important;
}

.empList-create-search div:nth-child(1){
    margin-left: 30px !important;
    width: 100% !important;
    
}


.empList-create-search div:nth-child(2){
    margin-left: 30px !important;
    width: 100% !important;
}


.empList-create-search div:nth-child(2) label{
    margin-right: 34px !important;
    font-size: 15px !important;
}

.empList-create-search button{
    margin-left: 90px !important;
    width: 75px !important;
    height: 40px !important;
   
}

.table-responsive{
    margin-top: -20px !important;
}
thead th:nth-child(1){
        width: 120px !important;
       }

       tr td:nth-child(1){
        width: 125px !important;
       }

       thead th:nth-child(2){
        width: 85px !important;
       }

       tr td:nth-child(2){
        width: 88px !important;
       }

       thead th:nth-child(3){
        width: 85px !important;
       }

       tr td:nth-child(3){
        width: 85px !important;
       }

       thead th:nth-child(4){
        width: 85px !important;
       }

       tr td:nth-child(4){
        width: 93px !important;
       }

       thead th:nth-child(5){
        width: 85px !important;
       }

       tr td:nth-child(5){
        width: 88px !important;
       }

       thead th:nth-child(6){
        width: 95px !important;
       }

       tr td:nth-child(6){
        width: 90px !important;
       }

       thead th:nth-child(7){
        width: 85px !important;
       }

       tr td:nth-child(7){
        width: 100px !important;
       }

       thead th:nth-child(8){
        width: 75px !important;
       }

       tr td:nth-child(8){
        width: 75px !important;
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



}   



</style>



    <div class="modal fade" id="schedUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="title">Update Schedule</h1>
                </div>
                    <form action="Data Controller/Schedules/empSchedule.php" method="POST">
                        <div class="modal-body">
                            
                            <div class="mb-3" >
                                <?php  
                                    $conn =mysqli_connect("localhost", "root", "" , "hris_db");
                                    $stmt = "SELECT * FROM employee_tb
                                            AS emp
                                            INNER JOIN empschedule_tb
                                            AS esched
                                            ON(emp.empid = esched.empid)  LIMIT 1";
                                    $result = $conn->query($stmt);
                                        if($result->num_rows > 0){
                                            while($row = $result->fetch_assoc()){
                                                echo "<input type='text' id='empName' style='border:none; font-size: 20px; font-weight: 500; margin: auto;' >";
                                            }
                                        }
                                ?>

                                <input type="hidden" class="form-control" name="empid" id="empid" readonly>
                            </div>
                            <div class="mb-3 mt-4 form-group">
                                <?php
                                    $server = "localhost";
                                    $user = "root";
                                    $pass ="";
                                    $database = "hris_db";

                                    $conn = mysqli_connect($server, $user, $pass, $database);
                                    $sql = "SELECT schedule_name FROM schedule_tb";
                                    $result = mysqli_query($conn, $sql);

                                    $options = "";
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $options .= "<option style='color:black;' value='".$row['schedule_name']."'>" .$row['schedule_name']."</option>";
                                        }
                                ?>
                                <label for="schedule_name">Schedule Type</label><br>
                                <select name="schedule_name" class="form-control" id="">
                               
                                    <?php echo $options; ?>
                                </select>
                            </div>
                            <div class="mb-3" class="form-group">
                                
                                <label for="sched_from">From</label>
                                <input type="date" name="sched_from" id="sched_from" class="form-control" onchange="datevalidate()" min="<?php echo date('Y-m-d'); ?>">
                                <div id="sched_from_error" class="text-danger"></div>

                                <label for="sched_from" class="mt-3">To</label>
                                <input type="date" name="sched_to" id="sched_to" class="form-control"  onchange="datevalidate()">
                                <div id="sched_to_error" class="text-danger"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border: none; background-color: inherit;">Close</button>
                                <button type="submit" class="btn btn-primary" id="submit-btn" style="background-color: black; border: none;"> Update </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>


    <div class="empList-container" id="schedule-list-container" style="background-color: white;">
        <div class="empList-title">
            <h1>Schedules</h1>
            <button class="btn btn-primary" style="background-color: black; border-radius: 14px; height: 50px;"><a href="scheduleForm.php"> Schedule List</a></button>
        </div>
        <div class="empList-create-search">
            <!-- <a href="#" class="empList-btn">Create New</a>         -->
                <div>
                    <?php
                       include('config.php');
                       
                        $sql = "SELECT * FROM dept_tb";
                        $result = mysqli_query($conn, $sql);

                        $options = "";
                        while ($row = mysqli_fetch_assoc($result)) {
                            $options .= "<option >" .$row['col_deptname'].  "</option>";
                        }
                        ?>

                                
                        <label for="depatment">Select Department</label>
                        <select name="department" id="" style="padding: 10px;">
                        <option value disabled selected>Select Department</option>
                            <?php echo $options; ?>
                        </select>      
                </div>
                <div>
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

                        <label for="emp">Select Employee</label>
                        <select name="empname" id="" style="padding: 10px;">
                            <option value disabled selected>Select Employee</option>
                            <?php echo $options; ?>
                        </select>
                </div>
                <button class="btn btn-primary" style="background-color: black; border:none; width: 100px; margin-right: 75px; margin-top: 20px;">Go</button>
        </div>

        <style>
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
                max-height: 450px;
                height: 450px;
                
                
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
        </style>
        
        <div class="table-responsive" id="table-responsiveness" style="width: 95%; margin:auto; margin-top: 30px;">
        <table id="order-listing" class="table table-responsive" style="width: 100%;">
                <thead>
                    <th>Employee</th>
                    <th>Time Entry</th>
                    <th>Time Out</th>
                    <th>Rest Day(s)</th>
                    <th>Work Setup</th>
                    <th>From(Date)</th>
                    <th>To(Date)</th>
                    <th>Action</th>
                    <th style="display: none;">Action</th>
                </thead>
                <tbody>

                <?php
                        $conn = mysqli_connect("localhost", "root", "" , "hris_db");
                        $stmt = "SELECT * FROM employee_tb AS emp
                            INNER JOIN empschedule_tb AS esched ON esched.empid = emp.empid
                            INNER JOIN schedule_tb AS sched ON sched.schedule_name = esched.schedule_name";
                        $result = $conn->query($stmt);

                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo "
                                <tr class='lh-1'>
                                <td style='font-weight: 400;'>".$row["fname"]. " ".$row["lname"]."</td>
                                <td style='font-weight: 400;'>9:00 AM</td>
                                <td style='font-weight: 400;'>6:00 PM</td>
                                <td style='font-weight: 400;'>".$row["restday"]. "</td>
                                <td style='font-weight: 400;'>".$row["schedule_name"]. "</td>
                                <td style='font-weight: 400;'>".$row["sched_from"]. "</td>
                                <td style='font-weight: 400;'>".$row["sched_to"]. "</td>
                                 <td>
                                 <button type='button' data-bs-toggle='modal' data-bs-target='#schedUpdate' id='sched-update' class='sched-update' style='border:none; background-color:inherit; color:cornflowerblue; outline:none; '>Update</button></td>
                                <td style='display: none;'>".$row['empid']. " </td
                            </tr>";
                            }
                        }
                    ?>
                </tbody>
        </table>
        </div>
    </div>

    <!-- <form action="">
    <div class="schedules-modal-update" id="schedules-modal-update">
        <div class="sched-container">
            <div class="sched-content">
                <div class="schedmodal-title">
                <h1>Update Schedule</h1>
                <div></div>
                </div>
                <div class="schedmodal-emp">
                    
                      <?php  
                        $conn =mysqli_connect("localhost", "root", "" , "hris_db");
                        $stmt = "SELECT * FROM employee_tb
                                AS emp
                                INNER JOIN empschedule_tb
                                AS esched
                                ON(emp.empid = esched.empid)  LIMIT 1";
                                $result = $conn->query($stmt);
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                                        echo "<h1>".$row["fname"].""." ". "" .$row["lname"]."</h1>";
                                    }
                                }
                        ?>
                
                </div>
                <div class="schedule-type-update">
                <?php
                    $server = "localhost";
                    $user = "root";
                    $pass ="";
                    $database = "hris_db";

                    $conn = mysqli_connect($server, $user, $pass, $database);
                    $sql = "SELECT schedule_name FROM schedule_tb";
                    $result = mysqli_query($conn, $sql);

                    $options = "";
                        while ($row = mysqli_fetch_assoc($result)) {
                            $options .= "<option value=' ". $row['schedule_name'] . "'>" .$row['schedule_name']."</option>";
                        }
                        ?>

                    <label for="schedule_name">Schedule Type</label><br>
                    <select name="schedule_name" id="">
                        <option value disabled selected>Select Schedule Type</option>
                        <?php echo $options; ?>
                    </select>
                </div>
                <div class="sched-update-date">
                <label for="sched_from">From</label>
                <input type="date" name="" id="">

                <label for="sched_from">To</label>
                <input type="date" name="" id="">
                <div>
                
                <div class="sched-update-btn">
                <button value="Cancel" id="sched-update-close" class="sched-update-close">Close</button>
                <button value="" type="submit">Submit</button>
                </div>
                
            </div>
        </div>
    </div>
    </form> -->
    
    <script>
function populateDateFields(row) {
    var startDate = row.getElementsByTagName('td')[5].innerHTML;
    var endDate = row.getElementsByTagName('td')[6].innerHTML;

    document.getElementById('sched_from').value = startDate;
    document.getElementById('sched_to').value = endDate;
}

var updateButtons = document.getElementsByClassName('sched-update');
for (var i = 0; i < updateButtons.length; i++) {
    updateButtons[i].addEventListener('click', function() {
        var row = this.closest('tr');
        populateDateFields(row);
    });
}

function datevalidate() {
    var startDateInput = document.getElementById('sched_from');
    var endDateInput = document.getElementById('sched_to');
    var startDate = new Date(startDateInput.value);
    var endDate = new Date(endDateInput.value);
    var today = new Date();
    today.setHours(0, 0, 0, 0); // Reset time to midnight for comparison

    var startError = document.getElementById('sched_from_error');
    var endError = document.getElementById('sched_to_error');
    var submitBtn = document.getElementById('submit-btn');

    if (startDate < today) {
        startError.innerHTML = "Start Date must be today or a future date.";
    } else {
        startError.innerHTML = "";
    }

    if (endDate < startDate) {
        endError.innerHTML = "End Date must be equal to or greater than Start Date.";
    } else {
        endError.innerHTML = "";
    }

    if (startError.innerHTML !== "" || endError.innerHTML !== "") {
        submitBtn.disabled = true;
    } else {
        submitBtn.disabled = false;
    }
}
</script>

  

<script>
// sched form modal

let Modal = document.getElementById('schedules-modal-update');

//get open modal
let modalBtn = document.getElementById('sched-update');

//get close button modal
let closeModal = document.getElementsByClassName('sched-update-close')[0];

//event listener
modalBtn.addEventListener('click', openModal);
closeModal.addEventListener('click', exitModal);
window.addEventListener('click', clickOutside);

//functions
function openModal(){
    Modal.style.display ='block';
}

function exitModal(){
    Modal.style.display ='none';
}

function clickOutside(e){
    if(e.target == Modal){
        Modal.style.display ='none';    
    }
}
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
      $('#schedule-list-container').addClass('move-content');
    } else {
      $('#schedule-list-container').removeClass('move-content');

      // Add class for transition
      $('#schedule-list-container').addClass('move-content-transition');
      // Wait for transition to complete before removing the class
      setTimeout(function() {
        $('#schedule-list-container').removeClass('move-content-transition');
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

<script> 
        $(document).ready(function(){
                $('.sched-update').on('click', function(){
                                    $('#schedUpdate').modal('show');
                                    $tr = $(this).closest('tr');

                                    var data = $tr.children("td").map(function () {
                                        return $(this).text();
                                    }).get();

                                    console.log(data);
                                    //id_colId
                                    $('#empid').val(data[8]);
                                    $('#sched_from').val(data[5]);
                                    $('#sched_to').val(data[6]);
                                    $('#empName').val(data[0]);
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
</body>
</html>