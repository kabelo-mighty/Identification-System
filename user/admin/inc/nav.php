                    <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">
                    <?php

$result=mysqli_query($conn,"SELECT * from admin where email='$email'");
$rows=mysqli_num_rows($result);        

if ($rows>0) {

while ($rows=mysqli_fetch_array($result)) {
echo $rows['firstname'].' '.$rows['lastname'];}}?> (Admin)</span><img class="border rounded-circle img-profile" src="assets/img/logo.png"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"></div>
                                </div>
       