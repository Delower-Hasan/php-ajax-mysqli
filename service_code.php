<?php
require 'db.php';


// insert

if(isset($_FILES['service_img']) && isset($_POST['service_title']) && isset($_POST['service_desc']) && isset($_POST['status'])){
    
    $title = $_POST['service_title'];
    $description = $_POST['service_desc'];
    $status = $_POST['status'];


    $file = $_FILES['service_img'];
    $after_explode = explode('.',$file['name']);
    $extension = end($after_explode);
    $img = 'default.png';
    $allow_ext = array('png','jpg','jpeg','gif');
    if(in_array($extension,$allow_ext)){
       if($file['size']<2000000){
           $insert_service = "INSERT INTO `services`(`service_img`, `service_title`, `service_desc`, `status`) VALUES ('$img','$title','$description','$status')";
           $insert_service_res = mysqli_query($db,$insert_service);
           echo 'Successfully inserted';

           $last_id = mysqli_insert_id($db);
           $fileName = $last_id.'.'.$extension;
           $newLocation = 'imageFolder/services/'.$fileName;
           move_uploaded_file($file['tmp_name'],$newLocation);
           $update_service = "UPDATE `services` SET `service_img`='$fileName' WHERE id='$last_id'";
           $update_res = mysqli_query($db,$update_service);

       }
       else{
           echo 'File Size is Big';
       }
    }
    else{
        echo 'File Not Found';
    }
 
}




// get all datas
if(isset($_POST['record'])){

    $select_all = "SELECT * FROM `services`";
    $select_res = mysqli_query($db,$select_all);
    $select_assoc = mysqli_fetch_all($select_res);
    print_r(json_encode($select_assoc));


}





// change status
if(isset($_POST['statusId'])){
    $id = $_POST['statusId'];
    $select_all = "SELECT * FROM `services` WHERE id = '$id'";
    $select_res = mysqli_query($db,$select_all);
    $after_assoc = mysqli_fetch_assoc($select_res);
    if($after_assoc['status']==0){
        $id = $_POST['statusId'];
        $active ="UPDATE `services` SET `status`=1 WHERE `id`='$id'";
        $active_res = mysqli_query($db,$active);
        echo 'Activated Status';
    }else if($after_assoc['status']==1){
        $id = $_POST['statusId'];
        $active ="UPDATE `services` SET `status`=0 WHERE `id`='$id'";
        $active_res = mysqli_query($db,$active);
        echo 'Deactivated Status';
    }
   
}




// Delete
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $slect_delete = "SELECT * FROM `services` WHERE id = '$id'";
    $select_del = mysqli_query($db,$slect_delete);
    $after_assoc = mysqli_fetch_assoc($select_del);
    $delete_from = 'imageFolder/services/'.$after_assoc['service_img'];
    unlink($delete_from);

    $delete_items ="DELETE FROM `services` WHERE id= '$id'";
    $delete_res = mysqli_query($db,$delete_items);
    echo "SuccessFully Deleted";
}


// Edit


if(isset($_FILES['service_img_edit']) && isset($_POST['edit_id']) && isset($_POST['service_title_edit']) && isset($_POST['service_desc_edit']) && isset($_POST['service_status_edit']) ){
 
    $id = $_POST['edit_id'];
   
    $title = $_POST['service_title_edit'];
    $description = $_POST['service_desc_edit'];
    $status = $_POST['service_status_edit'];

    $file = $_FILES['service_img_edit'];
    $after_explode = explode('.',$file['name']);
    $extension = end($after_explode);
    $image = 'default.png';
    $allow_ext = array('png','jpg','jpeg','gif');
    if(in_array($extension,$allow_ext)){
       if($file['size']<2000000){

       
        $slect_Edit = "SELECT * FROM `services` WHERE id = '$id'";
        $select_edit = mysqli_query($db,$slect_Edit);
        $after_assoc = mysqli_fetch_assoc($select_edit);
        $delete_from = 'imageFolder/services/'.$after_assoc['service_img'];
        unlink($delete_from);
           $fileName = $id.'.'.$extension;
           $newLocation = 'imageFolder/services/'.$fileName;
           move_uploaded_file($file['tmp_name'],$newLocation);

           $update_id = "UPDATE `services` SET `service_img`='$fileName',`service_title`='$title',`service_desc`='$description',`status`='$status' WHERE id = '$id'";
           $update_services_res = mysqli_query($db,$update_id);
           header('location:add_services.php');
       }
       else{
           echo 'File Size is Big';
       }
    }
    else{
        $update_id = "UPDATE `services` SET `service_title`='$title',`service_desc`='$description',`status`='$status' WHERE id = '$id'";
        $update_services_res = mysqli_query($db,$update_id);
        header('location:add_services.php');
    }

}




























?>