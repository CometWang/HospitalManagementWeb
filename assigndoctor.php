<!DOCTYPE html>
<html lang="en">
<head>
   <title>Result Page</title>
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <meta charset="utf-8">
   <!--Link the files that needed to be used to this file-->
   <link rel="stylesheet" type="text/css" href="result.css" />
   
</head>
<body>
<?php
include "connection.php";
?>
<h1>Patient List</h1>

<?php
$query="SELECT firstName,lastName FROM patient";
$result=mysqli_query($GLOBALS['link'],$query);
if (!$result) {
    die("databases query on art pieces failed. ");
}
    while($row = mysqli_fetch_assoc($result)){
        $set[] = $row;
   }
   $len = count($set);
   echo "<table>";
   echo "<tr>";
   echo " <th> First Name </th> <th> Last Name </th>  ";
   echo "</tr>";
   for($i=0; $i<$len; $i++){
      echo "<tr>";
      //$output .=  "<td value='".$set[$i]['firstName']."' onclick='".displaydocmsg()."' width=30%>". $set[$i]['firstName'] ."</td>";
      echo "<td  width=30%>". $set[$i]['firstName'] ."</td>";
      echo "<td width=30%>". $set[$i]['lastName']."</td>";
 
   }
   echo "</table>";
   mysqli_free_result($result);
   mysqli_close($GLOBALS['link']);
?>

<div id="app">
<form action="editdoctor.php" method="post">

         <div>
                <input type="text" name="docfn" class="control" placeholder="Doctor first name *" required/>
                <input type="text" name="docln" class="control" placeholder="Doctor last name *" required/>
</div>
<div>
                <input type="text" name="pfn" class="control" placeholder="Patient first name *" required/>
                <input type="text" name="pln" class="control" placeholder="Patient last name *" required/>
                
           </div>
      <input id="ss" type="submit" class="sub" name="operation" value="Stop treatment">
      <input id="ss" type="submit" class="sub" name="operation" value="Assign">
     
    </form>
    <button onclick="location.href='editdata.html'" type="button" class="sub" >Main Page</button>
</div>
</body>
</html>