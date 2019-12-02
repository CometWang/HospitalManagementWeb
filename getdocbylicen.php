<?
//this script will get the data for the search based on the licensed date

$date = $_POST["licendate"];
if(empty($date)){
    echo "<script >alert('Need Input!');window.location.href='resultHandle.html'</script>";
    exit();
}
require_once('connection.php');
//connector("localhost","root","","jwan949assign2db");

$query="SELECT firstName,lastName,specialty,licensedDate FROM doctor WHERE licensedDate<'$date'";
$job=mysqli_query($GLOBALS['link'],$query);
while($row = mysqli_fetch_assoc($job)){
    $set[] = $row;
}
$len = count($set);

    //form a table for result page
   
    $output="<table>";
    $output .= "<tr>";
    $output .= " <th> First Name </th> <th> Last Name </th> <th> Specialty </th><th> Licensed Date </th>  ";
    $output .="</tr>";
    for($i=0; $i<$len; $i++){
       $output .= "<tr>";
       //$output .=  "<td value='".$set[$i]['firstName']."' onclick='".displaydocmsg()."' width=30%>". $set[$i]['firstName'] ."</td>";
       $output .=  "<td width=30%>". $set[$i]['firstName'] ."</td>";
       $output .=  "<td  width=30%>". $set[$i]['lastName']."</td>";
       $output .=  "<td  width=30%>". $set[$i]['specialty']."</td>";
       $output .=  "<td  width=30%>". $set[$i]['licensedDate']."</td>";
  
    }
    $output .= "</table>";
    $final=file_get_contents('resultHandle.html');
    $zone=array("<p id=\"demo3\"></p>");
    $replace = array("<table>$output</table>");
    $page=str_replace($zone, $replace,$final);
    
    echo $page;
    mysqli_free_result($job);
    mysqli_close($GLOBALS['link']);

?>