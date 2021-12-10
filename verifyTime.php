<?php

    $taskName = $_GET['taskName'];
    $uniqueID = $_GET['uniqueID'];
    //echo $uniqueID;
    $strerr="";
    $message="";
    include_once('RepositoryV1.php');
    $objDBClass=new Repository();
    $connectionServer="timetracker";
    $objDBClass->OpenConnection($connectionServer,$strErr);
    if($strErr!=NULL){
        echo $strErr;
    }else{
        $strSQL = "UPDATE timetable SET saveRecord=1 WHERE  serial='$uniqueID' AND  taskname='$taskName'";
        $objDBClass->ExecuteQuery($strSQL,$strerr);
    if($strerr!=NULL){
        echo $strerr;
        }else{
          echo $uname;
        }
        $objDBClass->CloseConnection();
    }
?>