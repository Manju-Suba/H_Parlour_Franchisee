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
        
        #rej_filter_form .btn{
            margin-top: 2rem !important;
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
                    
         
            <div class="row">
                <div class="col-12">
                    <div class="float-right pr-5">
                        <button type="button" class="btn btn-round btn-sm btn-success" data-target="tooltip" data-placement="top">FCC<span class="tooltiptext" id="fcc_color" style="background-color:#6fd96f;">Franchise Code Creation -Status</span></button>&nbsp;
                        <button type="button" class="btn btn-round btn-sm btn-warning" data-target="tooltip" data-placement="left">BD<span class="tooltiptext" style="background-color:#f29d56;">Basic Details</span></button>&nbsp;
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

                                <div class="basic-form" style="padding:1.88rem 1.81rem 0 1.81rem">
                                    <form class="step-form-horizontal" id="rej_filter_form" action="javascript:void(0)" enctype="multipart/form-data"  method="post" data-parsley-validate autocomplete="off">
                                 	    <div class="form-row">
                                            <div class="form-group col-md-6">

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>RSM</label>
                                                        <select name="rsm" id="rsm" class="form-control nice_select">
                                                            <option value="" selected="selected">Choose RSM...</option>
                                                            <?php foreach($rsm_name as $val) { ?>
                                                                <option value="<?php echo $val['RSM_name']; ?>"><?php echo $val['RSM_name']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>BDM (CT)</label>
                                                        <select name="bdm" id="bdm" class="form-control nice_select" >
                                                            <option value="" selected="selected">Choose BDM...</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <button type="submit" class="btn btn-dark mt-4 ml-3">Filter</button>
                                            </div>
                                            <div class="form-group col-md-1">
                                                <a href="<?php echo base_url(); ?>index.php/cidhaya/rejected_form" class="btn btn-success mt-4">Reset</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--<h4 class="card-title">Entered Form</h4>-->
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration" id="rejected_form">
                                        <thead>
                                            <tr>
                                            	<th>S.NO</th>
                                                <th>Details</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Town Code</th>
                                                <th id="score">Score</th>
                                                <th>Proof Detail</th>
                                                <th>Created By</th>
                                                <th>Action</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                       
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- need to hide rej btn on pop -->

                <!-- Modal for approval-->
                <button type="button" class="btn btn-primary" id="approve_pop" data-toggle="modal" style="display:none;" data-target="#approval">Approval</button>
                <div class="modal fade" id="approval">
                    <div class="modal-dialog" role="document"> 
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Approval for this Form</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div> 
                            <div class="modal-body">
                                <form id="ithaya_rej_ap_form" action="javascript:void(0);" enctype="multipart/form-data" method="post" autocomplete="off">	
                                <input type="hidden" name="id" id="id" class="form-control" value="">
                                <input type="hidden" id="type">
                                <button type="button" name="approval" id="app_btn" class="btn mb-1 btn-success">Approve for Code Creation</button>

                                    <div class="form_hid_action" style="display:none;"> 
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="Department">Remarks</label>
                                            <div class="col-md-12">
                                                <textarea name="remarks" id="remarks" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                        <button type="submit" name="" id="submit_app_pop" class="btn mb-1 btn-success" style="float: right;">Submit</button>
                                    </div>
                                    <p id="form_resp" style="display:none;"></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Approve Modal approval -->

                <?php include('application/views/include/view_all_detail_pop.php'); ?> 
                <?php include('application/views/include/image_view_pop.php'); ?>
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

    <script src="<?php echo asset_url();?>new_add/js/rsm_pop_app_rej.js"></script>
    <script src="<?php echo asset_url();?>new_add/js/detail_pop.js"></script> 
    <script src="<?php echo asset_url();?>new_add/js/total_count_rsmi.js"></script>
    <script src="<?php echo asset_url();?>new_add/js/get_idhaya_app_list.js"></script>
    <script src="<?php echo asset_url();?>new_add/js/get_idhaya_filter.js"></script>

    <script src="<?php echo asset_url();?>plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
    
    <script>
        $(document).ready(function () {
            $("#rej_btn").css("display","none");
        })
    </script>

    <script>
        var BASE_URL = "<?php echo base_url();?>index.php/";
		var ASSET_URL = "<?php echo asset_url();?>";

	    $(document).ready(function () {
            var  page="rejected_form";

            if(page=="rejected_form"){
                $(".rejected_form").addClass("active");
            }
		});
		
		$('#toast-container').delay(5000).fadeOut('slow');	
		$(document).on("click", ".toast-close-button", function (e) {
			$('#toast-container').hide();
		});
		
	</script>
    <?php include('application/views/include/select_2_footer.php'); ?>

</body>

</html>