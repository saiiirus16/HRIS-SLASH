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
            echo "<script> alert('hello'); </script>";
            exit();
        }
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    $sql = "SELECT COUNT(*) AS employee_count FROM employee_tb";
    $result = mysqli_query($conn, $sql);

    if(!$result){
        die("Query Failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    $employee_count = $row["employee_count"];

    mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/ti-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> -->
    <!-- Link to the MDI CSS file -->
    <!-- <link rel="stylesheet" href="https://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css"> -->
    <!-- Import the MDI font files using @font-face -->
    <!-- inject:css -->
    <!-- <link rel="stylesheet" href="bootstrap/vertical-layout-light/style.css"> -->

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
    <link rel="stylesheet" href="css/styles.css">


    <style>
    @font-face {
        font-family: 'Material Design Icons';
        font-style: normal;
        font-weight: 400;
        src: url('https://cdn.materialdesignicons.com/5.4.55/fonts/materialdesignicons-webfont.woff2?v=5.4.55') format('woff2'),
            url('https://cdn.materialdesignicons.com/5.4.55/fonts/materialdesignicons-webfont.woff?v=5.4.55') format('woff');
    }
    </style>
    <title>HRIS | Dashboard</title>
</head>
<body >
    <header>
        <?php include("header.php")?>
    </header>

    <style>
    html{
        background-color: #f4f4f4 !important; 
    }
    body{
        overflow: hidden;
        background-color: #F4F4F4 !important;
    }

    .sidebars ul li{
        list-style: none;
        text-decoration:none;
        width: 287px;
        margin-left:-16px;
        line-height:30px;
       
    }

    .sidebars ul li .hoverable{
        height:55px;
    }

    .sidebars ul{
        height:100%;
    }

    .sidebars .first-ul{
        line-height:60px;
        height:100px;
    }

    .sidebars ul li ul li{
        width: 100%;
    }

    .card-body{
        width: 99.8%;
        box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17);
    }

    .card-header{
        width: 99.8%;
        box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.17);
    }

    
    @media(max-width: 1350px){
        html{
            background-color: #fff !important;
            overflow: scroll;
        }


     .dashboard-content{
        background-color: #fff !important;
     }

     .sidebar{
        background-color: #fff !important;
     }
     /* heder-user*/   
    .header-user{
       width: 400px;
       margin-right: -50px;
       transition: ease-in-out 1s;
    }

    .header-notif{
        margin-right: 30px;
        transition: ease-in-out 1s;
    }
    .header-head{
        margin-right: 25px;
        transition: ease-in-out 1s;
        
    }
    .header-head img{
        height: 50px;
        transition: ease-in-out 1s;
    }
    .header-type h1{
        font-size: 20px;
        transition: ease-in-out 1s;
    }
    .header-type p{
        font-size: 16px;
        transition: ease-in-out 1s;
    }
    .header-dropdown{
        margin-right: 30px;
        transition: ease-in-out 1s;
    }


    .dashboard-content{
        border: none;
        height: 1750px;
        transition: ease-in-out 1s;
    }
    
    .dashboard-contents{
        display:flex;
        flex-direction: column;
        transition: ease-in-out 1s;
    }


    /* first-dash-contents */
    .first-dash-contents{
        display:flex;
        flex-direction: column;
        align-items: center;
        margin-left: 35px;
        transition: ease-in-out 1s;
        
       
        
    }

    .emp-request-list-container{
        margin-top: 50px !important;
        margin-right: 20px !important;
        transition: ease-in-out 1s;
    }

    .employee-status-overview{
        margin-top: 20px !important;
        transition: ease-in-out 1s;
    }



    /*end of first-dash */


    /*second-dash-contents*/
    .second-dash-contents{
        margin: auto;
        display:flex;
        flex-direction: column;
        align-items: center;
        margin-left: 30px;
        transition: ease-in-out 1s;
        width: 93% !important;
    }

    .announcement-container{
        transition: ease-in-out 1s;
        width: 88% !important;
    }

    .event-container{
        margin-top: 30px !important;
        width: 88% !important;
        transition: ease-in-out 1s;
    }

    .event-content{
        width: 100% !important;
        transition: ease-in-out 1s;
    }

    /* end of second dash*/
    
  }
  

  @media(max-width: 500px){

html{
    overflow-x: hidden !important;
    background-color: #f4f4f4 !important;

}
body{
    overflow-y: hidden !important;
    background-color: #f4f4f4 !important;
    width: 500px !important;
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
    margin-right: 90px !important;
    border: none !important;
    
}

.responsive-bars-btn span{
    color: white !important;
    font-size: 18px !important;
}

.header-user{
   width: 290px;
   transition: ease-in-out 1s;
   background-color: black !important;
   
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

.dashboard-content{
    width: 390px;
    
    margin-left: 0px !important;
    margin-top: -20px !important;
}

.dashboard-title{
    background-color: #f4f4f4 !important;
}

.dashboard-title h1{
    margin-left: 20px;
    background-color: #f4f4f4 !important;
}

.dashboard-contents{
    background-color: #f4f4f4 !important;
}

.first-dash-contents{
    width: 500px !important;
    margin: auto !important;
}

.employee-status-overview{
    width: 100% !important;
}

.emp-status-title{
   margin-left: -10px !important;
}

.emp-status-container{
   
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
    align-items: center !important;
    height: 900px !important;
}

.emp-status-container div{
    width: 340px !important;
}

.emp-status-container div:nth-child(1){
    background-color: #000080 !important;
    
}

.emp-status-container div:nth-child(1) input{
color: white;
font-size: 35px !important;
margin-left: 10px !important;
margin-top: -5px !important;
}

.emp-status-container div:nth-child(1) label{
color: white;
margin-left: 10px !important;
font-size: 19px !important;
}   

.emp-status-container div:nth-child(1) p{
color: white;
margin-left: 10px !important;
margin-top: 5px !important; 
font-size: 19px !important;
} 

.emp-status-container div:nth-child(1) span{
    font-size: 19px !important;
    margin-left: 3px !important;
    color: black !important;
}


.emp-status-container div:nth-child(2){
    background-color: #F3797E !important; 
}

.emp-status-container div:nth-child(2) input{
color: white;
font-size: 35px !important;
margin-left: 10px !important;
margin-top: -5px !important;
}

.emp-status-container div:nth-child(2) label{
color: white;
margin-left: 10px !important;
font-size: 19px !important;
}   

.emp-status-container div:nth-child(2) p{
color: white;
margin-left: 10px !important;
margin-top: 5px !important; 
font-size: 19px !important;
} 

.emp-status-container div:nth-child(2) span{
    font-size: 19px !important;
    margin-left: 3px !important;
    color: black !important;
}

.emp-status-container div:nth-child(3){
    background-color: #4747A1 !important;
}

.emp-status-container div:nth-child(3) input{
color: white;
font-size: 35px !important;
margin-left: 10px !important;
margin-top: -5px !important;
}

.emp-status-container div:nth-child(3) label{
color: white;
margin-left: 10px !important;
font-size: 19px !important;
}   

.emp-status-container div:nth-child(3) p{
color: white;
margin-left: 10px !important;
margin-top: 5px !important; 
font-size: 19px !important;
} 

.emp-status-container div:nth-child(3) span{
    font-size: 19px !important;
    color: black !important;
    margin-left: 3px !important;
}

.emp-status-container div:nth-child(4){
    background-color: #7978E9 !important;
}

.emp-status-container div:nth-child(4) input{
color: white;
font-size: 35px !important;
margin-left: 10px !important;
margin-top: -5px !important;
}

.emp-status-container div:nth-child(4) label{
color: white;
margin-left: 10px !important;
font-size: 19px !important;
}   

.emp-status-container div:nth-child(4) p{
color: white;
margin-left: 10px !important;
margin-top: 5px !important; 
font-size: 19px !important;
} 

.emp-status-container div:nth-child(4) .wfh-color{
    font-size: 19px !important;
    margin-left: 3px !important;
    color: black !important;
}

.emp-status-container div:nth-child(5){
    background-color: #98BDFF !important;
}
.emp-status-container div:nth-child(5) input{
color: white;
font-size: 35px !important;
margin-left: 10px !important;
margin-top: -5px !important;
}

.emp-status-container div:nth-child(5) label{
color: white;
margin-left: 10px !important;
font-size: 19px !important;
}   

.emp-status-container div:nth-child(5) p{
color: white;
margin-left: 10px !important;
margin-top: 5px !important; 
font-size: 19px !important;
} 

.emp-status-container div:nth-child(5) span{
    font-size: 19px !important;
    margin-left: 3px !important;
    color: black !important;
}

.emp-request-list-container{
    width: 500px !important;
    
}

.emp-btn-container{
    width: 90% !important;
    margin:auto !important;

}

.emp-request-btn{
    position: relative !important;
    display: flex;
    justify-content: space-between;
   
    width: 95% !important;
    margin:auto !important;
}

/* .emp-request-btn div:nth-child(1){
    margin-left: 20px !important;
} */

.emp-request-btn div:nth-child(1) p{
    font-size: 10px !important;
   
    height: 25px !important;
    width: 25px !important;
}

.emp-request-btn div:nth-child(1) div{
    margin-left: 0px !important;
}

.emp-request-btn div:nth-child(2){
    margin-top: 5px !important;
    margin-left: -3px !important;
}

.emp-request-btn div:nth-child(3){
    margin-top: 5px !important;

}

.emp-request-btn div:nth-child(4){
    margin-top: 5px !important;
    margin-right: 5px !important;
}

.emp-request-btn div button{
    font-size: 13px !important;
}

.emp-request-table{
    width: 90% !important;
    margin-left: 11px !important;
    margin: auto !important;
}

.dash

.dash-responsive-btn{
    margin-top: 16px !important;
    display: block !important;
    margin-right: 40px !important;
}

.request-list-dropdown {
    display: none;
    margin-top: 10px;
    background-color: #f4f4f4 !important;
    position: absolute !important;
    right: -10px !important;
    bottom: -115px !important;
    width: 130px !important;
    border-radius: 7px !important;
    padding: 10px !important;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.2), 0 2px 5px 0 rgba(0, 0, 0, 0.17);
 }

 .request-list-dropdown button{
    font-size: 18px !important;
    font-weight: 500 !important;
 }
 
.emp-request-btn .fa-chevron-down {
    transition: transform 0.3s;
}

.emp-request-btn.active .fa-chevron-down {
    transform: rotate(180deg);
}

.request-table{
   
    margin-left: 10px !important;
    width: 95% !important; 
}

/* second content */
.second-dash-contents{
    display:flex;
    flex-direction: column;
    align-items: center;
    transition: ease-in-out 1s;
    margin:auto !important;
    margin-top: 20px !important;
    
    width: 500px !important;
    
}

.announcement-container{
    
    width: 485px !important;
    margin: auto !important;
    margin-left: 5px !important;
}

.announce-title{
    width: 93% !important;
    margin: auto !important;
    margin-left: 12px !important;
}

.announce-content{
    width: 100% !important;
    margin: auto !important;
    margin-top: 20px !important;
}

.announce-content button{
    font-size: 16px !important;
}

.announce-content h4{
    font-size: 26px !important;
}

.announce-content p{
    font-size: 14px !important;
}

.event-container{
    margin-bottom: 25px !important;
    width: 95% !important;
    margin-left: 0px !important;
}
.event-title{
    width: 95% !important;
    margin: auto !important;
}
.event-content{
    width: 96% !important;
    margin: auto !important;
}

.header-dropdown-menu a{
    margin-left: 30px !important;
    margin-bottom: 5px !important;
}


}   

  @media(max-width: 390px){

    html{
        overflow-x: hidden !important;
        background-color: white !important;
    }
    body{
        overflow-y: hidden !important;
        background-color: #fff !important;
        width: 390px !important;
    }
    #upper-nav{
        background-color: black !important; 
        width: 390px !important;
        height: 75px;
        position: fixed !important;
    }

    .navbar-menu-wrapper{
       
        width: 390px !important;
        height: 60px !important;
        position: fixed !important;
        
        
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

    #sidebar.active-sidebars {
    display: block !important;
  } 

  

    
    .navbar-toggler{
        display: none !important;
    }

    .responsive-bars-btn{
        display: block !important;
        margin-right: 40px !important;
        border: none !important;
        
    }

    .responsive-bars-btn span{
        color: white !important;
        font-size: 18px !important;
    }

    .header-user{
       width: 200px;
        margin-right: 90px;
       transition: ease-in-out 1s;
       background-color: black !important;
       
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

    .dashboard-content{
        width: 390px;
        
        margin-left: 0px !important;
        margin-top: -20px !important;
    }
    
    .dashboard-title{
        
    }

    .dashboard-title h1{
        margin-left: 20px;
    }

    .dashboard-contents{
        
    }

    .first-dash-contents{
   
        width: 95% !important;
        margin: auto !important;
    }

    .employee-status-overview{
        width: 100% !important;
    }

    .emp-status-title{
       margin-left: -15px !important;
    }

    .emp-status-container{
       
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
        align-items: center !important;
        height: 900px !important;
    }

    .emp-status-container div{
        width: 340px !important;
    }

    .emp-status-container div:nth-child(1){
        background-color: #000080 !important;
        
    }

    .emp-status-container div:nth-child(1) input{
    color: white;
    font-size: 35px !important;
    margin-left: 10px !important;
    margin-top: -5px !important;
    }

    .emp-status-container div:nth-child(1) label{
    color: white;
    margin-left: 10px !important;
    font-size: 19px !important;
    }   

    .emp-status-container div:nth-child(1) p{
    color: white;
    margin-left: 10px !important;
    margin-top: 5px !important; 
    font-size: 19px !important;
    } 

    .emp-status-container div:nth-child(1) span{
        font-size: 19px !important;
        margin-left: 3px !important;
        color: black !important;
    }


    .emp-status-container div:nth-child(2){
        background-color: #F3797E !important; 
    }

    .emp-status-container div:nth-child(2) input{
    color: white;
    font-size: 35px !important;
    margin-left: 10px !important;
    margin-top: -5px !important;
    }

    .emp-status-container div:nth-child(2) label{
    color: white;
    margin-left: 10px !important;
    font-size: 19px !important;
    }   
    
    .emp-status-container div:nth-child(2) p{
    color: white;
    margin-left: 10px !important;
    margin-top: 5px !important; 
    font-size: 19px !important;
    } 

    .emp-status-container div:nth-child(2) span{
        font-size: 19px !important;
        margin-left: 3px !important;
        color: black !important;
    }

    .emp-status-container div:nth-child(3){
        background-color: #4747A1 !important;
    }

    .emp-status-container div:nth-child(3) input{
    color: white;
    font-size: 35px !important;
    margin-left: 10px !important;
    margin-top: -5px !important;
    }

    .emp-status-container div:nth-child(3) label{
    color: white;
    margin-left: 10px !important;
    font-size: 19px !important;
    }   
    
    .emp-status-container div:nth-child(3) p{
    color: white;
    margin-left: 10px !important;
    margin-top: 5px !important; 
    font-size: 19px !important;
    } 

    .emp-status-container div:nth-child(3) span{
        font-size: 19px !important;
        color: black !important;
        margin-left: 3px !important;
    }

    .emp-status-container div:nth-child(4){
        background-color: #7978E9 !important;
    }

    .emp-status-container div:nth-child(4) input{
    color: white;
    font-size: 35px !important;
    margin-left: 10px !important;
    margin-top: -5px !important;
    }

    .emp-status-container div:nth-child(4) label{
    color: white;
    margin-left: 10px !important;
    font-size: 19px !important;
    }   
    
    .emp-status-container div:nth-child(4) p{
    color: white;
    margin-left: 10px !important;
    margin-top: 5px !important; 
    font-size: 19px !important;
    } 

    .emp-status-container div:nth-child(4) .wfh-color{
        font-size: 19px !important;
        margin-left: 3px !important;
        color: black !important;
    }

    .emp-status-container div:nth-child(5){
        background-color: #98BDFF !important;
    }
    .emp-status-container div:nth-child(5) input{
    color: white;
    font-size: 35px !important;
    margin-left: 10px !important;
    margin-top: -5px !important;
    }

    .emp-status-container div:nth-child(5) label{
    color: white;
    margin-left: 10px !important;
    font-size: 19px !important;
    }   
    
    .emp-status-container div:nth-child(5) p{
    color: white;
    margin-left: 10px !important;
    margin-top: 5px !important; 
    font-size: 19px !important;
    } 

    .emp-status-container div:nth-child(5) span{
        font-size: 19px !important;
        margin-left: 3px !important;
        color: black !important;
    }

    .emp-request-list-container{
        width: 95% !important;
        
    }

    .emp-btn-container{
        width: 100% !important;
        margin-left: 11px !important; 
    }

    .emp-request-btn{
        position: relative !important;
        display: flex;
        justify-content: space-between;
       
        width: 95% !important;
        margin:auto !important;
    }

    /* .emp-request-btn div:nth-child(1){
        margin-left: 20px !important;
    } */

    .emp-request-btn div:nth-child(1) p{
        font-size: 10px !important;
       
        height: 25px !important;
        width: 25px !important;
    }

    .emp-request-btn div:nth-child(1) div{
        margin-left: 0px !important;
    }

    .emp-request-btn div:nth-child(2){
        margin-top: 5px !important;
        margin-left: -3px !important;
    }

    .emp-request-btn div:nth-child(3){
        margin-top: 5px !important;
    
    }

    .emp-request-btn div:nth-child(4){
        margin-top: 5px !important;
        margin-right: 5px !important;
    }

    .emp-request-btn div button{
        font-size: 13px !important;
    }

    .emp-request-table{
        width: 100% !important;
        margin-left: 11px !important;
    }

    .dash

    .dash-responsive-btn{
        margin-top: 16px !important;
        display: block !important;
        margin-right: 40px !important;
    }

    .request-list-dropdown {
        display: none;
        margin-top: 10px;
        background-color: #f4f4f4 !important;
        position: absolute !important;
        right: -10px !important;
        bottom: -115px !important;
        width: 130px !important;
        border-radius: 7px !important;
        padding: 10px !important;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.2), 0 2px 5px 0 rgba(0, 0, 0, 0.17);
     }

     .request-list-dropdown button{
        font-size: 18px !important;
        font-weight: 500 !important;
     }
     
    .emp-request-btn .fa-chevron-down {
        transition: transform 0.3s;
    }

    .emp-request-btn.active .fa-chevron-down {
        transform: rotate(180deg);
    }

    .request-table{
       
        margin-left: 10px !important;
        width: 95% !important; 
    }

    /* second content */
    .second-dash-contents{
        display:flex;
        flex-direction: column;
        align-items: center;
        transition: ease-in-out 1s;
        margin-top: 20px !important;
        margin-left: 10px !important;
        width: 95% !important;
    }

    .announcement-container{
        
        width: 100% !important;
    }

    .announce-title{
        width: 95% !important;
        margin: auto !important;
    }

    .announce-content{
        width: 100% !important;
        margin: auto !important;
        margin-top: 20px !important;
    }

    .announce-content button{
        font-size: 16px !important;
    }

    .announce-content h4{
        font-size: 26px !important;
    }

    .announce-content p{
        font-size: 14px !important;
    }

    .event-container{
        margin-bottom: 25px !important;
        width: 100% !important;
        margin-left: 0px !important;
    }
    .event-title{
        width: 95% !important;
        margin: auto !important;
    }
    .event-content{
        width: 95% !important;
        margin: auto !important;
    }

    .header-dropdown-menu a{
        margin-left: 30px !important;
        margin-bottom: 5px !important;
    }
   
   
}  
.dropdown-icon {
        transition: color 0.3s;
        cursor: pointer;
       }

    .dropdown-icon:hover {
        color: blue;
       } 
  

