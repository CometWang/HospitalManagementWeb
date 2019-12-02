<?php
require_once('connection.php');
//connector("localhost","root","","jwan949assign2db");

$fn=$_POST["docfn"];
$ln=$_POST["docln"];
$licenNum=$_POST["doclicenNum"];
$hospitalcode=$_POST["hospitalcode"];
$specialty=$_POST["specialty"];

//verify user input
if(!empty($_POST["specialty"]) && !empty($_POST["licendate"])){
    $specialty=$_POST["specialty"];
    $date=$_POST["licendate"];
  
    $query="INSERT INTO doctor (firstName, lastName, licensedNum, code, specialty,licensedDate) VALUES('$fn','$ln','$licenNum','$hospitalcode','$specialty','$date')";
}
else if(empty($_POST["specialty"]) and empty($_POST["licendate"]))
{
    $query="INSERT INTO doctor (firstName, lastName, licensedNum, code) VALUES('$fn','$ln','$licenNum','$hospitalcode')";
}
else if(!empty($_POST["licendate"])&& empty($_POST["specialty"])){
   $date=$_POST["licendate"];
   $query="INSERT INTO doctor (firstName, lastName, licensedNum, code,licensedDate) VALUES('$fn','$ln','$licenNum','$hospitalcode','$date')";
 
}
else{
    $specialty=$_POST["specialty"];
    $query="INSERT INTO doctor (firstName, lastName, licensedNum, code,specialty) VALUES('$fn','$ln','$licenNum','$hospitalcode','$specialty')";

}


//$query="INSERT INTO doctor (firstName, lastName, licensedNum, code, specialty,licensedDate) VALUES('$fn','$ln','$licenNum','$hospitalcode','$specialty','$date')";
$job=mysqli_query($GLOBALS['link'],$query);
$amount=mysqli_affected_rows($GLOBALS['link']);
$message="Failed to insert duplicated data!";
if(!$job){
    echo "<script type='text/javascript'>alert('$message');window.location.href='editdata.html'</script>";

        exit();
    }
if($amount > 0){
        echo "<script type='text/javascript'>alert('Success!');window.location.href='editdata.html'</script>";
        exit();
    }

 mysqli_close($GLOBALS['link']);  


?>