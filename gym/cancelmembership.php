<!DOCTYPE html>
<html>
<?php
include("header.php");
include ("connection.php");
$a=array(
  'AL' => 'Alabama',
  'AK' => 'Alaska',
  'AZ' => 'Arizona',
  'AR' => 'Arkansas',
  'CA' => 'California',
  'CO' => 'Colorado',
  'CT' => 'Connecticut',
  'DE' => 'Delaware',
  'DC' => 'District Of Columbia',
  'FL' => 'Florida',
  'GA' => 'Georgia',
  'HI' => 'Hawaii',
  'ID' => 'Idaho',
  'IL' => 'Illinois',
  'IN' => 'Indiana',
  'IA' => 'Iowa',
  'KS' => 'Kansas',
  'KY' => 'Kentucky',
  'LA' => 'Louisiana',
  'ME' => 'Maine',
  'MD' => 'Maryland',
  'MA' => 'Massachusetts',
  'MI' => 'Michigan',
  'MN' => 'Minnesota',
  'MS' => 'Mississippi',
  'MO' => 'Missouri',
  'MT' => 'Montana',
  'NE' => 'Nebraska',
  'NV' => 'Nevada',
  'NH' => 'New Hampshire',
  'NJ' => 'New Jersey',
  'NM' => 'New Mexico',
  'NY' => 'New York',
  'NC' => 'North Carolina',
  'ND' => 'North Dakota',
  'OH' => 'Ohio',
  'OK' => 'Oklahoma',
  'OR' => 'Oregon',
  'PA' => 'Pennsylvania',
  'RI' => 'Rhode Island',
  'SC' => 'South Carolina',
  'SD' => 'South Dakota',
  'TN' => 'Tennessee',
  'TX' => 'Texas',
  'UT' => 'Utah',
  'VT' => 'Vermont',
  'VA' => 'Virginia',
  'WA' => 'Washington',
  'WV' => 'West Virginia',
  'WI' => 'Wisconsin',
  'WY' => 'Wyoming',
);
?>
<script>

</script>
</head>
<body>
<?php
include ("menu.php");
include ("bodyheader.php");
$id=intval($_GET['memberid']);
#Checking if is already canceled
$sqlcancel2="SELECT * FROM tblmembershipreg WHERE CustomerId=$id AND CanDate IS NOT NULL";
$resultcancel2=mysqli_query($connection,$sqlcancel2);
if (mysqli_num_rows($resultcancel2)>0){
    echo mysqli_num_rows($resultcancel2);
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col">';
    echo '<span class="display-4 text-danger">You have already canceled your membership</span>';
    echo '</div></div></div>';
    die();

}
#udate cancelation date
$date = date("Y-m-d H:i:s");
$sqlcancel="UPDATE tblmembershipreg SET CanDate='$date' WHERE CustomerId=$id";
mysqli_query($connection,$sqlcancel);
$sqlcancel2="SELECT * FROM tblmembershipreg WHERE CustomerId=$id";
$resultcancel2=mysqli_query($connection,$sqlcancel2);
$rowcancel=mysqli_fetch_array($resultcancel2);
$canceldate=date('M j Y', strtotime($rowcancel['CanDate']));
$sqlquery="SELECT * FROM tblmember WHERE id ='".$id."'";
$result=mysqli_query($connection,$sqlquery);
$row=mysqli_fetch_array($result);
$FirstName = $row['FirstName'];
$LastName = $row['LastName'];
$CellPhone = $row['CellPhone'];
$AddressLine1 = $row['AddressLine1'];
$AddressLine2 = $row['AddressLine2'];
$Email = $row['Email'];
$City = $row['City'];
$State = $row['State'];
$ZipCode = $row['ZipCode'];
$User=$row['User'];
$Password=$row['Password'];
?>
<div class="container">
    <form action="processmemberupdate.php" method="post" name="frmmember" onsubmit="return validateform();">
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-8">
                <h1 class="text-danger">Cancel Membership Confirmation</h1>
                <hr>
            </div>
        </div>
        <div class="form-row">
            <div class="col-2"></div>
<div class="col"><br><br><h4>Date: <span id="date" ><?php echo date("F j, Y");?></span></h4></div>
        </div>

        <div class="form-row">
            <div class="col-2"></div>
            <div class="col-8">
                <h3>Contact Information</h5>
                <hr>
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-4">
                <h5>Id</h5>
                <input type="text" class="form-control-plaintext" placeholder="Id" name="IDMember" value= "<?php echo $id;?>" readonly="readonly">
            </div>
                        <div class="col-2">
                <h5>Cancelation Date</h5>
                <input type="text" class="form-control-plaintext" placeholder="Cancelation Date" name="CanDate" value= "<?php echo $canceldate;?>" readonly="readonly">
            </div>
        </div>
            
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-4">
                <h5>First Name</h5>
                <input type="text" class="form-control-plaintext text-capitalize" placeholder="First Name" name="FName" value= "<?php echo $FirstName;?>" readonly="readonly">
            </div>
            <div class="col-4">
                <h5>Last Name</h5>
                <input type="text" class="form-control-plaintext text-capitalize" placeholder="Last Name" name="LName" value= "<?php echo $LastName;?>" readonly="readonly">
            </div>
        </div>
        <div class="form-row mb-4">
             <div class="col-2"></div>
            <div class="col-4">
                <h5>Cell Phone</h5>
                <input type="text" class="form-control-plaintext" placeholder="Cell Phone" name="CPhone" value= "<?php echo $CellPhone;?>">
            </div>
            <div class="col-4">
                <h5>E-Mail</h5>
                <input type="text" class="form-control-plaintext" placeholder="Email" name="Email" value= "<?php echo $Email;?>">
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-4">
                <h5>Address Line 1</h5>
                <input type="text" class="form-control-plaintext text-capitalize" placeholder="Address Line 1" name="AL1" value= "<?php echo $AddressLine1;?>">
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-2">
                <h5>City</h5>
                <input type="text" class="form-control-plaintext text-capitalize" placeholder="City" name="City" value=<?php echo $City;?>>
            </div>
            <div class="col-2">
                <h5>State</h5>
                <select class="form-control-plaintext " placeholder="State" name="State" disabled="disabled">
                    
                    <option value=''>Select State</option>

                    <?php
                    foreach ($a as $k=>$v){
                        if ($k==$State){
                            $Sselected="selected";
                        }else{
                            $Sselected="";
                        }
                        echo "<option value=$k $Sselected>$a[$k]</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-3">
                <h5>Zip Code</h5>
                <input type="text" class="form-control-plaintext" placeholder="Zip Code" name="ZCode" value= "<?php echo $ZipCode;?>">
            </div>
        </div>
        <div class="form-row mb-4">
            <div class="col-2"></div>
            <div class="col-4">
                <p><button type="button" class="btn btn-primary col d-print-none" onclick="window.print();">Print</button></p>
            
            </div>
            <div class="col-4">
                <p><a type="button" class="btn btn-primary col d-print-none" href="membermanagement.php">Go Back</a></p>
            </div>
        </div>        
    </form>
</div>

<?php
include ("footer.php");
?>