</style> 

<!------------------------------------Message alert------------------------------------------------->
<?php
        // if (isset($_GET['msg'])) {
        //     $msg = $_GET['msg'];
        //     echo '<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        //     '.$msg.'
        //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        //   </div>';
        // }
?>
<!------------------------------------End Message alert------------------------------------------------->

<!------------------------------------Message alert------------------------------------------------->
<?php
        // if (isset($_GET['error'])) {
        //     $err = $_GET['error'];
        //     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        //     '.$err.'
        //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        //   </div>';
        // }
?>
<!------------------------------------End Message alert------------------------------------------------->
    <?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hris_db";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Query the attendances table to count the number of present employees with an empid
    $query = "SELECT COUNT(*) AS present_count FROM attendances WHERE Status = 'Present' AND empid IS NOT NULL";
    $results = mysqli_query($conn, $query);
    
    // Check for errors
    if (!$results) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    // Fetch the result and store it in a variable
    $rows = mysqli_fetch_assoc($results);
    $present_count = $rows["present_count"];
    
    // Close the connection
    mysqli_close($conn);

    ?>


<!-------------------------------------------Modal of Announce Start Here--------------------------------------------->
<div class="modal fade" id="announcement_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Summary of Announcement</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
       <form action="Data Controller/Announcement/insert_announce.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3" style="display:none;">
                        <label for="Select_emp" class="form-label">Name</label>
                            <?php
                                include 'config.php'; 
                                @$employeeid = $_SESSION['empid'];
                                ?>
                                <input type="text" class="form-control" name="name_emp" value="<?php 
                                    error_reporting(E_ERROR | E_PARSE);
                                    if($employeeid == NULL){
                                        
                                        echo '0909090909';
                                    }else{
                                        echo $employeeid;
                                    }?>" id="empid" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="company" class="form-label">Title</label>
                            <input type="text" name="announce_title" class="form-control" id="announce_title_id" required>
                        </div>

                        <div class="mb-3">
                            <label for="date_announcement" class="form-label">Date</label>
                            <input type="date" name="announce_date" class="form-control" id="announce_date_id" required>
                        </div>

                        <div class="mb-3">
                            <label for="text_description" class="form-label">Description</label>
                            <textarea class="form-control" name="announce_description" id="announce_description_id"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="text_description" class="form-label">File Attachment</label>
                            <input type="file" name="file_upload" class="form-control" id="inputfile" >
                        </div>

                    </div><!--Modal body Close tag--->
                    <div class="modal-footer">
                <button type="submit" name="add_announcement" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </form>

      </div>
    </div>
  </div>
