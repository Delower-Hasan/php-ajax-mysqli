<?php
require 'header.php';
require 'sidebar.php';
?>
<style>
    div#required {
    color: mediumspringgreen;
    font-size: 25px;
    font-weight: bold;
    text-transform: capitalize;
    margin: 10px 0;
}
    div#resutl_view {
    color: mediumspringgreen;
    font-size: 25px;
    font-weight: bold;
    text-transform: capitalize;
    margin: 10px 0;
}
</style>

<div class="row justify-content-center">
<div class="col-md-4 mt-5 ">
    <h2 >Add Services</h2>
    <div id="required"></div>
  <div>
  
  <form  id="serviceForm" action="service_code.php" method="POST" enctype="multipart/form-data">
  <div class="form-group">
    <input type="file" name="service_img" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <div id="service_img"></div>
  </div>

  <div class="form-group">
    <input type="text" name="service_title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
    <div id="service_title"></div>
  </div>
  <div class="form-group">
      <textarea name="service_desc" class="form-control" cols="30" rows="10" placeholder="product Description"></textarea>
    <div id="service_desc"></div>
  </div>
  <div class="form-group">
      <select name="status" class="form-control" id="">
        <option value="#">Select Status</option>
        <option value="1">Active</option>
        <option value="0">Deactive</option>
      </select>
  
    <div id="status"></div>
  </div>
  <button type="submit" name="submit" value="submit"  class="btn btn-primary">Submit</button>
</form>
  </div>
</div>
<div class="col-md-8 mt-5">
  <div class="section-table">
    <h2>Services View</h2>
    <div id="resutl_view"></div>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">IMAGE</th>
      <th scope="col">TITLE</th>
      <th  scope="col">DESCRIPTION</th>
      <th  scope="col">STATUS</th>
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
    function warningOut(res){
        let wrOut = document.getElementById('required');
        setTimeout(()=>{
            wrOut.style.display='none';
        },2000)
        wrOut.style.display='block';
       if(wrOut.innerHTML ==''){
        wrOut.innerHTML= res
       }else{
        wrOut.innerHTML = res
       }
    }

    function warningOutViews(res){
     
        let viewVanish = document.getElementById('resutl_view');
        setTimeout(()=>{
        
     
            viewVanish.style.display='none';
        },2000)
        viewVanish.style.display='block';
     
    }
function getRecords(){
    let record = 'record';
    $.post({
        url:'service_code.php',
        data:{
            record:record,
        },
        success:function(datas){
            let data_arr = JSON.parse(datas);
            
            var outx = ``
            data_arr.forEach((data)=>{
                
            outx +=  `<tr>
                        <td> ${data[0]}</td>
                        <td><img src="imageFolder/services/${data[1]}" width="50" height="50" alt=""></td>
                        <td> ${data[2]}</td>
                        <td> ${data[3]}</td>
                     
                        <td > <p class='btn ${data[4]==1?'btn-primary':'btn-info'}' onclick='changeStatus(${data[0]})' > ${data[4] ==1? 'Active':'Deactive'} </p>  </td>
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


                                    <form  id="service_form_edit" action="service_code.php" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                      <input type="hidden" value="${data[0]}" name="edit_id">
                                    </div>

                                    <div class="form-group">
                                      <input type="file"  name="service_img_edit" onchange="document.getElementById('service_img').src = window.URL.createObjectURL(this.files[0])"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                     
                                    </div>

                                    <div>
                                    <img src="imageFolder/services/${data[1]}" alt="" id="service_img">
                                    </div>

                                   

                                    <div class="form-group">
                                      <input type="text" value="${data[2]}" name="service_title_edit" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Title">
                                      <div id="title"></div>
                                    </div>

                                    <div class="form-group">
                                    <textarea name="service_desc_edit" id="" class="form-control" cols="30" rows="10">${data[3]}</textarea>
                                    </div>

                                    <div class='form-group'>
                                    <select name="service_status_edit" class='form-control'>
                                      <option value="1" ${data[4]==1 ? 'selected':''}>Active</option>
                                      <option value="0"  ${data[4]==0 ? 'selected':''}>Dective</option>
                                    </select>
                                    </div>

                                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Update</button>
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
      let service_img  = document.forms['serviceForm']['service_img'];
      let service_title  = document.forms['serviceForm']['service_title'];
      let service_desc  = document.forms['serviceForm']['service_desc'];
      let status  = document.forms['serviceForm']['status'];
      service_img.value = '';
      service_title.value = '';
      service_desc.value = '';
      status.value = '';


    }

// insert


    $('#serviceForm').submit(function(e){
          e.preventDefault()
          $.ajax({
          url:'service_code.php',
          type:'POST',
          data: new FormData(this),
          contentType: false,
          cache:false,
          processData:false,
          success:function(response){
            noneValue()
            $('#required').html(response);
            getRecords()
            warningOut(response)
           
          }
        })
      })


      // ACTIVE DEACTIVE
      function changeStatus(id){
        $.post({
        url:'service_code.php',
        data:{
          statusId:id
        },
        success:function(data){
          $('#resutl_view').html(data);
          warningOutViews(data)
            getRecords();
        }
      })
      }
      
      // Edit Header 
$('#service_form_edit').submit(function(e){
          e.preventDefault()
          $.ajax({
          url:'service_code.php',
          type:'POST',
          data: new FormData(this),
          contentType: false,
          cache:false,
          processData:false,
          success:function(response){
           console.log(response)
           
            getRecords()
            warningOutViews(response)
           
          }
        })
      })



    //   Deletes

    function deleteItems(id){
      $.post({
          url:'service_code.php',
          data:{
              id:id,
          },
          success:function(data){
              $('#resutl_view').html(data);
              getRecords()
              warningOutViews(data)
          }
      })
    }


 
  
</script>
