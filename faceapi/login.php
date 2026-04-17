<?php
include '../src/connect.php';
require_once '../src/auth.php';

$flashMessage = app_get_flash_message();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = app_normalize_email($_POST['email'] ?? '');
    $password = (string) ($_POST['password'] ?? '');

    if ($email === '' || $password === '') {
        app_redirect('login.php', 'Email and password are required.');
    }

    $statement = mysqli_prepare($conn, 'SELECT person_id, email, password, employee_type FROM person WHERE email = ? LIMIT 1');
    mysqli_stmt_bind_param($statement, 's', $email);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($statement);

    if (!$row || !app_verify_password($password, $row['password'])) {
        app_redirect('login.php', 'Wrong email or password.');
    }

    if (strcasecmp($row['employee_type'], 'Police') !== 0) {
        app_redirect('login.php', 'Only authorized police users can use this service.');
    }

    if (app_password_needs_upgrade($row['password'])) {
        $newHash = app_hash_password($password);
        $updateStatement = mysqli_prepare($conn, 'UPDATE person SET password = ? WHERE person_id = ?');
        mysqli_stmt_bind_param($updateStatement, 'si', $newHash, $row['person_id']);
        mysqli_stmt_execute($updateStatement);
        mysqli_stmt_close($updateStatement);
    }

    app_start_session();
    session_regenerate_id(true);
    $_SESSION['email'] = $row['email'];
    $_SESSION['person_id'] = $row['person_id'];

    app_redirect('face.php', 'Login successful.');
}
?>
<!DOCTYPE html>
<html  lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Identification System | Police Login</title><link rel="icon" href="../assets/img/logo.jpg">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/alert.css">
    <link rel="stylesheet" href="assets/css/Bootstrap-4---Profile-Creation-Wizard.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Customizable-Background--Overlay.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/FPE-Gentella-form-elements-1.css">
    <link rel="stylesheet" href="assets/css/FPE-Gentella-form-elements.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/index-top-info-1.css">
    <link rel="stylesheet" href="assets/css/index-top-info.css">
    <link rel="stylesheet" href="assets/css/LinkedIn-like-Profile-Box.css">
    <link rel="stylesheet" href="assets/css/Multi-step-form.css">
    <link rel="stylesheet" href="assets/css/Navbar---Apple-1.css">
    <link rel="stylesheet" href="assets/css/Navbar---Apple.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
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
<body style="background: rgb(255,255,255);">
    <?php echo app_render_alert($flashMessage); ?>
    <div class=" shadow-lg login-card"  style="margin-top: 130px;background: rgb(255,255,255);opacity: 0.91;">
        <h3 class="text-uppercase" data-bs-toggle="tooltip" data-bss-tooltip="" style="font-size: 19px;text-align: right;color: rgb(46,35,253);" title="close"><a href="../index.php"><i class="fas fa-window-close" style="font-size: 21px;"></i></a>&nbsp;</h3>
        <p style="text-align: center;"><i class="la la-unlock" style="font-size: 131px;color: rgb(89,81,253);"></i></p>
        <h1 class="text-uppercase" style="font-size: 19px;text-align: left;color: rgb(46,35,253);"></h1>
        <h3 class="text-uppercase" style="font-size: 19px;text-align: center;color: rgb(46,35,253);"><strong>Police Login</strong>&nbsp;</h3>
        <form class="form-signin" name="form" onsubmit="return validateForm();"  method="post" action="">
        <span class="reauth-email"> </span><input class="form-control"  type="email" id="email"  name="email" placeholder="Email address" autofocus="" style="font-size: 14px;"><span id="uerror"></span>
        <input class="form-control" type="password" id="password" name="password" placeholder="Password" style="font-size: 14px;"><span id="perror"></span>
            <div class="checkbox"></div><button class="btn btn-primary btn-lg d-block btn-signin w-100" type="submit" style="background: rgb(48,37,252);color: var(--color-white);">Login</button>
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