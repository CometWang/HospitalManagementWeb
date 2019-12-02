<?php
//display doctormsg
//require_once("getdoctor.php");
$firstname =$_GET['param1'];
$lastname= $_GET['param2'];
require_once('connection.php');
//connector("localhost","root","","jwan949assign2db");

$query1="SELECT hospital.hospitalName, doctor.licensedNum, doctor.firstName,doctor.lastName, doctor.licensedDate, doctor.specialty from doctor INNER JOIN hospital ON doctor.code=hospital.code where doctor.firstName='$firstname' and doctor.lastName='$lastname'";
$job = mysqli_query($GLOBALS['link'],$query1);
if(!$job){
    echo "Failed to connect to db ***from doctor with infor query";
    exit();  
}
while($row=mysqli_fetch_assoc($job)){
    $set[]=$row;
}

$output = "<div id=\"docmsg\">";
$output .= "<h1>" .$set[0]["firstName"] . "  ".$set[0]["lastName"] ."</h1>";  
$output .= "<p>Hospital Name: ".$set[0]["hospitalName"] ."<br>";
$output .= "License Number: ".$set[0]["licensedNum"] ."<br>";
$output .= "licensed Date : ".$set[0]["licensedDate"] ."<br>";
$output .= "Specialty: ".$set[0]["specialty"] ."</p>";
$output .= "</div>";

$final=file_get_contents('resultHandle.html');
    $zone=array("<p id=\"demo2\"></p>");
    $replace = array("<div id=\"docmsg\">$output</div>");
    $page=str_replace($zone, $replace,$final);
    
    echo $page;
    mysqli_free_result($job);
    mysqli_close($GLOBALS['link']);
?>

