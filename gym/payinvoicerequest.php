<?php
include ('connection.php');
$InvoiceId=$_GET['invid'];
$payMethod=$_GET['payment'];
$CCNumber="";
if ($payMethod=='cc'){
 $sqlcc="SELECT cc.CCNumber FROM tblinvoice inv JOIN tblcredcardinfo cc ON cc.CustomerId=inv.CustomerId WHERE inv.id=$InvoiceId";
 if ($resultcc=mysqli_query($connection,$sqlcc)){
  $row=mysqli_fetch_array($resultcc);
  $CCNumber=$row['CCNumber'];
 }else{
  echo "No Credit Card Found";
 die();
 }
}
$sqlpayment="INSERT tblinvoicepaid (invoiceId,methodPayment,CreditCard) values ('$InvoiceId','$payMethod','$CCNumber')";
if ($resultpayment=mysqli_query($connection,$sqlpayment)){
 echo "Paid";
}else{
 echo "There was an error with payment";
 echo mysqli_error($connection);
 die();
}
mysqli_close($connection);
?>

