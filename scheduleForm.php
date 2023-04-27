<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php"); 
    }

    // include  'Data Controller/scheduleFormModalController.php';

    // $data = new DataController();
    // $languages = $data->getLanguage();
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
    <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="css/styles.css"> 
    <title>HRIS | Employee List Form</title>
</head>
<body>
    <header>
        <?php include("header.php")?>
    </header>

    <button id="schedFormBtn" class="schedFormBtn" > Assign to Employese</button>

    <?php
        include("editScheduleForms.php")
    ?>
    <form action="Data Controller/Schedules/empSchedule.php" method="POST">
        <div class="schedule-modal" id="schedFormModal" style="display:none;">
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
                                    $options .= "<option value='".$row['empid'] . "'>". $row['empid'] . " ". " - ". " " .$row['fname']. " ".$row['lname']. "</option>";
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
                                        $options .= "<option value='".$row['schedule_name']."'>".$row['schedule_name']."</option>";
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
                                <input type="date" name="sched_from" id="">
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
        <form action="Data Controller/Schedules/scheduleFormController.php" method="POST">
       <div class="schedule-form-show">

           
            <div class="scheduletable-container">
                    <div class="scheduletable-buttons">
                        <div class="scheduleBtn-crud">
                             <input type="submit" value="Submit" name="submit" class="btn btn-success"  >
                            <!-- <input type="submit" value="Update" name="" class="btn btn-success"  > -->
                            <!-- <button style="color:white; margin-left:20px"><a href="Button Controller/delete.pshp?id=$row[id]" style="color:white;">Delete</a></button> -->
                        </div>
                    </div>
            
                    <label for="schedule_name">Schedule Name</label><br>
                    <input class="schedule-input" type="text" name="schedule_name" id="" required>

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
                                <td><input type="checkbox" class="checkbox" name="monday" value="Monday" id="checkbox1" onclick="toggleInputs(this)"> Monday</td>
                                <td><input name="mon_timein" type="time" class="time-input" id="time1" disabled></td>
                                <td><input name="mon_timeout" type="time" class="time-input" id="time2" disabled></td>
                                <td><input name ="mon_wfh" type="checkbox" class="checkbox-lg" value="WFH" ></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox" name="tuesday" value="Tuesday" id="checkbox1" onclick="toggleInputs(this)"> Tuesday</td>
                                <td><input name="tues_timein" type="time" class="time-input" id="time3" disabled></td>
                                <td><input name="tues_timeout" type="time" class="time-input" id="time4" disabled></td>
                                <td><input name ="tues_wfh" type="checkbox" class="checkbox-lg" value="WFH"></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox" name="wednesday" value="Wednesday" id="checkbox1" onclick="toggleInputs(this)"> Wednesday</td>
                                <td><input name="wed_timein" type="time" class="time-input" id="time5" disabled></td>
                                <td><input name="wed_timeout" type="time" class="time-input" id="time6" disabled></td>
                                <td><input name ="wed_wfh" type="checkbox" class="checkbox-lg" value="WFH"></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox" name="thursday" value="Thursday" id="checkbox1" onclick="toggleInputs(this)"> Thursday </td>
                                <td><input name="thurs_timein" type="time" class="time-input" id="time7" disabled></td>
                                <td><input name="thurs_timeout" type="time" class="time-input" id="time8" disabled></td>
                                <td><input name ="thurs_wfh" type="checkbox" class="checkbox-lg" value="WFH"></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox" name="friday" value="Friday" id="checkbox1" onclick="toggleInputs(this)"> Friday</td>
                                <td><input name="fri_timein" type="time" class="time-input" id="time9" disabled></td>
                                <td><input name="fri_timeout" type="time" class="time-input" id="time10" disabled></td>
                                <td><input name ="fri_wfh" type="checkbox" class="checkbox-lg" value="WFH"></td>
                            </tr>
                            <tr>
                            <td><input type="checkbox" class="checkbox" name="saturday" value="Saturday" id="checkbox1" onclick="toggleInputs(this)"> Saturday</td>
                            <td><input name="sat_timein" type="time" class="time-input" id="time11" disabled></td>
                                <td><input name="sat_timeout" type="time" class="time-input" id="time12" disabled></td>
                                <td><input name ="sat_wfh" type="checkbox" class="checkbox-lg" value="WFH"></td>
                            </tr>
                            <tr>
                            <td><input type="checkbox" class="checkbox" name="sunday" value="Sunday" id="checkbox1" onclick="toggleInputs(this)"> Sunday</td>
                            <td><input name="sun_timein" type="time" class="time-input" id="time13" disabled></td>
                                <td><input name="sun_timeout" type="time" class="time-input" id="time14" disabled></td>
                                <td><input name ="sun_wfh" type="checkbox" class="checkbox-lg" value="WFH"></td>
                            </tr>
                            <tr>
                                <td ><input type="checkbox" name="flexible" id="" class="checkbox-lg" value="Flexible"> Flexible</td>
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
                                    <input class="numbox" id="my-number-input" type="number" name="grace_period" placeholder="00:00" disabled>
                                    <label for="graceperiod_minutes">Minutes</label>
                                </div>
                                
                            </div>
                            <div class="schedule-ot">
                                <div>
                                    <input type="checkbox" id="enable-number-input2" class="checkbox-lg" >
                                    <label for="ob_ot">Enable OT</label>
                                </div>
                                <div>
                                    <input class="numbox"  id="my-number-input2" type="number" name="sched_ot" placeholder="00:00" disabled>
                                    <label for="ob_minutes">Minutes</label> 
                                </div>
                            </div>
                            <div class="schedule-holiday">
                                <input type="checkbox" name="sched_holiday" id="" class="checkbox-lg" value="Holday Work">
                                <label for="ob_holiday">Holiday Work</label>
                            </div>
                        </div> 

                    </div>                   
                </div>
                </div> 
            </div>
       </div>
       </form>
       
       
       <!-- <form action="" method="">                   
       <div class="modal fade" id="empModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">User Info</h4>
                          <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <div class="modal-body">
                            
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
        </div> -->
        


    
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



// filter

// function filter(item){
// $.ajax({
// type: "POST",
// url: "Data Controller/empListFormController.php",
// data: { value: item},
// success:function(data){
//   $("#results").html(data);
// }
// });
// }


// function getEmployee(val){
//     $.ajax({
//         type: "POST",
//         url: "getEmployee.php",
//         data: 'empid='+val,
//         success:function(data){
//              $("employee-dd").html(data);
//              getEmployee();
//          }
//     });
// }
// </script>

<!-- <script type='text/javascript'>
            $(document).ready(function(){
                $('.schedule-info').click(function(){
                    var id = $(this).data('id');
                    $.ajax({
                        url: 'ajaxfile.php',
                        type: 'post',
                        data: {id: id},
                        success: function(response){ 
                            $('.modal-body').html(response); 
                            $('.schedModal').modal('show'); 
                        }
                    });
                });
            });
</script> -->


    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="main.js"></script>
</body>
</html>