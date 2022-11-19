
<?php

$result=mysqli_query($conn,"SELECT * from person where email='$email'");
$rows=mysqli_num_rows($result);        

if ($rows>0) {
  
while ($rows=mysqli_fetch_array($result)) {
   
   ?>

<nav class="navbar navbar-light navigation-clean-button" style="border-bottom: 1px solid rgb(44,32,252) ;">
        <div class="container"><a class="navbar-brand" href="#" style="font-size: 17px;color: rgb(44,32,252);"><i class="fa fa-bullseye"></i>&nbsp; Identification System</a>
            <h1 style="font-size: 18px;color: rgb(44,32,252);"><i class="fa fa-user-circle-o"></i>&nbsp; <?php echo $rows['firstname'].' '.$rows['lastname']?></h1>
        </div>
    </nav>
    <?php     }
          
              } ?>