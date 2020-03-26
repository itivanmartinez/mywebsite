<!DOCTYPE html>
<html>
<?php
include("header.php");
include("connection.php");
?>
<style>
    .color1{
        background-color:#9db3b4;
    }
    .color2{background-color:#2a465c;}
    .color3{background-color:#496595;}
    .color4{background-color:#ebedef;}
    .textcolor1{
        color:#496595;
    }
    .textcolor2{color:#9db3b4;}
    .textcolor3{color:#8d9ea5;}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
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
#grouped by membership name
$sqlmembershiptype="SELECT ms.Name ,COUNT(ms.Name) as memCount, SUM(inv.price) as priceSum, sum(inv.taxes) as sumTaxes, sum(inv.total) as sumTotal,ms.Price  from tblinvoice inv 
    LEFT JOIN tblinvoicepaid invp on inv.id=invp.invoiceId LEFT JOIN tblmemberships ms ON ms.Id=inv.membershipId WHERE invp.invoiceId is not null GROUP by ms.Name ORDER BY ms.Price";
$resultmembershiptype=mysqli_query($connection,$sqlmembershiptype);
$sqlmembershiptypeall="SELECT ms.Id, ms.Name  ,COUNT(ms.Id) as memCount, SUM(inv.price) as priceSum, sum(inv.taxes) as sumTaxes, sum(inv.total) as sumTotal,ms.Price  from tblinvoice inv 
    LEFT JOIN tblinvoicepaid invp on inv.id=invp.invoiceId LEFT JOIN tblmemberships ms ON ms.Id=inv.membershipId WHERE invp.invoiceId is not null or invp.invoiceId is null  GROUP by ms.Name ORDER BY ms.Price";
$resultmembershiptypeall=mysqli_query($connection,$sqlmembershiptypeall);
?>
<div class="container mb-3">
    <div class="row mb-3">
        <div class="col"><br><br><h4>Date: <span id="date" ><?php echo date("F j, Y");?></span></h4></div>
        <div class="col-2"><button type="button" class="btn btn-primary form-control d-print-none mb-2" onclick="window.print();">Print</button>
        <a type="button" class="btn btn-primary form-control d-print-none" href="reports.php">Go Back</a></div>
    </div>
</div>
<div class="container ">
        <div class="row mb-5 ">
        <div class="col color3 text-white text-center">
            <span class="display-4 ">Detailed Revenue Report</span><br>
            <span class="h4">Intended for: Sales Manager</span>
        </div>
    </div>
    

                <?php
                $memtotalrevenue=0;
                $totalinvoicespaid=0;
                while ($rowmembershiptype=mysqli_fetch_array($resultmembershiptypeall)){
                    
                $color="";
                $countcolor=2;
                    $memId=$rowmembershiptype['Id'];
                    $memName=$rowmembershiptype['Name'];
                    $memcount=$rowmembershiptype['memCount'];
                    $memtotal=$rowmembershiptype['sumTotal'];
                    $memPrice=$rowmembershiptype['Price'];
                    $memtotalrevenue=$memtotal+$memtotalrevenue;
                    $sqldetailrevenue="SELECT  me.Id,me.Name, m.id, m.FirstName,m.LastName, COUNT(m.id) as memberCount from tblinvoice inv 
                    JOIN tblmemberships me on inv.membershipId=me.Id
                    JOIN tblmember m on inv.CustomerId=m.id
                    where me.Id=$memId
                    GROUP BY m.LastName";
                    $resultdetailrevenue=mysqli_query($connection,$sqldetailrevenue);
                    echo "<div class='row'>
                    <div class='col-12'><hr></div>
                    <div class=\"col-4 color3 text-white h5\">Membership level:<span class='text-capitalize'> $memName</span></div>
                    <div class=\"col-4  color3 text-white h5\">Total Invoices: $memcount</div>
                    <div class=\"col-4  color3 text-white h5\">Price: $$memPrice</div></div><!--closing row-->";
                    
                            echo "<div class='row '><div class=\"col-1\"></div>";
                            echo "<div class=\"col-3 color1\"><b>Full Name</b></div>";
                            echo "<div class=\"col-3 color1\"><b>Membership Level</b></div>
                                <div class='col color1'><b>Invoices</b></div></div>";
                    while ($rowdetailrevenue=mysqli_fetch_array($resultdetailrevenue)){
                            $invoicespaid=$rowdetailrevenue['memberCount'];
                            $totalinvoicespaid=$totalinvoicespaid+$invoicespaid;
                            $fullname=$rowdetailrevenue['LastName'].", ".$rowdetailrevenue['FirstName'];
                            $memlevel=$rowdetailrevenue['Name'];
                            echo "<div class='row'><div class=\"col-1\"></div>";
                            echo "<div class=\"col-3 $color\">$fullname</div>";
                            echo "<div class=\"col-3 $color\"><span class=' text-capitalize'>$memlevel</span></div>";
                            echo "<div class=\"col $color\">$invoicespaid</div></div>";
                            
                            if ($color=='color1'){
                                $color='';
                    }elseif ($color==''){
                                $color='color1';
                    }
                    }
                    echo "<div class='row  h5 text-right'><div class='col-8'></div><div class=\"col color3 text-white text-capitalize\"><span>Total for $memName: $$memtotal</div></div>";
                  
                }
                echo "<div class='row'>
                <div class='color4 h5 textcolor1 col-9 text-right'>Total Invoices: $totalinvoicespaid</div>
                <div class='color4 h5 textcolor1 text-right col'><span>Grand Total:</span><span class='text-right'> $$memtotalrevenue</span></div></div>";
                
              
                ?>
    
</div><!--container--><br><br><br>
<div class="container">
    <div class="row">
        <div class="col bg-primary text-white text-center">
            <span class="display-4 "></span>
        </div>
    </div>
</div>





<?php
include ("footer.php");
?>

