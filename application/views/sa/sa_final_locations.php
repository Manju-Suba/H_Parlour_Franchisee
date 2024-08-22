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

            table.dataTable thead>tr>th.sorting_asc#plr, table.dataTable thead>tr>th.sorting_desc#plr, table.dataTable thead>tr>th.sorting#plr, table.dataTable thead>tr>td.sorting_asc#plr, table.dataTable thead>tr>td.sorting_desc#plr, table.dataTable thead>tr>td.sorting#plr {
                padding-right: 65px;
            }

            .img-thumbnail {
                max-width: 80%;
                height: 200px;
            }
            
            .btn-danger {
                color: #100c0c;
                /* background-color: #ff5e5e; */
                /* border-color: #ff5e5e; */
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
                                            <h4 >Doc Uploaded Locations</h4>
                                            <section>
                                                <div class="table-responsive" >
                                                    <table id="sa_final_location" class="table table-striped table-bordered zero-configuration">
                                                        <thead>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>State</th>
                                                                <th>City</th> 
                                                                <th>Town</th>
                                                                <th>Area</th>
                                                                <th>C_Shopname</th>
                                                                <th>Address</th>
                                                                <th id="plr">Place Review</th>
                                                                <th>Reviewed Date</th>
                                                                <th>Image</th>
                                                                <th>SA_Doc View</th>
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
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">SA Uploaded Documents</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                            <form id="upload_doc_form" action="javascript:void(0);" enctype="multipart/form-data" method="post" autocomplete="off">	
                                <input type="hidden" name="doc_id" id="doc_id" class="form-control" value="">
                                <input type="hidden" id="type" name="type">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for=""><b>MOM </b></label>
                                            <div class="ml-2" id="doc_1_img"></div>
                                            <input type="file" name="doc_1" id="doc_1" class="form-control">
                                            
                                        </div>
                                    </div> 
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for=""><b>Doc 2</b></label>
                                            <div class="ml-2" id="doc_2_img"></div>
                                            <input type="file" name="doc_2" id="doc_2" class="form-control">
                                            
                                        </div>
                                    </div> 
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for=""><b>Doc 3</b></label>
                                            <div class="ml-2" id="doc_3_img"></div>
                                            <input type="file" name="doc_3" id="doc_3" class="form-control">
                                            
                                        </div>
                                    </div> 
                                </div>
                                <button type="submit" name="" id="submit_pop" class="btn mb-1 btn-success" style="float: right;">Upload</button>

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
        <script src="<?php echo asset_url(); ?>new_add/js/location_table_sa.js"></script>
        <script src="<?php echo asset_url(); ?>new_add/js/location_count_sh.js"></script>
 
        <script src="<?php echo asset_url(); ?>plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
        <script>
            var BASE_URL = "<?php echo base_url();?>index.php/"; 
		    var ASSET_URL = "<?php echo asset_url();?>";
        </script>
        <?php include('application/views/include/select_2_footer.php'); ?>


    </body>

</html>