<!DOCTYPE html>
<html>
<?php
include("header.php");

?>
<style>
    .color1{
        background-color: rgba(73, 101, 149,1);
    }
    .textcolor1{
        color: rgba(73, 101, 149,1) !important;
    }
</style>
<script>
    function confirmGenerate(){
        con=confirm('Do you want to Generate New Invoices?');
         if (con==true){
            return true;}
        else{
            return false;
        }
    }
</script>
</head>
<body>
<?php
include ("menu.php");
include ("bodyheader.php");
?>

<div class="container h-100">
    <div class="row">
    <div class="col textcolor1">
        <h1>Management Report Center</h1>
    </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row ">
        <div class="col color1 text-white">
            <legend>Members Reports</legend>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col color1">
            <a class="btn textcolor1 bg-white  col-3" href="rptallmembers.php">All Members</a>
            <a class="btn textcolor1 bg-white col-3" href="rptnewmembers.php">New Members</a>
            <a class="btn textcolor1 bg-white col-3" href="rptallmemberscancellations.php">Memberships Cancelations</a>
            <br><br>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row bg-white">
        <div class="col color1 text-white">
            <legend>Class Reports</legend>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col color1">
            <a class="btn bg-white textcolor1 col-3" href="rptclassregistration.php">All Classes</a>
            <br><br>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row bg-white">
        <div class="col color1 text-white">
            <legend>Invoices</legend>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col color1">
            <a class="btn bg-white textcolor1 col-3" href="rptallinvoices.php">Invoices</a>
            <a class="btn bg-white textcolor1 col-3" href="rptgenerateinvoices.php" onclick="return confirmGenerate();">Generate invoices</a>
            <br><br>
        </div>
        
    </div>
</div>
<br>
<div class="container">
    <div class="row bg-white">
        <div class="col color1 text-white">
            <legend>Financial Reports</legend>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col color1">
            <a class="btn bg-white textcolor1 col-3" href="revenuestatistics.php">Statistics</a>
            <a class="btn bg-white textcolor1 col-3" href="rptrevenue.php">Summary Revenue</a>
            <a class="btn bg-white textcolor1 col-3" href="rptdetailedrevenue.php">Detailed Revenue</a>
            <br><br>
        </div>
        
    </div>
    <br><br><br><br><br>
</div>



<?php
include ("footer.php");
?>

