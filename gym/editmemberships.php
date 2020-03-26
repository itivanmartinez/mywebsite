<!DOCTYPE html>
    <html>
        <?php
        include ("header.php");
        include("connection.php");
        ?>
        <script>
            function confirmation(){
                var con=confirm("Do you want edit membership level?");
                    if (con==true){
                       
                    }else{
                       return false;
                    }}
                 
        </script>
        </head>
        <body>
            <?php
            include ("menu.php");
            include ("bodyheader.php");
            $id=intval($_GET['id']);
            $sqlquery="SELECT * FROM tblmemberships WHERE Id=$id";
            $result=mysqli_query($connection,$sqlquery);
            $row=mysqli_fetch_array($result);
            $numRows=mysqli_num_rows($result);
            echo $numRows;
            //if ($numRows==0){
            //    header("Location: addcreditcard.php?id=$id");
            //}
            if (!$row){
                echo (mysqli_error($connection));
                exit;
            }
            $id=$row['Id'];
            $Name=$row['Name'];
            $Price=$row['Price'];
            $Description=$row['Description'];
            ?>
            <br/><br/>
            <div class="container">
                <form action="processmembershipupdate.php" method="post" name=frmmembership" onsubmit="return confirmation();">
                    <div class="form-row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <legend>Membership Information</legend>
                            <hr>
                        </div>
                    </div>
                    <div class="form-row mb-4" >
                        <div class="col-2"></div>
                        <div class="col-2">
                            <label>Id</label>
                            <input type="text" class="form-control" placeholder="Id" name="id" value="<?php echo $id;?>" readonly="readonly">
                        </div>
                    </div>
                    <div class="form-row mb-4">
                        <div class="col-2"></div>
                        <div class="col-4">
                            <label>Name</label>
                            <input type="text" class="form-control text-capitalize" placeholder="Name" name="name" value="<?php echo $Name;?>" >
                        </div>
                    </div>
                    <div class="form-row mb-4">
                        <div class="col-2"></div>
                        <div class="col-4">
                            <label>Price</label>
                            <input type="number" class="form-control" placeholder="Price" name="price" value="<?php echo $Price ?>" >
                        </div>
                    </div>
                    <div class="form-row mb-4">
                        <div class="col-2"></div>
                        <div class="col-4">
                            <label>Description</label>
                            <textarea type="text" rows=3 class="form-control text-capitalize" placeholder="Description" name="description" ><?php echo $Description;?></textarea>
                        </div>
                    </div>
                    <div class="form-row mb-4">
                        <div class="col-2">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary col mr-2" name="btnCCUpdate">Save</button>
                        </div>
                        <div class="col-2">
                            <button type="Reset" class="btn btn-primary col mr-2" name= "btnCCReset">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </body>
    </html>