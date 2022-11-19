<!DOCTYPE html>
<html lang="en">
<?php
 
 //connection
 include '../src/connect.php'; 
if(isset($_POST['email']) && isset($_POST['password'])){
 
//Assign

$email=$_POST['email'];
$password=md5($_POST['password']);
 session_start();

//check record
$query="select * from person where email='$email'and password='$password'";
$result=mysqli_query($conn,$query) or die(mysqli_error($conn));
$row=mysqli_fetch_array($result);
//validate email if exist
$check=mysqli_query($conn,"select * from person WHERE email='$email'");
//validate email if exist
$ch=mysqli_query($conn,"select * from person WHERE email='$email' and confirmed_acc='1'");

if(mysqli_num_rows($check)){


if(mysqli_num_rows($ch))
{
    if($row !==NULL && strtolower($row['email'])==strtolower($email) && $row['password']==$password)
    {
    
    
       
        $_SESSION['email']=$row['email'];
        $email=$_SESSION['email'];
        $_SESSION['person_id']=$row['person_id'];
        $id=$_SESSION['person_id'];
        $_SESSION['id_number']=$row['id_number'];
        $idno=$_SESSION['id_number'];
        echo'<script>alert("Login was successful")</script>'; 
      
        header('Location: ../user/person/view.php');
        
        
    
    }else
    {
    
       
        echo'<script>alert("Wrong email or password.");window.location = "login.php";</script>';
        
         exit;
    }



}
else{



    echo'<script>alert("Account not confirmed.");window.location = "login.php";</script>';
        
    exit;






}



}else
{

    echo'<script>alert("Email not registered");window.location = "login.php";</script>';
    
    exit;


}

}

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Identification System | Login</title><link rel="icon" href="../assets/img/logo.jpg">
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
    <div style="height: 500px;background: url(&quot;assets/img/Facial-recognition-technology-explained-compressed.jpg&quot;) center / cover no-repeat;">
        <div class="d-flex justify-content-center align-items-center" style="height: inherit;min-height: initial;width: 100%;position: absolute;left: 0;background: rgba(30,41,99,0);">
            <div class="d-flex align-items-center order-5" style="height:200px;">
                <div class="container">
                    <h1 class="text-center" style="color: rgb(242,245,248);font-size: 30px;font-weight: bold;"><i class="fa fa-bullseye" style="color: rgb(255,255,255);"></i><strong>&nbsp;IDENTIFICATION SYSTEM</strong><br></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="shadow-lg login-card" style="margin-top: 130px;border-radius: 13px;background: rgb(255,255,255);">
    <h3 class="text-uppercase" data-bs-toggle="tooltip" data-bss-tooltip="" style="font-size: 19px;text-align: right;color: rgb(46,35,253);" title="close"><a href="../index.php"><i class="fa fa-window-close" style="font-size: 21px;"></i></a>&nbsp;</h3>    
    <p style="text-align: center;">
            <picture><img src="assets/img/logo.png" style="height: 120px;"></picture>
        </p>
        <h1 class="text-uppercase" style="font-size: 19px;text-align: left;color: rgb(46,35,253);"></h1>
        <h3 class="text-uppercase" style="font-size: 19px;text-align: center;color: rgb(46,35,253);"><strong> User Login</strong>&nbsp;</h3>
        <form class="form-signin" name="form" onsubmit="return validateForm();"  method="post" action="">
        <span class="reauth-email"> </span><input class="form-control"  type="email" id="email"  name="email" placeholder="Email address" autofocus="" style="font-size: 14px;"><span id="uerror"></span>
        <input class="form-control" type="password" id="password" name="password" placeholder="Password" style="font-size: 14px;"><span id="perror"></span>
            <div class="checkbox"></div><button class="btn btn-primary btn-lg d-block btn-signin w-100" type="submit" style="background: rgb(48,37,252);">Login</button>
        </form>
        <p class="lead" style="font-size: 15px;">Forgot your password?&nbsp;<a class="forgot-password" href="passwordrecover.php" style="color: rgb(44,32,252);font-size: 14px;font-weight: bold;">Click here</a>&nbsp;or Don't have account?&nbsp;<a href="register.php" style="color: rgb(46,35,253);font-weight: bold;font-size: 14px;">Click here</a></p>
       
    </div>
    <footer class="footer-basic">
        <p class="copyright" style="font-size: 14px;">Identificationsystem © 2022</p>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/Multi-step-form.js"></script>
</body>

</html>