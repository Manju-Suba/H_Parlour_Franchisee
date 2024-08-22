
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>H-PARLOUR FRANCHISEE</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo asset_url();?>images/logo.png">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="<?php echo asset_url();?>css/style.css" rel="stylesheet">
    

    <style>
        /* .error{
            width: 500px;
            color: red;
            border: 1px solid red;
            padding: 10px;
            background-color: #f3cbcb;
        }

        .success{
            width: 500px;
            border: 1px solid red;
            padding: 10px;
            background-color: #b8edd0;
        } */
        
        #submit:hover{
            /* background-color: #17851b; */
            background-color: #5041c9;
            
        }

        button:active{
            cursor: none;
        }


    </style>
</head>

<body class="h-100">
    
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->




    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6 col-md-6 col-sm-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="#"> <h4>H-Parlour Franchisee login</h4></a>
        
                                <form id="login_form" action="javascript:void(0)" method="post" class="mt-5 mb-5 login-input">
                                    <div class="form-group">
                                        <input type="text" autofocus="autofocus" name="emp_no" id="emp_no" class="form-control" placeholder="User ID" autocomplete="off">
                                    </div>
                                    <div id="user_err" style="display: none;"></div>

                                    <div class="form-group">
                                        <input type="password"  name="pass" id="pass" class="form-control" placeholder="Password" autocomplete="off">
                                    </div>
                                    <div id="pass_mess" style="display: none;" class="mb-4"></div>

                                    <div class="col-sm-12">
                                        <?php if ($this->session->flashdata('msg') !="") { ?> 
                                        <div class="alert alert-warning">
                                            <?= $this->session->flashdata('msg'); ?>
                                        </div>
                                        <?php } ?>
								    </div>
                                    <button type="submit" id="submit" class="form-control btn login-form__btn submit w-100">Sign In</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--**********************************
        Scripts
    ***********************************-->
    <script src="<?php echo asset_url();?>plugins/common/common.min.js"></script>
    <script src="<?php echo asset_url();?>js/custom.min.js"></script>
    <script src="<?php echo asset_url();?>js/settings.js"></script>
    <script src="<?php echo asset_url();?>js/gleek.js"></script>
    <script src="<?php echo asset_url();?>js/styleSwitcher.js"></script>

   <script>

        var BASE_URL = "<?php echo base_url();?>"; 
		var ASSET_URL = "<?php echo asset_url();?>";

    $('#login_form').submit(function(){

        // alert('working');
        emp_no = $('#emp_no').val();
        password = $('#pass').val();

        if(emp_no == "" || password == ""){

            if(emp_no =="" && password !=""){
                $("#user_err").fadeIn();
                $("#user_err").css("display","block");
                $("#user_err").html('<b style="color:red;" class="error">Please enter User id</b>');
                $("#user_err").delay(2000).fadeOut(500);
            }
            if(password =="" && emp_no !=""){
                $("#pass_mess").fadeIn();
                $("#pass_mess").css("display","block");
                $("#pass_mess").html('<b style="color:red;" class="error">Please enter password</b>');
                $("#pass_mess").delay(2000).fadeOut(500);
            }
            if(emp_no =="" && password ==""){
                $("#pass_mess").fadeIn();
                $("#pass_mess").css("display","block");
                $("#pass_mess").html('<b style="color:red;" class="error">Enter user id and password</b>');
                $("#pass_mess").delay(2000).fadeOut(500);
            }
        }else{

            $.ajax({   
                type: "POST",
                url: BASE_URL + 'index.php/loginController/doLogin',  
                data: $("#login_form").serialize(), 
                dataType: "JSON",

                success: function (data) {
                    $("#pass_mess").fadeIn();
                    $("#pass_mess").css("display","block");
                    if (data.response == "CC") {
                        $("#pass_mess").html('<b style="color:green;" class="success">Login successfully! </b>');
                        $("#pass_mess").delay(2000).fadeOut(500);

                        var explode = function(){
                            window.location.href="<?php echo base_url();?>index.php/cc/franchisee_form";
                        };
                        setTimeout(explode, 1900);
                    } 
                    else if(data.response == "CT"){

                        $("#pass_mess").html('<b style="color:green;">Login successfully!  </b>');
                        $("#pass_mess").delay(2000).fadeOut(500);

                        var explode = function(){
                            window.location.href="<?php echo base_url();?>index.php/ct/entered_form";
                        };
                        setTimeout(explode, 1900);
                    }
                    else if(data.response == "RSM"){
                        $("#pass_mess").html('<b style="color:green;">Login successfully!  </b>');
                        $("#pass_mess").delay(2000).fadeOut(500);

                        var explode = function(){
                            window.location.href="<?php echo base_url();?>index.php/rsm/login_type";
                        };
                        setTimeout(explode, 1900);
                    }
                    else if(data.response == "OM"){
                        $("#pass_mess").html('<b style="color:green;">Login successfully!  </b>');
                        $("#pass_mess").delay(2000).fadeOut(500);

                        var explode = function(){
                            window.location.href="<?php echo base_url();?>index.php/opm/login_type";
                        };
                        setTimeout(explode, 1900);
                    }
                    else if(data.response == "IDHAYA"){
                        $("#pass_mess").html('<b style="color:green;">Login successfully!  </b>');
                        $("#pass_mess").delay(2000).fadeOut(500);

                        var explode = function(){
                            window.location.href="<?php echo base_url();?>index.php/cidhaya/login_type";
                        };
                        setTimeout(explode, 1900);
                    }
                    else if(data.response == "SH"){

                        $("#pass_mess").html('<b style="color:green;">Login successfully!  </b>');
                        $("#pass_mess").delay(2000).fadeOut(500);

                        var explode = function(){
                            window.location.href="<?php echo base_url();?>index.php/sh/login_type";
                        };
                        setTimeout(explode, 1900);
                    }
                    else if(data.response == "TT"){
                        $("#pass_mess").html('<b style="color:green;">Login successfully!  </b>');
                        $("#pass_mess").delay(2000).fadeOut(500);

                        var explode = function(){
                            window.location.href="<?php echo base_url();?>index.php/tt/approve_form";
                        };
                        setTimeout(explode, 1900);
                    }
                    else if(data.response == "SA"){
                        $("#pass_mess").html('<b style="color:green;">Login successfully!  </b>');
                        $("#pass_mess").delay(2000).fadeOut(500);

                        var explode = function(){
                            window.location.href="<?php echo base_url();?>index.php/sa/login_type";
                        };
                        setTimeout(explode, 1900);
                    }
                    else if(data.response == "MT"){
                        $("#pass_mess").html('<b style="color:green;">Login successfully!  </b>');
                        $("#pass_mess").delay(2000).fadeOut(500);

                        var explode = function(){
                            window.location.href="<?php echo base_url();?>index.php/mt/approved_form";
                        };
                        setTimeout(explode, 1900);
                    }
                    else if(data.response == "REP"){
                        $("#pass_mess").html('<b style="color:green;">Login successfully!  </b>');
                        $("#pass_mess").delay(2000).fadeOut(500);

                        var explode = function(){
                            window.location.href="<?php echo base_url();?>index.php/rep/location_table";
                        };
                        setTimeout(explode, 1900);
                    }
                    else if(data.response == "MP"){
                        $("#pass_mess").html('<b style="color:green;">Login successfully!  </b>');
                        $("#pass_mess").delay(2000).fadeOut(500);

                        var explode = function(){
                            window.location.href="<?php echo base_url();?>index.php/mp/franchise_form";
                        };
                        setTimeout(explode, 1900);
                    }
                    else if(data.response == "error"){
                        $("#pass_mess").html('<b style="color:red;">Username / Password Invalid</b>');
                        $("#pass_mess").delay(2000).fadeOut(500);
                    }
                    else{
                        $("#pass_mess").html('<b style="color:red;">You Are Not Allowed !</b>');
                        $("#pass_mess").delay(1900).fadeOut(500);
                    }
                }
            })
        }
    })

   </script>
</body>
</html>