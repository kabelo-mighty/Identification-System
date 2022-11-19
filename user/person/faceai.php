<!--session-->
<?php include 'inc/session.php'?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Identification System | Facial Identity</title><link rel="icon" href="../../assets/img/logo.jpg">
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

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
                <li class="nav-item" role="presentation" style="color: rgb(132,132,132);"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-2" style="font-size: 16px;color: rgb(44,32,252);font-weight: bold;"><i class="fa fa-user"></i>&nbsp; Account</a></li>
                <li class="nav-item" role="presentation" style="color: rgb(15,15,16);"><a class="nav-link active" role="tab" data-bs-toggle="tab" href="#tab-3" style="font-weight: bold;font-size: 16px;color: rgb(44,32,252);"><i class="fa fa-camera"></i>&nbsp; Facial Service</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade" role="tabpanel" id="tab-1"><a class="btn" role="button"  style="border-style: none;color: rgb(132,132,132);font-size: 17px;" href="view.php">Dashboard</a></div>
                <div class="tab-pane fade" role="tabpanel" id="tab-2"><a class="btn" role="button"  style="border-style: none;color: rgb(132,132,132);font-size: 17px;" href="profile.php">Profile</a>
                <a class="btn" role="button"  style="border-style: none;color: rgb(132,132,132);font-size: 17px;" href="crecord.php">Criminal record</a>
                <a class="btn" role="button"  style="border-style: none;color: rgb(132,132,132);font-size: 17px;" href="inc/delete.php?value=<?php echo $id; ?>">Delete Account</a>
                <a class="btn" role="button"  href="../../account/logout.php"  style="border-style: none;color: rgb(132,132,132);font-size: 17px;">Logout</a></div>
                <div class="tab-pane fade show active" role="tabpanel" id="tab-3">
                    <p><a class="btn" role="button"  style="border-style: none;color: rgb(132,132,132);font-size: 17px;" href="faceai.php">Capture Photo</a><a class="btn" role="button"  style="border-style: none;color: rgb(132,132,132);font-size: 17px;" href="face-open.php">View Photo</a></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="padding-top: 61px;padding-right: 40px;padding-left: 40px;">
        <div class="shadow" style="background: #ffffff;margin-top: 0px;border-radius: 10px;">
            <h1 class="text-center" style="font-size: 20px;padding-top: 20px;color: rgb(44,32,252);">&nbsp; &nbsp;<i class="fa fa-camera-retro"></i>&nbsp; Capture facial identity</h1>
            <div class="row" style="margin-left: 0px;margin-right: 0px;">
                <div class="col-lg-5 offset-lg-1">
                    <h1 style="font-size: 20px;color: rgb(44,32,252);"><i class="fa fa-hourglass-end"></i>&nbsp;Instructions To follow</h1>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-angle-right"></i>&nbsp;Ensure that there is light in the room.</li>
                        <li><i class="fa fa-angle-right"></i>&nbsp;Make sure you face the camera.</li>
                        <li><i class="fa fa-angle-right"></i>&nbsp;The web cam enable you to capture 640 x640.</li>
                        <li><i class="fa fa-angle-right"></i>&nbsp;Confirm the image ,if not visible retake.</li>
                    </ul>
                </div>
                <div class="col-lg-5">
                    <p style="color: rgb(67,67,67);text-align: center;">Click here to access web camera</p>
                    <h1 class="text-center" style="font-size: 20px;">&nbsp;&nbsp;<i class="fa fa-chevron-down flash animated infinite" style="color: rgb(44,32,252);"></i>&nbsp;&nbsp;</h1>
                    <p class="text-center"><button class="btn" id="accesscamera" data-toggle="modal" data-target="#photoModal" type="button" style="margin-top: 15px;margin-bottom: 23px;background: rgb(44,32,252);color: rgb(255,255,255);">Capture photo</button></p>
                </div>
            </div>
        </form>
        
    </div>

<!--modal-->
    <!--Modal-->
    <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Capture Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div id="my_camera" class="d-block mx-auto rounded overflow-hidden"></div>
                    </div>
                    <div id="results" class="d-none"></div>
                    <form method="post" id="photoForm">
                        <input type="hidden" id="photoStore" name="photoStore" value="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn mx-auto text-white" style="margin-top: 15px;margin-bottom: 23px;background: rgb(44,32,252);color: rgb(255,255,255);" id="takephoto">Capture Photo</button>
                    <button type="button" class="btn btn mx-auto text-white d-none" style="margin-top: 15px;margin-bottom: 23px;background: rgb(44,32,252);color: rgb(255,255,255);" id="retakephoto">Retake</button>
                    <button type="submit" class="btn btn mx-auto text-white d-none" style="margin-top: 15px;margin-bottom: 23px;background: rgb(44,32,252);color: rgb(255,255,255);" id="uploadphoto" form="photoForm">Save</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <script src="./plugin/sweetalert/sweetalert.min.js"></script>
    <script src="./plugin/webcamjs/webcam.min.js"></script>
    <script src="main.js"></script>
    <!--close-->





    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="assets/js/Multi-step-form.js"></script>
</body>

</html>


