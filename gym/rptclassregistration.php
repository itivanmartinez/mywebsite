<!DOCTYPE html>
<html>
<?php
include("header.php");
include("connection.php");
$DayArray=array("all"=>"Show All","mon"=>"Monday","tue"=>"Tuesday","wed"=>"Wedenesday","thu"=>"Thursday","fri"=>"Friday","sat"=>"Saturday", "sun"=>"Sunday");
$TimeArray=array("8a"=>"8:00 A.M","9a"=>"9:00 A.M","10a"=>"10:00 A.M","11a"=>"11:00 A.M","12p"=>"12:00 P.M","1p"=>"1:00 P.M","2p"=>"2:00 P.M","3p"=>"3:00 P.M","4p"=>"4:00 P.M","5p"=>"5:00 P.M","6p"=>"6:00 P.M","7p"=>"7:00 P.M","8p"=>"8:00 P.M");
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


    function showInfo(str){
        
        xmlhttp.onreadystatechange = function(){
            if (this.readyState==4 && this.status==200){
                document.getElementById("showclassregistration").innerHTML=this.responseText;
            }
        };
        
        xmlhttp.open("GET","tblshowclassregistration.php?request="+str,true);
        xmlhttp.send();
    }
</script>
</header>
<body onload="showInfo('all');">

<?php
include("menu.php");
include("bodyheader.php");
?>
<br><br>
<div class="container">
       <div class='row'>
        <div class="col"><br><br><h4>Date: <span id="date" ><?php echo date("F j, Y");?></span></h4></div>
    </div>
    <div class="row">
        <div class="col">
            <h1>Class Report</h1>
        </div>
        <div class="float-right col-2">
        <button type="button" class="btn btn-primary col d-print-none" onclick="window.print();">Print</button>
        <p></p><a type="button" class="btn btn-primary col d-print-none" href="reports.php">Go Back</a>
        </div>
    </div>

</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-4">
            <select name="classday" class="form-control" onclick="showInfo(this.value);">
            <?php
            foreach ($DayArray as $keyday=>$valueday){
                echo "<option value=$keyday>$valueday</option>";
            }
            ?>
            </select>
        </div>
    </div>
    <br>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Location</th>
            <th>Instructor</th>
            <th>Seats Available</th>
            <th>Day</th>
            <th>Time</th>
            <th></th><th></th>
        </tr>
    </thead>
    <tbody id="showclassregistration">

    </tbody>
    
</table>
</div>





<?php
include("footer.php");
mysqli_close($connection);
?>