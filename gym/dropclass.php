<!DOCTYPE html>
<html>
<?php
include("header.php");
include("connection.php")
?>
</head>
<body>
<?php
include ("menu.php");
include ("bodyheader.php");
$DayArray=array("all"=>"Show All","mon"=>"Monday","tue"=>"Tuesday","wed"=>"Wedenesday","thu"=>"Thursday","fri"=>"Friday","sat"=>"Saturday", "sun"=>"Sunday");
$TimeArray=array("8a"=>"8:00 A.M","9a"=>"9:00 A.M","10a"=>"10:00 A.M","11a"=>"11:00 A.M","12p"=>"12:00 P.M","1p"=>"1:00 P.M","2p"=>"2:00 P.M","3p"=>"3:00 P.M","4p"=>"4:00 P.M","5p"=>"5:00 P.M","6p"=>"6:00 P.M","7p"=>"7:00 P.M","8p"=>"8:00 P.M");
$ClassId=$_GET['classid'];
$memberID=$_GET['memberid'];
$sqldropclass="DELETE FROM tblclassregistration WHERE classId=$ClassId AND MemberId=$memberID";
$resultdropclass=mysqli_query($connection,$sqldropclass);
if (mysqli_affected_rows($connection)<1){
    echo "<p class=\"display-4\">There was an error</p>";
    die();
}
$sqlclassinfo="SELECT * FROM tblclasses WHERE id=$ClassId";
$resultclassinfo=mysqli_query($connection,$sqlclassinfo);
$rowclass=mysqli_fetch_array($resultclassinfo);
#Class info
$classid=$rowclass['id'];
$classname=$rowclass['Name'];
$classdescription=$rowclass['Description'];
$classlocation=$rowclass['Location'];
$classinstructor=$rowclass['Instructor'];
   if ($classlocation==1){
      $classlocation="Yoga Room";
   }
   if ($classlocation==2){
      $classlocation='Pool';
   }
   if ($classlocation==3){
      $classlocation="Studio";
   }
?>

<div class="container">

    <div class="row">
      
        <span class="h1 text-danger">You have been succesfully dropped from class</span>
    </div>
    <div class="form-row">
<div class="col"><h4>Date: <span id="date" ><?php echo date("F j, Y");?></span></h4></div>    <div class="float-right row">
    <button type="button" class="btn btn-primary col d-print-none" onclick="window.print();">Print</button>
    <a type="button" class="btn btn-primary col d-print-none ml-4" href="classregistration.php?classid=<?php echo $ClassId ?>">Go Back</a>
    </div>
        </div>

    <div class="row">
        <legend class='h2'>Class Information</legend>
 
    <div class="col">
           <hr>
    </div>
    </div>

<div class="row">
    <div class="col-4">
        <label class="h5">ID Class: </label><span><?php echo " ".$classid; ?></span>
    </div>
    <div class="col-8">
        <label class="h5">Name: </label><span class="text-capitalize"><?php echo " ".$classname; ?></span>
    </div>
    <div class="col-5">
        <label class="h5">Description: </label><span class="text-capitalize"><?php echo " ".$classdescription; ?></span>
    </div>
</div>
<div class="row">
    <div class="col-4">
      <label class="h5">Instructor: </label><span class="text-capitalize"><?php echo " ".$classinstructor; ?></span>    
    </div>
    <div class="col">
        <label class="h5">Location: </label><span class="text-capitalize"><?php echo " ".$classlocation; ?></span>
    </div>
</div>
<hr>

</div>


<br>
<div class="container">
    <div class= "col-8">
    <table class="table table-striped">
        <legend class="h2">Member Information</legend>
    <thead>
        <tr>
            <th>Member ID</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $sqlmemberinfo="SELECT * FROM tblmember WHERE id = $memberID";
        $resultmember=mysqli_query($connection,$sqlmemberinfo);
        $rowmember=mysqli_fetch_array($resultmember);
        $MemberID=$rowmember['id'];
        $MemberLasName=$rowmember['LastName'];
        $MemberFirstName=$rowmember['FirstName'];
         echo "<tr>";
         echo "<td class=\"text-capitalize\">$MemberID</td>";
         echo "<td class=\"text-capitalize\">$MemberLasName</td>";
         echo "<td class=\"text-capitalize\">$MemberFirstName</td>";
         echo "</tr>";
         
    ?>
        </tbody>
        
    </table>


<?php
mysqli_close($connection);
include ("footer.php");
?>