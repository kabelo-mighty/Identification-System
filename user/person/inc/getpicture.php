<?php

$qry=mysqli_query($conn,"select * from face_identification WHERE person_id='$id'");
$data=mysqli_fetch_array($qry);

?>