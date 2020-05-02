
(function(){
    function bgsOut(){
        setTimeout(function(){
            var bgs = document.getElementById('bgs');
            bgs.style.display = 'none';
        },3000)
    }
    
        $('#regSubmit').click(function(e){
            e.preventDefault();
            var name = document.forms["register"]["fname"].value;
            var email = document.forms["register"]["email"].value;
            var pass = document.forms["register"]["pass"].value;
            var conPass = document.forms["register"]["conPass"].value;
            var alrt = `<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong> Input </strong> is empty
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>`
            if (name == "") {
            $('#fname').html(alrt);
            return false;
            }
            else if(email == ""){
                $('#email').html(alrt);
            }
            else if(pass == ""){
                $('#pass').html(alrt);
            }
            else if(conPass == ""){
                $('#conPass').html(alrt);
            }
            else if(conPass != pass){
                $('#conPass').html('PassWord Is not Matched')
            }
            $.ajax({
                url: 'registerCode.php',
                type:'POST',
                data: $('#register input').serialize(),
                success:function(data){
                    $('#bgs').html(data);
                    bgsOut();
                }
            })
        })
    
    
}())



    // login
    (function(){
        $('#login').click(function(e){
            e.preventDefault();
            var email = document.forms['loginForm']["email"].value
            var pass = document.forms['loginForm']["pass"].value  
          $.post({
              url:'registerCode.php',
              data: {
                  email:email,
                  pass:pass,
              },
              success:function(data){
                 let isLogged = data;
                 if(isLogged == 1){
                    sessionStorage.setItem("logged", "x");
                    window.location = 'master.php';
                 }
                 else{
                    var alrt = `<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong> Password Or Email </strong> is not Matched
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>`
                    $('#logsAlert').html(alrt)
                    window.location = 'login.php';
                 }
  
              },
          })
        
        })

    }())





    

    // add logos
 


