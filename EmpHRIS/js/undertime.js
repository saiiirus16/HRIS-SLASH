function undertime_hours() {
  var start_time = document.getElementById("under_time_from_id").value;
  var end_time = document.getElementById("under_time_to_id").value;

  // Parse the start and end time into Date objects
  var start_date = new Date("1970-01-01T" + start_time);
  var end_date = new Date("1970-01-01T" + end_time);

  // If the start time is earlier than the end time, it means that the start time is on the previous day
  if (start_date < end_date) {
    start_date.setDate(start_date.getDate() - 1);
  }

  // Compute the time difference in milliseconds
  var time_diff_ms = start_date.getTime() - end_date.getTime();

  // Convert the time difference into hours and minutes
  var time_diff_hours = Math.floor(time_diff_ms / (1000 * 60 * 60));
  var time_diff_minutes = Math.floor((time_diff_ms / (1000 * 60)) % 60);

  // Format the total undertime as HH:MM
  var total_undertime = (time_diff_hours < 10 ? "0" : "") + time_diff_hours + ":" + (time_diff_minutes < 10 ? "0" : "") + time_diff_minutes;

  // Set the value of the total undertime input field
  document.getElementById("under_id").value = total_undertime;
}
