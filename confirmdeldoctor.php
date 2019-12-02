<?php
require_once('connection.php');
//connector("localhost","root","","jwan949assign2db");


if(!empty($_GET["flag"])){
    $flag=$_GET["flag"];
    $firstn=$_GET["fn"];
    $lastname=$_GET["ln"];
    if($flag==1){
        $query="DELETE FROM doctor WHERE firstName ='$firstn' and lastName='$lastname'";
    //confirm to delete the information
         $job = mysqli_query($GLOBALS['link'],$query);     
         if(!$job){
            echo"<script type='text/javascript'>alert('Failed to delete');
            window.location.href='editdata.html'</script>
            ";
         }
         else{
            echo"<script type='text/javascript'>alert('Success!');
            window.location.href='editdata.html'</script>
            ";
         }
    }
}
mysqli_close($GLOBALS['link']);


?>