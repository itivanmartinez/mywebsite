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
        function updateInvoices(str){
            xmlhttp.onreadystatechange = function(){
                if (this.readyState==4 && this.status==200){
                 response=this.responseText;
                    document.getElementById('tblinvoices').innerHTML=this.responseText;
                    
        }
    };
     xmlhttp.open("GET","updateinvoices.php?request="+str,true);
            xmlhttp.send();
}
</script>
</head>
<?php
include ("menu.php");
include ("bodyheader.php");
?>
<body onload="updateInvoices('all');">

<div class="container">
    <div class="row"><div class="col"><h4>Date: <span id="date" ><?php echo date("F j, Y");?></span></h4></div></div>
    <div class="row">
        <div class="col">
            <h1>All Invoices Report</h1>
        </div>
        <div class="float-right col-2">
        <button type="button" class="btn btn-primary col d-print-none" onclick="window.print();">Print</button>
        <p></p><a type="button" class="btn btn-primary col d-print-none" href="reports.php">Go Back</a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-9"></div>
        <div class="col float-right">
            <select class="form-control" onchange="updateInvoices(this.value);">
                <option >Filters</option>
                <option value="all">All Invoices</option>
                <option value="paid">Paid Invoices</option>
                <option value="unpaid">Unpaid Invoices</option>
            </select></div>
    </div>
</div>

<br>

<div class="container" id="tblinvoices">

</tbody>
</table>
</div>



<?php
include ("footer.php");
?>

