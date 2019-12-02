<?php

require_once('connection.php');
//connector("localhost","root","","jwan949assign2db");

$query="SELECT firstName,lastName FROM doctor WHERE licensedNum IN (SELECT distinct doctor.licensedNum FROM doctor WHERE doctor.licensedNum not in (select doctorlicensedNum From treatment))";
$job=mysqli_query($GLOBALS['link'],$query);
    if(!$job){
        echo"<script type='text/javascript'>alert('No data');window.location.href='MainPage.html'</script>"; 
        mysqli_free_result($job);
        exit();
    }
    while($row = mysqli_fetch_assoc($job)){
        $set[] = $row;
   }
   $len = count($set);

   //form a table for result page
  
   $output="<table>";
   $output .= "<tr>";
   $output .= " <th> First Name </th> <th> Last Name </th>  ";
   $output .="</tr>";
   for($i=0; $i<$len; $i++){
      $output .= "<tr>";
      //$output .=  "<td value='".$set[$i]['firstName']."' onclick='".displaydocmsg()."' width=30%>". $set[$i]['firstName'] ."</td>";
      $output .=  "<td   width=30%>".$set[$i]['firstName']."</td>";
      $output .=  "<td   width=30%>". $set[$i]['lastName']."</td>";
 
   }
   $output .= "</table>";
   $final=file_get_contents('resultHandle.html');
   $zone=array("<p id=\"demo4\"></p>");
   $replace = array("<table>$output</table>");
   $page=str_replace($zone, $replace,$final);
   
   echo $page;
   mysqli_free_result($job);
   mysqli_close($GLOBALS['link']);
?>