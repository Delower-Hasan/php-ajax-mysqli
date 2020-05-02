<?php
require 'header.php';
require 'sidebar.php';
?>


<div class="col-md-6 mt-5 ">
    <h2 >Add Header</h2>
    <div id="required"></div>
   

  <div>
  
  <form  id="headerForm" action="HeaderCode.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <input type="file" name="about_img" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter image">
    <div id="banner_img"></div>
  </div>

  <div class="form-group">
    <input type="text" name="about_title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter about_title">
    <div id="about_title"></div>
  </div>
  <div class="form-group">
      <textarea name="about_desc" class="form-control" id="" cols="30" rows="10" placeholder="Description" ></textarea>
    <div id="about_desc"></div>
  </div>
  <div class="form-group">
    <input type="text" name="about_list_title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
    <div id="about_list_title"></div>
  </div>

  <div class="form-group">
    <input type="text" name="about_list" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter about list">
    <div id="about_list"></div>
  </div>

  <div class="form-group">
    <select name="status" id="" class="form-control">
      <option value="#">Select status</option>
      <option value="1">Active</option>
      <option value="0">Deactive</option>
    </select>
  </div>
 
  <button type="submit" name="submit" value="submit" id="logoSubmit" class="btn btn-primary">Submit</button>
</form>
  </div>
</div>






<?php
require 'bottom.php';
require 'footer.php';
?>

<script>
$(document).ready(function(){
    // getRecords()
    warningOut()

})

// getRecords
function warningOut(){
        setTimeout(()=>{
            let wrOut = document.getElementById('required');
            wrOut.style.display='none';
        },3000)
    }
function noneValue(){
      let about_img  = document.forms['headerForm']['about_img'];
      let about_title  = document.forms['headerForm']['about_title'];
      let about_desc  = document.forms['headerForm']['about_desc'];
      let about_list_title  = document.forms['headerForm']['about_list_title'];
      let about_list  = document.forms['headerForm']['about_list'];
      let status  = document.forms['headerForm']['status'];
      about_img.value = '';
      about_title.value = '';
      about_desc.value = '';
      about_list_title.value = '';
      about_list.value = '';
      status.value = '';

    }

    // insert
$('#headerForm').submit(function(e){
          e.preventDefault()
        
          $.ajax({
          url:'about_code.php',
          type:'POST',
          data: new FormData(this),
          contentType: false,
          cache:false,
          processData:false,
          success:function(response){
            noneValue()
         
            let res = ` <div class="alert alert-primary"  role="alert">
                           Empty File
                        </div>`;
                        $('#required').html(res);
          
            // getRecords()
            warningOut()
          }
        })
      })
      



   

 
  
</script>
