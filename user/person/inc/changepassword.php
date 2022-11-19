<?php


if(isset($_POST['password']))
{
$password=md5($_POST['password']);



$com="UPDATE  person
SET 
password='$password'
WHERE person_id='$id'";



$e=mysqli_query($conn,$com);


if($e){
    mysqli_close($conn);


    echo '<script>alert("Password Changed.");window.location = "profile.php";</script>';

    exit;

    }
    else
    {
        echo mysqli_error();

    }
}


        ?>