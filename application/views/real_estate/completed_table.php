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
            .card .card-body {   
                padding:0 0 1.88rem 0;
            }

            #even {
                border-radius: 15px 15px;
                background: #e93366b8;
            } 

            #mor{
                border-radius: 15px 15px;
                background: #23bb9ef7;
            }

            #aft{
                border-radius: 15px 15px;
                background: #0899df;
            }

            .row {
                margin-right: -15px;
                margin-left: -5px;
            }

            .img-thumbnail {
                max-width: 80%;
                height: 200px;
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
                                    <form class="step-form-horizontal p-4" action="javascript:void(0)" enctype="multipart/form-data" id=""   data-parsley-validate method="post" autocomplete="off"> 
                                        <div>
                                            <h4 >Completed Locations</h4>
                                            <section>
                                                <div class="table-responsive" >
                                                    <table id="completed_location" class="table table-striped table-bordered zero-configuration">
                                                        <thead>
                                                            <tr>
                                                                <th>S.No</th> 
                                                                <th>State</th>
                                                                <th>City</th>
                                                                <th>Town</th>
                                                                <th>Area</th>
                                                                <th>C_Shopname</th>
                                                                <th>Address</th>
                                                                <th>Place Review</th>
                                                                <th>Reviewed Date</th>
                                                                <th>Image</th>
                                                                <!-- <th>Action</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                    
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </section>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              

                <!-- The Modal -->
                <div class="modal" id="myModal">
                    <div class="modal-dialog ">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Approval For This Location</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form id="pop_rej_ap_form" action="javascript:void(0);" enctype="multipart/form-data" method="post" autocomplete="off">	
                                    <input type="hidden" name="id" id="id" class="form-control" value="">
                                    <input type="hidden" name="app_reg_id" id="app_reg_id" class="form-control" value="">
                                    <input type="hidden" id="type" name="type">
                                    <button type="button" name="approval" id="app_btn" class="btn mb-1 btn-success">Approval For This Location</button>
                                    <button type="button" name="reject" id="rej_btn" class="btn mb-1 btn-danger">Hold (Future Prospects)</button>

                                    <div class="form_hid_action_doc" style="display:none;"> 
                                    </div>

                                    <div class="form_hid_action" style="display:none;"> 
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="Department">Remarks</label>
                                            <div class="col-md-12">
                                                <textarea name="remarks" id="remarks" class="form-control"></textarea>
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
                <div class="modal" id="myModalview">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content"> 
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Place Review Image</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <br>
                                <div class="row">
                                    <div class="col-4 ">
                                        <h5>Morning View Img/Doc</h5>
                                        <div class="morn_imgs"></div>
                                    </div>
                                    <div class="col-4">
                                        <h5>Afternoon View Img/Doc</h5>
                                        <div class="after_imgs"></div>
                                    </div>
                                    <div class="col-4 ">
                                        <h5>Evening View Img/Doc</h5>
                                        <div class="even_imgs"></div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                        </div>
                    </div>
                </div>
                                        
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="<?php echo asset_url();?>new_add/js/completed_location_rep.js"></script>
        

        <script src="<?php echo asset_url(); ?>plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
        <script>
            var BASE_URL = "<?php echo base_url();?>index.php/"; 
		    var ASSET_URL = "<?php echo asset_url();?>";
            $(document).ready(function () {
                var  page="completed_table";

                if(page=="completed_table"){
                    $(".completed_table").addClass("active");
                }
            }); 
          


	    </script>
        <script>
            $(".low_to_upper_case").keyup(function(){
                $(this).val($(this).val().toUpperCase());
            })
           
        </script>
        <?php include('application/views/include/select_2_footer.php'); ?>


    </body>

</html>