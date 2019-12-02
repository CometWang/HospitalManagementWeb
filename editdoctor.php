<?php
include "connection.php";

$operation=$_POST["operation"];
$docfn = $_POST["docfn"];
$docln = $_POST["docln"];
$pfn = $_POST["pfn"];
$pln = $_POST["pln"];

function assign($doclicen, $patientnum){

$query3="INSERT INTO treatment (ohip, doctorlicensedNum) VALUES ('$patientnum','$doclicen')";
$query3result=mysqli_query($GLOBALS['link'],$query3);
$affectedrows=mysqli_affected_rows($GLOBALS['link']);
if($affectedrows<1){
    echo"<script type='text/javascript'>alert('Fail to insert duplicated data!');
    window.location.href='assigndoctor.php'</script>
    ";
    mysqli_close($GLOBALS['link']);
    exit();

}else{
    echo"<script type='text/javascript'>alert('Success!');
    window.location.href='assigndoctor.php'</script>
    ";
    mysqli_close($GLOBALS['link']);
    exit();

}

}

function stop($doclicen, $patientnum){
    //verify the treatment relationship exists
    $query4="SELECT count(*) AS amount FROM treatment WHERE ohip='$patientnum' AND doctorlicensedNum='$doclicen'";
    $query4result=mysqli_query($GLOBALS['link'],$query4);
    while($row=mysqli_fetch_assoc($query4result)){
        $amount=$row["amount"];     
    }
    if($amount == 0){
        echo"<script type='text/javascript'>alert('The doctor was not treating the patient. Delete failed.');
    window.location.href='assigndoctor.php'</script>
    ";
    mysqli_close($GLOBALS['link']);
    exit();
    }else{
        $query5="DELETE FROM treatment WHERE ohip='$patientnum' AND doctorlicensedNum='$doclicen'";
        $query5result=mysqli_query($GLOBALS['link'],$query5);
        $affectedrows=mysqli_affected_rows($GLOBALS['link']);
        if($affectedrows>0){
            echo"<script type='text/javascript'>alert('Delete Success!');
            window.location.href='assigndoctor.php'</script>
            ";
            mysqli_close($GLOBALS['link']);
            exit();
        }
       
    }

}
//verify both doctor and patient exist
$finddoc="SELECT count(*) AS amount FROM doctor WHERE firstName='$docfn' and lastName='$docln'";
$docresult = mysqli_query($GLOBALS['link'],$finddoc);
while($row=mysqli_fetch_assoc($docresult)){
    $docamount=$row["amount"];
    
}
$findp="SELECT count(*) AS amount FROM patient WHERE firstName='$pfn' and lastName='$pln'";
$presult = mysqli_query($GLOBALS['link'],$findp);
while($row=mysqli_fetch_assoc($presult)){
    $pamount=$row["amount"];
    
}
if($docamount==0){
    echo"<script type='text/javascript'>alert('Patient not exist');
    window.location.href='assigndoctor.php'</script>
    ";
    mysqli_close($GLOBALS['link']);
    exit();
}
if($pamount==0){
    echo"<script type='text/javascript'>alert('Patient not exist');
    window.location.href='assigndoctor.php'</script>
    ";
    mysqli_close($GLOBALS['link']);
    exit();
}
//both exist
//**********find doctor's licennum
$query1="SELECT licensedNum FROM doctor WHERE firstName='$docfn' AND lastName='$docln'";
$query1result = mysqli_query($GLOBALS['link'],$query1);
while($row=mysqli_fetch_assoc($query1result)){
    $doclicennum=$row["licensedNum"];   
}
//**********fetch the patient ohip
$query2="SELECT ohip FROM patient WHERE firstName='$pfn' AND lastName='$pln'";
$query2result = mysqli_query($GLOBALS['link'],$query2);
while($row=mysqli_fetch_assoc($query2result)){
    $ohipnum=$row["ohip"];   
}
//begin operation
if($operation=="Stop treatment"){
    stop($doclicennum, $ohipnum);
}else{
    assign($doclicennum, $ohipnum);
}
?>