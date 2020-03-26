
<?php
include ('connection.php');
$request=$_GET['request'];
$sqlquery="SELECT m.Id,m.FirstName,m.LastName,inv.Id as inId,inv.price,inv.total,inv.month,inv.dueDate,inv.membershipId ,invp.DatePayment FROM tblmember m JOIN tblinvoice inv ON m.id=inv.CustomerId
    LEFT JOIN tblinvoicepaid invp on inv.id=invp.invoiceId WHERE invp.invoiceId is null or invp.invoiceId is not null ORDER BY inv.dateIssued asc";
if ($request=="unpaid"){
    $sqlquery="SELECT m.Id,m.FirstName,m.LastName,inv.Id as inId,inv.price,inv.total,inv.month,inv.dueDate,inv.membershipId,invp.DatePayment FROM tblinvoice inv JOIN tblmember m on inv.CustomerId= m.id
    LEFT JOIN tblinvoicepaid invp ON inv.id= invp.invoiceId WHERE invp.invoiceId IS NULL ORDER BY inv.membershipId,inv.dateIssued";
}
if ($request=="paid"){
    $sqlquery="SELECT m.Id,m.FirstName,m.LastName,inv.Id as inId,inv.price,inv.total,inv.month,inv.dueDate,inv.membershipId ,invp.DatePayment FROM tblinvoice inv JOIN tblmember m on inv.CustomerId= m.id
    LEFT JOIN tblinvoicepaid invp ON inv.id= invp.invoiceId WHERE invp.invoiceId IS NOT NULL ORDER BY inv.membershipId,inv.dateIssued";
}
if ($request=="all"){
    $sqlquery="SELECT m.Id,m.FirstName,m.LastName,inv.Id as inId,inv.price,inv.total,inv.month,inv.dueDate,inv.membershipId ,invp.DatePayment FROM tblmember m JOIN tblinvoice inv ON m.id=inv.CustomerId
    LEFT JOIN tblinvoicepaid invp on inv.id=invp.invoiceId WHERE invp.invoiceId is null or invp.invoiceId is not null ORDER BY inv.dateIssued asc";
}
if ($result=mysqli_query($connection,$sqlquery)){
    $sqlmembershipname="SELECT Id, Name FROM tblmemberships";
$membershiparray=[];
$sqlresulmembership=mysqli_query($connection,$sqlmembershipname);
while ($rowa=mysqli_fetch_array($sqlresulmembership)){
    $membershiparray[$rowa['Id']]=$rowa['Name'];
}
$numInvoices=mysqli_num_rows($result);
}else{
    echo "There was an error retreiving data from Table.";
    echo "<p>".mysqli_error($connection)."</p>";
    die();
}
?>
    <div class="col-4" id="ninvoices"><h5>Total invoices: <?php echo $numInvoices;?></h5></div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Invoice Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Menbership</th>
                <th>Price</th>
                <th>Total</th>
                <th>Service Date</th>
                <th>Due Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="tblinvoices">
<?php
while ($row=mysqli_fetch_array($result)){
    $membershipID=$row['Id'];
    $memFirstName=$row['FirstName'];
    $memLastName=$row['LastName'];
    $membershiId=$row['membershipId'];
    $membershipPrice=$row['price'];
    $membershiptotal=$row['total'];
    $membershipdue=$row['dueDate'];
    $membershipmonth=$row['month'];
    $InvoiceId=$row['inId'];
    if (isset($row['DatePayment'])){
        $paidinv=true;
    }else {
        $paidinv=false;
    }
    $membershipname=$membershiparray[$membershiId];
    echo "<tr>";
    echo "<td>$InvoiceId</td>";
    echo "<td class='text-capitalize'>$memFirstName</td>";
    echo "<td class='text-capitalize'>$memLastName</td>";
    echo "<td class='text-capitalize'>$membershipname</td>";
    echo "<td>$membershipPrice</td>";
    echo "<td>$membershiptotal</td>";
    echo "<td>$membershipmonth</td>";
    echo "<td class='text-capitalize'>$membershipdue</td>";
    if ($paidinv==true){
        $txt="See";
        $paid="y";
        $color="btn-danger";
    }else{
        $txt="Pay";
        $paid="";
        $color="btn-primary";
    }
    echo "<td><a href='payinvoice.php?id=$membershipID&invid=$InvoiceId&paid=$paid' class='btn $color text-white col-12 d-print-none'>$txt</a></td>";
    echo "</tr>";
    
}
return $numInvoices;
?>
