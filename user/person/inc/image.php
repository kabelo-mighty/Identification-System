<?php

include 'connect.php';

$image=mysqli_query($conn,"select * from face_identification WHERE person_id='$id'");
if(!mysqli_num_rows($image))
{
?>
<div class="col-lg-4 offset-lg-4" style="text-align: center;">
<picture><img src="../../faceapi/person_face_id/error.png" style="height: 200px;"></picture>
</div>
<?php }else{ ?>

<div class="col-lg-4 offset-lg-4" style="text-align: center;">
<picture><img src="../../faceapi/person_face_id/<?php echo $data['picture'].'.jpg' ?>" style="height: 200px;"></picture>
</div>  
<?php } ?>