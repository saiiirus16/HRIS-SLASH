<form action="" method="POST">
       <div id="scheduleModal-form" class="schedModal">
       <div class="scheduletable-buttons">
                        <div class="scheduleBtn-crud" style="margin-top:-39px">
                             <input type="submit" value="Submit" name="submit" class="btn btn-success"  >
                            <input type="submit" value="Update" name="" class="btn btn-success"  >
                            <!-- <button style="color:white; margin-left:20px"><a href="Button Controller/delete.php?id=$row[id]" style="color:white;">Delete</a></button> -->
                        </div>
                    </div>
                    
                    <div class="schedules">
                    <label for="schedule_names" class="schedule-name">Schedule Name</label><br>
                    <input class="schedule-inputs" type="text" name="schedule_name" id="" required>
                    </div>
                   

                <table class="table-hover" id="scheduleForm-tables" >
                        <thead>
                            <th> </th>
                            <th>Time Entry </th>
                            <th>Time Out </th>
                            <th>Work From Home </th>
                        </thead>
                        <tbody>
                            <tr>
                                <input type="hidden" name="id" value="<?php echo $schedrow['id']; ?>">
                                <td><input type="checkbox" class="checkbox" name="monday" id="checkbox1" onclick="toggleInputs(this)" value="<?php if(isset($schedrow['monday'])&& !empty($schedrow['monday'])) { echo 'Monday'; } else { echo 'No data'; }?>"> Monday</td>
                                <td><input name="mon_timein" type="time" class="time-input" id="time1"  value="<?php if(isset($schedrow['mon_timein'])&& !empty($schedrow['mon_timein'])) { echo $schedrow['mon_timein']; } else {echo 'No data'; }?>"></td>
                                <td><input name="mon_timeout" type="time" class="time-input" id="time2"  value="<?php if(isset($schedrow['mon_timeout'])&& !empty($schedrow['mon_timeout'])) { echo $schedrow['mon_timeout']; } else { echo 'No data'; }?>"></td>
                                <td><input name ="mon_wfh" type="checkbox" class="checkbox-lg" value="WFH"></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox" name="tuesday"  id="checkbox1" onclick="toggleInputs(this)" value="<?php if(isset($schedrow['tuesday'])&& !empty($schedrow['tuesday'])) { echo 'Tuesday'; } else { echo 'No data'; }?>"> Tuesday</td>
                                <td><input name="tues_timein" type="time" class="time-input" id="time3"  value="<?php if(isset($schedrow['tues_timein'])&& !empty($schedrow['tues_timein'])) { echo $schedrow['tues_timein']; } else {echo 'No data'; }?>"></td>
                                <td><input name="tues_timeout" type="time" class="time-input" id="time4"  value="<?php if(isset($schedrow['tues_timeout'])&& !empty($schedrow['tues_timeout'])) { echo $schedrow['tues_timeout']; } else {echo 'No data'; }?>"></td>
                                <td><input name ="tues_wfh" type="checkbox" class="checkbox-lg" value="WFH"></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox" name="wednesday"  id="checkbox1" onclick="toggleInputs(this)" value="<?php if(isset($schedrow['wednesday'])&& !empty($schedrow['wednesday'])) { echo 'Wednesday'; } else { echo 'No data'; }?>"> Wednesday</td>
                                <td><input name="wed_timein" type="time" class="time-input" id="time5"  value="<?php if(isset($schedrow['wed_timein'])&& !empty($schedrow['wed_timein'])) { echo $schedrow['wed_timein']; } else {echo 'No data'; }?>"></td>
                                <td><input name="wed_timeout" type="time" class="time-input" id="time6"  value="<?php if(isset($schedrow['wed_timeout'])&& !empty($schedrow['wed_timeout'])) { echo $schedrow['wed_timeout']; } else {echo 'No data'; }?>"></td>
                                <td><input name ="wed_wfh" type="checkbox" class="checkbox-lg" value="WFH"></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox" name="thursday" value="<?php if(isset($schedrow['thursday'])&& !empty($schedrow['thursday'])) { echo 'Thursday'; } else { echo 'No data'; }?>" id="checkbox1" onclick="toggleInputs(this)">  Thursday </td>
                                <td><input name="thurs_timein" type="time" class="time-input" id="time7"  value="<?php if(isset($schedrow['thurs_timein'])&& !empty($schedrow['thurs_timein'])) { echo $schedrow['thurs_timein']; } else {echo 'No data'; }?>"></td>
                                <td><input name="thurs_timeout" type="time" class="time-input" id="time8" value="<?php if(isset($schedrow['thurs_timeout'])&& !empty($schedrow['thurs_timeout'])) { echo $schedrow['thurs_timeout']; } else {echo 'No data'; }?>"></td>
                                <td><input name ="thurs_wfh" type="checkbox" class="checkbox-lg" value="WFH"></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" class="checkbox" name="friday" value="<?php if(isset($schedrow['friday'])&& !empty($schedrow['friday'])) { echo 'Friday'; } else { echo 'No data'; }?>" id="checkbox1" onclick="toggleInputs(this)"> Friday</td>
                                <td><input name="fri_timein" type="time" class="time-input" id="time9"  value="<?php if(isset($schedrow['fri_timein'])&& !empty($schedrow['fri_timein'])) { echo $schedrow['fri_timein']; } else {echo 'No data'; }?>"></td>
                                <td><input name="fri_timeout" type="time" class="time-input" id="time10"  value="<?php if(isset($schedrow['fri_timeout'])&& !empty($schedrow['fri_timeout'])) { echo $schedrow['fri_timeout']; } else {echo 'No data'; }?>"></td>
                                <td><input name ="fri_wfh" type="checkbox" class="checkbox-lg" value="WFH"></td>
                            </tr>
                            <tr>
                            <td><input type="checkbox" class="checkbox" name="saturday" value="<?php if(isset($schedrow['saturday'])&& !empty($schedrow['saturday'])) { echo 'Saturday'; } else { echo 'No data'; }?>"id="checkbox1" onclick="toggleInputs(this)"> Saturday</td>
                            <td><input name="sat_timein" type="time" class="time-input" id="time11"  value="<?php if(isset($schedrow['sat_timein'])&& !empty($schedrow['sat_timein'])) { echo $schedrow['sat_timein']; } else {echo 'No data'; }?>"></td>
                                <td><input name="sat_timeout" type="time" class="time-input" id="time12"  value="<?php if(isset($schedrow['sat_timeout'])&& !empty($schedrow['sat_timeout'])) { echo $schedrow['sat_timeout']; } else {echo 'No data'; }?>"></td>
                                <td><input name ="sat_wfh" type="checkbox" class="checkbox-lg" value="WFH"></td>
                            </tr>
                            <tr>
                            <td><input type="checkbox" class="checkbox" name="sunday" value="<?php if(isset($schedrow['sunday'])&& !empty($schedrow['sunday'])) { echo 'Sunday'; } else { echo 'No data'; }?>" id="checkbox1" onclick="toggleInputs(this)" > Sunday</td>
                            <td><input name="sun_timein" type="time" class="time-input" id="time13"  value="<?php  if(isset($schedrow['sun_timein'])&& !empty($schedrow['sun_timein'])) { echo $schedrow['mon_timein']; } else echo 'No data';?>"></td>
                                <td><input name="sun_timeout" type="time" class="time-input" id="time14"  value="<?php if(isset($schedrow['sun_timeout'])&& !empty($schedrow['sun_timeout'])) { echo $schedrow['sun_timeout']; } else {echo 'No data'; }?>"></td>
                                <td><input name ="sun_wfh" type="checkbox" class="checkbox-lg" value="WFH"></td>
                            </tr>
                            <tr>
                                <td ><input type="checkbox" name="flexible" id="" class="checkbox-lgs" value="Flexible"> Flexible</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                 <div class="schedule-extras">
                    <div>
                        <div class="schedule-gracePeriods">
                                <div>
                                    <input type="checkbox" id="enable-number-inputs" class="checkbox-lg" >
                                    <label for="grace_period">Grace Period</label>
                                </div>
                                <div>
                                    <input class="numbox" id="my-number-input" type="number" name="grace_period" placeholder="00:00" value="<?php if(isset($schedrow['grace_period'])&& !empty($schedrow['grace_period'])) { echo $schedrow['grace_period']; } else {echo 'No data'; }?>">
                                    <label for="graceperiod_minutes">Minutes</label>
                                </div>
                                
                            </div>
                            <div class="schedule-ots">
                                <div>
                                    <input type="checkbox" id="enable-number-input2" class="checkbox-lg" >
                                    <label for="ob_ot">Enable OT</label>
                                </div>
                                <div>
                                    <input class="numbox"  id="my-number-input2" type="number" name="sched_ot" placeholder="00:00"  value="<?php if(isset($schedrow['sched_ot'])&& !empty($schedrow['sched_ot'])) { echo $schedrow['sched_ot']; } else {echo 'No data'; }?>">
                                    <label for="ob_minutes">Minutes</label> 
                                </div>
                            </div>
                            <div class="schedule-holidays">
                                <input type="checkbox" name="sched_holiday" id="" class="checkbox-lg" value="Holiday Work">
                                <label for="ob_holiday">Holiday Work</label>
                            </div>
                        </div> 

                    </div>                   
                </div>

            </div>
       </div>
       </form> 