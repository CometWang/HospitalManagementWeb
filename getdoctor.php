<?php
require_once('connection.php');
//connector("localhost","root","","jwan949assign2db");

$namechoice=$_POST["searchdoctor"];
if(!empty($sortchoice)){
$sortchoice=$_POST["sequence"];}

//if the sortchoice is empty then list the doctors by alphabetical order
//if the sortchoice is not empty then list the doctors by sortchoice order
if(empty($sortchoice)){
    $query = "SELECT lastName,firstName FROM doctor ORDER BY $namechoice";
    $job=mysqli_query($GLOBALS['link'],$query);
    if(!$job){
        echo "Failed to connect to db ***from doctor query";
        exit;  
    }
    while($row = mysqli_fetch_assoc($job)){
         $set[] = $row;
    }
}else{
    if($sortchoice == "ascend"){
       $query = "SELECT lastName,firstName FROM doctor ORDER BY $namechoice";
    }else{
       $query = "SELECT lastName,firstName FROM doctor ORDER BY $namechoice DESC";
    }
    $job=mysqli_query($GLOBALS['link'],$query);
    if(!$job){
        echo "Failed to connect to db ***from doctor with sequence query";
        mysqli_free_result($job);
        exit();  
    }
    while($row = mysqli_fetch_assoc($job)){
         $set[] = $row;
    }
}
  
    $len = count($set);

    //form a table for result html page
   
    $output="<table>";
    $output .= "<tr>";
    $output .= " <th> First Name </th> <th> Last Name </th>  ";
    $output .="</tr>";
    for($i=0; $i<$len; $i++){
       $output .= "<tr>";
       //$output .=  "<td value='".$set[$i]['firstName']."' onclick='".displaydocmsg()."' width=30%>". $set[$i]['firstName'] ."</td>";
       $output .=  "<td value='".$set[$i]['firstName']."'  width=30%><a href='displaydocmsg.php?param1=".$set[$i]['firstName']."&param2=".$set[$i]['lastName']."'>". $set[$i]['firstName'] ."</a></td>";
       $output .=  "<td value='".$set[$i]['lastName']."'  width=30%><a href='displaydocmsg.php?param1=".$set[$i]['firstName']."&param2=".$set[$i]['lastName']."'>". $set[$i]['lastName']."</a></td>";
  
    }
    $output .= "</table>";
    //get the html page and replace the demo item in html
    $final=file_get_contents('resultHandle.html');
    $zone=array("<p id=\"demo\"></p>");
    $replace = array("<table>$output</table>");
    $page=str_replace($zone, $replace,$final);
    
    echo $page;
    mysqli_free_result($job);
    mysqli_close($GLOBALS['link']);

?>