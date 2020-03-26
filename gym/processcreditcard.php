
<!DOCTYPE html><html>

<?php
include ("header.php");
include ("bodyheader.php");
include("connection.php");
//sql string to select table
$MID=$_POST['memberId'];
$CCNumber=$_POST['CCNumber'];
$EDate=$_POST['EDate'];
$CVV=$_POST['CVV'];
$NameCC=$_POST['NameCC'];
$BAddress=$_POST['BAddress'];
$State=$_POST['State'];
$City=$_POST['City'];
$ZCode=$_POST['ZCode'];
$sql="INSERT INTO tblcredcardinfo (CustomerId,CCNumber,BillingName,BillingAddress,BillingZipCode,BillingState,BillingCity,expDate,CVV)
values('$MID','$CCNumber','$NameCC','$BAddress','$ZCode','$State','$City','$EDate','$CVV')";
if (mysqli_query($connection,$sql)){
    
        echo "<div class='container'>";
        echo "<p>Credit Card Info added Successfully</p>";
        echo "<a class='btn btn-primary' href='membermanagement.php'>Go Back</a>";
        echo "</div>";
}else{
    echo"Error: " .$sql."<br>".mysqli_error($connection);
}
mysqli_close($connection);
?>