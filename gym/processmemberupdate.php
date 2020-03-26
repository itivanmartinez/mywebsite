<!DOCTYPE html>
    <html>
<?php
include("header.php");
include ("bodyheader.php");
echo "<div class='container'>";
include("connection.php");
$ID=$_POST['IDMember'];
$CellPhone=$_POST['CPhone'];
$AddressLine1=$_POST['AL1'];
$Email=$_POST['Email'];
$City=$_POST['City'];
$State=$_POST['State'];
$ZipCode=$_POST['ZCode'];
$Password=$_POST['UPass'];
$SelMembership=$_POST['SelMembership'];
$sql="UPDATE tblmember SET Password='".$Password."', CellPhone='".$CellPhone."', AddressLine1='".$AddressLine1."', Email='".$Email."', City='".$City."', State='".$State."', ZipCode='".$ZipCode."' WHERE id='".$ID."'";
$sql2="UPDATE tblmembershipreg SET MembershipId='".$SelMembership."' WHERE CustomerId=$ID";
if (mysqli_query($connection,$sql)){
    if (mysqli_query($connection,$sql2)){
        
        echo "<p class='display-4'>Record edited succesfully</p>";
        echo "<a class='btn btn-primary' href='membermanagement.php'>Go Back</a>";
        
    
    }else{
        echo "<p class='display-4'>There was an error updating membership</p>";
    }

}else{
    echo "<p class='display-4'>Error: " .$sql."<br>".mysqli_error($connection)."</p>";
}
echo "</div>";
mysqli_close($connection);
?>