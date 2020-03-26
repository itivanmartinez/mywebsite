<!DOCTYPE html>
<html>
<?php
include("header.php");

?>
<script>
         if (window.XMLHttpRequest){
        //code for ie7, firefox,chrome,opera,safari
        xmlhttp= new XMLHttpRequest();
        }
        else{
        //code for ie6,ie5
         xmlhttp=new AciveXObject("Microsoft.XMLHTTP");
        }
    function showDate(){
var d = new Date();
var month = new Array();
month[0] = "January";
month[1] = "February";
month[2] = "March";
month[3] = "April";
month[4] = "May";
month[5] = "June";
month[6] = "July";
month[7] = "August";
month[8] = "September";
month[9] = "October";
month[10] = "November";
month[11] = "December";
var n = month[d.getMonth()]+" "+d.getDate()+", "+d.getFullYear();
document.getElementById('date').innerHTML=n;
}
function payInvoice(){
     
            payment=document.getElementById("payment").value;
            if (payment=="cash" || payment=="cc"){
             
            }else{
             alert("Please Choose a method of payment");
             return false;
            }
            invid=document.getElementById("invoice").innerHTML;
            xmlhttp.onreadystatechange = function(){
                if (this.readyState==4 && this.status==200){
                 response=this.responseText;
                    document.getElementById('invpaid').innerHTML="<p class='display-3 text-white bg-danger'>"+response+"</p>";
                    if (response.trim()=="Paid"){
                     document.getElementById('btnPay').innerHTML="";
                     document.getElementById('payment').disabled=true;
                    }
        }
    };
     xmlhttp.open("GET","payinvoicerequest.php?invid="+invid+"&payment="+payment,true);
            xmlhttp.send();
}
</script>

</head>
<body >
<?php
include ("menu.php");
include ("bodyheader.php");
?>
 <?php
$numInvoices=0;
include("connection.php");
$membershipID=$_GET['id'];
if (isset($_GET['paid'])){
 $paid=trim($_GET['paid']);
 echo $paid;}
  else{
  $paid="";
 }
if ($paid=="y"){
 $paidtxt="<p class='display-3 text-white bg-danger'>Paid</p>";
}else{
  $paidtxt="<p class='display-3 text-white bg-danger'></p>";
}
$invoiceID=$_GET['invid'];
$sqlquery="SELECT m.Id,m.FirstName,m.LastName,m.AddressLine1,m.DateJoined,m.City,m.State,m.ZipCode,inv.Id as inId,inv.price,inv.total,inv.month,inv.dueDate,inv.membershipId FROM tblmember m JOIN tblinvoice inv ON m.id=inv.CustomerId 
WHERE m.id=$membershipID AND inv.Id=$invoiceID ORDER BY inv.dateIssued asc";
$result=mysqli_query($connection,$sqlquery);
echo mysqli_error($connection);
$sqlmembershipname="SELECT Id, Name FROM tblmemberships";
$membershiparray=[];
$sqlresulmembership=mysqli_query($connection,$sqlmembershipname);
while ($rowa=mysqli_fetch_array($sqlresulmembership)){
    $membershiparray[$rowa['Id']]=$rowa['Name'];
}
while ($row=mysqli_fetch_array($result)){
    $sqlmpay="SELECT * FROM tblinvoicepaid WHERE invoiceId=$invoiceID";
    $resulmpay=mysqli_query($connection,$sqlmpay);
    $rowmpay=mysqli_fetch_array($resulmpay);
    $methodPay=$rowmpay['methodPayment'];
    $datepaid=$rowmpay['DatePayment'];
    $membershiId=$row['membershipId'];
    $memFirstName=$row['FirstName'];
    $memLastName=$row['LastName'];
    $invoicePrice=$row['price'];
    $invoicetotal=$row['total'];
    $invoicedue=$row['dueDate'];
    $invoicemonth=$row['month'];
    $memberaddress=$row['AddressLine1'];
    $InvoiceId=$row['inId'];
    $membershipname=$membershiparray[$membershiId];
    $memberCity=$row['City'];
    $memberstate=$row['State'];
    $memberzip=$row['ZipCode'];
    $memberDateJoined=$row['DateJoined'];


}
?>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col bg-primary">
            <h1 class="text-white text-center display-3">Six Pack Invoice</h1>
        </div>
        <div class="float-right col-2">
        <button type="button" class="btn btn-primary col d-print-none" onclick="window.print();">Print</button>
        <p></p><a type="button" class="btn btn-primary col d-print-none" href="rptallinvoices.php">Go Back</a>
        </div>
    </div>
    <br><br>
    <div class="row">
     <div class="col  text-center" id="invpaid"><?php echo $paidtxt;?></div>
    </div>
