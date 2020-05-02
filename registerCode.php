<?php
session_start();
require 'db.php';

extract($_POST);
if(isset($_POST['fname']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['conPass']) ){
    $name = $_POST['fname'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $conPass = $_POST['conPass'];
   $insert = "INSERT INTO `registration`(`userName`, `email`, `password`, `confirmPass`) VALUES ('$name','$email','$pass','$conPass')";
   $insert_res = mysqli_query($db,$insert);
   ?>
   <div class="alert alert-primary" role="alert">
    Successfully registered
</div>

<?php
}


if(isset($_POST['email']) && isset($_POST['pass'])){
 $email = $_POST['email'];
 $pass = $_POST['pass'];

 $user = "SELECT COUNT(*) as innova FROM registration WHERE email='$email' AND password='$pass'";
 $user_res = mysqli_query($db,$user);

 $fetch_assoc = mysqli_fetch_assoc($user_res);
if($fetch_assoc['innova']==1){
    echo $fetch_assoc['innova'];
}
else{
    echo $fetch_assoc['innova'];
}



}

// logo








?>