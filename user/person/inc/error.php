
<?php 

 //connection
 include 'connect.php';

 $A=mysqli_query($conn,"select * from person WHERE person_id='$id'");
$F=mysqli_query($conn,"select * from face_identification WHERE person_id='$id'");
$row=mysqli_fetch_array($A);
if( !mysqli_num_rows($F) && $row['confirmed_acc']=='0')
{
?>

<div class="alert alert-success alert-dismissible shake animated" role="alert" id="save-sucess" style="background: rgb(44,32,252);border: 1px none #0C6D38;border-radius: 10px;font-size: 14px;color: rgb(255,255,255);"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <h1 style="font-size: 20px;font-weight: bold;"><i class="fa fa-bullhorn"></i>&nbsp; Alert!</h1>
    <span style="color: #ffffff;font-weight: bold;">
    <i class="fa fa-remove me-1"></i>Add facial identity !<br></span>
    <span style="color: #ffffff;font-weight: bold;">
    <i class="fa fa-remove me-1"></i>Your account infomation need to be verified by the Authorities.<br></span>
    </div>


<?php }else if(!mysqli_num_rows($F)){ ?>

    <div class="alert alert-success alert-dismissible shake animated" role="alert" id="save-sucess" style="background: rgb(44,32,252);border: 1px none #0C6D38;border-radius: 10px;font-size: 14px;color: rgb(255,255,255);"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <h1 style="font-size: 20px;font-weight: bold;"><i class="fa fa-bullhorn"></i>&nbsp; Alert!</h1>
   
    <span style="color: #ffffff;font-weight: bold;">
    <i class="fa fa-remove me-1"></i>Your account infomation need to be verified by the Authorities.<br></span>
    </div>

    <?php }else if($row['confirmed_acc']=='0'){ ?>

<div class="alert alert-success alert-dismissible shake animated" role="alert" id="save-sucess" style="background: rgb(44,32,252);border: 1px none #0C6D38;border-radius: 10px;font-size: 14px;color: rgb(255,255,255);"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
<h1 style="font-size: 20px;font-weight: bold;"><i class="fa fa-bullhorn"></i>&nbsp; Alert!</h1>

<span style="color: #ffffff;font-weight: bold;">
    <i class="fa fa-remove me-1"></i>Your account infomation need to be verified by the Authorities.<br></span>
</div>

<?php }else{ ?>
    <?php }; ?>