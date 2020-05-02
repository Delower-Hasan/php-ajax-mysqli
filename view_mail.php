<?php
require 'header.php';
require 'sidebar.php';
?>

<div class="col-md-8 mt-5">
  <div class="section-table">
    <h2>Mail View</h2>
    <div id="message_delete" class="text-danger"></div>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">NAME</th>
      <th scope="col">EMAIL</th>
      <th scope="col">MESSAGE</th>
      <th  scope="col">ACTION</th>
      <th  scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody id="tb_body">
    
 
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


    function warningOut(res){
        let wrOut = document.getElementById('message_delete');
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

    function getRecords(){
          let record = 'x';
          $.post({
              url:'sendMessage.php',
              data:{
                  record:record,
              },
              success:function(datas){
                  let data_arr = JSON.parse(datas);
                  let outPUt = ``;
                  let menu = document.getElementById('db-menu')
                  data_arr.forEach(element => {
                    outPUt += `
                    <tr>
                        <td>${element[0]}</td>
                        <td>${element[1]}</td>
                        <td>${element[2]}</td>
                        <td>${element[3]}</td>
                        <td class="btn btn-danger mt-2" onclick='deleteItems(${element[0]})'> Delete </td>
                        <td > 
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal${element[0]}">
                        View
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal${element[0]}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel${element[0]}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel${element[0]}">Single View</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <table class="table table-bordered">

                                <tr>
                                <th scope="col">ID</th>
                                <td>${element[0]}</td>
                                </tr>
                                <tr>
                                <th scope="col">NAME</th>
                                <td>${element[1]}</td>
                                </tr>
                                <tr>
                                <th scope="col">EMAIL</th>
                                <td>${element[2]}</td>
                                </tr>
                                <tr>
                                <th scope="col">MESSAGE</th>
                                <td>${element[3]}</td>
                                </tr>


                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                
                            </div>
                            </div>
                        </div>
                        </div>
                        
                        
                        </td>
                    </tr>
                    
                    `
                  });

                  $('#tb_body').html(outPUt);
               
                  
              }
          })
      }


// status changes

// function changeStatus(id){
//       $.post({
//         url:'about_code.php',
//         data:{
//           statusId:id
//         },
//         success:function(data){
//             console.log(data)
//             getRecords();
//         }
//       })
//   }

 //   Deletes

    function deleteItems(id){
      $.post({
          url:'sendMessage.php',
          data:{
              id:id,
          },
          success:function(data){
            getRecords()
            warningOut(data)
          }
      })
    }

   









</script>



