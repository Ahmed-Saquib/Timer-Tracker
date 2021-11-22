<style>
  .countupp {
  text-align: center;
  margin-bottom: 20px;
}
.countupp .timeel {
  display: inline-block;
  padding: 30px;
  padding-bottom: 50px;
  background: #151515;
  margin: 0;
  color: white;
  min-width: 2.6rem;
  margin-left: 13px;
  border-radius: 10px 10px 10px 10px;
}

.countup {
  text-align: center;
  font-size: 40px;
}
.countup .timeel {
  display: inline-block;
  padding: 30px;
  padding-bottom: 50px;
  background: #151515;
  margin: 0;
  color: white;
  min-width: 2.6rem;
  margin-left: 7px;
  border-radius: 10px 10px 10px 10px;
}

</style>


<?php
$permitted_chars = '0123456789';
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}
$uniqueID = generate_string($permitted_chars, 4);
echo $uniqueID;
date_default_timezone_set('Asia/Dhaka');
$today = date("F j, Y h:i:s");
$id = "countup1";
?>
<div class="cleanslate w24tz-current-time w24tz-middle" style="display: inline-block !important; visibility: hidden !important; min-width:300px !important; min-height:145px !important;">
<p><a href="//24timezones.com/Dhaka/time" style="text-decoration: none" class="clock24" id="tz24-1624356701-c173-eyJob3VydHlwZSI6IjEyIiwic2hvd2RhdGUiOiIxIiwic2hvd3NlY29uZHMiOiIxIiwiY29udGFpbmVyX2lkIjoiY2xvY2tfYmxvY2tfY2I2MGQxYjc1ZGRjMDU4IiwidHlwZSI6ImRiIiwibGFuZyI6ImVuIn0=" title="Current time in Dhaka" target="_blank" rel="nofollow"></a></p><div id="clock_block_cb60d1b75ddc058"></div></div>
<script type="text/javascript" src="//w.24timezones.com/l.js" async></script>
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

</div>
        <input name="uname" class="form-control" placeholder="Username" id= "uname" type="text"  >

        <input name="uniqueID"   id= "uniqueID"  value ="<?php echo $uniqueID ?>"  type="number" disabled>
  </div>




<input type="button" class="btn btn-primary btn-block " id="startTime" value="Start time" onClick = "StartTime('<?php echo($id); ?>')">

<input type="button" class="btn btn-primary btn-block " id="endTime" value="Stop" onclick="StopTime()" disabled>



<button type="button"  onclick = saveRecord()>Save record</button>
<div class="countupp" id="countupp1">
  <span class="timeel timeRefDays">DD</span>
  <span class="timeel timeRefHours">HH</span>
  <span class="timeel timeRefMinutes">MM</span>
  <span class="timeel timeRefSeconds">SS</span>
</div>


<div class="countup" id="countup1">
  <span class="timeel days">00</span>
  <span class="timeel hours">00</span>
  <span class="timeel minutes">00</span>
  <span class="timeel seconds">00</span>
</div>
<script>

function StartTime(id) {

  var uname = document.getElementById('uname').value;
  var uniqueID = document.getElementById('uniqueID').value;
  console.log(uniqueID);
              jQuery.ajax({
                url: 'insertTime.php',
                type: 'GET',
                dataType: 'html',
                data:  "uname=" + uname + "&uniqueID=" + uniqueID,

                success: function (response) {
                 console.log(response);
                 document.getElementById("startTime").disabled = true;
                 document.getElementById("endTime").disabled = false;
                },
                error: function (response) {
                  alert("Some error occured"+response);
                }
              });

  // Month Day, Year Hour:Minute:Second, id-of-element-container
  var today = new Date();
  var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
  var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
  var dateTime = date+' '+time;
  countUpFromTime(dateTime, id);
  //insertTime();

};
function saveRecord(){
  var uname = document.getElementById('uname').value;
  var uniqueID = document.getElementById('uniqueID').value;
              jQuery.ajax({
                url: 'verifyTime.php',
                type: 'GET',
                dataType: 'html',
                data:  "uname=" + uname + "&uniqueID=" + uniqueID,

                success: function (response) {
                 console.log(response);
                },
                error: function (response) {
                  alert("Some error occured"+response);
                }
              });
}
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
function StopTime() {

  var uname = document.getElementById('uname').value;
  var uniqueID = document.getElementById('uniqueID').value;
              jQuery.ajax({
                url: 'endTime.php',
                type: 'GET',
                dataType: 'html',
                data:  "uname=" + uname + "&uniqueID=" + uniqueID,

                success: function (response) {
                 console.log(response);
                 document.getElementById("startTime").disabled = false;
                 document.getElementById("endTime").disabled = true;
                },
                error: function (response) {
                  alert("Some error occured"+response);
                }
              });

  clearTimeout(countUpFromTime.interval);

}
function saveRecordFunction(){

}

</script>