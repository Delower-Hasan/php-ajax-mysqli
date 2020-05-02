<?php
require 'db.php';

if(isset($_FILES['about_img']) && isset($_POST['about_title']) && isset($_POST['about_list_title']) && isset($_POST['about_list']) && isset($_POST['status']) && isset($_POST['about_desc']) ){


    $about_title = $_POST['about_title'];
    $about_list_title = $_POST['about_list_title'];
    $about_list = $_POST['about_list'];
    $status = $_POST['status'];
    $about_desc = $_POST['about_desc'];

    if(!empty($_FILES['about_img'] )){
        $file = $_FILES['about_img'];
        $after_explode = explode('.',$file['name']);
        $extension = end($after_explode);
        $abt_img = 'default.png';
        $allow_ext = array('png','jpg','jpeg','gif');
        if(in_array($extension,$allow_ext)){
           if($file['size']<2000000){
               $insert_about = "INSERT INTO `about`(`about_img`, `about_title`, `about_desc`, `about_list_title`, `about_list`, `status`) VALUES ('$abt_img','$about_title','$about_desc','$about_list_title','$about_list','$status')";
               $insert_about_res = mysqli_query($db,$insert_about);
               echo 'Form Submitted Successfully';
    
               $last_id = mysqli_insert_id($db);
               $fileName = $last_id.'.'.$extension;
               $newLocation = 'imageFolder/about/'.$fileName;
               move_uploaded_file($file['tmp_name'],$newLocation);
               $update_about = "UPDATE `about` SET `about_img`='$fileName' WHERE id ='$last_id'";
               $update_res = mysqli_query($db,$update_about);
    
           }
           else{
               echo 'File Size is Big';
           }
        }
        else{
            echo 'File Not Found';
        }
     
    }

}




// Select Data
if(isset($_POST['record'])){
    $selectAll = "SELECT * FROM `about`";
    $select_res = mysqli_query($db,$selectAll);
    $fetch_all_logos = mysqli_fetch_all($select_res);
    print_r(json_encode($fetch_all_logos));
 }


// change status
if(isset($_POST['statusId'])){
    $id = $_POST['statusId'];

    $deactive_all = "UPDATE `about` SET `status`=0 WHERE `status`=1";
    $deactive_res = mysqli_query($db,$deactive_all);

    $active ="UPDATE `about` SET `status`=1 WHERE `id`='$id'";
    $active_res = mysqli_query($db,$active);
}


// Delete

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $slect_delete = "SELECT * FROM `about`";
    $select_del = mysqli_query($db,$slect_delete);
    $after_assoc = mysqli_fetch_assoc($select_del);
    $delete_from = 'imageFolder/about/'.$after_assoc['banner_img'];
    unlink($delete_from);

    $delete_items ="DELETE FROM `about` WHERE id= '$id'";
    $delete_res = mysqli_query($db,$delete_items);
    echo "SuccessFully Deleted";
}




// Edit





if(isset($_FILES['about_img_edit']) && isset($_POST['about_title_edit']) && isset($_POST['about_list_title_edit']) && isset($_POST['about_list_edit']) && isset($_POST['status_edit']) && isset($_POST['about_desc_edit']) ){

    $about_title = $_POST['about_title_edit'];
    $about_list_title = $_POST['about_list_title_edit'];
    $about_list = $_POST['about_list_edit'];
    $status = $_POST['status_edit'];
    $about_desc = $_POST['about_desc_edit'];
    $id = $_POST['edit_id'];

    $file = $_FILES['about_img_edit'];
    $after_explode = explode('.',$file['name']);
    $extension = end($after_explode);
    $image = 'default.png';
    $allow_ext = array('png','jpg','jpeg','gif');
    if(in_array($extension,$allow_ext)){
       if($file['size']<2000000){

       
        $slect_Edit = "SELECT * FROM `about`";
        $select_edit = mysqli_query($db,$slect_Edit);
        $after_assoc = mysqli_fetch_assoc($select_edit);
        $delete_from = 'imageFolder/about/'.$after_assoc['about_img_edit'];
        unlink($delete_from);
           $fileName = $id.'.'.$extension;
           $newLocation = 'imageFolder/about/'.$fileName;
           move_uploaded_file($file['tmp_name'],$newLocation);

           $update_id = "UPDATE `about` SET `about_img`='$fileName',`about_title`='$about_title',`about_desc`='$about_desc',`about_list_title`='$about_list_title',`about_list`='$about_list',`status`='$status' WHERE id='$id' ";
           $update_header_res = mysqli_query($db,$update_id);
           header('location:view_about.php');
       }
       else{
           echo 'File Size is Big';
       }
    }
    else{
        $update_id = "UPDATE `about` SET `about_title`='$about_title',`about_desc`='$about_desc',`about_list_title`='$about_list_title',`about_list`='$about_list',`status`='$status' WHERE id='$id' ";
           $update_header_res = mysqli_query($db,$update_id);
           header('location:view_about.php');
    }

}






























?>