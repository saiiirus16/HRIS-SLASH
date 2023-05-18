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

    

        $server = "localhost";
        $user = "root";
        $pass ="";
        $database = "hris_db";
    
        $conn = mysqli_connect($server, $user, $pass, $database);
    
        if(count($_POST) > 0){
            mysqli_query($conn, "UPDATE schedule_tb
                                 SET schedule_name='".$_POST['schedule_name']."', monday='".$_POST['monday']."', mon_timein='".$_POST['mon_timein']."', mon_timeout='".$_POST['mon_timeout']."', mon_wfh='".$_POST['mon_wfh']."', tuesday='".$_POST['tuesday']."', tues_timein='".$_POST['tues_timein']."', tues_timeout='".$_POST['tues_timeout']."', tues_wfh='".$_POST['tues_wfh']."', wednesday='".$_POST['wednesday']."', wed_timein='".$_POST['wed_timein']."', wed_timeout='".$_POST['wed_timeout']."', wed_wfh='".$_POST['wed_wfh']."', thursday='".$_POST['thursday']."', thurs_timein='".$_POST['thurs_timein']."', thurs_timeout='".$_POST['thurs_timeout']."', thurs_wfh='".$_POST['thurs_wfh']."', friday='".$_POST['friday']."', fri_timein='".$_POST['fri_timein']."', fri_timeout='".$_POST['fri_timeout']."', fri_wfh='".$_POST['fri_wfh']."', saturday='".$_POST['saturday']."', sat_timein='".$_POST['sat_timein']."', sat_timeout='".$_POST['sat_timeout']."', sat_wfh='".$_POST['sat_wfh']."', sunday='".$_POST['sunday']."', sun_timein='".$_POST['sun_timein']."', sun_timeout='".$_POST['sun_timeout']."', sun_wfh='".$_POST['sun_wfh']."', flexible='".$_POST['flexible']."', grace_period='".$_POST['grace_period']."',  sched_ot='".$_POST['sched_ot']."', sched_holiday='".$_POST['sched_holiday']."'
                                 WHERE id='".$_POST['id']."'");
            header ("Location: Schedules.php");
        }
            $resulta = mysqli_query($conn, "SELECT * FROM schedule_tb WHERE id ='". $_GET['id']. "'");
            $schedrow = mysqli_fetch_assoc($resulta);
        
        

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
    <script src="https://kit.fontawesome.com/803701e46b.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link rel="stylesheet" href="css/styles.css"> 
    <title>HRIS | Employee List Form</title>
</head>
<body>
    <header>
        <?php include("header.php")?>
    </header>




    <button id="schedFormBtn" class="schedFormBtn" > Assign to Employee</button>
    <form action="Data Controller/Schedules/empSchedule.php" method="POST">
        <div class="schedule-modal" id="schedFormModal">
            <div class="schedule-modal-container"  id="schedFormModal">
                    <div class="schedule-modal-content">
                        <div class="sched-modal-title">
                            <h1>Change Schedule</h1>
                            <div> </div>
                        </div>
                        <div class="schedule-select">
                            <div>
                            <?php
                                $server = "localhost";
                                $user = "root";
                                $pass ="";
                                $database = "hris_db";

                                $conn = mysqli_connect($server, $user, $pass, $database);
                                $sql = "SELECT department_name FROM employee_tb";
                                $result = mysqli_query($conn, $sql);

                                $options = "";
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $options .= "<option value='".$row['department_name']."'>" .$row['department_name'].  "</option>";
                                }
                                ?>

                                
                                <label for="depatment">Select Department</label><br>
                                <select name="" id="">
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
                                    $options .= "<option value='".$row['empid']."'>". $row['empid'] . " ". " - ". " " .$row['fname']. " ".$row['lname']. "</option>";
                                }
                                ?>

                                <label for="emp">Select Employee</label><br>
                                <select name="empid" id="employee-dd">
                                <option value disabled selected>Select Employee</option>
                                    <?php echo $options; ?>
                                </select>

                            </div>
                        </div>
                        <div class="sched-type">
                            <div>
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
                                        $options .= "<option value='".$row['schedule_name']."'>" .$row['schedule_name']."</option>";
                                    }
                                    ?>

                                <label for="schedule_name">Schedule Type</label><br>
                                <select name="schedule_name" id="">
                                <option value disabled selected>Select Schedule Type</option>
                                    <?php echo $options; ?>
                                </select>
                                </div>   

                        </div>
                        <div class="sched-modal-date">
                            <div>
                                <label for="from">From</label><br>
                                <input type="date" name="sched_from" id="" >
                            </div>
                            <div>
                                <label for="from">To</label><br>
                                <input type="date" name="sched_to" id="">   
                            </div>
                        </div>

                        <div class="sched-modal-btn">
                            <div>

                            </div>
                            <div>
                                <input value="Cancel" style="outline:none; cursor:pointer;" class="schedFormClose" id="schedFormClose">
                                <input type="submit" value="Submit"  style="outline:none; cursor:pointer;">
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </form>

    
    <form action="" method="POST">
       <div class="scheduleform-container">
            <div class="schedulelist-container">
                <div class="schedulelist-title">
                    <h1>Schedule List</h1>
                </div>
                <div class="schedulelist">

                     <?php
                            $server = "localhost";
                            $user = "root";
                            $pass ="";
                            $database = "hris_db";

                            $conn = mysqli_connect($server, $user, $pass, $database);
                            $sql = "SELECT * FROM schedule_tb";
                            $results = mysqli_query($conn, $sql);

                           
                            if($results->num_rows > 0){
                                while($rows = $results->fetch_assoc()){
                                    echo "<button style='border:none; background-color: inherit; display: flex; margin-left: 20px; font-size: 26px; margin-top: 10px; font-weight: 500;'><a href='editScheduleForm.php?id=$rows[id]'>".$rows['schedule_name']."</a></button>";
                                }
                            }
                        ?>

                   
                    <!-- <a href="scheduleForm.php"><h1>Office Based</h1></a>
                    <a href="http://"><h1>Flexible</h1></a>
                    <a href="http://"><h1>Work From Home</h1></a> -->
                </div>
            </div>
            <div class="scheduletable-container">
                    <div class="scheduletable-buttons">
                        <div class="scheduleBtn-crud">
                            <!-- <button style="color:white;" type="submit"><a href="" style="color:white;">Add</a></button> -->
                            <input type="submit" value="Update" name="update" class="btn btn-success"  >
                            <button class="btn btn-success"><a href="actions/Schedules/delete.php?id=<?php echo $schedrow['id'] ?>" style="color:white;">Delete</a></button>
                        </div>
                    </div>

                    <label for="schedule_name">Schedule Name</label><br>
                    <input class="schedule-input" type="text" name="schedule_name" id="" value="<?php echo $schedrow['schedule_name'];?>" required>

                <div class="scheduletable-table">

            <div class="schedule-table-container">
                <table class="table-hover" id="scheduleForm-table">
                        <thead>
                            <th> </th>
                            <th>Time Entry </th>
                            <th>Time Out </th>
                            <th>Work From Home </th>
                        </thead>
                        <tbody>
                            <tr>
                                <input type="hidden" name="id" value="<?php echo $schedrow['id']; ?>">
                                <td>
                                <input type="checkbox" class="checkbox" name="monday" id="checkbox1" onclick="toggleInputs(this)" value="Monday" <?php if ($schedrow['monday']){ echo "checked"; } ?>> Monday</td>
                                <td><input name="mon_timein" type="time" class="time-input" id="time1"  value="<?php if(isset($schedrow['mon_timein'])&& !empty($schedrow['mon_timein'])) { echo $schedrow['mon_timein']; } else {echo 'No data'; }?>"></td>
                                <td><input name="mon_timeout" type="time" class="time-input" id="time2"  value="<?php if(isset($schedrow['mon_timeout'])&& !empty($schedrow['mon_timeout'])) { echo $schedrow['mon_timeout']; } else { echo 'No data'; }?>"></td>
                                <td><input name ="mon_wfh" type="checkbox" class="checkbox-lg" value="WFH" <?php if ($schedrow['mon_wfh']){ echo "checked"; } ?>></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox" name="tuesday"  id="checkbox1" onclick="toggleInputs(this)" value="Tuesday" <?php if ($schedrow['tuesday']){ echo "checked"; } ?>> Tuesday</td>
                                <td><input name="tues_timein" type="time" class="time-input" id="time3"  value="<?php if(isset($schedrow['tues_timein'])&& !empty($schedrow['tues_timein'])) { echo $schedrow['tues_timein']; } else {echo 'No data'; }?>"></td>
                                <td><input name="tues_timeout" type="time" class="time-input" id="time4"  value="<?php if(isset($schedrow['tues_timeout'])&& !empty($schedrow['tues_timeout'])) { echo $schedrow['tues_timeout']; } else {echo 'No data'; }?>"></td>
                                <td><input name ="tues_wfh" type="checkbox" class="checkbox-lg" value="WFH" <?php if ($schedrow['tues_wfh']){ echo "checked"; } ?>></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox" name="wednesday"  id="checkbox1" onclick="toggleInputs(this)" value="Wednesday" <?php if ($schedrow['wednesday']){ echo "checked"; } ?>> Wednesday</td>
                                <td><input name="wed_timein" type="time" class="time-input" id="time5"  value="<?php if(isset($schedrow['wed_timein'])&& !empty($schedrow['wed_timein'])) { echo $schedrow['wed_timein']; } else {echo 'No data'; }?>"></td>
                                <td><input name="wed_timeout" type="time" class="time-input" id="time6"  value="<?php if(isset($schedrow['wed_timeout'])&& !empty($schedrow['wed_timeout'])) { echo $schedrow['wed_timeout']; } else {echo 'No data'; }?>"></td>
                                <td><input name ="wed_wfh" type="checkbox" class="checkbox-lg" value="WFH" <?php if ($schedrow['wed_wfh']){ echo "checked"; } ?>></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox" name="thursday" value="Thursday" <?php if ($schedrow['thursday']){ echo "checked"; } ?> id="checkbox1" onclick="toggleInputs(this)">  Thursday </td>
                                <td><input name="thurs_timein" type="time" class="time-input" id="time7"  value="<?php if(isset($schedrow['thurs_timein'])&& !empty($schedrow['thurs_timein'])) { echo $schedrow['thurs_timein']; } else {echo 'No data'; }?>"></td>
                                <td><input name="thurs_timeout" type="time" class="time-input" id="time8" value="<?php if(isset($schedrow['thurs_timeout'])&& !empty($schedrow['thurs_timeout'])) { echo $schedrow['thurs_timeout']; } else {echo 'No data'; }?>"></td>
                                <td><input name ="thurs_wfh" type="checkbox" class="checkbox-lg" value="WFH" <?php if ($schedrow['thurs_wfh']){ echo "checked"; } ?>></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox" name="friday" value="Friday" <?php if ($schedrow['friday']){ echo "checked"; } ?> id="checkbox1" onclick="toggleInputs(this)"> Friday</td>
                                <td><input name="fri_timein" type="time" class="time-input" id="time9"  value="<?php if(isset($schedrow['fri_timein'])&& !empty($schedrow['fri_timein'])) { echo $schedrow['fri_timein']; } else {echo 'No data'; }?>"></td>
                                <td><input name="fri_timeout" type="time" class="time-input" id="time10"  value="<?php if(isset($schedrow['fri_timeout'])&& !empty($schedrow['fri_timeout'])) { echo $schedrow['fri_timeout']; } else {echo 'No data'; }?>"></td>
                                <td><input name ="fri_wfh" type="checkbox" class="checkbox-lg" value="WFH" <?php if ($schedrow['fri_wfh']){ echo "checked"; } ?>></td>
                            </tr>
                            <tr>
                            <td><input type="checkbox" class="checkbox" name="saturday" value="Saturday" <?php if ($schedrow['saturday']){ echo "checked"; } ?>id="checkbox1" onclick="toggleInputs(this)"> Saturday</td>
                            <td><input name="sat_timein" type="time" class="time-input" id="time11"  value="<?php if(isset($schedrow['sat_timein'])&& !empty($schedrow['sat_timein'])) { echo $schedrow['sat_timein']; } else {echo 'No data'; }?>"></td>
                                <td><input name="sat_timeout" type="time" class="time-input" id="time12"  value="<?php if(isset($schedrow['sat_timeout'])&& !empty($schedrow['sat_timeout'])) { echo $schedrow['sat_timeout']; } else {echo 'No data'; }?>"></td>
                                <td><input name ="sat_wfh" type="checkbox" class="checkbox-lg" value="WFH" <?php if ($schedrow['sat_wfh']){ echo "checked"; } ?>></td>
                            </tr>
                            <tr>
                            <td><input type="checkbox" class="checkbox" name="sunday" value="Sunday" <?php if ($schedrow['sunday']){ echo "checked"; } ?> id="checkbox1" onclick="toggleInputs(this)" > Sunday</td>
                            <td><input name="sun_timein" type="time" class="time-input" id="time13"  value="<?php  if(isset($schedrow['sun_timein'])&& !empty($schedrow['sun_timein'])) { echo $schedrow['sun_timein']; } else echo 'No data';?>"></td>
                                <td><input name="sun_timeout" type="time" class="time-input" id="time14"  value="<?php if(isset($schedrow['sun_timeout'])&& !empty($schedrow['sun_timeout'])) { echo $schedrow['sun_timeout']; } else {echo 'No data'; }?>"></td>
                                <td><input name ="sun_wfh" type="checkbox" class="checkbox-lg" value="WFH" <?php if ($schedrow['sun_wfh']){ echo "checked"; } ?>></td>
                            </tr>
                            <tr>
                                <td ><input type="checkbox" name="flexible" id="" class="checkbox-lg" value="Flexible" <?php if ($schedrow['flexible']){ echo "checked"; } ?>> Flexible</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                 <div class="schedule-extra">
                    <div>
                        <div class="schedule-gracePeriod">
                                <div>
                                    <input type="checkbox" id="enable-number-input" class="checkbox-lg" >
                                    <label for="grace_period">Grace Period</label>
                                </div>
                                <div>
                                    <input class="numbox" id="my-number-input" type="number" name="grace_period" placeholder="00:00" value="<?php if(isset($schedrow['grace_period'])&& !empty($schedrow['grace_period'])) { echo $schedrow['grace_period']; } else {echo 'No data'; }?>">
                                    <label for="graceperiod_minutes">Minutes</label>
                                </div>
                                
                            </div>
                            <div class="schedule-ot">
                                <div>
                                    <input type="checkbox" id="enable-number-input2" class="checkbox-lg" >
                                    <label for="ob_ot">Enable OT</label>
                                </div>
                                <div>
                                    <input class="numbox"  id="my-number-input2" type="number" name="sched_ot" placeholder="00:00"  value="<?php if(isset($schedrow['sched_ot'])&& !empty($schedrow['sched_ot'])) { echo $schedrow['sched_ot']; } else {echo 'No data'; }?>">
                                    <label for="ob_minutes">Minutes</label> 
                                </div>
                            </div>
                            <div class="schedule-holiday">
                                <input type="checkbox" name="sched_holiday" id="" class="checkbox-lg" value="Holiday Work" <?php if ($schedrow['sched_holiday']){ echo "checked"; } ?>>
                                <label for="ob_holiday">Holiday Work</label>
                            </div>
                        </div> 

                    </div>                   
                </div>

            </div>
       </div>
       </form>   


    
