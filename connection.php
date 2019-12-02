<?php
$servername="localhost";
$username="root";

$password="cs3319";

$db="jwan949assign2db";
$link=mysqli_connect($servername, $username, $password, $db);

if (!$link) {
         echo "Failed to connect to the database" . $servername;
         exit(1);  
      
}
    
    



?>