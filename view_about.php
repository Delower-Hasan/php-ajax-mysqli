<?php
require 'header.php';
require 'sidebar.php';
?>

<div class="col-md-8 mt-5">
  <div class="section-table">
    <h2>Header View</h2>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">IMAGE</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th  scope="col">list Title</th>
      <th  scope="col">list</th>
      <th  scope="col">status</th>
      <th  scope="col">ACTION</th>
      <th  scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody id="th_header">
    
 
  </tbody>
</table>
  </div>
</div>

<?php
require 'bottom.php';
require 'footer.php';
?>

<script>
    $(document).ready(function(){
        getRecords();
    })

function getRecords(){
    let record = 'record';
    $.post({
        url:'about_code.php',
        data:{
            record:record,
        },
        success:function(datas){
            let data_arr = JSON.parse(datas);
            var outx = ``
            data_arr.forEach((data)=>{
                
            outx +=  `<tr>
                        <td> ${data[0]}</td>
                        <td><img src="imageFolder/about/${data[1]}" width="50" height="50" alt=""></td>
                        <td> ${data[2]}</td>
                        <td> ${data[3].substr(0,20)}....</td>
                        <td> ${data[4]}</td>
                        <td> ${data[5]}</td>
                        <td >
                        <p class='btn ${data[6]==1?'btn-primary':'btn-info'}' onclick='changeStatus(${data[0]})' > ${data[6] ==1? 'Active':'Deactive'} </p> 
                        

                        <td  class="btn btn-danger mt-2" onclick='deleteItems(${data[0]})'> Delete  </td>
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


                                    <form  id="about_edit" action="about_code.php" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                      <input type="hidden" value="${data[0]}" name="edit_id">
                                    </div>

                                    <div class="form-group">
                                    <input type="file" name="about_img_edit" class="form-control"  onchange="document.getElementById('banner_img').src = window.URL.createObjectURL(this.files[0])" placeholder="Enter image">
                                   
                                </div>

                                  

                                    <div>
                                    <img src="imageFolder/about/${data[1]}" alt="" id="banner_img">
                                    </div>

                                    <div class="form-group">

                                   

                                <div class="form-group">
                                    <input type="text" name="about_title_edit" class="form-control" id="exampleInputEmail1" value="${data[2]}" aria-describedby="emailHelp" placeholder="Enter about_title">
                                    <div id="about_title"></div>
                                </div>

                                <div class="form-group">
                                    <textarea name="about_desc_edit" class="form-control" id="" cols="30" rows="10" placeholder="Description" > "${data[3]}"</textarea>
                                    <div id="about_desc"></div>
                                </div>
                                <div class="form-group">
                                    <input type="text" value="${data[4]}" name="about_list_title_edit" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
                                    <div id="about_list_title"></div>
                                </div>

                                <div class="form-group">
                                    <input type="text" value="${data[5]}" name="about_list_edit" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter about list">
                                    <div id="about_list"></div>
                                </div>

                                <div class="form-group">
                                    <select name="status_edit" id="" class="form-control">
                                    <option value="#">Select status</option>
                                    <option value="1" ${data[6]==1 ? 'selected':''}>Active</option>
                                    <option value="0" ${data[6]==0 ? 'selected':''}>Deactive</option>
                                    </select>
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
getRecords()






// status changes

function changeStatus(id){
      $.post({
        url:'about_code.php',
        data:{
          statusId:id
        },
        success:function(data){
            getRecords();
        }
      })
  }

 //   Deletes

    function deleteItems(id){
      $.post({
          url:'about_code.php',
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

      // Edit Header 
$('#about_edit').submit(function(e){
          e.preventDefault()
          $.ajax({
          url:'about_code.php',
          type:'POST',
          data: new FormData(this),
          contentType: false,
          cache:false,
          processData:false,
          success:function(response){
            $('#required').html(response);
            getRecords()
            warningOut()
           
          }
        })
      })











</script>