<script>
function toggleInputs(checkbox) {
  var row = checkbox.parentNode.parentNode;
  var inputs = row.getElementsByTagName("input");
  for (var i = 1; i < inputs.length; i++) {
    inputs[i].disabled = !checkbox.checked;
  }
}

const checkbox = document.getElementById('enable-number-input');
const checkbox2 = document.getElementById('enable-number-input2');
const numberInput = document.getElementById('my-number-input');
const numberInput2 = document.getElementById('my-number-input2');


checkbox.addEventListener('change', () => {
  numberInput.disabled = !checkbox.checked;
});

checkbox2.addEventListener('change', () => {
  numberInput2.disabled = !checkbox2.checked;
});


// sched form modal

let Modal = document.getElementById('schedFormModal');

//get open modal
let modalBtn = document.getElementById('schedFormBtn');

//get close button modal
let closeModal = document.getElementsByClassName('schedFormClose')[0];

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

//filter

function filter(item){
$.ajax({
type: "POST",
url: "Data Controller/empListFormController.php",
data: { value: item},
success:function(data){
  $("#results").html(data);
}
});
}


function getEmployee(val){
    $.ajax({
        type: "POST",
        url: "getEmployee.php",
        data: 'empid='+val,
        success:function(data){
             $("employee-dd").html(data);
             getEmployee();
         }
    });
}


</script>


    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="main.js"></script>
</body>
</html>