<?php

    $uname = $_GET['uname'];
    $uniqueID = $_GET['uniqueID'];
    echo $uniqueID;
    $strerr="";
    $message="";
    include_once('RepositoryV1.php');
    $objDBClass=new Repository();
    $connectionServer="timetracker";
    $objDBClass->OpenConnection($connectionServer,$strErr);
    if($strErr!=NULL){
        echo $strErr;
    }else{
        // $strSQL = "UPDATE timetable SET verified=1 WHERE  serial='$uniqueID' AND  taskname='$uname'";
        $strSQL = "INSERT INTO timetable (taskname,serial,starttime) values ('$uname','$uniqueID',NOW())";
        $objDBClass->ExecuteQuery($strSQL,$strerr);


    if($strerr!=NULL){
        echo $strerr;
      }else{
          echo $uname;
      }
    $objDBClass->CloseConnection();
    }


?>