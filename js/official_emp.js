function timevalidate(){
    let start_time = document.getElementById(start_time).value;
    let end_time = document.getElementById(end_time).value;


    if(start_time > end_time){
        alert('End Time must beyond to Start Time')
        document.getElementById("start_time").disabled = true;
        document.getElementById("end_time").disabled = true;
  
      }
    
      else if(start_time ==''){
        alert('You cannot insert below 9:00am ')
        document.getElementById("start_time").disabled = true;
        document.getElementById("end_time").disabled = true;
      }
      else {
    
        document.getElementById("start_time").disabled = false;
        document.getElementById("end_time").disabled = false;
      }

};


