<!DOCTYPE html>
<html>
<?php
include("header.php");
include("connection.php")
?>
</head>
<body>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['PrivilegeID'])){
	$privilege=$_SESSION['PrivilegeID'];
    $mId=$_SESSION['memberID'];
}else{
	$privilege=0;
    $mId=0;
}

include ("menu.php");
include ("bodyheader.php");
$DayArray=array("all"=>"Show All","mon"=>"Monday","tue"=>"Tuesday","wed"=>"Wedenesday","thu"=>"Thursday","fri"=>"Friday","sat"=>"Saturday", "sun"=>"Sunday");
$TimeArray=array("8a"=>"8:00 A.M","9a"=>"9:00 A.M","10a"=>"10:00 A.M","11a"=>"11:00 A.M","12p"=>"12:00 P.M","1p"=>"1:00 P.M","2p"=>"2:00 P.M","3p"=>"3:00 P.M","4p"=>"4:00 P.M","5p"=>"5:00 P.M","6p"=>"6:00 P.M","7p"=>"7:00 P.M","8p"=>"8:00 P.M");
if (isset($_POST['memberId'])){
    $MemberID=$_POST['memberId'];
    $ClassId=$_POST['classid'];
	$classlocation=$_POST['location'];
}else{
    $MemberID="0";
    $ClassId=$_GET['classid'];;
    $classlocation=0;
}

if (isset($_GET['memberid'])){
    $MemberID=$_GET['memberid'];
    $ClassId=$_GET['classid'];
	$classlocation=$_GET['location'];
}else{
    
}
   if ($classlocation=="Yoga Room"){
      $classlimit=15;;
   }
   if ($classlocation=='Pool'){
      $classlimit=20;
   }
   if ($classlocation=="Studio"){
      $classlimit=15;
   }
$sqlsearch="SELECT * FROM tblclassregistration WHERE memberId=$MemberID and classId=$ClassId";
$sqlsearchmember="SELECT * FROM tblmember WHERE id =$MemberID";
$sqlsearclass="SELECT * FROM tblclassregistration WHERE classId =$ClassId";
if ($resultsearch=mysqli_query($connection,$sqlsearch)){}else{
echo "error on searching class and members";
echo mysqli_error($connection);
}
if ($resultmember=mysqli_query($connection,$sqlsearchmember)){}else{
	echo "error on searching members";
	echo mysqli_error($connection);
}
if ($resultclassimit=mysqli_query($connection,$sqlsearclass)){}else{
	echo "error on searching class registration";
	echo mysqli_error($connection);
}
    if ($privilege==1){
    $goback="classregistration.php" ;  
    }else{
       $goback="classregistrationform.php";
    }
if (mysqli_num_rows( $resultsearch)>0){
    echo "<div class=\"container\">";
    echo "<span class=\"display-4 text-danger\">You are already registered for this class<p>Please select another class</p></span>";

    echo "<p><a href=\"$goback?classid=$ClassId\" class='btn btn-primary col-3'>Go Back</a></p>";
    echo "</div>";
    die;
}

if (mysqli_num_rows( $resultmember)<1){
    echo "<div class=\"container\">";
    echo "<span class=\"display-4 text-danger\">You must select a member to continue</p></span>";
    echo "<p><a href=\"$goback?classid=$ClassId\" class='btn btn-primary col-3'>Go Back</a></p>";
    echo "</div>";
    die;
}
if (mysqli_num_rows( $resultclassimit)>=$classlimit){

    echo "<div class=\"container\">";
    echo "<span class=\"display-4 text-danger\">Class Limit has been reached</p></span>";
    echo "<p><a href=\"$goback?classid=$ClassId\" class='btn btn-primary col-3'>Go Back</a></p>";
    echo "</div>";
    die;
}
$sql="INSERT INTO tblclassregistration (memberId,classId)
values('$MemberID','$ClassId')";
if (mysqli_query($connection,$sql)){
    echo "<div class='container'>";
    echo "<span class='display-4 row'>You have been succesfully registered for class</span>";
    echo "</div>";
    $sqlclassreg="SELECT M.id,M.FirstName,M.LastName,CL.id AS clid,CL.Name,CL.Description, CL.Location, CL.Instructor, CLD.days,CLD.time FROM tblmember M 
JOIN tblclassregistration CR ON M.id=CR.memberId JOIN tblclasses CL on CR.classId=CL.id JOIN tblclassesdays CLD on CLD.id=CL.id
WHERE M.id = $MemberID AND CL.id=$ClassId";
$result2=mysqli_query($connection,$sqlclassreg);
$row2=mysqli_fetch_array($result2);
$MemberFName=$row2['FirstName'];
$MemberLName=$row2['LastName'];
$ClassId=$row2['clid'];
$ClassName=$row2['Name'];
$ClassDescription=$row2['Description'];
$ClassLocation=$row2['Location'];
$Classinstructor=$row2['Instructor'];
$ClassDay=$DayArray[$row2['days']];
$ClassTime=$TimeArray[$row2['time']];

}else{
    echo"Error: " .$sql."<br>".mysqli_error($connection);
    die();
}
mysqli_close($connection);
?>
<br><br>
<div class="container">
	<div class="row">
		<div class="col"><br><br><h4>Date: <span id="date" ><?php echo date("F j, Y");?></span></h4></div>
	</div>
    <div class= "row">
		
        <div class="col-8 border">
            <p></p>
            <p>Member Information</p>
            <table class="table col-5 table-striped" >
                <tr>
                    <th>ID:</th>
                    <td><?php echo $MemberID; ?></td>
                </tr>
                <tr>
                    <th>First Name:</th>
                    <td class="text-capitalize"><?php echo $MemberFName; ?></td>
                </tr>
                <tr>
                    <th>Last Name:</th>
                    <td class="text-capitalize"><?php echo $MemberLName; ?></td>
                </tr>
            </table>
        </div>
        <div class="float-right col-2">
            <p><button type="button" class="btn btn-primary col d-print-none" onclick="window.print();">Print</button></p>
            <p><a type="button" class="btn btn-primary col d-print-none" href="<?php echo $goback; ?>?classid=<?php echo $ClassId; ?>">Go Back</a></p>
        </div>
    </div>
    <br>

    <div class= "row">
        <div class="col-8 border">
            <p></p>
            <p>Class Information</p>
            <table class="table col-5 table-striped" >
                <tr>
                    <th>Class ID:</th>
                    <td><?php echo $ClassId; ?></td>
                </tr>
                <tr>
                    <th>Class Name:</th>
                    <td class="text-capitalize"><?php echo $ClassName?></td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td class="text-capitalize"><?php echo $ClassDescription ?></td>
                </tr>
                <tr>
                    <th>Instructor:</th>
                    <td class="text-capitalize"><?php echo $Classinstructor ?></td>
                </tr>
                <tr>
                    <th>Day:</th>
                    <td><?php echo $ClassDay ?></td>
                </tr>
                <tr>
                    <th>Time:</th>
                    <td><?php echo $ClassTime ?></td>
                </tr>
            </table>
        </div>
    </div>
    <br>
</div>
<?php
include ("footer.php");
?>