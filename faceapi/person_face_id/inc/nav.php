
<?php

$result=mysqli_query($conn,"SELECT * from person where email='$email'");
$rows=mysqli_num_rows($result);        

if ($rows>0) {
  
while ($rows=mysqli_fetch_array($result)) {
   
   ?>
<nav class="navbar navbar-light navbar-expand-lg navigation-clean-search" style="background: rgb(86,77,253);">
        <div class="container"><a class="navbar-brand" href="#" style="font-size: 14px;">&nbsp;<?php echo $rows['firstname'].' '.$rows['lastname']?>(Police Officer)</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1" style="border-color: rgb(86,77,253);"><i class="material-icons" style="color: var(--color-white);"><span class="navbar-toggler-icon"></span></i><span class="visually-hidden">Toggle navigation</span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav"></ul>&nbsp;&nbsp;<a class="btn ms-auto" role="button" href="..\faceapi\person_face_id\inc\logout.php" style="background: var(--color-white);color: rgb(86,77,253);">Logout</a>
            </div>
        </div>
    </nav>
    <?php     }
          
        } ?>
