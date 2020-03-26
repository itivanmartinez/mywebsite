<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['PrivilegeID'])){
	$privilege=$_SESSION['PrivilegeID'];
    $mId=$_SESSION['memberID'];
}
else{
	echo" You have to log in";
	exit();
}
include("connection.php");
$request=$_GET['request'];
$DayArray=array("mon"=>"Monday","tue"=>"Tuesday","wed"=>"Wedenesday","thu"=>"Thursday","fri"=>"Friday","sat"=>"Saturday", "sun"=>"Sunday");
$TimeArray=array("8a"=>"8:00 A.M","9a"=>"9:00 A.M","10a"=>"10:00 A.M","11a"=>"11:00 A.M","12p"=>"12:00 P.M","1p"=>"1:00 P.M","2p"=>"2:00 P.M","3p"=>"3:00 P.M","4p"=>"4:00 P.M","5p"=>"5:00 P.M","6p"=>"6:00 P.M","7p"=>"7:00 P.M","8p"=>"8:00 P.M");

if ($request=="all"){
    $sql="SELECT * FROM tblclasses cl inner JOIN tblclassesdays cd ON cd.id=cl.id";
}else{
$sql="SELECT * FROM tblclasses cl inner JOIN tblclassesdays cd ON cd.id=cl.id WHERE cd.days='$request'";
}
$DayArray=array("all"=>"Show All","mon"=>"Monday","tue"=>"Tuesday","wed"=>"Wedenesday","thu"=>"Thursday","fri"=>"Friday","sat"=>"Saturday", "sun"=>"Sunday");
$result=mysqli_query($connection,$sql);
while ($row=mysqli_fetch_array($result)){
    $id=$row['id'];
    $sqlsearclass="SELECT * FROM tblclassregistration WHERE classId =$id";
    $resultclassimit=mysqli_query($connection,$sqlsearclass);
   
    $name=$row['Name'];
    $description=$row['Description'];
    $location=$row['Location'];
    $instructor=$row['Instructor'];
    $maxsignups=$row['MaxSignUps'];
    if ($row['Location']==1){
     $loc='Yoga Room';
    }elseif ($row['Location']==2){
     $loc='Pool';
     }elseif ($row['Location']==3){
     $loc='Studio';
    }else {
    $loc='Not Assigned';
    }
    $seatsavailable=$maxsignups - mysqli_num_rows($resultclassimit);
    if ($seatsavailable<0){
        $seatsavailable=0;
        
    }
    if ($privilege==1) { $display='d-none';
    $reglink="processclassregistration.php?classid=$id&memberid=$mId&location=$loc";
    $js="onclick='return confirmreg();'";
    }
    else{
        $js="";
        $display="";    $reglink="classregistrationform.php?classid=$id";}
    $classday=$DayArray[$row['days']];
    $daytime=$TimeArray[$row['time']];

    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td class='text-capitalize'>$name</td>";
    echo "<td class='text-capitalize'>$description</td>";
    echo "<td class='text-capitalize'>$loc</td>";
    echo "<td class='text-capitalize'>$instructor</td>";
    echo "<td>$seatsavailable</td>";
    echo "<td class='text-capitalize'>$classday</td>";
    echo "<td>$daytime</td>";
    
    echo "<td><a type='button' class='btn btn-primary d-print-none' href='$reglink' $js>Register</a></td>";

    echo "<td><a type='button' class='btn btn-primary d-print-none $display' href='classregistrationroster.php?classid=$id' >Roster</a></td>";
}
?>

