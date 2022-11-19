<?php include'..\faceapi\person_face_id\inc\session.php';?>
<!DOCTYPE html>
<html class="font-monospace" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> Identification System | Facial Recognition</title><link rel="icon" href="../assets/img/logo.jpg">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
 
    <link rel="stylesheet" href="assets/css/alert.css">
    <link rel="stylesheet" href="assets/css/Bootstrap-4---Profile-Creation-Wizard.css">
    <link rel="stylesheet" href="assets/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Customizable-Background--Overlay.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/FPE-Gentella-form-elements-1.css">
    <link rel="stylesheet" href="assets/css/FPE-Gentella-form-elements.css">
    <link rel="stylesheet" href="assets/css/Google-Style-Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
   
    <link rel="stylesheet" href="assets/css/index-top-info.css">
    <link rel="stylesheet" href="assets/css/LinkedIn-like-Profile-Box.css">
 
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

var cerror=document.getElementById("cerror");


if(
 document.forms["form"]["idno"].value==""
 
 )
{

cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty*</span>"


return false;


}else
{
//name 

//cellno
var cellno=document.forms["form"]["idno"].value;

if(cellno=="")
{

   cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+" field should not be empty *</span>";
  return false;

}
else
if(!cellno.match(/^[0-9]+$/))
{

cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+"field should be filled with number only.*</span>";
return false;   
}
else
if(cellno.toString().length!=13)
{
cerror.innerHTML="<span class='lead text-start' style='color:rgb(46,35,253);font-size:14px;''>"+"field should be 13 characters.*</span>";    

return false;   
}
else
{
cerror.innerHTML="";

}



}
}
</script>
<body  style="background: rgb(255,255,255);" onload="init()">
    <!--nav--->
    <?php include'..\faceapi\person_face_id\inc\nav.php';?>

    <div class="container" style="margin-top: 59px;">
        <div class="row">
            <div class="col-md-6 col-lg-5 col-xl-4">
                <h1 class="text-uppercase" style="font-size: 16px;font-weight: bold;color: rgb(86,77,253);">&nbsp;Rules</h1>
                <ul class="list-unstyled">
                    <li>-&nbsp;The information is confidential.</li>
                    <li>-&nbsp;The information should not be distributed or shared.</li>
                </ul>
            </div>
            <div class="col-md-6">
                <div class=" shadow-none login-card" style="margin-top: 0px;background: rgb(255,255,255);opacity: 0.91;">
                    <p style="color: rgb(67,67,67);text-align: center;">Scan the face here.</p>
                    <h3 class="text-uppercase" data-bs-toggle="tooltip" data-bss-tooltip="" style="font-size: 19px;text-align: right;color: rgb(46,35,253);" title="close">&nbsp;</h3>
                    <form class="form-signin" action="search.py" name="form" onsubmit="return validateForm();" method="post" enctype="multipart/form-data"><span class="reauth-email"> </span>
                        <video onclick="snapshot(this);" width=250 height=250 id="video" controls autoplay></video>
                        <input class="form-control" type="text" name="idno" id="idno"  placeholder="Id Number" autofocus="" style="font-size: 14px;margin-top: 15px;"><span id="cerror"></span><br>
                        <input type="text" accept="image/png" hidden name="current_image" id="current_image">
                        <div class="checkbox"></div>
                        <button type="submit" class="btn btn-primary btn-lg d-block btn-signin w-100"  id="load1" onclick="login()"  value="login" style="background: rgb(48,37,252);color: rgb(255,255,255);" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">Retrieve Information</button>
                        
                    </form>
                    <canvas  id="myCanvas" width="400" height="350" hidden></canvas> 
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
 

</body>
<script>
    //--------------------
    // GET USER MEDIA CODE
    //--------------------
        navigator.getUserMedia = ( navigator.getUserMedia ||
                           navigator.webkitGetUserMedia ||
                           navigator.mozGetUserMedia ||
                           navigator.msGetUserMedia);

    var video;
    var webcamStream;
      if (navigator.getUserMedia) {
         navigator.getUserMedia (

            // constraints
            {
               video: true,
               audio: false
            },

            // successCallback
            function(localMediaStream) {
                video = document.querySelector('video');
               video.srcObject = localMediaStream;
               webcamStream = localMediaStream;
            },

            // errorCallback
            function(err) {
               console.log("The following error occured: " + err);
            }
         );
      } else {
         console.log("getUserMedia not supported");
      }  


   
    var canvas, ctx;

    function init() {
      // Get the canvas and obtain a context for
      // drawing in it
mcanvas = document.getElementById("myCanvas");
      ctx = mcanvas.getContext('2d');
    }

    function login() {
       // Draws current image from the video element into the canvas
      ctx.drawImage(video,0,0,mcanvas.width,mcanvas.height);
      var dataURL = mcanvas.toDataURL('image/png');
       document.getElementById("current_image").value=dataURL;

    }

</script>
</html>