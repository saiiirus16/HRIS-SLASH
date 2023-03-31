// search bar 

const searchBar = document.getElementById("search_bar");
const dataTable = document.getElementById("data_table");
const headerRow = dataTable.querySelector("thead tr");

searchBar.addEventListener("input", () => {
  const searchTerm = searchBar.value.toLowerCase();
  const rows = dataTable.getElementsByTagName("tr");
  for (let i = 0; i < rows.length; i++) {
    if (rows[i] === headerRow) {
      // always display the header row
      headerRow.style.display = "";
    }else {
    const cells = rows[i].getElementsByTagName("td");
    let matchFound = false;
    for (let j = 0; j < cells.length; j++) {
      const cellText = cells[j].textContent.toLowerCase();
      if (cellText.indexOf(searchTerm) > -1) {
        matchFound = true;
        break;
      }
    }
    if (matchFound) {
      rows[i].style.display = "";
    } else {
      rows[i].style.display = "none";
    }
   }
  }
});



function strvalidate() {
    let today = new Date(); // Get the current date and time
    let id_inpt_strTime = new Date(document.getElementById("id_inpt_strdate").value); // Get the date input value as a Date object
    //let id_inpt_strTime = new Date(document.getElementById("id_inpt_strdate").value.replace(/-/g, '\/'));

    if (id_inpt_strTime.getTime() < today.getTime()) { // Compare the two dates using getTime()

        alert('You cannot select the date today and the past dates');
        document.getElementById("id_btnsubmit").style.cursor = "no-drop";
        document.getElementById("id_btnsubmit").disabled = true;      
        document.getElementById("id_inpt_enddate").disabled = true;
    } 

    else {
        document.getElementById("id_btnsubmit").style.cursor = "pointer";
        document.getElementById("id_btnsubmit").disabled = false;
        document.getElementById("id_inpt_enddate").disabled = false;
    }
  }

  function endvalidate() {
    let id_inpt_strTime1 = new Date(document.getElementById("id_inpt_strdate").value);
    let id_inpt_endTime1 = new Date(document.getElementById("id_inpt_enddate").value);
    let id_leavePeriod = document.getElementById("id_leavePeriod");
    let leavePeriodText = id_leavePeriod.options[id_leavePeriod.selectedIndex].text;
  
    if (leavePeriodText === 'Half Day') {
      if (id_inpt_strTime1.getTime() !== id_inpt_endTime1.getTime()) {
        alert("For half-day leaves, the start and end dates must be the same.");
        document.getElementById("id_btnsubmit").style.cursor = "no-drop";
        document.getElementById("id_btnsubmit").disabled = true;
      } else {
        if (id_inpt_strTime1.getTime() > id_inpt_endTime1.getTime()) {
          alert("Please set the End Date not before the Start Date");
          document.getElementById("id_btnsubmit").style.cursor = "no-drop";
          document.getElementById("id_btnsubmit").disabled = true;
        } else {
          document.getElementById("id_btnsubmit").style.cursor = "pointer";
          document.getElementById("id_btnsubmit").disabled = false;
        }
      }
    } else { //if fullday
      if (id_inpt_strTime1.getTime() === id_inpt_endTime1.getTime()) {
        alert("For Full-day leaves, the start and end dates must NOT be the same.");
        document.getElementById("id_btnsubmit").style.cursor = "no-drop";
        document.getElementById("id_btnsubmit").disabled = true;
      }else{
    //else
    if (id_inpt_strTime1.getTime() > id_inpt_endTime1.getTime()) {
      alert("Please set the End Date not before the Start Date");
      document.getElementById("id_btnsubmit").style.cursor = "no-drop";
      document.getElementById("id_btnsubmit").disabled = true;
    } else {
      document.getElementById("id_btnsubmit").style.cursor = "pointer";
      document.getElementById("id_btnsubmit").disabled = false;
    }
      }
      
    }
  }
  function halfdaysides(){
    let halfday_side = document.getElementById('id_leavePeriod').value;

    if(halfday_side === 'Half Day'){
      document.getElementById('id_chckfirsthalf').style.display = "flex";
      document.getElementById('id_chckSecondhalf').style.display = "flex";
    }
    else{
      document.getElementById('id_chckfirsthalf').style.display = "none";
      document.getElementById('id_chckSecondhalf').style.display = "none";
    }
  }

  const firstHalfCheckbox = document.querySelector('input[name="firstHalf"]');
  const secondHalfCheckbox = document.querySelector('input[name="secondHalf"]');
  firstHalfCheckbox.addEventListener('click', function() {
      secondHalfCheckbox.checked = !this.checked;
  });
  secondHalfCheckbox.addEventListener('click', function() {
      firstHalfCheckbox.checked = !this.checked;
  });