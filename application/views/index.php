<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>H-PARLOUR FRANCHISEE</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo asset_url();?>images/logo.png">
    <!-- Custom Stylesheet -->
    <link href="<?php echo asset_url();?>plugins/jquery-steps/css/jquery.steps.css" rel="stylesheet">
    <link href="<?php echo asset_url();?>plugins/toastr/css/toastr.min.css" rel="stylesheet">
    <link href="<?php echo asset_url();?>css/style.css" rel="stylesheet">
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">

    <?php include('application/views/include/select_2_head.php'); ?>

    <style> 
        p {
            margin-top: 0.7rem;
            margin-bottom: 0.5rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__clear {
            cursor: pointer;
            float: right;
            font-weight: bold;
            display: none;
        }

    /* * //year picker start */ 
        .ui-datepicker-div{
            position: fixed;
            top: 758.796px;
            left: 1135.66px;
            z-index: 1;
            display: block;
        }
        
        .ui-datepicker-prev.ui-corner-all,.ui-datepicker-next.ui-corner-all,.ui-datepicker-month,.ui-datepicker-calendar,.ui-datepicker-current{
            display: none;
        }

        /* .ui-datepicker-year{
            width:183px;
            height: 40px;
            padding: 0px 60px;
        }

        .ui-datepicker-close.ui-state-default.ui-priority-primary.ui-corner-all{
            width:70px;
            float: right;
            background-color: #e5e4f1;
            margin-top: 10px;
            margin-bottom: 5px;
            margin-right: 4px;
            border-radius: 5px 5px 5px 5px;

        }

        #ui-datepicker-div{
            position: fixed;
            top: 710.453px;
            left: 567.891px;
            z-index: 1;
            border: 1px solid #8b8080;
            background-color: #d3d1d1f2;
        }

        .ui-widget-header {
            border: 1px solid #e78f08;
            background: #f6a828 url(images/ui-bg_gloss-wave_35_f6a828_500x100.png) 50% 50% repeat-x;
            color: #fff;
            font-weight: bold;
        }

        #ui-datepicker-div .ui-datepicker-header .ui-datepicker-title{
            padding: 5px 5px 5px 5px;
        } */


        .wizard .content > .body label.error {
            position: absolute;
            top: 77%;
            margin-left: 0;
            font-size:13px ;

        }

/* //year picker end */

    .error{
        border:1px solid #fbc2c4;
        box-shadow:0 0 0 1px #ed4a4a;
        appearance:none;
        background-color:rgb(251, 227, 228);
        /* transition:all ease-in 0.2s; */

    }
        
    </style>
</head> 

<body>
 
    <!--*******************
        Preloader start
    ********************-->
    <!-- <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div> -->
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <!-- <!?php include('application/views/include/header.php'); ?> -->
        
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <!-- <!?php include('application/views/include/sidebar.php'); ?> -->
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
               
            </div>
            <!-- row -->
             <!-- start: alert Message -->
            <?php $message = $this->session->flashdata('message'); ?>
            <?php $error = $this->session->flashdata('error'); ?>
            <?php if (!empty($message)): ?>
                <div id="toast-container" class="toast-top-center">
                    <div class="toast toast-success" aria-live="polite">
                        <button type="button" class="toast-close-button" role="button">×</button>
                        <div class="toast-title">Franchisee</div>
                        <div class="toast-message"><?php echo $message; ?></div>
                        </div>
                </div>
                <?php $this->session->set_flashdata('message', ''); ?>

            <?php endif; ?> 

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger ">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color:#fff;">×</button>
                    <i class="fa fa-times-circle fa-fw fa-lg"></i>
                    <strong></strong><?php echo $error; ?>
                </div>
                <?php $this->session->set_flashdata('error', ''); ?>

            <?php endif; ?>
            <!-- start: alert Message -->
                    
            <div class="container-fluid"> 
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-body">
                                <h1>Franchise Information</h1>
                                <br>
                                <form  action="<?php echo base_url('index.php/user/user_info'); ?>" data-parsley-validate method="post" autocomplete="off" enctype="multipart/form-data"> 
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Name <span style="color:red;">*</span></label>
                                                    <input type="text" id="f_name" name="name" class="form-control low_to_upper_case" placeholder="Enter User Name" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Email <span style="color:red;">*</span></label>
                                                    <input type="email" name="email" id="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Enter your email ..." required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Mobile <span style="color:red;">*</span></label>
                                                    <input type="text" name="mobile" id="mobile" minlength="10" maxlength="10" oninput="mobileValid();" class="form-control" placeholder="Mobile no." required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Whatsapp No. ( &nbsp;<input type="checkbox" id="mobile_same" name="mobile_same" onclick="myFunction()">&nbsp; same as mobile no.)&nbsp;<span style="color:red;">*</span></label>
                                                    <input type="text" name="whatsapp_no" id="whatsapp_no" class="form-control" minlength="10" maxlength="10" oninput="mobileValid_2();" placeholder="Whatsapp no." required>
                                                </div>
                                            </div> 
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Landline(Optional)</label>
                                                    <input type="text" name="landline" id="landline" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" minlength="10" maxlength="12" placeholder="Landline no.">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <p>Gender  <span style="color:red;">*</span></p>
                                                    <div class="row ml-2">
                                                        <input type="radio" id="gender" name="gender" value="Male" required>&nbsp;
                                                        <p >Male</p><br>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" id="gender2" name="gender" value="Female" required>&nbsp;
                                                        <p >Female</p><br>&nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <p>Marital Status  <span style="color:red;">*</span></p>
                                                    <div class="row ml-2">
                                                        <input type="radio" id="marital_status" name="marital_status" value="Married" required>&nbsp;
                                                        <p >Married</p><br>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" id="marital_status2" name="marital_status" value="Unmarried" required>&nbsp;
                                                        <p >Unmarried</p><br>&nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">  
                                                <div class="form-group">
                                                    <p>Language  <span style="color:red;">*</span></p>
                                                    <div class="row ml-2">
                                                        <input type="radio" id="language" name="language" value="English" required>&nbsp;
                                                        <p >English</p><br>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" id="language2" name="language" value="Tamil" required>&nbsp;
                                                        <p >Tamil</p><br>&nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <p>Occupation  <span style="color:red;">*</span></p>
                                                    <div class="row ml-1">
                                                        <input type="radio" id="occupation" name="occupation" value="Self run business" required>&nbsp;
                                                        <p >Self run business</p><br>&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" id="occupation2" name="occupation" value="Employee" required>&nbsp;
                                                        <p >Employee</p><br>&nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label>Educational Qualification <span style="color:red;">*</span></label>
                                                    <select name="education_q" id="education_q" class="form-control c-pointer" required>
                                                        <option value="" disabled selected>Select Education </option>
                                                        <option value="10th">10th</option>
                                                        <option value="12th">12th</option>
                                                        <option value="Degree Holder">Degree Holder</option>
                                                    </select>
                                                </div>
                                            </div>
                                           
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">Individual's Monthly Income<span style="color:red;">*</span></label>
                                                    <input type="number" name="monthly_income" id="monthly_income" onkeydown="return event.keyCode !== 69" class="form-control" placeholder="₹" required>
                                                </div>
                                            </div> 
 
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">Family's total Monthly Income <span style="color:red;">*</span></label>
                                                    <input type="number" name="family_income" id="family_income" onkeydown="return event.keyCode !== 69" class="form-control" placeholder="₹" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-3"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3"> 
                                                <div class="form-group">
                                                    <label for="">State <span style="color:red;">*</span></label>
                                                    <select name="shop_sate" id="shop_sate" class="form-control nice_select " required>
                                                        <option value="">Select State</option>
                                                        <?php foreach($sates as $sates ){ ?>
                                                            <option value="<?php echo $sates['state_name']; ?>"><?php echo $sates['state_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div> 
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">District <span style="color:red;">*</span></label>
                                                    <select id="shop_city" name="shop_city" class="form-control nice_select" required>      
                                                        <option value="">Select District</option>
                                                    </select> 
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">Town <span style="color:red;">*</span></label>
                                                    <select id="shop_town" name="shop_town" class="form-control nice_select" required>      
                                                        <option value="">Select Town</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" name="town_code" id="town_code" class="form-control" placeholder="Town Code">
                                            <input type="hidden" name="population" id="population" class="form-control" placeholder="Population"/>
                                            
                                            <div class="col-lg-3"> 
                                                <div class="form-group">
                                                    <label for="">Address <span style="color:red;">*</span></label>
                                                    <textarea name="address" class="form-control low_to_upper_case" rows="2" placeholder="Type your address here..." required></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-3"> 
                                                <div class="form-group">
                                                    <label for="">Pincode <span style="color:red;">*</span></label>
                                                    <input type="text" name="pincode" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" maxlength="6" minlength="6" placeholder="Enter pincode.." required>
                                                </div>
                                            </div>
                                            <div class="col-lg-3"> 
                                                <div class="form-group">
                                                    <label for="">Residing since : (year) <span style="color:red;">*</span></label>
                                                    <input type="text" name="residing_year" id="residing_year" class="form-control" placeholder="Select year" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-3"> 
                                                <div class="form-group">
                                                    <label for="">Sourced By(Optional)</label>
                                                    <select name="sourced_by" class="form-control c-pointer" >
                                                        <option value="select" disabled selected>Select</option>
                                                        <option value="Advertisement">Advertisement</option>
                                                        <option value="Facebook">Facebook</option>
                                                        <option value="WhatsApp">WhatsApp</option>
                                                        <option value="Newspaper">Newspaper</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3"> 
                                                <div class="form-group">
                                                    <label for="">Referred Person(Optional)</label>
                                                    <input type="text" name="referred_person" class="form-control" placeholder="Enter Referred Person">
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="">Proof Type<span style="color:red;">*</span></label>
                                                    <select name="proof" id="proof" class="form-control text-dark" onchange="myFFunction()" required>
                                                        <option value="select" disabled selected>Select</option>
                                                        <option value="Aadhar">Aadhar</option>
                                                        <option value="Pan">Pan</option>
                                                        <option value="Driving Licence">Driving Licence</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label id="demo">Proof </label>&nbsp;No.<span style="color:red;">*</span>
                                                    <input type="text" id="proof_no" name="proof_no" class="form-control low_to_upper_case" minlength="10" maxlength="13"  placeholder="Enter your id number..." required >
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label id="demo1">Proof</label>&nbsp;Attachment
                                                    <input type="file" name="image_proof" id="image_proof" class="form-control" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn mb-1 btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="http://hemas.in/">Hemas.in</a> 2018</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="<?php echo asset_url();?>plugins/common/common.min.js"></script>
    <script src="<?php echo asset_url();?>js/custom.min.js"></script>
    <script src="<?php echo asset_url();?>js/settings.js"></script>
    <script src="<?php echo asset_url();?>js/gleek.js"></script>
    <script src="<?php echo asset_url();?>js/styleSwitcher.js"></script>


    <script src="<?php echo asset_url();?>plugins/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo asset_url();?>js/plugins-init/jquery-steps-init.js"></script>
    <script src="<?php echo asset_url();?>plugins/jqueryui/js/jquery-ui.min.js"></script>
    
    <!-- Toastr -->
    <script src="<?php echo asset_url();?>plugins/toastr/js/toastr.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/toastr/js/toastr.init.js"></script>

    <!-- added new --> 
    <!-- <script src="<?php echo asset_url();?>new_add/js/distributor_form.js"></script>  -->
    <!-- <script src="<?php echo asset_url();?>new_add/js/total_count_tso.js"></script> -->
    <!-- <script src="<?php echo asset_url();?>new_add/js/ss_code_check.js"></script> -->

    <?php include('application/views/include/select_2_footer.php'); ?>
     
    <script>

        var BASE_URL = "<?php echo base_url();?>index.php/"; 
        var ASSET_URL = "<?php echo asset_url();?>";

		$(document).on("click", ".toast-close-button", function (e) {
			$('#toast-container').hide();
		});

        function myFunction() {
            var checkBox = document.getElementById("mobile_same");
            if (checkBox.checked == true){
                // getMobile();
                var mobile = $('#mobile').val();
                $('#whatsapp_no').val(mobile);

                $("#mobile").on("keyup", function(){
                    var value = $(this).val();
                    $("#whatsapp_no").val(value);
                });

            } else {
                var mobile = "";
                $('#whatsapp_no').val(mobile);
            }

        }

        function myFFunction() {
            var x = document.getElementById("proof").value;
            // alert(x);
            document.getElementById("demo").innerHTML = x;
            document.getElementById("demo1").innerHTML = x;
            $('#proof-error').hide();

            if( x == "Pan"){
                $("#proof_no").attr('maxlength','10');
                $("#proof_no").attr('minlength','10');
            }else if( x == "Aadhar"){
                $("#proof_no").attr('maxlength','12');
                $("#proof_no").attr('minlength','12');
            }else{
                $("#proof_no").attr('maxlength','13');
                $("#proof_no").attr('minlength','10');
            }
        }
        
        // function getMobile() {
        //     var mobile = $('#mobile').val();
        //     $('#whatsapp_no').val(mobile);
        // }

       

        
        function mobileValid(){
            var textInput = document.getElementById("mobile").value;
            textInput = textInput.replace(/[^0-9]/g, "");
            document.getElementById("mobile").value = textInput;
        }

        function mobileValid_2(){
            var textInput = document.getElementById("whatsapp_no").value;
            textInput = textInput.replace(/[^0-9]/g, "");
            document.getElementById("whatsapp_no").value = textInput;
        }
		
		$('#step-form-horizontal').data('serialize',$('#step-form-horizontal').serialize()); // On load save form current state

		$(window).bind('beforeunload', function(e){
			if($('#step-form-horizontal').serialize()!=$('#step-form-horizontal').data('serialize'))return true;
			else e=null; // i.e; if form state change show warning box, else don't show it.
			 
		});
		
		$(document).on("submit", "form", function(event){
				// disable warning
				$(window).off('beforeunload');
			});
		
		
		$('.toast-success').delay(5000).fadeOut('slow');

        // get city
		jQuery(document).on('change', 'select#shop_sate', function (e) {
			e.preventDefault();
			var stateID = jQuery(this).val();
			getCityList(stateID);
		 
		});
		
		// function get All Cities
		function getCityList(stateID) {
			$.ajax({
				url: BASE_URL + 'user/getcities',
				type: 'post',
				data: {stateID: stateID},
				dataType: 'json',
				beforeSend: function () {
					jQuery('select#shop_city').find("option:eq(0)").html("Please wait..");
				},
				complete: function () {
					// code
				},
				success: function (json) {
					var options = '';
					options +='<option value="">Select District</option>';
					for (var i = 0; i < json.length; i++) {
						options += '<option value="' + json[i].district_name + '">' + json[i].district_name + '</option>';
					}
					jQuery("select#shop_city").html(options);

                    // town list
                    var options = '';
					options +='<option value="">Select Town</option>';
					jQuery("select#shop_town").html(options);
		 
				},
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
		
		// get town
		jQuery(document).on('change', 'select#shop_city', function (e) {
			e.preventDefault();
			var cityID = jQuery(this).val();
			getTownList(cityID);
		 
		});

        
		
		// function get All town
		function getTownList(cityID) {
			$.ajax({
				url: BASE_URL + 'user/gettowns',
				type: 'post',
				data: {cityID: cityID},
				dataType: 'json',
				beforeSend: function () {
					jQuery('select#shop_town').find("option:eq(0)").html("Please wait..");
				},
				complete: function () {
					// code
				},
				success: function (json) {
					var options = '';
					options +='<option value="">Select Town</option>';
					for (var i = 0; i < json.length; i++) {
						options += '<option value="' + json[i].town_name + '">' + json[i].town_name + '</option>';
					}
					jQuery("select#shop_town").html(options);
		 
				},
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
		
		
		
		// get zip code
		jQuery(document).on('change', 'select#shop_town', function (e) {
			e.preventDefault();
			var townID = jQuery(this).val();
			getZipList(townID);
		 
		});
		
		// function get All town
		function getZipList(townID) {
			$.ajax({
				url: BASE_URL + 'user/getzip',
				type: 'post',
				data: {townID: townID},
				dataType: 'json',
				success: function (json) {
					//alert(json.zip_code);
					console.log(json);
					$('#town_code').val(json.town_code);
				},
			});

            $.ajax({
				url: BASE_URL + 'user/get_population',
				type: 'post',
				data: {townID: townID},
				dataType: 'json',
				success: function (json) {
					//alert(json.zip_code);
					console.log(json);
					$('#population').val(json.population);
				},
			});
		}
	</script>

    <script>
        $(".low_to_upper_case").keyup(function(){
            $(this).val($(this).val().toUpperCase());
        })

        // $('#f_name').bind('input', function() {
        //     var c = this.selectionStart,
        //         r = /[^a-z0-9 .]/gi,
        //         v = $(this).val();
        //     if(r.test(v)) {
        //         $(this).val(v.replace(r, ''));
        //         c--;
        //     }
        //     this.setSelectionRange(c, c);
        // });

        function testInput(event) {
            var value = String.fromCharCode(event.which);
            var pattern = new RegExp(/[a-zåäö ]/i);
            return pattern.test(value);
        }

        $('#f_name').bind('keypress', testInput);


        $("#email").blur(function(){
            validEmail();
        });

        function validEmail()
        {
            var mail = document.getElementById('email').value; 
            var email = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
            if (mail.match(email))
            {
                $("input[name='email']").removeClass('error'); 
            }
            else
            {
                $("input[name='email']").addClass('error'); 
            }
        }

    </script>

    <script type="text/javascript">

$(function() { 
            $('#residing_year').datepicker( {
                yearRange: "c-30:c",
                changeDate: false,
                changeMonth: false,
                changeYear: true,
                showButtonPanel: true,
                closeText:'Select',
                currentText: 'This year',
                onClose: function(dateText, inst) {
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).val($.datepicker.formatDate("yy", new Date(year, 0, 1)));
                },
                beforeShow: function(input, inst){
                if ($(this).val()!=''){
                    var tmpyear = $(this).val();
                    $(".ui-datepicker-month").hide();
                    $(".ui-datepicker-calendar").hide();
                    $(this).datepicker('option','defaultDate',new Date(tmpyear, 0, 1));
                }
                }
            }).focus(function () {
                $(".ui-datepicker-month").hide();
                $(".ui-datepicker-calendar").hide();
                $(".ui-datepicker-current").hide();
                $(".ui-datepicker-prev").hide();
                $(".ui-datepicker-next").hide();
                // $("#ui-datepicker-div").position({
                // my: "left top",
                // at: "left bottom",
                // of: $(this)
                // });
            }).attr("readonly", false);
        });

    </script>
   
</body>

</html>