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
    <link href="<?php echo asset_url();?>common.css" rel="stylesheet"> 
    
    <?php include('application/views/include/select_2_head.php'); ?>

     <style> 
		
        .btn-mini{
            margin: 5px 5px 5px 5px;
        }
        .wizard > .content > .body select.error {
			background: rgb(251, 227, 228);
			border: 1px solid #fbc2c4;
			color: #8a1f11;
		}
        .pop_edit_form label{
            font-size:14px;
        }
        .pop_edit_form .steps ul li a{
            font-size:13px;
        }
        .state_select span.select2-container,.district_select span.select2-container,.town_select span.select2-container{
            width:100% !important;
        }
        
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
                <div class="alert alert-danger ">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color:#fff;">×</button>
                    <i class="fa fa-times-circle fa-fw fa-lg"></i>
                    <strong></strong><?php echo $error; ?>
                </div>
                <?php $this->session->set_flashdata('error', ''); ?>

            <?php endif; ?>
            <!-- start: alert Message -->


            <div class="row">
                <div class="col-12">
                    <div class="float-right pr-5">
                        <button type="button" class="btn btn-round btn-sm btn-success" data-target="tooltip" data-placement="top">FCC<span class="tooltiptext" id="fcc_color" style="background-color:#6fd96f;">Franchise Code Creation -Status</span></button>&nbsp;
                        <button type="button" class="btn btn-round btn-sm" style="background-color:#9d980d;" data-target="tooltip" data-placement="left">BD<span class="tooltiptext" style="background-color:#9d980d;">Basic Details </span></button>&nbsp;
                        <button type="button" class="btn btn-round btn-sm btn-warning" data-target="tooltip" data-placement="left">CC<span class="tooltiptext" style="background-color:#f29d56;">Call Center Person </span></button>&nbsp;
                        <button type="button" class="btn btn-round btn-sm btn-danger" data-target="tooltip" data-placement="left">CT<span class="tooltiptext" style="background-color:red;">Cluster Team</span></button>&nbsp;
                        <button type="button" class="btn btn-round btn-sm" style="background-color:#e83e8c;" data-target="tooltip" data-placement="left">TT<span class="tooltiptext" style="background-color:#e83e8c;">Training Team</span></button>                        
                        <button type="button" class="btn btn-round btn-sm" style="background-color:#11cdef;" data-target="tooltip" data-placement="left">MT<span class="tooltiptext" style="background-color:#11cdef;">Maintenance Team</span></button>&nbsp;
                        <button type="button" class="btn btn-round btn-sm btn-info" data-target="tooltip" data-placement="left">SA<span class="tooltiptext" style="background-color:#4d7cff;">Sales Admin</span></button>&nbsp;
                        <button type="button" class="btn btn-round btn-sm btn-primary" data-target="tooltip" data-placement="left">SH<span class="tooltiptext" style="background-color:#7571f9;">Nethaji (Sales Head)</span></button>                        
                    </div>   
                </div>   
            </div>   


            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!--<h4 class="card-title">Entered Form</h4>-->
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration" id="funneled_tbl">
                                        <thead>
                                            <tr>
                                            	<th>S.NO</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Town Code</th>
                                                <th id="score">Score</th> 
                                                <th>Proof Detail</th>
                                                <th>Created By</th>
                                                <th>RSM </th>
                                                <th>Remarks</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         	
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <?php include('application/views/include/view_detail_pop.php'); ?>

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
    
    <!-- Toastr -->
    <script src="<?php echo asset_url();?>plugins/toastr/js/toastr.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/toastr/js/toastr.init.js"></script>

    
    <script src="<?php echo asset_url();?>plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
    
    <?php include('application/views/include/select_2_footer.php'); ?>
    <!-- added new --> 
    <script src="<?php echo asset_url();?>new_add/js/ct_entered_form.js"></script> 
    <script src="<?php echo asset_url();?>new_add/js/detail_pop.js"></script> 
    <script src="<?php echo asset_url();?>new_add/js/total_count_ct.js"></script>

    <script> 

        var BASE_URL = "<?php echo base_url();?>index.php/"; 
		var ASSET_URL = "<?php echo asset_url();?>";

        $(document).ready(function () {
            var  page="funneled_form";

            if(page=="funneled_form"){
                $(".funneled_form").addClass("active");
            }

        });
	</script>

        <script>
            $(".low_to_upper_case").keyup(function(){
                $(this).val($(this).val().toUpperCase());
            })
        </script>
     

</body>

</html>