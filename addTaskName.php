<?php
    $taskName = $_GET['taskName'];
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
            $strSQL = "INSERT INTO task (taskName) values ('$taskName')";
            $objDBClass->ExecuteQuery($strSQL,$strerr);
        if($strerr!=NULL){
            echo $response = "0";
        }else{
            echo $response = "1";
        }
        $objDBClass->CloseConnection();
    }
?>