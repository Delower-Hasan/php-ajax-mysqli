<?php
require 'db.php';

if(isset($_POST['fname']) && isset($_POST['email']) && isset($_POST['message'])){
    $name = $_POST['fname'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    if(!empty($name) && !empty($email)){
        $insert_message = "INSERT INTO `message`(`name`, `email`, `message`) VALUES ('$name','$email','$message')";
        $insert_message_res = mysqli_query($db,$insert_message);
        echo 'Message successfully sent';
    }
    else{
        echo "BRO... সব কিছু ফ্রি পাইছো?";
    }
  
 
}


// get all datas
if(isset($_POST['record'])){
    $select_all = "SELECT * FROM `message`";
    $select_res = mysqli_query($db,$select_all);
    $select_assoc = mysqli_fetch_all($select_res);
    print_r(json_encode($select_assoc));
}


// Delete

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $delete_items ="DELETE FROM `message` WHERE id= '$id'";
    $delete_res = mysqli_query($db,$delete_items);
    echo "SuccessFully Deleted";
}











?>