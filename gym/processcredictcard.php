<?php
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
$sql="INSERT INTO tblcrecardinfo (CustomerId,CCNumber,BillingName,BillingAddress,BillingZipCode,BillingState,BillingCity)
values('$MID','$CCNumber','$NameCC','$BAddress','$ZCode','$State','$City')";
if (mysqli_query($connection,$sql)){
    echo "Credit Card Info added Successfully";
}else{
    echo"Error: " .$sql."<br>".mysqli_error($connection);
}
mysqli_close($connection);
?>