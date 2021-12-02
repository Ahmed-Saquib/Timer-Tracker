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
  // This unique id will be given to each task and store in database
?>
<html>
  <head>
    <link rel="stylesheet" href="timetracker.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="//w.24timezones.com/l.js" async></script>

    <!------ Include the above in your HEAD tag ---------->
    <style>
      body {
        background-color: #dddddd;
      }
    </style>
  </head>
  <body>
    <div class="container-fluid home-main">
        <div class="countupp" id="countupp1">
          <span class="timeel timeRefDays">D</span>
          <span class="timeel timeRefHours">H</span>
          <span class="timeel timeRefMinutes">M</span>
          <span class="timeel timeRefSeconds">S</span>
        </div>
        <div class="countup" id="countup1">
          <span class="timeel days">00</span>
          <span class="timeel hours">00</span>
          <span class="timeel minutes">00</span>
          <span class="timeel seconds">00</span>
        </div>
        <!--<h2>Kshiti Ghelani <span class="blinker">.</span></h2> 
        <button type="button" class="btn btn-default">View Profile</button> -->
      </div>
      <div class="container-fluid home-content1">
        <div class="row">
          <div class="col-md-6 content1-left">

            <!-- real time clock code -->

            <div class="cleanslate w24tz-current-time w24tz-middle" style="display: inline-block !important; background: #dddddd !important; visibility: hidden !important; min-width:350px !important; min-height:145px !important;">
            <p><a href="//24timezones.com/Dhaka/time" style="text-decoration: none" class="clock24" id="tz24-1624356701-c173-eyJob3VydHlwZSI6IjEyIiwic2hvd2RhdGUiOiIxIiwic2hvd3NlY29uZHMiOiIxIiwiY29udGFpbmVyX2lkIjoiY2xvY2tfYmxvY2tfY2I2MGQxYjc1ZGRjMDU4IiwidHlwZSI6ImRiIiwibGFuZyI6ImVuIn0=" title="Current time in Dhaka" target="_blank" rel="nofollow"></a></p><div id="clock_block_cb60d1b75ddc058"></div></div>
            <h3>Give a Task name and start the timer</h3>

            <input name="uname" class="form-control" placeholder="Task name" id= "uname" type="text"  >
            <input name="uniqueID"   id= "uniqueID"  value ="<?php echo $uniqueID ?>"  type="hidden" disabled>
            <input type="button" class="btn btn-primary btn-block " id="startTime" value="Start timer" onclick="StartTime()">
            <input type="button" class="btn btn-primary btn-block " id="endTime" value="Stop timer" onclick="StopTime()" disabled>
            <button type="button"  onclick = saveRecord()>Save record</button>

            <h1>Add Task options 🡇</h1>
            <input name="Main task" class="form-control" placeholder="Main task name" id= "mainTaskName" type="text">
            <button type="button"  onclick = saveMainTaskName()>Add</button>
            <input name="Sub task" class="form-control" placeholder="Sub task name" id= "subTaskName" type="text">
            <button type="button"  onclick = saveSubTaskName()>Add</button>
          </div>
          <div class="col-md-6 content1-right">
            <!-- Quotes !!! -->
            <p>"Time is money." – Benjamin Franklin.</p>
            <p>"Better three hours too soon than a minute too late." – William Shakespeare.</p>
            <p>Replace – Netflix with Sleep, TV with Exercise, Overthinking with Action, Blame with Responsibility.</p>
          </div>
        </div>
      </div>
      <div class="container-fluid home-content2">
        <p><span>News</span> and <span>announcements</span> for all things <span>Bootstrap</span>, including new <span>releases</span> and <span>Bootstrap Themes</span>.</p>
      </div>
      
    <script>

      function StartTime() {
        var uname = document.getElementById('uname').value;
        var uniqueID = document.getElementById('uniqueID').value;
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
    </script>
  </body>
</html>