</div>
<br><br><br>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="float-left"><h4>Date: <span id="date" ><?php if ($datepaid==""){ echo date("F j, Y");}else{echo date('F d, Y', strtotime($datepaid));}?></span></h4></div>
            <div class="float-right">
             <select class="form-control" id="payment" <?php if ($paid=="y"){ echo "disabled";}?>>
              <option>Payment Method</option>
              <option value="cash" <?php if ($methodPay=="cash"){ echo "selected";}?>>Cash</option>
              <option value="cc" <?php if ($methodPay=="cc"){ echo "selected";}?>>Credit Card</option>
             </select>
            </div>
        </div>
        
        
    </div>
    <div class="row">
     <div class="col"><hr></div>
    </div>
<div class="row">
 <div class="col"><legend>Member Information</legend></div>
</div>
<div class="row">
    <div class="col-4">
        <p><span class="font-weight-bold">Name: </span><span class="font-italic"><?php echo $memFirstName." ".$memLastName;?></span></p>
        <p><span class="font-weight-bold">Address: </span><span class="font-italic"><?php echo $memberaddress;?><br>
            <span class="font-weight-bold">        </span><span class="font-italic"><?php echo $memberCity.", ".$memberCity." ".$memberzip;?>
        </span></p>
    </div>
    <div class="col-4">
        <p><span class="font-weight-bold">Membership:   </span><span class="font-italic"><?php echo $membershipname;?></span></p>
        <p><span class="font-weight-bold">Member Since: </span><span class="font-italic"><?php echo date('F d, Y', strtotime($memberDateJoined));?><br>
    </div>
        <div class="col-4">
        <p><span class="font-weight-bold">Invoice Number:   </span><span class="font-italic" id="invoice"><?php echo $invoiceID;?></span></p>
        <p><span class="font-weight-bold">Due Date: </span><span class="font-italic text-danger"><?php echo $invoicedue;?><br>
    </div>
</div>
<div class="row">

    <table class="table table-striped ">
     <thead >
      <tr class="d-flex">
       <th class="col">DESCRIPTION</th>
       <th class="col-sm-2">UNIT PRICE</th>
       <th class="col-sm-2">QTY</th>
       <th class="col-sm-2">TOTAL</th>
      </tr>
     </thead>
     <tbody>
      <tr class="d-flex bg-primary text-white">
       <td class="text-capitalize col"><?php echo $membershipname." membership for ".$invoicemonth?></td>
       <td class="col-sm-2"><?php echo $invoicePrice?></td>
       <td class="col-sm-2">1</td>
       <td class="col-sm-2"><?php echo $invoicePrice?></td>
      </tr>
      <tr><td></tr>
      <tr
     </tbody>
     
    </table>

 </div >
    <div class="row mt-2 text-white">
     <div class="col-8"></div>
      <span class="col-2 bg-primary border border-dark">Sub-Total</span><span class="col-2 bg-primary border border-dark"><?php echo $invoicePrice?></span>
    </div>
    <div class="row mt-2 text-white">
     <div class="col-8"></div>
      <span class="col-2 bg-primary border border-dark">Tax</span><span class="col-2 bg-primary border border-dark"><?php echo $invoicetotal-$invoicePrice?></span>
    </div>
    <div class="row mt-2 text-white">
     <div class="col-8"></div>
      <span class="col-2 bg-danger border border-dark">Total</span><span class="col-2 bg-danger border border-dark"><?php echo $invoicetotal?></span>
    </div>
    <br>
    <div class="row mt-2 text-white" >
     <div class="col-8"></div>
     <div class="col-4 p-0" id="btnPay">
      <?php if ($paid=="y"){
       echo "";
      }else{
       echo '<a type="button" class="btn btn-primary col m-0" onclick="payInvoice();" >Pay Invoice</a>';
      }?>
     </div>
     
    </div>
</div><!--Closing container-->

<div class="">
 <br><br><br><br><br><br><br><br>
</div>

<?php
include ("footer.php");
?>

