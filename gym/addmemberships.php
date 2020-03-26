<!DOCTYPE html>
    <html>
        <?php
        include("header.php");
        include("connection.php");
        
        ?>
        <script>
            function validateForm(){
                myForm=document.forms.frmmembership;
                ClassName=myForm.ClassName;
                ClassDescription=myForm.ClassDescription;
                ClassPrice=myForm.ClassPrice;
                if (ClassName.value==""){
                    alert("Must Enter a Name");
                    ClassName.focus();
                    return false;
                }
                if (ClassDescription.value==""){
                    alert("Must Enter a Description");
                    ClassDescription.focus();
                    return false;
                }
                if (ClassPrice.value==""){
                    alert("Must Enter a Price");
                    ClassPrice.focus();
                    return false;
                }
                if (ClassPrice.value>0 && Number.isInteger(parseInt(ClassPrice.value))){
                    return;
                    }else{
                    alert("Price must be a positive and whole number");
                    ClassPrice.focus();
                    return false;
                    }
                      var con=confirm("Do you want add membership level?");
                    if (con==true){
                       
                    }else{
                       return false;
                    }
            }
        </script>
        </head>
        <body>
            <?php
            include("menu.php");
            include("bodyheader.php");
            ?>
            <br><br>
            <div class="container">
                <form action="processmembership.php" method="post" name="frmmembership" onsubmit="return validateForm();">
                    <div class="form-row">
                        <div class="col-2"></div>
                        <div class="col-6">
                            <legend>Add Membership Level</legend>
                            <hr>
                        </div>
                    </div>
                    <div class="col-2"></div>
                    <div class="form-row">
                        <div class="col-2"></div>
                        <div class="col-4">
                             <legend>Name</legend>
                            <input type="text" placeholder="Class Name" class="form-control text-capitalize" name="ClassName">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-2"></div>
                        <div class="col-4">
                            <legend>Class description</legend>
                            <textarea class="form-control text-capitalize" name="ClassDescription" placeholder="Enter Class Description" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-2"></div>
                        <div class= "col-4">
                            <legend>Price</legend>
                            <input type="number" placeholder="Enter Price" class="form-control" name="ClassPrice">
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col-2"></div>
                        <div class="col-2">
                            <button type="submit" name="btnMembershipSubmit" class="btn btn-primary form-control">Add Membership</button>
                        </div>
                        <div class="col-2">
                            <button type="reset" name="btnMembershipSubmit" class="btn btn-primary form-control">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </body>
    </html>