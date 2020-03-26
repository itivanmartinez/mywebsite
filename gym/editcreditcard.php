<!DOCTYPE html>
    <html>
        <?php
        include("header.php");
        ?>
        <script>
            function showInfo(str){
                if (str==""){
                    document.getElementById("CCTable").innerHTML="<b>Credit Card Info will be displayed here...</b>";
                    return;
                }else{
                    if (window.XMLHttpRequest){
                        //code for ie7, firefox,chrome,opera,safari
                        xmlhttp= new XMLHttpRequest();
                    }
                    else{
                        //code for ie6,ie5
                        xmlhttp=new AciveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange=function(){
                        if (this.readyState==4 && this.status==200){
                            document.getElementById("CCTable").innerHTML=this.responseText;
                        }
                    };
                    xmlhttp.open("GET","tblcreditcardmembershowinfo.php?rquest="+str,true);
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
                    <div class="forms-row mb-4">
                        <div class="col-2"></div>
                        <div class="col-lg-6 col-xl-6">
                            <legend>Edit Credit Card Form</legend>
                            <hr />
                        </div>
                    </div> 
                    <div class="forms-row mb-4">
                        <div class="col-2"></div>
                        <div class="col-lg-6 col-xl-6">
                            <label>Enter Member ID</label>
                            <input class="form-control" type="text" placeholder="Enter Member ID" name="Lookup" onkeyup="showInfo(this.value);">
                        </div>
                    </div>
                </form>
                <br />
                <div id="CCTable">
                    <b>Credit Card Info will be displayed here...</b>
                </div>
                
            </div>
            <?php include("footer.php");?>
            
        </body>   
    </html>