<?php include 'inc/session.php';?>
<!DOCTYPE html>
<html lang="en">
<?php include'inc/connect.php'; ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Identification System | Update</title><link rel="icon" href="../../assets/img/logo.jpg">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="assets/css/Profile-Card.css">
    <link rel="stylesheet" href="assets/css/Registration-Form-with-Photo.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<?php

$id=$_GET['value'];
$qry=mysqli_query($conn,"select * from docket WHERE docket_id='$id'");
$data=mysqli_fetch_array($qry);

?>
<body style="background: #ffffff;">
    <section class="register-photo" style="background: rgb(255,255,255);">
        <div class="form-container">
            <form method="post">
                <p class="d-lg-flex justify-content-lg-center" style="color: rgb(44,32,252);"><img class="d-lg-flex justify-content-lg-center" src="assets/img/logo.png" style="height: 150px;"></p>
                <h1 class="text-center" style="font-family: ABeeZee, sans-serif;font-size: 21px;">Update Criminal information<a class="float-end" href="criminal.php"><i class="fas fa-window-close" style="color: rgb(44,32,252);"></i></a></h1>
                <hr>
                <p style="color: rgb(44,32,252);">Criminal Record information</p>
                <div class="mb-3"><input class="form-control" type="text" name="" value="<?php echo $data['crime_type']?>" placeholder="Crime  type"></div>

                <select class="form-control">
                 <optgroup label="Select year">
                 <option value="">Select year</option>
               <?php


               $firstYear = (int)date('Y') - 99;
               $lastYear = $firstYear + 99;
               for($i=$firstYear;$i<=$lastYear;$i++)
               {?>
                
                  
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
               
               <?php } ?> 
            </optgroup>
                  </select>
               
                <div class="mb-3"><button class="btn btn-primary d-block w-100" type="submit" style="background: rgb(44,32,252);color: rgb(255,255,255);">Save</button></div>
            </form>
        </div>
    </section>
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