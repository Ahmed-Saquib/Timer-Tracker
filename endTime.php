<?php

    $taskName = $_GET['taskName'];
    $uniqueID = $_GET['uniqueID'];
    $strerr="";
    $message="";
    include_once('RepositoryV1.php');
    $objDBClass=new Repository();
    $connectionServer="timetracker";
    $objDBClass->OpenConnection($connectionServer,$strErr);
    if($strErr!=NULL){
        echo $strErr;
    }else{
        $strSQL = "UPDATE timetable SET endtime = NOW() WHERE  serial='$uniqueID' AND  taskname='$taskName'";
        //echo $strSQL;
        $objDBClass->ExecuteQuery($strSQL,$strerr);
        $SQLupdate = "SELECT TIMEDIFF (endtime,starttime)  from timetable WHERE serial = '$uniqueID' AND  taskname='$taskName'";
        //echo $SQLupdate;
        $Result= $objDBClass->RetriveData($SQLupdate,$strerr);
        //echo $Result[0][0];
        $time = $Result[0][0];
        //echo $time;
        $finalSQL = "UPDATE timetable SET TimeDiff = '$time' WHERE  serial='$uniqueID' AND  taskname='$taskName'";
        //echo $finalSQL;
        $objDBClass->ExecuteQuery($finalSQL,$strerr);

    if($strerr!=NULL){
        echo $strerr;
      }else{
          echo 'successful';
      }
    $objDBClass->CloseConnection();
    }


?>