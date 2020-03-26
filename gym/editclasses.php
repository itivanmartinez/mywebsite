<!DOCTYPE html>
    <?php
    include("header.php");
    include("connection.php");
    ?>
    <script>
        
    </script>
</head>
<body>
    <?php
    include("menu.php");
    include("bodyheader.php");
    $classid=$_GET['id'];
    $sqledit="SELECT * FROM tblclasses c JOIN tblclassesdays cd ON c.id= cd.id WHERE c.id=$classid" ;
    $resultedit=mysqli_query($connection,$sqledit);
    $row=mysqli_fetch_array($resultedit);
    ?>
    <br><br>
    <div class="container">
        <form action="processclassesupdate.php" method="post" name="frmclasses">
            <div class="form-row">
                <div class="col-2"></div>
                <div class="col-4">
                    <legend>Edit Class Information</legend>
                    <hr>
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="col-2"></div>
                <div class="col-4">
                    <label>Class Id</label>
                    <input type="text" value="<?php echo $row['id']?>" readonly placeholder="Enter Class Name" name="ClassId" class="form-control">
                </div>
            </div>
            <div class="form-row mb-4">
                <div class="col-2"></div>
                <div class="col-4">
                    <label>Name</label>
                    <input type="text" value="<?php echo $row['Name']?>" placeholder="Enter Class Name" name="ClassName" class="form-control text-capitalize">
                </div>
            </div>
            <div class="form-row">
                <div class="col-2"></div>
                <div class="col-4">
                    <label>Description</label>
                    <textarea rows=4 placeholder="Enter a description for the class" name="ClassDescription" class="form-control text-capitalize"><?php echo $row['Description'];?></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="col-2"></div>
                <div class="col-4">
                    <label>Class Location</label>
                    <select name="ClassLocation" class="form-control">
                        <option selected>Choose Class Location</option>
                        <option value="1" <?php if ($row['Location']==1){echo "selected";}?>>Yoga Room (Max 15)</option>
                        <option value="2" <?php if ($row['Location']==2){echo "selected";}?>>Pool      (Max 20)</option>
                        <option value="3" <?php if ($row['Location']==3){echo "selected";}?>>Studio    (Max 15)</option>
                    </select>
                </div>
         
            </div>
            <div class="form-row">
                <div class="col-2"></div>
                <div class="col-4">
                    <label>Day</label>
                    <select name="ClassDay" class="form-control">
                    <?php
            $DayArray=array("all"=>"Show All","mon"=>"Monday","tue"=>"Tuesday","wed"=>"Wedenesday","thu"=>"Thursday","fri"=>"Friday","sat"=>"Saturday", "sun"=>"Sunday");
            $TimeArray=array("8a"=>"8:00 A.M","9a"=>"9:00 A.M","10a"=>"10:00 A.M","11a"=>"11:00 A.M","12p"=>"12:00 P.M","1p"=>"1:00 P.M","2p"=>"2:00 P.M","3p"=>"3:00 P.M","4p"=>"4:00 P.M","5p"=>"5:00 P.M","6p"=>"6:00 P.M","7p"=>"7:00 P.M","8p"=>"8:00 P.M");
            foreach ($DayArray as $keyday=>$valueday){
                if ($keyday==$row['days']){
                            $Sselected="selected";
                        }else{
                            $Sselected="";
                        }
                        echo "<option value=$keyday $Sselected>$DayArray[$keyday]</option>";
            }

                    ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col-2"></div>
                <div class="col-4">
                    <label>Instructor Name</label>
                    <input type="text" name="Classinstructor" value="<?php echo $row['Instructor']?>" class="form-control text-capitalize">
                </div>
            </div>
            <div class="form-row">
                <div class="col-2"></div>
                <div class="col-4">
                    <label>Time</label>
                    <select class="form-control" name="ClassTime">
                        <option >Choose Time</option>
            <?php
            foreach ($TimeArray as $keytime=>$valuetime){
                if ($keytime==$row['time']){
                            $Sselected="selected";
                        }else{
                            $Sselected="";
                        }
                        echo "<option value=$keytime $Sselected>$TimeArray[$keytime]</option>";
            }

                    ?>
                    </select>
                </div>
            </div>
            <br>
            <div class="form-row">
                <div class="col-2"></div>
                <div class="col-2">
                    <button class="btn btn-primary form-control mr-1" type="submit">Save</button>
                </div>
                <div class="col-2">
                    <button class="btn btn-primary form-control ml-1" type="reset">Reset</button>
                </div>
            </div>
        </form>
        <br><br>
     </div>
    
            
        
    
<?php
include("footer.php");
?>