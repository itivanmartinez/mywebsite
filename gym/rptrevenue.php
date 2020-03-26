<!DOCTYPE html>
<html>
<?php
include("header.php");
include("connection.php");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
<style>
    .color1{
        background-color:#9db3b4 !important;
    }
    .color2{background-color:#2a465c !important;}
    .color3{background-color:#496595 !important;}
    .color4{background-color:#ebedef !important;}
    .textcolor1{
        color:#496595 !important;
    }
    .textcolor2{color:#9db3b4 !important;}
    .textcolor3{color:#8d9ea5 !important;}
</style>
</head>
<body>
<?php
include ("menu.php");
include ("bodyheader.php");
$sqlrevenue="SELECT COUNT(ms.Name) as memCount, SUM(inv.price) as priceSum, sum(inv.taxes) as sumTaxes, sum(inv.total) as sumTotal  from tblinvoice inv 
    LEFT JOIN tblinvoicepaid invp on inv.id=invp.invoiceId LEFT JOIN tblmemberships ms ON ms.Id=inv.membershipId WHERE invp.invoiceId is null or invp.invoiceId is not null";
$resultrevenue=mysqli_query($connection,$sqlrevenue);
$rowtotal=mysqli_fetch_array($resultrevenue);
#nOT PAID INVOICES
$sqlrevenuenotpaid="SELECT COUNT(ms.Name) as memCount, SUM(inv.price) as priceSum, sum(inv.taxes) as sumTaxes, sum(inv.total) as sumTotal  from tblinvoice inv 
    LEFT JOIN tblinvoicepaid invp on inv.id=invp.invoiceId LEFT JOIN tblmemberships ms ON ms.Id=inv.membershipId WHERE invp.invoiceId is null";
$resultrevenuenotpaid=mysqli_query($connection,$sqlrevenuenotpaid);
$rownotpaid=mysqli_fetch_array($resultrevenuenotpaid);
#Paid Invoices
$sqlrevenuepaid="SELECT COUNT(ms.Name) as memCount, SUM(inv.price) as priceSum, sum(inv.taxes) as sumTaxes, sum(inv.total) as sumTotal  from tblinvoice inv 
    LEFT JOIN tblinvoicepaid invp on inv.id=invp.invoiceId LEFT JOIN tblmemberships ms ON ms.Id=inv.membershipId WHERE invp.invoiceId is not null";
$resultrevenuepaid=mysqli_query($connection,$sqlrevenuepaid);
$rowpaid=mysqli_fetch_array($resultrevenuepaid);
#cash and credit card totals for paid invoices
$sqlmethodpayment="SELECT invp.methodPayment ,COUNT(ms.Name) as memCount, SUM(inv.price) as priceSum, sum(inv.taxes) as sumTaxes, sum(inv.total) as sumTotal  from tblinvoice inv 
    LEFT JOIN tblinvoicepaid invp on inv.id=invp.invoiceId LEFT JOIN tblmemberships ms ON ms.Id=inv.membershipId WHERE invp.invoiceId is not null GROUP by invp.methodPayment";
$resultmethodpayment=mysqli_query($connection,$sqlmethodpayment);
$rowmethodcash=mysqli_fetch_array($resultmethodpayment);
$rowmethodcc=mysqli_fetch_array($resultmethodpayment);
#unpaid membership grouped by membership name
############################################################################################################################################################################
$sqlmembershiptype="SELECT ms.Name ,COUNT(ms.Name) as memCount, SUM(inv.price) as priceSum, sum(inv.taxes) as sumTaxes, sum(inv.total) as sumTotal  from tblinvoice inv 
    LEFT JOIN tblinvoicepaid invp on inv.id=invp.invoiceId LEFT JOIN tblmemberships ms ON ms.Id=inv.membershipId WHERE invp.invoiceId is not null GROUP by ms.Name";
$resultmembershiptype=mysqli_query($connection,$sqlmembershiptype);
#paid membership group by name
$sqlmembersippaid="SELECT ms.Name ,COUNT(ms.Name) as memCount, SUM(inv.price) as priceSum, sum(inv.taxes) as sumTaxes, sum(inv.total) as sumTotal  from tblinvoice inv 
    LEFT JOIN tblinvoicepaid invp on inv.id=invp.invoiceId LEFT JOIN tblmemberships ms ON ms.Id=inv.membershipId WHERE invp.invoiceId is  null GROUP by ms.Name";
$resultmembershippaid=mysqli_query($connection,$sqlmembersippaid);
$sqlmembershiptotal="SELECT ms.Name ,COUNT(ms.Name) as memCount, SUM(inv.price) as priceSum, sum(inv.taxes) as sumTaxes, sum(inv.total) as sumTotal  from tblinvoice inv 
    LEFT JOIN tblinvoicepaid invp on inv.id=invp.invoiceId LEFT JOIN tblmemberships ms ON ms.Id=inv.membershipId WHERE invp.invoiceId is null or invp.invoiceId is not null group by ms.Name";
$resultmembershiptotal=mysqli_query($connection,$sqlmembershiptotal);
?>
<div class="container mb-3">
    <div class="row mb-3">
        <div class="col"><br><br><h4>Date: <span id="date" ><?php echo date("F j, Y");?></span></h4></div>
        <div class="col-2"><button type="button" class="btn btn-primary form-control d-print-none mb-2" onclick="window.print();">Print</button>
        <a type="button" class="btn btn-primary form-control d-print-none" href="reports.php">Go Back</a></div>
    </div>
</div>
<div class="container ">
        <div class="row">
        <div class="col color3 text-white text-center">
            <span class="display-4 ">Summary Revenue Report</span><br>
            <span class="h4">Intended for: Sales Manager</span>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-4">
            <table class="table table-striped">
                
                <legend><h4>All Invoices</h4></legend>
                <caption>Revenue by membership report</caption>
                <thead>
                    <tr class="color3 text-white"><th>Membership</th>
                    <th>Total Revenue</th></tr>
                </thead>
                <?php
                $memtotalrevenue=0;
                $totalcount=0;
                while ($rowmembershiptotal=mysqli_fetch_array($resultmembershiptotal)){
                    $memname=$rowmembershiptotal['Name'];
                    $memtotal=$rowmembershiptotal['sumTotal'];
                    $memtotalrevenue=$memtotal+$memtotalrevenue;
                    $totalcount=$totalcount+$rowmembershiptotal['memCount'];
                    echo "<tr >";
                    echo "<th class='text-capitalize'>$memname</th>";
                    echo "<td class='text-right'>$memtotal</td>";
                }
                echo "<tr class='color2 h3 text-white'><td>Total:</td><td class='text-right'>$memtotalrevenue</td></tr>"
                ?>
            </table>
            <h5><span>Number of Invoices:</span><span class="text-right"><?php echo " ".$totalcount?></span></h5>
        </div>
        <div class="col-4">
            <table class="table table-striped">
                
                <legend><h4>Paid Invoices</h4></legend>
                <caption>Revenue by membership report</caption>
                <thead>
                    <tr class="color3 text-white"><th>Membership</th>
                    <th>Total Revenue</th></tr>
                </thead>
                <?php
                $memtotalrevenue=0;
                $totalcount=0;
                while ($rowmembershiptype=mysqli_fetch_array($resultmembershiptype)){
                    $memname=$rowmembershiptype['Name'];
                    $memtotal=$rowmembershiptype['sumTotal'];
                    $totalcount=$totalcount+$rowmembershiptype['memCount'];
                    $memtotalrevenue=$memtotal+$memtotalrevenue;

                    echo "<tr class=''>";
                    echo "<th class='text-capitalize'>$memname</th>";
                    echo "<td class='text-right'>$memtotal</td>";
                }
                echo "<tr class='color2 h3 text-white'><td>Total:</td><td class='text-right'>$memtotalrevenue</td></tr>"
                ?>
            </table>
            <h5><span>Number of Invoices:</span><span class="text-right"><?php echo " ".$totalcount?></span></h5>
        </div>
                <div class="col-4">
            <table class="table table-striped">
                
                <legend><h4>Unpaid Invoices</h4></legend>
                <caption>Revenue by membership report</caption>
                <thead>
                    <tr class="color3 text-white"><th>Membership</th>
                    <th>Total Revenue</th></tr>
                </thead>
                <?php
                $memtotalrevenue=0;
                $totalcount=0;
                while ($rowmembershippaid=mysqli_fetch_array($resultmembershippaid)){
                    $memname=$rowmembershippaid['Name'];
                    $memtotal=$rowmembershippaid['sumTotal'];
                    $totalcount=$totalcount+$rowmembershippaid['memCount'];
                    $memtotalrevenue=$memtotal+$memtotalrevenue;

                    echo "<tr class=''>";
                    echo "<th class='text-capitalize'>$memname</th>";
                    echo "<td class='text-right'>$memtotal</td>";

                }
                echo "<tr class='color2 h3 text-white'><td>Total:</td><td class='text-right'>$memtotalrevenue</td></tr>"
                ?>
            </table>
            <h5><span>Number of Invoices:</span><span class="text-right"><?php echo " ".$totalcount?></span></h5>
        </div> 
    </div>
</div><!--container--><br><br><br>






<?php
include ("footer.php");
?>

