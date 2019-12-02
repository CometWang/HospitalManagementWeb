<?php
require_once('connection.php');

$ohipnum=$_POST["ohipnum"];

//check if the patient exist
$query3="SELECT count(*) as amount FROM patient WHERE ohip='$ohipnum'";
$check=mysqli_query($GLOBALS['link'],$query3);

while($new = mysqli_fetch_assoc($check)){
    $amount=$new['amount'];
}
if($amount==0){
    echo"<script type='text/javascript'>alert('Patient not exist');window.location.href='MainPage.html'</script> ";
    mysqli_close($GLOBALS['link']);
    exit();
}
mysqli_free_result($check);

//Since every patient must have a doctor, display their infor
$query="SELECT patient.firstName AS patientfn, patient.lastName AS patientln, doctor.firstName AS docfn, doctor.lastName AS docln FROM treatment INNER JOIN patient ON patient.ohip=treatment.ohip INNER JOIN doctor ON doctor.licensedNum=treatment.doctorlicensedNum WHERE treatment.ohip=$ohipnum";
$job=mysqli_query($GLOBALS['link'],$query);
    if(!$job){
        echo"<script type='text/javascript'>alert('The patient you search doesn't exist! Please check input!');window.location.href='MainPage.html'</script>"; 
        mysqli_free_result($job);
        exit();
    }

    while($row = mysqli_fetch_assoc($job)){
        $set[] = $row;
   }
   
$output = "<div id=\"patientmsg\">";
$output .= "<h1>Patient:   " .$set[0]["patientfn"] ."  ". $set[0]["patientln"]."<br>" ;  
$output .= "Doctor:  ".$set[0]["docfn"] ."  ". $set[0]["docln"] ."<br></h1>";

$output .= "</div>";

$final=file_get_contents('patientinfor.html');
    $zone=array("<p id=\"demo\"></p>");
    $replace = array("<div id=\"patientmsg\">$output</div>");
    $page=str_replace($zone, $replace,$final);
    
    echo $page;
    mysqli_free_result($job); 
    mysqli_close($GLOBALS['link']);


?>