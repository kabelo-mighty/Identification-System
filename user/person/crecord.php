<!--session-->
<?php include 'inc/session.php'?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Identification System | Profile</title><link rel="icon" href="../../assets/img/logo.jpg">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/alert.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Customizable-Background--Overlay.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/Multi-step-form.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body  style="background: #ffffff;">
     <!--nav bar-->
  <?php include 'inc/nav.php'; ?>
    <div class="container" style="padding-top: 61px;padding-right: 40px;padding-left: 40px;">
  <!--error-->

  <?php include 'inc/error.php'?>

  <!--end error-->
        <div class="shadow" style="padding-top: 9px;border-radius: 10px;">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-1" style="font-size: 16px;color: rgb(44,32,252);font-weight: bold;"><i class="fa fa-home"></i>&nbsp;Home</a></li>
                <li class="nav-item" role="presentation" style="color: rgb(132,132,132);"><a class="nav-link active" role="tab" data-bs-toggle="tab" href="#tab-2" style="font-size: 16px;color: rgb(44,32,252);font-weight: bold;"><i class="fa fa-user"></i>&nbsp; Account</a></li>
                <li class="nav-item" role="presentation" style="color: rgb(15,15,16);"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-3" style="font-weight: bold;font-size: 16px;color: rgb(44,32,252);"><i class="fa fa-camera"></i>&nbsp; Facial Service</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade" role="tabpanel" id="tab-1">
                    <a class="btn" role="button"  style="border-style: none;color: rgb(132,132,132);font-size: 17px;" href="view.php">Dashboard</a></div>
                <div class="tab-pane fade show active" role="tabpanel" id="tab-2">
                    <a class="btn" role="button"  style="border-style: none;color: rgb(132,132,132);font-size: 17px;" href="profile.php">Profile</a>
                    <a class="btn" role="button"  style="border-style: none;color: rgb(132,132,132);font-size: 17px;" href="crecord.php">Criminal record</a>
                    <a class="btn" role="button"  style="border-style: none;color: rgb(132,132,132);font-size: 17px;" href="inc/delete.php?value=<?php echo $id; ?>">Delete Account</a>
                <a class="btn" role="button"  href="../../account/logout.php" style="border-style: none;color: rgb(132,132,132);font-size: 17px;">Logout</a></div>
                <div class="tab-pane fade" role="tabpanel" id="tab-3">
                    <p><a class="btn" role="button"  style="border-style: none;color: rgb(132,132,132);font-size: 17px;" href="faceai.php">Capture Photo</a>
                    <a class="btn" role="button"  style="border-style: none;color: rgb(132,132,132);font-size: 17px;" href="face-open.php">View Photo</a></p>
                </div>
            </div>
        </div>
    </div>
    <?php



if(isset($_POST['crimetype']) && isset($_POST['year']))
{
 

$crimetype=$_POST['crimetype'];
$year=$_POST['year'];

   
$command="
INSERT INTO docket(person_id, crime_type,year) 
            VALUES ('$id','$crimetype','$year')";



$edit=mysqli_query($conn,$command);  


if($edit){
mysqli_close($conn);

echo '<script>alert("docket number generated");window.location = "crecord.php";</script>';

exit;

}






}


?>
    <div class="container" style="padding-top: 61px;padding-right: 40px;padding-left: 40px;">
   
        <br><br>
    <form class=" shadow" style="background: #ffffff;margin-top: 0px;border-radius: 10px;">
        <h1 class="text-center" style="font-size: 20px;padding-top: 20px;color: rgb(44,32,252);"><i class="fa fa-certificate"></i>  Criminal file</h1>
  
        <div class="row" style="margin-left: 0px;margin-right: 0px;">
            <div class="col-lg-5 col-xl-10 offset-xl-1">
                <div class="table-responsive ">
                    <table class="table" style="color: rgb(44,32,252);">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><i class="fa fa-balance-scale"></i> Criminal record Type</th>
                                <th><i class="fa fa-calendar"></i> year</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                       
                            <tr>
                                 <?php

$query="SELECT * from person,docket where  person.person_id=docket.person_id and person.person_id='$id'";
$result=mysqli_query($conn,$query);

$rows=mysqli_num_rows($result);                   

    if ($rows>0) {               
while ($rows=mysqli_fetch_array($result)) {
?>
                                <td>DOC100<?php echo $rows['docket_id']?></td>
                                <td><?php echo $rows['crime_type']; ?></td>
                                <td><?php echo $rows['year']; ?></td>
                               
                            </tr>
                            <?php }}else{ ?>

<h5 style="font-weight: bold;color: var(--color-black);text-align:center;">No record of crime.</h5>
<?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
    </div>
    <footer class="footer-basic" style="margin-top: 30px;">
        <p class="copyright" style="font-size: 14px;">Identificationsystem © 2022</p>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/Multi-step-form.js"></script>
</body>

</html>