</div><div class="modal fade" id="announcement_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Summary of Announcement</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
       <form action="Data Controller/Announcement/insert_announce.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3" style="display:none;">
                        <label for="Select_emp" class="form-label">Name</label>
                            <?php
                                include 'config.php'; 
                                @$employeeid = $_SESSION['empid'];
                                ?>
                                <input type="text" class="form-control" name="name_emp" value="<?php 
                                    error_reporting(E_ERROR | E_PARSE);
                                    if($employeeid == NULL){
                                        
                                        echo '0909090909';
                                    }else{
                                        echo $employeeid;
                                    }?>" id="empid" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="company" class="form-label">Title</label>
                            <input type="text" name="announce_title" class="form-control" id="announce_title_id" required>
                        </div>

                        <div class="mb-3">
                            <label for="date_announcement" class="form-label">Date</label>
                            <input type="date" name="announce_date" class="form-control" id="announce_date_id" required>
                        </div>

                        <div class="mb-3">
                            <label for="text_description" class="form-label">Description</label>
                            <textarea class="form-control" name="announce_description" id="announce_description_id"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="text_description" class="form-label">File Attachment</label>
                            <input type="file" name="file_upload" class="form-control" id="inputfile" >
                        </div>

                    </div><!--Modal body Close tag--->
                    <div class="modal-footer">
                <button type="submit" name="add_announcement" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </form>

      </div>
    </div>
  </div>
