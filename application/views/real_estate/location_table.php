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
            /*.nav-header .brand-logo a{ padding:0;}
            .nav-header .brand-logo a b img{ max-width:100%;}
            [data-sidebar-style="full"][data-layout="vertical"] .menu-toggle .nav-header .brand-logo a{ padding:0;}
            [data-nav-headerbg="color_1"] .nav-header{background-color:#fff;}
            .wizard > .steps > ul > li{ width:30%;}
            .wizard .content{ min-height:500px !important;}*/
            .card .card-body {    padding:0 0 1.88rem 0;}
            

            #even {
                border-radius: 15px 15px;
                background: #e93366b8;
                /* padding: 20px;  */
                /* width: 200px; */
                /* height: 150px;  */
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
                                            <h4 >Locations</h4>
                                            <section>
                                                <div class="table-responsive" >
                                                    <table id="location_table" class="table table-striped table-bordered zero-configuration">
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
                                                                <th>Action</th>
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
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Place Review</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-3"><b>State </b><span class="float-right">:</span></div>
                                            <div class="col-md-9" id="state"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><b>City  </b><span class="float-right">:</span></div>
                                            <div class="col-md-9" id="city"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"><b>Town </b><span class="float-right">:</span></div>
                                            <div class="col-md-9" id="town"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4"><b>Shop Name </b><span class="float-right">:</span></div>
                                            <div class="col-md-8" id="c_shopname"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4"><b>Address </b><span class="float-right">:</span></div>
                                            <div class="col-md-8" id="address"></div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <form role="form" id="edit_location_review_form" action="javascript:void(0)"  class="ajax-form" method="POST" >
                                    <input type="hidden" id="edit_id"  name="edit_id" >

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Morning </label>
                                                <input type="text"  id="morning" name="morning" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Afternoon </label>
                                                <input type="text"  id="afternoon" name="afternoon" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" placeholder="">
                                            </div>
                                            <div id="after_error"></div>&nbsp;

                                        </div>  
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Evening </label>
                                                <input type="text"  id="evening" name="evening" class="form-control" placeholder="">
                                            </div>
                                            <span class="text-danger font-weight-bold" id="even_error"></span>&nbsp;

                                        </div>  
                                        <div class="col-lg-4" id="morn_pri" hidden="true">
                                            <div class="form-group">
                                                <label for="">Morning View Upload  </label>
                                                <div id="morn_img"></div>
                                                <input type="file" name="morn_review_image" id="morn_review_image" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">
                                                
                                            </div>
                                        </div> 
                                        <div class="col-lg-4" id="after_pri" hidden="true">
                                            <div class="form-group">
                                                <label for="">Afternoon View Upload  </label>
                                                <div id="after_img"></div>
                                                <input type="file" name="after_review_image" id="after_review_image" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">
                                            </div>
                                        </div>  
                                        <div class="col-lg-4" id="even_pri" hidden="true">
                                            <div class="form-group">
                                                <label for="">Evening View Upload  </label>
                                                <div id="even_img"></div>
                                                <input type="file" name="even_review_image" id="even_review_image" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">
                                            </div>
                                        </div>     
                                    </div>  
                                   
                                    <div class="modal-footer">
                                       
                                        <div  id="update"></div>&nbsp;
                                        <button class="btn btn-primary" type="submit" id="update_location">Update</button>
                                       
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                                        
                    <?php include('application/views/include/image_view_pop.php'); ?>
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
        <script src="<?php echo asset_url();?>new_add/js/location_table_rep.js"></script>
        <script src="<?php echo asset_url();?>new_add/js/completed_location_rep.js"></script>
        
 
        <script src="<?php echo asset_url(); ?>plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo asset_url(); ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
        <script>
            var BASE_URL = "<?php echo base_url();?>index.php/"; 
		    var ASSET_URL = "<?php echo asset_url();?>"; 

            $(".low_to_upper_case").keyup(function(){
                $(this).val($(this).val().toUpperCase());
            })

            $("#evening").on("keyup",function(e){
                even = $('#evening').val();
                if(even !=""){
                    $("#even_pri").attr('hidden',false);
                }else{
                    $("#even_pri").attr('hidden', true);
                }
            });


            $("#afternoon").on("keyup",function(e){
                aft = $('#afternoon').val();
                if(aft !=""){
                    $("#after_pri").attr('hidden',false);
                    $("#evening").prop('disabled', false);
                }else{
                    $("#evening").prop('disabled', true);
                }

            });

            $('#morning').on("keyup",function(e){
                mor = $('#morning').val();
                if(mor !=""){
                    $("#morn_pri").attr('hidden',false);
                    $("#afternoon").prop('disabled', false);
                    $("#evening").prop('disabled', true);
                }else{
                    $("#afternoon").prop('disabled', true);
                    $("#evening").prop('disabled', true);
                }
            })

           
           
        </script>
        <?php include('application/views/include/select_2_footer.php'); ?>


    </body>

</html>