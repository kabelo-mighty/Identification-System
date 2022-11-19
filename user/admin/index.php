<!DOCTYPE html>
<html lang="en">
<?php
 
 //connection
 include '../../src/connect.php'; 
if(isset($_POST['email']) && isset($_POST['password'])){
 
//Assign

$email=$_POST['email'];
$password=md5($_POST['password']);
 session_start();

//check record
$query="select * from admin where email='$email'and password='$password'";
$result=mysqli_query($conn,$query) or die(mysqli_error($conn));
$row=mysqli_fetch_array($result);
//validate email if exist
$check=mysqli_query($conn,"select * from admin WHERE email='$email'");


if(mysqli_num_rows($check)){

if($row !==NULL && strtolower($row['email'])==strtolower($email) && $row['password']==$password)
{


   
    $_SESSION['email']=$row['email'];
    $email=$_SESSION['email'];
    $_SESSION['admin_id']=$row['admin_id'];
    $id=$_SESSION['admin_id'];
   
    echo'<script>alert("Login was successful")</script>'; 
  
    header('Location: dashboard.php');
    
    

}else
{

   
    echo'<script>alert("Wrong email or password.");window.location = "index.php";</script>';
    
     exit;
}

}else
{

    echo'<script>alert("You are not an authorized admin.");window.location = "index.php";</script>';
    
    exit;


}
}

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Identification System | Login</title><link rel="icon" href="../../assets/img/logo.jpg">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/alert.css">
    <link rel="stylesheet" href="assets/css/Bootstrap-4---Profile-Creation-Wizard.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Customizable-Background--Overlay.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/index-top-info-1.css">
    <link rel="stylesheet" href="assets/css/index-top-info.css">
    <link rel="stylesheet" href="assets/css/LinkedIn-like-Profile-Box.css">
    <link rel="stylesheet" href="assets/css/Multi-step-form.css">
    <link rel="stylesheet" href="assets/css/Navbar---Apple-1.css">
    <link rel="stylesheet" href="assets/css/Navbar---Apple.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Profile-Card.css">
    <link rel="stylesheet" href="assets/css/Profile-with-data-and-skills.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Video-Responsive.css">
</head>
<script>

    
function validateForm() 
{
var uerror=document.getElementById("uerror");
var perror=document.getElementById("perror");


if(document.forms["form"]["email"].value=="" && document.forms["form"]["password"].value=="")
{

uerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Email field should not be empty *</span>"
perror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+"Password field should not be empty *</span>"

return false;

}else
if(document.forms["form"]["email"].value=="")
{

uerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+"Please fill the email field *</span>"

return false;

}else
{

    uerror.innerHTML=""; 
}

if(document.forms["form"]["password"].value=="")
{


perror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:12px;''>"+" Please fill the password field *</span>"

return false;

}else
{

    perror.innerHTML=""; 
}

}
</script>
<body  style="background: rgb(255,255,255);">
    <div class="shadow-lg login-card" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="500" style="margin-top: 130px;border-radius: 13px;background: rgb(255,255,255);">
        <p style="text-align: center;">
            <picture><img src="assets/img/logo.png" style="height: 120px;"></picture>
        </p>
        <h1 class="text-uppercase" style="font-size: 19px;text-align: left;color: rgb(46,35,253);"></h1>
        <h3 class="text-uppercase" style="font-size: 19px;text-align: center;color: rgb(46,35,253);"><strong>Admin Login</strong>&nbsp;</h3>
        <form class="form-signin" name="form" onsubmit="return validateForm();"  method="post" action="">
        <span class="reauth-email"> </span><input class="form-control"  type="email" id="email"  name="email" placeholder="Email address" autofocus="" style="font-size: 14px;"><span id="uerror"></span>
        <input class="form-control" type="password" id="password" name="password" placeholder="Password" style="font-size: 14px;"><span id="perror"></span>
            <div class="checkbox"></div><button class="btn btn-primary btn-lg d-block btn-signin w-100" type="submit" style="background: rgb(48,37,252);color: #ffff;">Login</button>
        </form>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="assets/js/Bootstrap-4---Profile-Creation-Wizard-1.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="assets/js/Bootstrap-4---Profile-Creation-Wizard.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="assets/js/Bootstrap-4---Profile-Creation-Wizard-2.js"></script>
    <script src="assets/js/DataTable---Fully-BSS-Editable.js"></script>
    <script src="assets/js/Multi-step-form.js"></script>
    <script src="assets/js/Navbar---Apple.js"></script>
</body>

</html>