</div>
<!-------------------------------------------Modal of Announce End Here---------------------------------------------> 

<!-------------------------------------------Modal of View Summary Start Here--------------------------------------------->
<div class="modal fade" id="view_summary" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Announcement</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="order-listing" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Created By</th>
                                <th>Title</th>
                                <th>Details</th>
                                <th>Attachment</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            include 'config.php';

                            $query = "SELECT
                            announcement_tb.id,
                            announcement_tb.announce_title,
                            employee_tb.empid,
                            CONCAT(
                                employee_tb.`fname`,
                                ' ',
                                employee_tb.`lname`
                            ) AS `full_name`,
                            announcement_tb.announce_date,
                            announcement_tb.description,
                            announcement_tb.file_attachment,
                            announcement_tb.date_file
                            FROM announcement_tb INNER JOIN employee_tb ON employee_tb.empid = announcement_tb.empid;";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $row['id']?></td>
                                <td><?php echo $row['announce_date']?></td>
                                <td><?php echo $row['full_name']?></td>
                                <td><?php echo $row['announce_title']?></td>
                                <td><?php echo $row['description']?></td>
                                <?php if(!empty($row['file_attachment'])): ?>
                                <td>
                                <button type="button" class="btn btn-outline-success downloadbtn" data-bs-toggle="modal" data-bs-target="#download">Download</button>
                                </td>
                                <?php else: ?>
                                <td>None</td> <!-- Show an empty cell if there is no file attachment -->
                                <?php endif; ?>
                               
                            </tr>
                        </tbody>
                        <?php
                            }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div><!---Modal Body Close Tag-->

    </div>
  </div>
