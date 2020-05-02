<?php
require 'header.php';
require 'sidebar.php';
?>
<div class="row justify-content-center">
<div class="col-md-6 mt-5 ">
    <h2 >Add logo</h2>
  <div >
  
  <form  id="logoForm" action="logo.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
   
    <input type="file" name="logo" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <div id="fileInfo"></div>
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
<div class="col-md-6 mt-5">
  <div class="section-table">
    <h2>Logos</h2>
  <table class="table">
  <thead>
    <tr>
      <th >Id</th>
      <th >Logos</th>
      <th >status</th>
      <th  >Delete</th>
      
    </tr>
  </thead>
  <tbody id="tbody">
    
 
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
   
    getrecord()
    (function(){
      
      function noneValue(){
      let file  = document.forms['logoForm']['logo']
      let status  = document.forms['logoForm']['status']
      file.value = '';
      status.value = '#';
    }

    // insert

  $('#logoForm').submit(function(e){
          e.preventDefault()
        
      
          $.ajax({
          url:'logo.php',
          type:'POST',
          data: new FormData(this),
          contentType: false,
          cache:false,
          processData:false,
          success:function(response){
            $('#fileInfo').html(response);
            noneValue()
            getrecord()
          }
        })
      })
    }())

  })

      // deleteData

  function deleteImg(id){
     $.post({
       url:'logo.php',
        data:{
          id:id
        },
        success:function(res){
          console.log(res);
          getrecord()
        }
     })
    }


    // get records
   
    
      function getrecord(){
        $items = 'logos';
        $.ajax({
          url:'logo.php',
          type:'POST',
          data:{
            logo:$items,
          },
          success:function(datas){
         
           let arr_datas =JSON.parse(datas);
           var out = ``
           arr_datas.forEach(function(data){
             
           out +=  (`<tr>
                            <td> ${data[0]}</td>
                            <td><img src="imageFolder/logo/${data[1]}" width="50" height="50" alt=""></td>
                            <td  class='btn ${data[2]==1?'btn-primary':'btn-info'} mr-5' onclick ="changeStatus(${data[0]})" >${data[2] ==1? 'Active':'Deactive'} </td>
                            <td class="btn btn-danger mt-2" onclick='deleteImg(${data[0]})'> Delete </td>
                      </tr>`)

           })
           $('#tbody').html(out);
          
          }
       
        }) 
      }
    
      // getrecord()

      function changeStatus(id){
      
          $.post({
            url:'logo.php',
            data:{
              statusId:id
            },
            success:function(data){
              getrecord();
            }
          })
      }
    

        
   

   

  
</script>
