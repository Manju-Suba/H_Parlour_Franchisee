

$('#loginForm').submit(function(e) {

    $("#btnSignin").attr("disabled", true);
    $("#btnSignin").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');
    
    var formData = new FormData(this);
    e.preventDefault();

       $.ajax({  
            url:BASE_URL + 'LoginController/doLogin', 
            method:"POST",  
            data: formData,
            cache:false,
            contentType: false,
            processData: false,
            dataType:"json",

            success:function(data) {
                if(data.logstatus =='success'){

                    setTimeout(
                        function() {
                            window.location = BASE_URL + data.url;

                        }, 2000);

                }
                else{
                    $("#btnSignin").attr("disabled", false);
                    $("#btnSignin").text('Log In');

                }
                
            }  
        }); 
    
    
});