</div>
<!-------------------------------------------Modal of View Summary End Here--------------------------------------------->
    
<!---------------------------------------Download Modal Start Here -------------------------------------->
<div class="modal fade" id="download" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="actions/Announcement/download.php" method="POST">
      <div class="modal-body">
        <input type="hidden" name="table_id" id="id_table">
        <input type="hidden" name="table_name" id="name_table">
        <h3>Are you sure you want download the PDF File?</h3>
      </div>
      <div class="modal-footer">
        <button type="submit" name="yes_download" class="btn btn-primary">Yes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
      </div>
      </form>

    </div>
  </div>
</div>
<!---------------------------------------Download Modal End Here --------------------------------------->


    <div class="dashboard-container" id="dashboard-container">
        <div class="dashboard-content" style="margin-left: 320px;">
            <div class="dashboard-title" style="">
                <h1>DASHBOARD</h1>
            </div>
            <div class="dashboard-contents">
                <div class="first-dash-contents">
                    <div class="employee-status-overview">
                        <div class="emp-status-title">
                            <p>Employee Status Overview</p>
                            <p>Real time status</p>
                        </div>
                        <div class="emp-status-container">
                            <div>
                                <input type="text" name="present" value="<?php echo $present_count; ?>" readonly>
                                <p style="margin-top: -7px; ">of <span style="color: red;"><?php echo $employee_count?> </span></p>
                                <label for="present" style="margin-top: 3px;" ><i class="mdi    mdi-alarm-check"> </i>Present</label>   
                            </div>
                            <div>
                                <input type="text" name="absent" value="32" readonly >
                                <p style="margin-top: -7px; ">of <span style="color: red;"><?php echo $employee_count?> </span></p>
                                <label for="absent" style="margin-top: 3px;" ><i class="mdi mdi-alarm-off"></i> Absent</label>
                            </div>
                            <div>
                                <input type="text" name="on_leave" value="11" readonly >
                                <p style="margin-top: -7px; ">of <span style="color: red;"><?php echo $employee_count?> </span></p>
                                <label for="on_leave" style="margin-top: 3px;" ><i class="mdi mdi-airplane-takeoff"></i>  On Leave</label>
                            </div>
                            <div>
                                <input type="text" name="wfh" value="19" readonly style="margin-top:12px;"> 
                                <p style=" ">of <span class="wfh-color" style="color: red;"><?php echo $employee_count?> </span></p>
                                <label for="wfh" style="margin-top: -6px; margin-bottom: 20px"><i class="mdi mdi-home"></i> <span style="font-size: 16px;"> Working Home</span></label>
                            </div>
                            <div>
                                <input type="text" name="late" value="20" readonly style="margin-bottom: 5px; margin-left: 3px;">
                                <p style="margin-top: -7px; margin-left: 3px; ">of <span style="color: red; "><?php echo $employee_count?> </span></p>
                                <label for="present" style="margin-top: 3px;" ><i class="mdi mdi-run"> </i>Late</label>
                            </div>
                        </div>
                    </div>

                    <div class="emp-request-list-container">
                        <div class="emp-btn-container">
                            <div class="emp-request-btn">
                                <div>
                                    <button class="mb-2">Employee Request List <p>20</p></button>
                                    <div style="border: gold 1px solid;"></div>
                                </div>

                                <!-- <div class="dash-responsive-btn">
                                    <span class="fa-solid fa-chevron-down"></span>
                                </div> -->
                                
                                
                                    <div> 
                                        <button>Leave</button>
                                    </div>
                                    <div>      
                                        <button>Loans</button>
                                    </div>
                                    <div>    
                                        <button>Overtime</button>
                                    </div>  
                                
                            </div>
                        </div>
                        <div class="emp-request-table">
                            <table class="table request-table table-borderless ml-5 mt-3">
                                <thead >
                                    <th class="emp-table-adjust" style="color: blue">Type of Request</th>
                                    <th style="color: blue">Requestor</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-weight: 400">Vacation Leave</td>
                                        <td style="font-weight: 400">Cyrus De Guzman</td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: 400">Sick Leave</td>
                                        <td style="font-weight: 400">Cyrus De Guzman</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>   

                <div class="second-dash-contents">
                    <div class="announcement-container">
                        <div class="announce-title">
                            <h3 class="mb-0 d-inline-block mt-2 ml-2">Announcement</h3>
                                <i class="mdi mdi-arrow-down-drop-circle float-right mt-2 mr-2 dropdown-icon" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#announcement_modal" style="cursor: pointer;">Add Announcement</a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#view_summary" style="cursor: pointer;">View Summary</a>
                        </div>
                        <div class="announce-content">   
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
                                     
                                    if (mysqli_num_rows($result) > 0){  
                                     while ($row = mysqli_fetch_assoc($result)) {
                                    if ($slideIndex % 1 === 0) {
                                       echo "<div class='announcement-slide'>";
                                    }
                          ?>
                           <h4 class="mt-2 ml-2"><?php echo $row['announce_title']?></h4>
                            <p class="ml-2">
                            <span style="color: #7F7FDD; font-style: Italic;">
                            <?php 
                                    if($row['empid'] === '0909090909')
                                        {
                                            echo 'SuperAdmin';
                                        }
                                    else {
                                        echo $row['full_name'];
                                        }
                                ?>
                                 </span> - <?php echo $row['announce_date']?></p>
                            <p class="ml-2"><?php echo $row['description']?></p>
                            <?php
                                if (($slideIndex + 1) % 1 === 0) {
                                echo "</div>";
                               }
                                $slideIndex++;
                                }
                          if ($slideIndex % 1 !== 0) {
                                echo "</div>";
                               }
                            } else {
                                echo "<div class='announcement-slide'>";
                                echo "<h4 style='text-align: center; margin-top:60px;'>No items on whiteboard</h4>";
                                echo "</div>";
                            }
                               ?>
                                
                            <button class="prev" onclick="prevSlide()">&#10094;</button>
                            <button class="next" onclick="nextSlide()">&#10095;</button>
                        </div>   
                        </div>
                    </div>

                    <div class="event-container mt-2" id="event-box" style="width: 670px; margin-left: 5px;">
                        <div class="event-title">
                            <div>
                                <p><span class="mdi mdi-calendar-check" style="margin-right:10px;"></span> Events</p>
                            </div>
                            <div>
                                <i class="mdi mdi-arrow-down-drop-circle float-right mt-2 mr-2" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: blue"></i>
                            </div>
                        </div>
                        <div class="event-content">
                        </div>
                    </div>
                </div>    

            </div>
        </div>
    </div>
    


    



