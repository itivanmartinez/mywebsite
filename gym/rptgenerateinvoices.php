<!DOCTYPE html>
<html>
<?php
include("header.php");

?>
</head>
<body>
<?php
include ("menu.php");
include ("bodyheader.php");
?>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col">
            <h1>Invoice Generation Service</h1>
        </div>
        <div class="float-right col-2">
        <button type="button" class="btn btn-primary col d-print-none" onclick="window.print();">Print</button>
        <p></p><a type="button" class="btn btn-primary col d-print-none" href="reports.php">Go Back</a>
        </div>
    </div>
</div>
<br>
<div class="container">
    <?php
$numInvoices=0;
include("connection.php");
$sqlquery="SELECT * FROM tblmember m LEFT JOIN tblmembershipreg mr ON m.id=mr.CustomerID JOIN tblmemberships me ON me.Id=mr.MembershipId
WHERE mr.CanDate IS NULL ORDER BY m.id ";
$result=mysqli_query($connection,$sqlquery);
while ($row=mysqli_fetch_array($result)){
    $memId=$row['id'];
    $membershiId=$row['MembershipId'];
    $membershipPrice=$row['Price'];
    $taxes=0.0875*$membershipPrice;
    $total=$taxes+$membershipPrice;
    $month=date('F Y', mktime(0, 0, 0, date('m')-1, 1, date('Y')));
    $due=date('F d, Y', mktime(0, 0, 0, date('m')+1, 1, date('Y')));
    $sqlgenerateinvoice="INSERT INTO tblinvoice (membershipId, CustomerId, price,taxes,total,month,dueDate)
    VALUES ('$membershiId','$memId','$membershipPrice','$taxes','$total','$month','$due')";
    if ($queryinvoice=mysqli_query($connection,$sqlgenerateinvoice)){
        $numInvoices=$numInvoices+1;
    }else{
        echo "There was an error creating invoices.Please contact system administrator";
    }
}
if ($numInvoices>0){
    echo "<span class='display-4 text-primary'><strong>$numInvoices</strong> invoices have been created for $month and are due $due </span>";
}else{
    echo "<span class='display-4 text-primary'>There was an error creating invoices. No invoice has been created.</span>";
}
?>


</div>



<?php
include ("footer.php");
?>

