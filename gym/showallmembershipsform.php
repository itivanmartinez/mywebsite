<!DOCTYPE html>
<html>
<?php
include("header.php");
include("connection.php")
?>
<script>
      function showInfo(str){
            if (window.XMLHttpRequest){
                //code for ie7, firefox,chrome,opera,safari
                xmlhttp= new XMLHttpRequest();
            }
            else{
                //code for ie6,ie5
                xmlhttp=new AciveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function(){
                if (this.readyState==4 && this.status==200){
                    document.getElementById("showmemberships").innerHTML=this.responseText;
                }
            };
            
            xmlhttp.open("GET","tblshowallmemberships.php?rquest="+str,true);
            xmlhttp.send();
        } 
</script>
</head>
<body>
<?php
include ("menu.php");
include ("bodyheader.php");
?>
<div class="container">
    <br>
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary col-3 float-right text-white" href="addmemberships.php">Add Membership</a>
        </div>
    </div>
    <br>
    <div class="row" id="showmemberships">
        <?php
        include("tblshowallmemberships.php")
        ?>
    </div>
</div>
<?php
include ("footer.php");
?>