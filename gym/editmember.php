<!DOCTYPE html>
<html>
<?php
include("header.php");
?>
<script>
    function showInfo(str){
        if (str==""){
            document.getElementById("CCTable").innerHTML = "";
            return;
        } else {
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
                    document.getElementById("CCTable").innerHTML=this.responseText;
                }
            };
            
            xmlhttp.open("GET","tblmembershowinfo.php?rquest="+str,true);
            xmlhttp.send();
        }
    }
</script>
</head>
<body>
    
<?php
include ("menu.php");
include ("bodyheader.php");
?>
<div class="container">
    <br/>
    <form>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-lg-6 col-xl-6">
                <legend>Edit Member Form</legend>
                <hr/>
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-lg-6 col-xl-6">
                <label>Enter Last Name</label>
                <input type="text" class="form-control" placeholder="Enter Last Name" name="Lookup" onkeyup="showInfo(this.value);" autofocus>
            </div>
        </div>
    </form>
    <br/>
    <div id="CCTable">
        <b>Member Info will be displayed here...</b>
    </div>
</div>
<?php
include ("footer.php");
?>