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



            <div class="container">
                <div class="row">
                    <!-- <div class="col-md-1 col-xs-12"></div> -->
                    <div class="col-md-5 col-xs-12">
                        <a href="completed_location ">
                            <div class="card w-100">
                                <div class="card-body mt-3 mb-3">
                                    <div class="col-xs-4 col-md-4">
                                        <img src="<?php echo asset_url(); ?>images/location.jpg" alt="" class="img-thumbnail" width="90" height="60">
                                    </div>
                                    <div class="col-xs-6 col-md-6" style="margin-left:110px;margin-top:-55px">
                                        <h5 class="card-title " style="font-size:30px">Real Estate</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-5 col-xs-12">
                        <a href="entered_form ">
                            <div class="card w-100">
                                <div class="card-body mt-3 mb-3">
                                    <div class="col-xs-4 col-md-4">
                                        <img src="<?php echo asset_url(); ?>images/franchise.jpg" alt="" class="img-thumbnail" width="90" height="60">
                                    </div>
                                    <div class="col-xs-6 col-md-6" style="margin-left:110px;margin-top:-55px">
                                        <h5 class="card-title " style="font-size:30px">Franchisee</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-1 col-xs-12"></div>
                </div>
            </div>

            <!-- <!?php include('application/views/include/sh_form_action_pop.php'); ?> -->
            <!-- <!?php include('application/views/include/image_view_pop.php'); ?> -->
            <!-- <!?php include('application/views/include/entered_form_ccpop.php'); ?> -->

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

    <script src="<?php echo asset_url(); ?>new_add/js/sh_pop_app_rej.js"></script>
    <script src="<?php echo asset_url(); ?>new_add/js/detail_pop.js"></script>
    <script src="<?php echo asset_url();?>new_add/js/total_count_sh.js"></script>

    <script src="<?php echo asset_url(); ?>plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>


    <script>
        var BASE_URL = "<?php echo base_url(); ?>index.php/";
        var ASSET_URL = "<?php echo asset_url(); ?>";

        $(document).ready(function() {
            var page = "entered_form";

            if (page == "entered_form") {
                $(".entered_form").addClass("active");
            }

        });


        $('#toast-container').delay(5000).fadeOut('slow');
        $(document).on("click", ".toast-close-button", function(e) {
            $('#toast-container').hide();
        });
    </script>
    <script>
        $(".low_to_upper_case").keyup(function() {
            $(this).val($(this).val().toUpperCase());
        })
    </script>
    <?php include('application/views/include/select_2_footer.php'); ?>


</body>

</html>