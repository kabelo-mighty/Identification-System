<!DOCTYPE html>
<html lang="en">
    <?php

    include '../src/connect.php';
    
    $id=$_GET['edt'];
    
    ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Identification System | Found Information</title><link rel="icon" href="../assets/img/logo.jpg">
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
    <link rel="stylesheet" href="assets/css/FPE-Gentella-form-elements-1.css">
    <link rel="stylesheet" href="assets/css/FPE-Gentella-form-elements.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
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
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Profile-Card.css">
    <link rel="stylesheet" href="assets/css/Profile-with-data-and-skills.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Video-Responsive.css">
</head>

<body style="background: var(--bs-white);border-radius: 4px;">
<section id="tab">
    <div class="container"  style="padding-top: 60px;">
        <div class="row">
            <div class="col-md-8 col-lg-5 col-xl-5 offset-md-2 offset-lg-4 offset-xl-4" style="border-style: ridge;">
                <div class="card shadow-none" style="line-height: 14px;letter-spacing: 1px;">
                    <div class="card-body" style="font-size: 13px;border-style: ridge;">
                        <h2 class="text-uppercase card-subtitle" style="font-size: 16px;font-weight: bold;color: var(--color-black);text-align: center;">Confidential information</h2>
                    </div>
                    <div class="card-body" style="font-size: 13px;border-style: ridge;">
                        <h5 class="text-uppercase card-subtitle" style="font-size: 16px;font-weight: bold;color: var(--color-black);text-align: center;">&nbsp;Personal Details</h5>
                        <hr style="background: var(--color-black);color: rgb(0,0,0);">
                        <!--pinfo query -->
                  <?php

                  $query="SELECT f.picture as p from face_identification f,person p where p.person_id = f.person_id and p.id_number='$id'";
                  $result=mysqli_query($conn,$query);

                  $rows=mysqli_num_rows($result);                   

                      if ($rows>0) {               
                  while ($rows=mysqli_fetch_array($result)) {
                  ?>
                        <div style="text-align: center;">
                            <picture><img src="person_face_id/<?php echo $rows['p'] ?>.jpg" style="height: 240px;width: 320px;filter:saturate(0%);""></picture>
                        </div>
                        <?php }}?>
                        <hr style="background: var(--color-black);color: rgb(0,0,0);">
                        <div class="table-responsive" style="border-color: var(--color-black);text-align: left;font-size: 13px;">
                            <table class="table table-borderless">
                                <thead style="border-color: var(--color-black);">
                                    <tr></tr>
                                </thead>
                                 <!--pinfo query -->
                                 <?php

                                 $query="SELECT * from person where id_number='$id'";
                                 $result=mysqli_query($conn,$query);
                        
                                 $rows=mysqli_num_rows($result);                   
                        
                                     if ($rows>0) {               
                                    while ($rows=mysqli_fetch_array($result)) {
                                ?>
                                <tbody>
                                    <tr>
                                        <td style="font-weight: bold;color: var(--color-black);">Firstname</td>
                                        <td style="font-weight: bold;"><?php echo $rows['firstname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;color: var(--color-black);">Lastname</td>
                                        <td style="font-weight: bold;"><?php echo $rows['lastname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;color: var(--color-black);">Date Of Birth</td>
                                        <td style="font-weight: bold;"><?php
                                          $age=DateTime::createFromFormat("Y-m-d", $rows['dateOfbirth']);
                                          $pyear=$age->format("Y");
                                          $month=$age->format("M");
                                          $day=$age->format("d");
                                        
                                        echo $day.' '.$month.' '.$pyear; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;color: var(--color-black);">Gender</td>
                                        <td style="font-weight: bold;"><?php echo $rows['gender']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;color: var(--color-black);">Id Number</td>
                                        <td style="font-weight: bold;"><?php echo $rows['id_number']; ?></td>
                                    </tr>
                                    <tr>
                                        <tr>
                                            <td style="font-weight: bold;color: var(--color-black);">Age</td>
                                            <td style="font-weight: bold;"><?php 
                                            $age=DateTime::createFromFormat("Y-m-d", $rows['dateOfbirth']);
                                            $pyear=$age->format("Y");
                                            $curr=date("Y");
                                            $calcAge=$curr-$pyear;
                                            
                                            echo $calcAge; ?></td>
                                    </tr>
                                </tbody>
                                <?php }
                            } ?>
                            </table>
                        </div>
                    </div>
                    <div class="card-body" style="font-size: 13px;border-style: ridge;">
                        <h5 class="text-uppercase card-subtitle" style="font-size: 16px;font-weight: bold;color: var(--color-black);text-align: center;">&nbsp;Address</h5>
                        <hr style="background: var(--color-black);">
                        <div class="table-responsive" style="border-color: var(--color-black);">
                            <table class="table table-borderless">
                                <thead style="border-color: var(--color-black);">
                                    <tr></tr>
                                </thead>
                                <!--ainfo query -->
                                <?php

                                $query="SELECT * from person where id_number='$id'";
                                $result=mysqli_query($conn,$query);

                                $rows=mysqli_num_rows($result);                   

                                    if ($rows>0) {               
                                while ($rows=mysqli_fetch_array($result)) {
                                ?>
                               <tbody>
                                    <tr>
                                        <td style="font-weight: bold;color: var(--color-black);">House no</td>
                                        <td style="font-weight: bold;"><?php echo $rows['house_no']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;color: var(--color-black);">Street name</td>
                                        <td style="font-weight: bold;"><?php echo $rows['street_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;color: var(--color-black);">Suburb</td>
                                        <td style="font-weight: bold;"><?php echo $rows['suburb']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;color: var(--color-black);">City</td>
                                        <td style="font-weight: bold;"><?php echo $rows['city']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;color: var(--color-black);">Province</td>
                                        <td style="font-weight: bold;"><?php echo $rows['province']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;color: var(--color-black);">Zip Code</td>
                                        <td style="font-weight: bold;"><?php echo $rows['zip_code']; ?></td>

                                    </tr>
                                    <?php 

                                    if($rows['country']){
                                        ?>
                                    <tr>
                                        <td style="font-weight: bold;color: var(--color-black);">Country</td>
                                        <td style="font-weight: bold;"><?php echo $rows['country']; ?></td>
                                    </tr>
                                    <?php }else{ ?>
                                        <?php }; ?>
                                </tbody>
                                <?php }
                            } ?>
                            </table>
                        </div>
                    </div>
                    <div class="card-body shadow-none" style="font-size: 13px;border-style: ridge;">
                        <h5 class="text-uppercase card-subtitle" style="font-size: 16px;font-weight: bold;color: var(--color-black);text-align: center;">&nbsp;Contact</h5>
                        <hr style="background: var(--color-black);">
                        <div class="table-responsive" style="border-color: var(--color-black);">
                            <table class="table table-borderless">
                                <thead style="border-color: var(--color-black);">
                                    <tr></tr>
                                </thead>
                                 <!--cinfo query -->
                                 <?php

                                $query="SELECT * from person where id_number='$id'";
                                $result=mysqli_query($conn,$query);

                                $rows=mysqli_num_rows($result);                   

                                    if ($rows>0) {               
                                while ($rows=mysqli_fetch_array($result)) {
                                ?>
                                <tbody>
                                    <tr>
                                        <td style="font-weight: bold;color: var(--color-black);">Email</td>
                                        <td style="font-weight: bold;"><?php echo $rows['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;color: var(--color-black);">Phone Number</td>
                                        <td style="font-weight: bold;"><?php echo '('.substr($rows['phone'],0,3).')'.' '.substr($rows['phone'],3,3).' '.substr($rows['phone'],6,4); ?></td>
                                    </tr>
                                </tbody>
                                <?php }
                            } ?>
                            </table>
                        </div>
                    </div>
                    <div class="card-body" style="font-size: 13px;border-style: ridge;">
                        <h3 class="text-uppercase card-subtitle" style="font-size: 16px;font-weight: bold;color: var(--color-black);text-align: center;">&nbsp;Next of keen</h3>
                        <hr style="background: var(--color-black);">
                        <div class="table-responsive" style="border-color: var(--color-black);">
                            <table class="table table-borderless">
                                <thead style="border-color: var(--color-black);">
                                    <tr></tr>
                                </thead>
                                 <!--kinfo query -->
                                 <?php

                                    $query="SELECT * from person where  id_number='$id'";
                                    $result=mysqli_query($conn,$query);

                                    $rows=mysqli_num_rows($result);                   

                                        if ($rows>0) {               
                                    while ($rows=mysqli_fetch_array($result)) {
                                    ?>
                                <tbody>
                                
                                <tr>
                                    <td style="font-weight: bold;color: var(--color-black);">Firstname</td>
                                    <td style="font-weight: bold;"><?php echo $rows['keen_firstname']; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;color: var(--color-black);">Lastname</td>
                                    <td style="font-weight: bold;"><?php echo $rows['keen_lastname']; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;color: var(--color-black);">Email</td>
                                    <td style="font-weight: bold;"><?php echo $rows['keen_email']; ?></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;color: var(--color-black);">Phone</td>
                                    <td style="font-weight: bold;"><?php echo '('.substr($rows['keen_phone'],0,3).')'.' '.substr($rows['keen_phone'],3,3).' '.substr($rows['keen_phone'],6,4); ?></td>
                                </tr>
                            </tbody>
                            <?php }
                        } ?>
                            </table>
                        </div>
                    </div>
                    <div class="card-body" style="font-size: 13px;border-style: ridge;">
                        <h5 class="text-uppercase card-subtitle" style="font-size: 16px;font-weight: bold;color: var(--color-black);text-align: center;">&nbsp;Criminal Record</h5>
                        <hr style="background: var(--color-black);">
                        <div class="table-responsive" style="border-color: var(--color-black);">
                            <table class="table table-borderless">
                                <thead style="border-color: var(--color-black);">
                                    <tr></tr>
                                </thead>
                                 
                                <tbody> 
                                    <!--kinfo query -->
                                  <?php

                                    $query="SELECT * from person,docket where  person.person_id=docket.person_id and person.id_number='$id'";
                                    $result=mysqli_query($conn,$query);

                                    $rows=mysqli_num_rows($result);                   

                                        if ($rows>0) {               
                                    while ($rows=mysqli_fetch_array($result)) {
                                    ?>
                                    <tr>
                                        <td style="font-weight: bold;color: var(--color-black);">Docket#<?php echo $rows['docket_id']; ?></td>
                                        <td style="font-weight: bold;"><?php echo $rows['crime_type']; ?></td>
                                        <td style="font-weight: bold;"><?php echo $rows['year']; ?></td>
                                    </tr>
                                    <?php }}else{ ?>

                                    <h1 style="font-weight: bold;color: var(--color-black);text-align:center;">No record of crime.</h1>
                                    <?php }?>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p style="text-align: center;margin-top: 9px;">&nbsp;&nbsp;<a class="btn" type="button" href="face.php" style="color: rgb(255,255,255);background: var(--color-black);">&nbsp;Back</a>&nbsp;&nbsp;<button class="btn" type="button" onclick="myApp.printTable()" style="color: rgb(255,255,255);background: var(--color-black);">&nbsp;Print</button></p>
            </div>
        </div>
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
<script>
    var myApp = new function () {
        this.printTable = function () {
            var tab = document.getElementById('tab');
            var win = window.open('Identified', 'Personel', 'height=700,width=700');
            win.document.write(tab.outerHTML);
            win.document.close();
            win.print();
        }
    }
</script>
</html>