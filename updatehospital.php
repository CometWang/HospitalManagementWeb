<?php
//update the hospitalname
require_once('connection.php');
//connector("localhost","root","","jwan949assign2db");
$origin = $_POST["originname"];
$new = $_POST["updatename"];

$query="UPDATE hospital SET hospitalName='$new' WHERE code='$origin'";
$job=mysqli_query($GLOBALS['link'],$query);
if(!$job){
    echo "<script >alert('Invalid data! Please check input!');window.location.href='hospitalresult.html'</script>";
    exit();
}else{
    echo "<script >alert('Success update!');window.location.href='hospitalresult.html'</script>";
    exit();
}
mysqli_close($GLOBALS['link']);
?>