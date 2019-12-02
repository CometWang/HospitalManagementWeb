<?php
//delete doctor

require_once('connection.php');
//connector("localhost","root","","jwan949assign2db");

$fn=$_POST["docfn"];
$ln=$_POST["docln"];
$query="SELECT count(*) AS num FROM doctor WHERE firstName='$fn' and lastName='$ln'";
$try=mysqli_query($GLOBALS['link'],$query);
while($row=mysqli_fetch_assoc($try)){
  $num=$row['num']; 
}
if($num==0){
  echo"<script type='text/javascript'>alert('Doctor not exist');window.location.href='editdata.html'</script> ";
            mysqli_close($GLOBALS['link']);
            exit();

}

//verify whether the doctor has patients.
$query2="SELECT count(*) as amount FROM doctor INNER JOIN treatment ON doctor.licensedNum = treatment.doctorlicensedNum WHERE doctor.firstName = '$fn' and doctor.lastName='$ln'";
$result=mysqli_query($GLOBALS['link'],$query2);
while($row=mysqli_fetch_assoc($result)){
   $count=$row['amount']; 
}
//the doctor has patient -> use alert box
$msg="The doctor is currently treating other people! Are you sure you want to delete?";
if($count > 0){
    //pass the patameter to another php page to continue deleting
    echo"<script type='text/javascript'>if(confirm('$msg'))
      {window.location.href='confirmdeldoctor.php?flag=1&fn=".$fn."&ln=".$ln."';
    }else{window.location.href='editdata.html';}
    </script>
    ";
}else{
  $query3="DELETE FROM doctor WHERE firstName='$fn' and lastName='$ln'";
  $del=mysqli_query($GLOBALS['link'],$query3);
  if(!$del){
    echo "Failed to delete the data!";
    mysqli_close($GLOBALS['link']);
    exit();
  }else{
    echo "<script type='text/javascript'>alert('Success!');window.location.href='editdata.html'</script> ";
    mysqli_close($GLOBALS['link']);
    exit();
  }

}
mysqli_close($GLOBALS['link']);
?>