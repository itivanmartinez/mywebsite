<!DOCTYPE html>
<html>
<?php
include("header.php");
include("connection.php");
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
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
</head>
<body>
<?php
include ("menu.php");
include ("bodyheader.php");
#all invoices
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
#Totals for each membership level(invoices paid and unpaid)
$sqltotalbymemlevel="SELECT ms.Name ,COUNT(ms.Name) as memCount, SUM(inv.price) as priceSum, sum(inv.taxes) as sumTaxes, sum(inv.total) as sumTotal,ms.Price  from tblinvoice inv 
    LEFT JOIN tblinvoicepaid invp on inv.id=invp.invoiceId LEFT JOIN tblmemberships ms ON ms.Id=inv.membershipId WHERE invp.invoiceId is not null or invp.invoiceId is  null  GROUP by ms.Name ORDER BY ms.Price";
$resulttotalbymemlevel=mysqli_query($connection,$sqltotalbymemlevel);

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
                <span class="display-4 ">Revenue Statistics Report</span><br>
            <span class="h4">Intended for: Sales Manager</span>
            </div>
        </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class='card-header h5 text-center color3 text-white'>Method of Payment</div>
                <div class='card-body'>
                    <table class='table'>
                        <tr>
                            <th>Cash</th><td class="text-right">$<?php echo $rowmethodcash["sumTotal"];?></td>
                        </tr>
                        <tr>
                            <th>Credit Card</th><td class="text-right">$<?php echo $rowmethodcc["sumTotal"];?></td>
                        </tr>
                         <tr class='color2 text-white h5'>
                            <th>Total Paid</th><td class="text-right">$<?php echo $rowmethodcc["sumTotal"]+$rowmethodcash["sumTotal"];?></td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div class="row"><div class='col'><hr></div></div>
        <div class="row">
        <div class="col-6">
            <div class="card">
                <div class='card-header h5 text-center color3 text-white'>Revenue by Membership Level</div>
                <div class='card-body'>
                    <table class='table'>
                        <tr>
                            <th>Unpaid</th><td class="text-right">$<?php echo $rownotpaid["sumTotal"];?></td>
                        </tr>
                        <tr>
                            <th>Paid</th><td class="text-right">$<?php echo $rowpaid["sumTotal"];?></td>
                        </tr>
                         <tr class='color2 text-white h5'>
                            <th>Total Revenue</th><td class="text-right">$<?php echo $rowtotal["sumTotal"];?></td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
            <canvas id="myChartinvoices"></canvas>
        </div>
    </div>
    <div class="row"><div class='col'><hr></div></div>
        <div class="row">
        <div class="col-6">
            <div class="card">
                <div class='card-header h5 text-center color3 text-white text-wrap'>Revenue by Membership Level</div>
                <div class='card-body'>
                    <table class='table'>
                       <?php
                       $memtotalrevenue=0;
                       while ($rowtotalbymemlevel=mysqli_fetch_array($resulttotalbymemlevel)){
                    $memname=$rowtotalbymemlevel['Name'];
                    $memtotal=$rowtotalbymemlevel['sumTotal'];
                    $memtotalrevenue=$memtotal+$memtotalrevenue;
                    echo "<tr >";
                    echo "<th class='text-capitalize'>$memname</th>";
                    echo "<td class='text-right'>$$memtotal</td><tr>";}
                    echo "<tr class='color2 text-white h5'>";
                    echo "<th class='text-capitalize'>Total</th>
                    <td class='text-right '>$$memtotalrevenue</td></tr>";
                    ?>
                    
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
            <canvas id="myChartinvoices"></canvas>
        </div>
    </div>
</div>
<br><br><br><br>
<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Method of Payment"],
        datasets: [{
            label: 'Cash',
            data: ['<?php echo $rowmethodcash["sumTotal"];?>'],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
            ],
            borderColor: [
                'rgba(255,99,132,1)',
            ],
            borderWidth: 1
        },
        {
            label: 'Credit Cards',
            data: ['<?php echo $rowmethodcc["sumTotal"];?>'],
            backgroundColor: [
                'rgba(54, 162, 235, 0.5)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
//Chart Invoice creation
var ctxinv = document.getElementById("myChartinvoices").getContext('2d');
var myChart = new Chart(ctxinv, {
    type: 'pie',
    data: {
        labels: ["Paid", "Unpaid"],
        datasets: [{
            label: 'Cash',
            data: ['<?php echo $rownotpaid["sumTotal"];?>',<?php echo $rowpaid["sumTotal"];?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        },
]
    },

});
</script>






<?php
include ("footer.php");
?>

