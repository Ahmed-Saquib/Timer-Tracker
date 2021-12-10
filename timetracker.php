<?php
  $strerr="";
  $message="";
  include_once('RepositoryV1.php');
  $objDBClass=new Repository();
  $connectionServer="timetracker";
  $objDBClass->OpenConnection($connectionServer,$strErr);

  $TaskSQL="SELECT taskName FROM task";
  $TaskArray=$objDBClass->RetriveData($TaskSQL,$strErr);

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
  $id = "countup1";
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
      #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      #customers td, #customers th {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: center;
      }

      

      #customers tr:hover {background-color: #f2f2f2;}

      #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #5812C5;
        color: white;
        border: 1px solid black;

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

            <select name="taskName" class="form-control" Id="taskName">
              <option value="">Select Task/Project</option>
              <?php for($i=0;$i<count($TaskArray);$i++){ ?>
              <option value="<?php echo($TaskArray[$i][0])?>"><?php echo($TaskArray[$i][0])?></option>
              <?php } ?>
            </select>

            <select name="jobType" id="jobType">
              <option value="">Select type</option>
              <option value="Personal">Personal</option>
              <option value="Professional">Professional</option>
              <option value="Academic">Academic</option>
              <option value="Others">Others</option>
            </select>

            <input name="taskDetails" class="form-control" placeholder="Details" id= "taskDetails" type="text"  >
            <br>
            <br>
            <input name="uniqueID"   id= "uniqueID"  value ="<?php echo $uniqueID ?>"  type="hidden" disabled>
            <input type="button" class="btn btn-primary btn-block " id="startTime" value="Start timer" onclick="StartTime('<?php echo($id); ?>')">
            <input type="button" class="btn btn-primary btn-block " id="endTime" value="Stop timer" onclick="StopTime()" disabled>
            <button type="button"  id="saveRecord" onclick = saveRecord() disabled>Save record</button>
            <button type="button"  id="refresh" onclick = refresh()>Refresh</button>
            <br>
            <br>
            <details>
            <summary>Click for options</summary>
            <br>
            <input name="taskName" class="form-control" placeholder="Project / Task name" id= "taskName" type="text" required>
            <button type="button"  onclick = saveTaskName()>Add</button>
            <p id="response"> </p>
            </details>
          </div>
          <div class="col-md-6 content1-right">
            <table id="customers">
              <tr>
                <th>Task/Project Name</th>
                <th>Type</th>
                <th>Duration</th>
              </tr>
              <tr>
                <td>Alfreds Futterkiste</td>
                <td>Maria Anders</td>
                <td>Germany</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="container-fluid home-content2">
        <p><span>News</span> and <span>announcements</span> for all things <span>Bootstrap</span>, including new <span>releases</span> and <span>Bootstrap Themes</span>.</p>
      </div>
      
    <script>

      function StartTime(id) {
        var taskName = document.getElementById('taskName').value;
        var uniqueID = document.getElementById('uniqueID').value;
        var jobType = document.getElementById('jobType').value;
        var taskDetails = document.getElementById('taskDetails').value;
        jQuery.ajax({
          url: 'insertTime.php',
          type: 'GET',
          dataType: 'html',
          data:  "taskName=" + taskName + "&uniqueID=" + uniqueID + "&jobType=" + jobType + "&taskDetails=" + taskDetails,
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

      function saveTaskName(){
        var taskName = document.getElementById('taskName').value;      
        if(taskName == ""){
          $("#response").html("<span style='color: red; font-size: 80%;'>Error: Task / Project name shouldn't be empty !</span>");
        }else{
          jQuery.ajax({
            url: 'addTaskName.php',
            type: 'GET',
            dataType: 'html',
            data:  "taskName=" + taskName,

            success: function (response) {
              if(response=='1'){
                $("#response").html("<span style='color: green; font-size: 80%;'>Task/Project added !</span>");
              }else{
                $("#response").html("<span style='color: red; font-size: 80%;'>Error: couldn't add !</span>");
              }
            },
            error: function (response) {
              alert("Some error occured"+response);
            }
          });
        }
      }

      function saveRecord(){
        var taskName = document.getElementById('taskName').value;
        var uniqueID = document.getElementById('uniqueID').value;
        jQuery.ajax({
          url: 'verifyTime.php',
          type: 'GET',
          dataType: 'html',
          data:  "taskName=" + taskName + "&uniqueID=" + uniqueID,

          success: function (response) {
            console.log(response);
          },
          error: function (response) {
            alert("Some error occured"+response);
          }
        });
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

      function StopTime() {
        var taskName = document.getElementById('taskName').value;
        var uniqueID = document.getElementById('uniqueID').value;
        jQuery.ajax({
          url: 'endTime.php',
          type: 'GET',
          dataType: 'html',
          data:  "taskName=" + taskName + "&uniqueID=" + uniqueID,

          success: function (response) {
            console.log(response);
            document.getElementById("startTime").disabled = false;
            document.getElementById("endTime").disabled = true;
            document.getElementById("saveRecord").disabled = false;
          },
          error: function (response) {
            alert("Some error occured"+response);
          }
        });
        clearTimeout(countUpFromTime.interval);
      };	

      function refresh(){
        location.reload();
      }
    </script>
  </body>
</html>