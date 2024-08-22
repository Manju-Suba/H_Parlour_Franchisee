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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php include('application/views/include/select_2_head.php'); ?>

    <style>
	
        .dataTables_filter input {
            height: 46px;
            padding: 0px 5px;
        }

        .wizard > .content > .body select.error {
			background: rgb(251, 227, 228);
			border: 1px solid #fbc2c4;
			color: #8a1f11;
		}
        .opacity-30-no-click{
            pointer-events: none;
            opacity: 75%;
        }
        .dt-buttons{
            padding-left: 25px;
        }
        .dt-buttons button{
            cursor: pointer;
        }

        #filter_form .btn{
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
                        <button type="button" class="btn btn-round btn-sm btn-success" data-target="tooltip" data-placement="top">FRC<span class="tooltiptext" style="background-color:#6fd96f;">Franchise</span></button>&nbsp;
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
                                    <form class="step-form-horizontal" id="filter_form" action="javascript:void(0)" enctype="multipart/form-data"  method="post" data-parsley-validate autocomplete="off">
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
                                                <a href="<?php echo base_url(); ?>index.php/mt/approved_form" class="btn btn-success mt-4">Reset</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered zero-configuration ml-2" id="maintanance_team_approve_list">
                                            <thead>
                                                <tr>
                                                    <th>S.NO</th>
                                                    <th>Details</th>
                                                    <th>Name</th> 
                                                    <th>Code</th> 
                                                    <th>Mobile</th>
                                                    <th>Address</th> 
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
                                
                                <?php include('application/views/include/mt_doc_upload.php'); ?>
                                <?php include('application/views/include/post_doc_upload.php'); ?>
                                <?php include('application/views/include/image_view_pop.php'); ?>
                                <?php include('application/views/include/sh_image_view_pop.php'); ?>
 
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

    <script src="<?php echo asset_url();?>new_add/js/detail_pop.js"></script> 
    <script src="<?php echo asset_url();?>new_add/js/mt_doc_approve.js"></script>

    <script src="<?php echo asset_url();?>cdn/jquery-3.5.1.js"></script>
    <script src="<?php echo asset_url();?>cdn/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo asset_url();?>cdn/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo asset_url();?>cdn/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="<?php echo asset_url();?>cdn/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="<?php echo asset_url();?>cdn/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="<?php echo asset_url();?>cdn/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="<?php echo asset_url();?>cdn/buttons/1.7.1/js/buttons.print.min.js"></script>

 
    <script>
        var BASE_URL = "<?php echo base_url();?>index.php/";
		var ASSET_URL = "<?php echo asset_url();?>";

	    $(document).ready(function () {
            var  page="mt_approved_form";

            if(page=="mt_approved_form"){
                $(".mt_approved_form").addClass("active");
            }

		});
		
        $("#rsm").change(function(){
            var rsm=$("#rsm").val();
            $.ajax({  
                type: "POST",
                url: BASE_URL + 'common/get_bdm_b_b',  
                data: {'rsm':rsm,}, 
                dataType: "JSON",

                success: function (data) {

                    var options = '';
                    options +='<option value="">Choose BDM...</option>';
                    for (var i = 0; i < data["bdm"].length; i++) {
                        options += '<option value="' + data["bdm"][i].BDM_name + '">' + data["bdm"][i].BDM_name + '</option>';
                    }
                    $("#bdm").html(options);
                }
            })
        })

		$('#toast-container').delay(5000).fadeOut('slow');	
		$(document).on("click", ".toast-close-button", function (e) {
			$('#toast-container').hide();
		});

	</script>
    
    <?php include('application/views/include/select_2_footer.php'); ?>

</body>

</html>