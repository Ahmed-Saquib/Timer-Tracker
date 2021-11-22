<?php
$strerr="";
$message="";
include_once('RepositoryV1.php');
$objDBClass=new Repository();
$connectionServer="timetracker";
$objDBClass->OpenConnection($connectionServer,$strErr);
if($strErr!=NULL){
    echo $strErr;
}else{
    

}
if(isset($_POST['submit']) && !empty($_POST['submit'])) {
    echo "connected";
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $date = $_POST['birthday'];
    
    $x=2;
    $p='D';
    $q=$x."".$p;
    echo $q;

    $enddate = new DateTime($date);
    $enddate->add(new DateInterval("P$q"));
    $enddate=$enddate->format('Y-m-d H:i:s');
    echo $enddate  ;


    $strSQL = "INSERT INTO test (fname,lname,startdate,enddate) 
        values ('$fname','$lname','$date','$enddate')";
        $objDBClass->ExecuteQuery($strSQL,$strerr);
    echo $strSQL;
        if($strerr!=NULL){
            echo $strerr;
        }
}else{
    echo"error";
}

$objDBClass->CloseConnection();



?>
<!DOCTYPE html>
<html>
<body>

<h2>HTML Forms</h2>

<form method="post" action="" > 
  <label for="fname">First name:</label><br>
  <input type="text" id="fname" name="fname" value="John"><br>
  <label for="lname">Last name:</label><br>
  <input type="text" id="lname" name="lname" value="Doe"><br><br>
  <label for="birthday">Birthday:</label>
  <input type="datetime-local" id="birthday" name="birthday">
  <input type="submit" id="submit" name="submit" value="submit">
</form> 


</body>
</html>