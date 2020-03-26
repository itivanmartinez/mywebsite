<!DOCTYPE html>
<html>
<?php
include("header.php");
include("connection.php")
?>
</head>
<body>
<?php
include ("bodyheader.php");

$UName=$_POST['UName'];
$UPass=$_POST['UPass'];
$Privilege="1";
$FirstName=$_POST['FName'];
$LastName=$_POST['LName'];
$CellPhone=$_POST['CPhone'];
$AddressLine1=$_POST['AL1'];

$Email=$_POST['Email'];
$City=$_POST['City'];
$State=$_POST['State'];
$ZipCode=$_POST['ZCode'];
$SelMembership=$_POST['SelMembership'];
$sql="INSERT INTO tblmember (FirstName,LastName,CellPhone,AddressLine1,,Email,City,State,ZipCode,User,Password,privilegeID)
values('$FirstName','$LastName','$CellPhone','$AddressLine1','$Email','$City','$State','$ZipCode','$UName','$UPass','$Privilege')";

if (mysqli_query($connection,$sql)){
    $lastid=mysqli_insert_id($connection);
    $sql2="INSERT INTO tblmembershipreg (CustomerId,MembershipId) values ('$lastid','$SelMembership')";
    $sql3="SELECT * FROM tblmemberships WHERE id=$SelMembership";
    $result2=mysqli_query($connection,$sql2);
    $result3=mysqli_query($connection,$sql3);
    $row3=mysqli_fetch_array($result3);
    echo "<div class='container'>";
    echo "<span class='display-4 row'>New Member Added Successfully</span>";
    echo "</div>";
}else{
    echo"Error: " .$sql."<br>".mysqli_error($connection);
}
mysqli_close($connection);
?>
<br><br>
<div class="container">
    <div class= "row">
        <div class="col-8 border">
            <p></p>
            <p>Log In Information</p>
            <table class="table col-5 table-striped" >
                <tr>
                    <th>User:</th>
                    <td><?php echo $UName; ?></td>
                </tr>
                <tr>
                    <th>Password:</th>
                    <td><?php echo $UPass; ?></td>
                </tr>
            </table>
        </div>
        <div class="float-right col-2">
            <p><button type="button" class="btn btn-primary col d-print-none" onclick="window.print();">Print</button></p>
            <p><a type="button" class="btn btn-primary col d-print-none" href="index.php">Go Back</a></p>
        </div>
    </div>
    <br>
    <div class= "row">
        <div class="col-8 border">
            <p></p>
            <p>Membership Information</p>
            <table class="table col-5 table-striped" >
                <tr>
                    <th>Membership:</th>
                    <td><?php echo $row3['Name']; ?></td>
                </tr>
                <tr>
                    <th>Price:</th>
                    <td><?php echo $row3['Price']; ?></td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-8 border">
            <p></p>
            <p>Contact Information</p>
            <table class="table col-5 table-striped" >
                <tr>
                    <th>First Name:</th>
                    <td><?php echo $FirstName; ?></td>
                </tr>
                <tr>
                    <th>Last Name:</th>
                    <td><?php echo $LastName; ?></td>
                </tr>
                <tr>
                    <th>Cell Phone:</th>
                    <td><?php echo $CellPhone; ?></td>
                </tr>
                <tr>
                    <th>Address Line 1:</th>
                    <td><?php echo $AddressLine1; ?></td>
                </tr>
                <tr>
                    <th>Address Line 2:</th>
                    <td><?php echo $AddressLine2; ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?php echo $Email; ?></td>
                </tr>
                <tr>
                    <th>City:</th>
                    <td><?php echo $City; ?></td>
                </tr>
                <tr>
                    <th>State:</th>
                    <td><?php echo $State; ?></td>
                </tr>
                <tr>
                    <th>Zip Code:</th>
                    <td><?php echo $ZipCode; ?></td>
                </tr>
                
            </table>
        </div>
    </div>
</div>
<?php
include ("footer.php");
?>