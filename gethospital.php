<?php
require_once('connection.php');


$query="SELECT hospital.hospitalName, doctor.firstName, doctor.lastName FROM hospital INNER JOIN doctor where hospital.head=doctor.licensedNum";
$job=mysqli_query($GLOBALS['link'],$query);
if(!$job){
        echo "Failed to connect to db";
        exit();  
}
while($row = mysqli_fetch_assoc($job)){
         $set[] = $row;
}
$len = count($set);
$output="<table>";
    $output .= "<tr>";
    $output .= " <th> Hospital Name </th> <th> Headman First Name </th><th> Headman Last Name </th>  ";
    $output .="</tr>";
    for($i=0; $i<$len; $i++){
       $output .= "<tr>";
       $output .=  "<td width=30%>". $set[$i]['hospitalName'] ."</td>";
       $output .=  "<td width=30%>". $set[$i]['firstName'] ."</td>";
       $output .=  "<td width=30%>". $set[$i]['lastName']."</td>";
  
    }
    $output .= "</table>";
    $final=file_get_contents('hospitalresult.html');
    $zone=array("<p id=\"demo\"></p>");
    $replace = array("<table>$output</table>");
    $page=str_replace($zone, $replace,$final);
    
    echo $page;
    mysqli_free_result($job);
    mysqli_close($GLOBALS['link']);

?>