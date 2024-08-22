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
    <link href="<?php echo asset_url();?>plugins/toastr/css/toastr.min.css" rel="stylesheet">
    <link href="<?php echo asset_url();?>plugins/jquery-steps/css/jquery.steps.css" rel="stylesheet">
    <link href="<?php echo asset_url();?>plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?php echo asset_url();?>css/style.css" rel="stylesheet">
    
  
     <style>
		/*.nav-header .brand-logo a{ padding:0;}
		.nav-header .brand-logo a b img{ max-width:100%;}
		[data-sidebar-style="full"][data-layout="vertical"] .menu-toggle .nav-header .brand-logo a{ padding:0;}
		[data-nav-headerbg="color_1"] .nav-header{background-color:#fff;}
		.wizard > .steps > ul > li{ width:30%;}
		.wizard .content{ min-height:500px !important;}*/
	</style>

</head>

<body>

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
         <?php include('application/views/include/header.php'); ?>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
         <?php include('application/views/include/sidebar.php'); ?>
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
                        	<div class="toast toast-success" aria-live="polite" style="">
                                <button type="button" class="toast-close-button" role="button">×</button>
                                <div class="toast-title">Franchisee</div>
                                <div class="toast-message"><?php echo $message; ?></div>
                             </div>
                        </div>
                        <?php $this->session->set_flashdata('message', ''); ?>
                        
                    
                    <?php endif; ?>

                    <?php if (!empty($error)): ?>
                        <div id="toast-container" class="toast-top-center">
                        	<div class="toast toast-error" aria-live="polite" style="">
                                <button type="button" class="toast-close-button" role="button">×</button>
                                <div class="toast-title">Franchisee</div>
                                <div class="toast-message"><?php echo $error; ?></div>
                             </div>
                        </div>
                        <?php $this->session->set_flashdata('error', ''); ?>

                    <?php endif; ?>
                    <!-- start: alert Message -->
                    
         
                    

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            	<form name="recruitment_form" id="recruitment_form" class="form-horizontal form-bordered" action="<?php echo base_url('index.php/common/change_pass'); ?>" enctype="multipart/form-data"  data-parsley-validate method="post" autocomplete="off">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="basicInput">New Password</label>
                                        <input type="password" name="new_pass" id="new_pass" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="helpInputTop">Confirm New Password</label>
                                        <input type="password" name="confirm_pass" id="confirm_pass" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                    </div>
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

    <script src="<?php echo asset_url();?>new_add/js/total_count_cc.js"></script>
    <script src="<?php echo asset_url();?>new_add/js/total_count_ct.js"></script>
    <script src="<?php echo asset_url();?>new_add/js/total_count_sh.js"></script>
    <script src="<?php echo asset_url();?>new_add/js/total_count_cod.js"></script>
    <script src="<?php echo asset_url();?>new_add/js/total_count_rsmi.js"></script>
    <script src="<?php echo asset_url();?>new_add/js/rsm_pop_app_rej.js"></script>

    <script>

    var BASE_URL = "<?php echo base_url();?>index.php/"; 
    var ASSET_URL = "<?php echo asset_url();?>";
    
	    $(document).ready(function () {

            total_count_tt(); 
            total_count_mt(); 
            total_count_mp();

            var  page="change_password";
            if(page=="change_password"){
                $(".change_password").addClass("active");
            }

		});
		
        // total count //
        function total_count_tt(){
            $.ajax({
                url : BASE_URL + 'tt/get_details_count',
                method : 'POST',
                dataType : 'JSON',

                success: function(data){

                    $('#tt_approve_details').html(data.tt_approve_details);
                }
            })
        }

        function total_count_mt(){
            $.ajax({
                url : BASE_URL + 'mt/get_details_count',
                method : 'POST',
                dataType : 'JSON',

                success: function(data){

                    $('#mt_upload_details').html(data.mt_upload_details);
                    $('#mt_uploaded_details').html(data.mt_uploaded_details);
                }
            })
        }

        function total_count_mp(){
            $.ajax({
                url : BASE_URL + 'mp/get_details_count',
                method : 'POST',
                dataType : 'JSON',

                success: function(data){
                    $('#mp_entered').html(data.mp_entered);
                }
            })
        }

		// <!--alert message-->	
		$('#toast-container').delay(5000).fadeOut('slow');	
		$(document).on("click", ".toast-close-button", function (e) {
			$('#toast-container').hide();
		});
		// <!--alert message-->
		
	</script>
     

</body>

</html>