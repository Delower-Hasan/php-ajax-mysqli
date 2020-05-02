<?php
require 'db.php';

if(isset($_FILES['banner_img']) && isset($_POST['phone']) && isset($_POST['title']) && isset($_POST['subtitle'])){
    $phone = $_POST['phone'];
    $title = $_POST['title'];
    $subTitle = $_POST['subtitle'];

    $file = $_FILES['banner_img'];
    $after_explode = explode('.',$file['name']);
    $extension = end($after_explode);
    $image = 'default.png';
    $allow_ext = array('png','jpg','jpeg','gif');
    if(in_array($extension,$allow_ext)){
       if($file['size']<2000000){
           $insert_logo = " INSERT INTO `header`(`phone`, `title`, `subtitle`, `banner_img`) VALUES ('$phone','$title','$subTitle','$image')";
           $insert_logo_res = mysqli_query($db,$insert_logo);
           $last_id = mysqli_insert_id($db);
           $fileName = $last_id.'.'.$extension;
           $newLocation = 'imageFolder/header/'.$fileName;
           move_uploaded_file($file['tmp_name'],$newLocation);
           $update_banner = "UPDATE `header` SET `banner_img`='$fileName' WHERE id = '$last_id'";
           $update_res = mysqli_query($db,$update_banner);

       }
       else{
           echo 'File Size is Big';
       }
    }
    else{
        echo 'File Not Found';
    }

}

// get Records
if(isset($_POST['record'])){
   $selectAll = "SELECT * FROM `header`";
   $select_res = mysqli_query($db,$selectAll);
   $fetch_all_logos = mysqli_fetch_all($select_res);
   print_r(json_encode($fetch_all_logos));
}


// Delete

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $slect_delete = "SELECT * FROM `header`";
    $select_del = mysqli_query($db,$slect_delete);
    $after_assoc = mysqli_fetch_assoc($select_del);
    $delete_from = 'imageFolder/header/'.$after_assoc['banner_img'];
    unlink($delete_from);

    $delete_items ="DELETE FROM `header` WHERE id= '$id'";
    $delete_res = mysqli_query($db,$delete_items);
    echo "SuccessFully Deleted";
}




// Edit






if(isset($_FILES['banner_img_edit']) && isset($_POST['phone_edit']) && isset($_POST['title_edit']) && isset($_POST['subtitle_edit'])){
 
    $phone = $_POST['phone_edit'];
    $title = $_POST['title_edit'];
    $subTitle = $_POST['subtitle_edit'];
    $id = $_POST['edit_id'];

    $file = $_FILES['banner_img_edit'];
    $after_explode = explode('.',$file['name']);
    $extension = end($after_explode);
    $image = 'default.png';
    $allow_ext = array('png','jpg','jpeg','gif');
    if(in_array($extension,$allow_ext)){
       if($file['size']<2000000){

       
        $slect_Edit = "SELECT * FROM `header`";
        $select_edit = mysqli_query($db,$slect_Edit);
        $after_assoc = mysqli_fetch_assoc($select_edit);
        $delete_from = 'imageFolder/header/'.$after_assoc['banner_img'];
        unlink($delete_from);
           $fileName = $id.'.'.$extension;
           $newLocation = 'imageFolder/header/'.$fileName;
           move_uploaded_file($file['tmp_name'],$newLocation);

           $update_id = "UPDATE `header` SET `phone`='$phone',`title`='$title',`subtitle`='$subTitle',`banner_img`='$fileName' WHERE id = '$id'";
           $update_header_res = mysqli_query($db,$update_id);
           header('location:addHeader.php');
      
      
     

       }
       else{
           echo 'File Size is Big';
       }
    }
    else{
        $update_id = "UPDATE `header` SET `phone`='$phone',`title`='$title',`subtitle`='$subTitle' WHERE id = '$id'";
        $update_header_res = mysqli_query($db,$update_id);
        header('location:addHeader.php');
    }

}









?>