<!DOCTYPE html>
<html>
<?php
include("header.php");
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
                    document.getElementById("CCTable").innerHTML=this.responseText;
                }
            };
            
            xmlhttp.open("GET","showallmembertable.php?rquest="+str,true);
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


    
</div>
<div class="container">
    <form>
        <div class="form-row">
            <div class="col">
                <legend>Member Management</legend>
                <hr/>
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col">
                <h5>Enter Id to Search</h4>
                <input type="text" class="form-control col-4 float-left" placeholder="Enter Id or Last Name" name="Lookup" onkeyup="showInfo(this.value)">
                <a class="col-3 float-right btn btn-secondary text-white" href="addmember.php"><span>Add Member</span></a>
            </div>
        </div>
    </form>
    <div id="CCTable">
        <?php include ("showallmembertable.php");?>
    </div>
</div>
<?php
include ("footer.php");
?>