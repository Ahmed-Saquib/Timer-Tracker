<style>
.countup {
  text-align: center;
  margin-bottom: 20px;
}
.countup .timeel {
  display: inline-block;
  padding: 10px;
  background: #151515;
  margin: 0;
  color: white;
  min-width: 2.6rem;
  margin-left: 13px;
  border-radius: 10px 0 0 10px;
}
.countup span[class*="timeRef"] {
  border-radius: 0 10px 10px 0;
  margin-left: 0;
  background: #e8c152;
  color: black;
}
</style>


<?php
date_default_timezone_set('Asia/Dhaka');
$today = date("F j, Y h:i:s");
$id = "countup1";
?>
<div class="cleanslate w24tz-current-time w24tz-middle" style="display: inline-block !important; visibility: hidden !important; min-width:300px !important; min-height:145px !important;">
<p><a href="//24timezones.com/Dhaka/time" style="text-decoration: none" class="clock24" id="tz24-1624356701-c173-eyJob3VydHlwZSI6IjEyIiwic2hvd2RhdGUiOiIxIiwic2hvd3NlY29uZHMiOiIxIiwiY29udGFpbmVyX2lkIjoiY2xvY2tfYmxvY2tfY2I2MGQxYjc1ZGRjMDU4IiwidHlwZSI6ImRiIiwibGFuZyI6ImVuIn0=" title="Current time in Dhaka" target="_blank" rel="nofollow"></a></p><div id="clock_block_cb60d1b75ddc058"></div></div>
<script type="text/javascript" src="//w.24timezones.com/l.js" async></script>

<button type="button"  onClick = "Time('<?php echo($id); ?>')">Start timer</button>
<button type="button"  onClick = "myStopFunction()">Stop timer</button>
<button type="button"  onClick = "saveRecordFunction()">Save record</button>

<div class="countup" id="countup1">
  <span class="timeel days">00</span>
  <span class="timeel timeRefDays">days</span>
  <span class="timeel hours">00</span>
  <span class="timeel timeRefHours">hours</span>
  <span class="timeel minutes">00</span>
  <span class="timeel timeRefMinutes">minutes</span>
  <span class="timeel seconds">00</span>
  <span class="timeel timeRefSeconds">seconds</span>
</div>
<script>

function Time(id) {
  // Month Day, Year Hour:Minute:Second, id-of-element-container
  var today = new Date();
  var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
  var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
  var dateTime = date+' '+time;
  countUpFromTime(dateTime, id); // ****** Change this line!
};


function countUpFromTime(countFrom, id) {

  countFrom = new Date(countFrom).getTime();
  var now = new Date(),
      countFrom = new Date(countFrom),
      timeDifference = (now - countFrom);

  var secondsInADay = 60 * 60 * 1000 * 24,
      secondsInAHour = 60 * 60 * 1000;

  days = Math.floor(timeDifference / (secondsInADay) * 1);
  hours = Math.floor((timeDifference % (secondsInADay)) / (secondsInAHour) * 1);
  mins = Math.floor(((timeDifference % (secondsInADay)) % (secondsInAHour)) / (60 * 1000) * 1);
  secs = Math.floor((((timeDifference % (secondsInADay)) % (secondsInAHour)) % (60 * 1000)) / 1000 * 1);

  var idEl = document.getElementById(id);
  idEl.getElementsByClassName('days')[0].innerHTML = days;
  idEl.getElementsByClassName('hours')[0].innerHTML = hours;
  idEl.getElementsByClassName('minutes')[0].innerHTML = mins;
  idEl.getElementsByClassName('seconds')[0].innerHTML = secs;

  clearTimeout(countUpFromTime.interval);
  countUpFromTime.interval = setTimeout(function(){ countUpFromTime(countFrom, id); }, 1000);
}
function myStopFunction() {
  clearTimeout(countUpFromTime.interval);
}

</script>