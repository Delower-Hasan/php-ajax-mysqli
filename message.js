if(sessionStorage.getItem('logged') !=='x'){
    window.location = 'login.php';
  }
  
  
      $(document).ready(function(){
          getRecords();
        })
  
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
                      <a class="dropdown-item preview-item">
                      <div class="preview-thumbnail">
                          <img src="backend/images/faces/face4.jpg" alt="image" class="profile-pic">
                      </div>
                      <div class="preview-item-content flex-grow">
                        <h6 class="preview-subject ellipsis font-weight-medium "> ${element[1]}
                          <span class="float-right font-weight-light small-text">${element[2]}</span>
                        </h6>
                        <p class="font-weight-light small-text">
                         ${element[4]==0? 'Unseen':'Seen'}
                        </p>
                      </div>
                    </a>
                      
                      `
                  });

                  $('#dp-menu').html(outPUt);
               
                  
              }
          })
      }
    