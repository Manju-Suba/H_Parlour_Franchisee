<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>H-PARLOUR FRANCHISEE</title>

        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo asset_url(); ?>images/logo.png">
        <!-- Custom Stylesheet -->
        <link href="<?php echo asset_url(); ?>plugins/toastr/css/toastr.min.css" rel="stylesheet">
        <link href="<?php echo asset_url(); ?>plugins/jquery-steps/css/jquery.steps.css" rel="stylesheet">
        <link href="<?php echo asset_url(); ?>plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="<?php echo asset_url(); ?>css/style.css" rel="stylesheet">
 
        <?php include('application/views/include/select_2_head.php'); ?>
        <style>
          
            .card .card-body {    padding:0 0 1.88rem 0;}

           
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
            <?php include('application/views/include/location_menu.php'); ?>
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



                <div class="container-fluid"> 
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="card">
                                <div class="card-body">
                                    <form class="step-form-horizontal p-4" action="javascript:void(0)" enctype="multipart/form-data" id="add_location_form"   data-parsley-validate method="post" autocomplete="off"> 
                                        <div>
                                            <h4>Add Location</h4>
                                            <section>
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">State <span style="color:red;">*</span></label>
                                                            <select required class="form-control" name="state" id="state">
                                                                <option  value="">Choose State</option>
                                                                <?php foreach($states as $state){ ?>
                                                                    <option value="<?php echo $state->id; ?>"><?php echo $state->name; ?></option>';
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">City <span style="color:red;">*</span></label>
                                                            <select required class="form-control" name="city" id="city">
                                                                <option value="">Choose City</option>
                                                               
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">Town <span style="color:red;">*</span></label>
                                                            <select required class="form-control" name="town" id="town">
                                                                <option value="">Choose Town</option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">Area <span style="color:red;">*</span></label>
                                                            <input type="text" required id="area" name="area" class="form-control" placeholder="Enter Area">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">C_Shopname <span style="color:red;">*</span></label>
                                                            <input type="text" id="c_shopname" required name="c_shopname" class="form-control" placeholder="Enter C_Shopname">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label for="">Address <span style="color:red;">*</span></label>
                                                            <textarea  id="address" name="address" required class="form-control" placeholder="Enter Address"></textarea>
                                                        </div>
                                                    </div>
                                                    <button class="ml-3 btn btn-primary" id="save_location">Save</button>&nbsp;<span class="text-success font-weight-bold" id="insert"></span>
                                                </div>
                                            </section>
                                        </div>
                                    </form>
                                </div>
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
        <script src="<?php echo asset_url(); ?>plugins/common/common.min.js"></script>
        <script src="<?php echo asset_url(); ?>js/custom.min.js"></script>
        <script src="<?php echo asset_url(); ?>js/settings.js"></script>
        <script src="<?php echo asset_url(); ?>js/gleek.js"></script>
        <script src="<?php echo asset_url(); ?>js/styleSwitcher.js"></script> 
        
        <script src="<?php echo asset_url();?>plugins/jquery-steps/build/jquery.steps.min.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="<?php echo asset_url();?>js/plugins-init/jquery-steps-init.js"></script>

        <script src="<?php echo asset_url();?>new_add/js/add_location.js"></script> 
        <script src="<?php echo asset_url(); ?>new_add/js/location_count_sh.js"></script>

        <script src="<?php echo asset_url(); ?>plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>


        <script>
            var BASE_URL = "<?php echo base_url();?>index.php/"; 
		    var ASSET_URL = "<?php echo asset_url();?>";

          


	    </script>
        <script>
            $(".low_to_upper_case").keyup(function(){
                $(this).val($(this).val().toUpperCase());
            })

        </script>
        <?php include('application/views/include/select_2_footer.php'); ?>


    </body>

</html>