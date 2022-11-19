<?php


$qry=mysqli_query($conn,"select * from person WHERE person_id='$id'");
$data=mysqli_fetch_array($qry);

?>