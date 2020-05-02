<?php
require 'db.php';


if(!empty($_FILES['logo'] )){
    $status = $_POST['status'];
    $file = $_FILES['logo'];
    $after_explode = explode('.',$file['name']);
    $extension = end($after_explode);
    $logo = 'default.png';
    $allow_ext = array('png','jpg','jpeg','gif');
    if(in_array($extension,$allow_ext)){
       if($file['size']<2000000){
           $insert_logo = "INSERT INTO `logos`(`logo`, `status`) VALUES ('$logo','$status')";
           $insert_logo_res = mysqli_query($db,$insert_logo);

           $last_id = mysqli_insert_id($db);
           $fileName = $last_id.'.'.$extension;
           $newLocation = 'imageFolder/logo/'.$fileName;
           move_uploaded_file($file['tmp_name'],$newLocation);
           $update_logo = "UPDATE `logos` SET `logo`='$fileName' WHERE id = '$last_id'";
           $update_res = mysqli_query($db,$update_logo);

       }
       else{
           echo 'File Size is Big';
       }
    }
    else{
        echo 'File Not Found';
    }
}



if(isset($_POST['logo'])){
   $select_logo = "SELECT * FROM `logos`";
   $select_logo_res = mysqli_query($db,$select_logo);
   $fetch_all_logos = mysqli_fetch_all($select_logo_res);
   print_r(json_encode($fetch_all_logos));
}



// deleteId

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $deleteLogo = "SELECT * FROM `logos`";
    $deleteLogo_res = mysqli_query($db,$deleteLogo);
    $after_assoc = mysqli_fetch_assoc($deleteLogo_res);
    $delete_from = 'uploads/'.$after_assoc['logo'];
    unlink($delete_from);
    $deleteId = " DELETE FROM `logos` WHERE id = '$id'";
    $delete_re = mysqli_query($db,$deleteId);

}

// change status
if(isset($_POST['statusId'])){
    $id = $_POST['statusId'];
    $deactive_all = "UPDATE `logos` SET `status`=0 WHERE `status`=1";
    $deactive_res = mysqli_query($db,$deactive_all);

    $active ="UPDATE `logos` SET `status`=1 WHERE `id`='$id'";
    $active_res = mysqli_query($db,$active);
}



?>

