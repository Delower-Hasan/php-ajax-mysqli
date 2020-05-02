<?php
require 'header.php';
require 'sidebar.php';
?>

<div class="row justify-content-center">
<div class="col-md-4 mt-5 ">
    <h2 >Add Header</h2>
    <div id="required"></div>
  <div>
  
  <form  id="headerForm" action="HeaderCode.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <input type="file" name="banner_img" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <div id="banner_img"></div>
  </div>

  <div class="form-group">
    <input type="text" name="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Phone">
    <div id="phone"></div>
  </div>
  <div class="form-group">
    <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
    <div id="title"></div>
  </div>
  <div class="form-group">
    <input type="text" name="subtitle" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
    <div id="subtitle"></div>
  </div>
 
  <button type="submit" name="submit" value="submit" id="logoSubmit" class="btn btn-primary">Submit</button>
</form>
  </div>
</div>
<div class="col-md-8 mt-5">
  <div class="section-table">
    <h2>Header View</h2>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">IMAGE</th>
      <th scope="col">PHONE</th>
      <th scope="col">TITLE</th>
      <th  scope="col">SUBTITLE</th>
      <th  scope="col">ACTION</th>
      <th  scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody id="th_header">
    
 
  </tbody>
</table>
  </div>
</div>
</div>



<?php
require 'bottom.php';
require 'footer.php';
?>

<script>
$(document).ready(function(){
    getRecords()

})

// getRecords
    function warningOut(){
        setTimeout(()=>{
            let wrOut = document.getElementById('required');
            wrOut.style.display='none';
        },3000)
    }
function getRecords(){
    let record = 'record';
    $.post({
        url:'HeaderCode.php',
        data:{
            record:record,
        },
        success:function(datas){
            let data_arr = JSON.parse(datas);
            var outx = ``
            data_arr.forEach((data)=>{
                
            outx +=  `<tr>
                        <td> ${data[0]}</td>
                        <td><img src="imageFolder/header/${data[4]}" width="50" height="50" alt=""></td>
                        <td> ${data[1]}</td>
                        <td> ${data[2]}</td>
                        <td> ${data[3]}</td>
                        <td class="btn btn-danger mt-2" onclick='deleteItems(${data[0]})'> Delete </td>
                        <td  > 
                        
                              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal${data[0]}">
                                Edit
                              </button>

                            
                              <div class="modal fade" id="exampleModal${data[0]}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Edit Items</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">


                                    <form  id="headerForm_edit" action="HeaderCode.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                      <input type="hidden" value="${data[0]}" name="edit_id">
                                    </div>

                                    <div class="form-group">
                                      <input type="file"  name="banner_img_edit" onchange="document.getElementById('Header_img').src = window.URL.createObjectURL(this.files[0])"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                      <div id="banner_img"></div>
                                    </div>

                                    <div>
                                    <img src="imageFolder/header/${data[4]}" alt="" id="Header_img">
                                    </div>

                                    <div class="form-group">
                                      <input type="text" value="${data[1]}" name="phone_edit" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Phone">
                                      <div id="phone"></div>
                                    </div>

                                    <div class="form-group">
                                      <input type="text" value="${data[2]}" name="title_edit" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
                                      <div id="title"></div>
                                    </div>

                                    <div class="form-group">
                                      <input type="text" value="${data[3]}" name="subtitle_edit" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter SubTitle">
                                      <div id="subtitle"></div>
                                    </div>
                                    <button type="submit" name="submit" value="submit" id="logoSubmit" class="btn btn-primary">Update</button>
                                  </form>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                        
                        
                        </td>
                    </tr>`
            })
          
            $('#th_header').html(outx);
        }
    })
}


function noneValue(){
      let file  = document.forms['headerForm']['banner_img'];
      let phone  = document.forms['headerForm']['phone'];
      let title  = document.forms['headerForm']['title'];
      let subtitle  = document.forms['headerForm']['subtitle'];
      file.value = '';
      phone.value = '';
      title.value = '';
      subtitle.value = '';


    }
$('#headerForm').submit(function(e){
          e.preventDefault()
          $.ajax({
          url:'HeaderCode.php',
          type:'POST',
          data: new FormData(this),
          contentType: false,
          cache:false,
          processData:false,
          success:function(response){
            noneValue()
            $('#required').html(response);
            getRecords()
            warningOut()
          }
        })
      })
      
      // Edit Header 
$('#headerForm_edit').submit(function(e){
          e.preventDefault()
          $.ajax({
          url:'HeaderCode.php',
          type:'POST',
          data: new FormData(this),
          contentType: false,
          cache:false,
          processData:false,
          success:function(response){
            noneValue()
            $('#required').html(response);
            getRecords()
            warningOut()
           
          }
        })
      })



    //   Deletes

    function deleteItems(id){
      $.post({
          url:'HeaderCode.php',
          data:{
              id:id,
          },
          success:function(data){
              $('#required').html(data);
              getRecords()
              warningOut()
          }
      })
    }


 
  
</script>
