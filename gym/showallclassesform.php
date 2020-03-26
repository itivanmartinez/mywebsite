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
                    document.getElementById("showclasslocation").innerHTML=this.responseText;
                }
            };
            
            xmlhttp.open("GET","tblshowallclasses.php?rquest="+str,true);
            xmlhttp.send();
        } 
</script>
</head>
<body onload="showInfo('');">
<?php
include ("menu.php");
include ("bodyheader.php");
?>
<div class="container">
    <div class="row">
        <div class="col-10">
            <select id="ClassLocation" class="form-control col-4 float-left" onchange="showInfo(this.value);">
                <option selected="" value="">Show all Classes</option>
                <option value="1">Yoga Room (Max 15)</option>
                <option value="2">Pool      (Max 20)</option>
                <option value="3">Studio    (Max 15)</option>
            </select>
            <a class="btn btn-secondary col-4 float-right text-white" href="addclasses.php">Add Class</a>
        </div>
        <div class="col-3">
            
        </div>
    </div>
    <br>
    <div class="row" id="showclasslocation">
        <div class="col" ><span class="display-4">Choose a Class Location to continue...</span></div>
    </div>
</div>
<?php
include ("footer.php");
?>