<!------------------------------------Script para lumabas ang download modal------------------------------------------------->
<script>
     $(document).ready(function(){
               $('.downloadbtn').on('click', function(){
                $('#download').modal('show');
                      $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                    return $(this).text();
                    }).get();
                   console.log(data);
                   $('#id_table').val(data[0]);
                   $('#name_table').val(data[2]);
               });
             });
</script>
<!---------------------------------End ng Script para lumabas ang download modal------------------------------------------>

<!---------------------------- Script para lumabas ang warning message na PDF File lang inaallow------------------------------------------>
<script>
  document.getElementById('inputfile').addEventListener('change', function(event) {
    var fileInput = event.target;
    var file = fileInput.files[0];
    if (file.type !== 'application/pdf') {
      alert('Please select a PDF file.');
      fileInput.value = ''; // Clear the file input field
    }
  });
</script>

<!--------------------End ng Script para lumabas ang Script para lumabas ang warning message na PDF File lang inaallow--------------------->
        
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



<!--     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="vendors/js/vendor.bundle.base.js"></script> -->

<!-- endinject -->
<!-- Plugin js for this page-->
<!-- <script src="vendors/datatables.net/jquery.dataTables.js"></script>
<script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="bootstrap js/template.js"></script> -->
<!-- Custom js for this page-->
<!-- <script src="bootstrap js/data-table.js"></script> -->
<!-- End custom js for this page-->
    <!-- <script src="main.js"></script> -->

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