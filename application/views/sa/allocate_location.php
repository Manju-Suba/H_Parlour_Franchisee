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
            padding: 0 0 1.88rem 0;
            border-radius: 0px 0px 0px 0px;
            border: thin solid #8b97e7;
        }

        body {font-family: Arial;}

        /* Style the tab */
        .tab {
        overflow: hidden;
        /* border: 1px solid #ccc; */
        background-color:#e7e8ef7a;
        }

        /* Style the buttons inside the tab */
        .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color:#8b97e7;
        
        }

        #overall_card{
            border-radius: 0px 0px 0px 0px;
            border: thin solid #5162d9;
        }

        /* .tabcontent {
            float: left; 
            padding: 0px 20px;
            width: 100%;
            border-left: none;
            height: 500px;
            background-color: #f4f9fb;
            border-radius: 0px 0px 0px 0px;
            border: thick solid #5162d9;
        } */

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
            <?php if (!empty($message)) : ?>
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
                        <div class="card" id="overall_card">
                           
                                <div class="tab">
                                    <button class="tablinks active" onclick="openTab(event, 'f_locations')">Free Locations</button>
                                    <button class="tablinks" onclick="openTab(event, 'a_locations')">Allocated Locations</button>
                                </div>

                                <div id="f_locations" class="tabcontent" style="display:block;">
                                <div class="card-body">
                                    <br>
                                    <h3 class="ml-4">Free Locations</h3>
                                    <table id="free_location" class="table table-striped table-bordered zero-configuration" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>State</th>
                                                <th>City</th>
                                                <th>Town</th>
                                                <th>Area</th>
                                                <th>C_Shopname</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                </div>

                                <div id="a_locations" class="tabcontent" style="display:none;">
                                <div class="card-body">

                                    <br>
                                    <h3 class="ml-4">Allocated Locations</h3>
                                    <table id="allocated_location" class="table table-striped table-bordered zero-configuration" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>State</th> 
                                                <th>City</th>
                                                <th>Town</th>
                                                <th>Area</th>
                                                <th>C_Shopname</th>
                                                <th>Address</th>
                                                <th>Allocated Person</th>
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
            </div>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog ">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Allocate Real Estate Person</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form id="rep_allocate_form" action="javascript:void(0);" enctype="multipart/form-data" method="post" autocomplete="off">
                                <input type="hidden" name="allocate_location_id" id="allocate_location_id">
                                
                                <!-- <h4 class="ml-3" id="c_name"> </h4> -->
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <h5>Choose Real Estate Person</h5>
                                                            
                                        <select id="rep_choosen" name="rep_choosen" class="form-control" required>
                                            <option value="" selected disabled>Select..</option>
                                            <option value="REP001">REAL ESTATE PERSON 1</option>
                                            <option value="REP002">REAL ESTATE PERSON 2</option>
                                            <option value="REP003">REAL ESTATE PERSON 3</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <button type="submit" name="" id="submit_pop" class="btn mb-1 btn-success" style="float: right;">Submit</button>

                                <p id="form_resp" style="display:none;"></p>
                            </form>

                        </div>
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

    <script src="<?php echo asset_url(); ?>plugins/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/plugins-init/jquery-steps-init.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="<?php echo asset_url(); ?>new_add/js/allocate_location.js"></script>
    <script src="<?php echo asset_url(); ?>new_add/js/location_count_sh.js"></script>


    <script src="<?php echo asset_url(); ?>plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
    <script>
        var BASE_URL = "<?php echo base_url(); ?>index.php/";
        var ASSET_URL = "<?php echo asset_url(); ?>";

        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
        
    </script>
    <?php include('application/views/include/select_2_footer.php'); ?>


</body>

</html>