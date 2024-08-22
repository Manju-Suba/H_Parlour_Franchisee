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
    <link href="<?php echo asset_url(); ?>plugins/bootstrap-multiselect/css/bootstrap-multiselect.css" rel="stylesheet">
    <link href="<?php echo asset_url(); ?>css/style.css" rel="stylesheet">

    <?php include('application/views/include/select_2_head.php'); ?>

    <style>
        /* Extra small devices (phones, 600px and down) */
        @media only screen and (max-width: 600px) {
            .tab.example {
                display: none;
            }

            .tabcontent {
                float: left;
                /* padding: 0px 12px; */
                padding: 0px 20px;
                width: 100%;
                border-left: none;
                height: auto !important;
                background-color: #f4f9fb;
                border-radius: 0px 35px 0px 25px;
                /* border: thick solid #1ea7df; */
            }

            .btn-sty {
                text-align: right;
            }

        }

        @media only screen and (min-width: 600px) and (max-width: 1019px) {
            .tab.example {
                display: none;
            }

            .tabcontent {
                float: left;
                /* padding: 0px 12px; */
                padding: 0px 20px;
                width: 85%;
                border-left: none;
                height: 850px;
                background-color: #f4f9fb;
                border-radius: 0px 35px 0px 25px;
                /* border: thick solid #1ea7df; */
            }

            .btn-sty {
                text-align: right;
            }
        }

        @media only screen and (min-width: 1020px) and (max-width: 1250px) {
            #select_sty .multiselect {
                width: 120px;
                border: 1px solid #dcdddf;
            }

            .tabcontent {
                float: left;
                /* padding: 0px 12px; */
                padding: 0px 20px;
                width: 85%;
                border-left: none;
                height: 850px;
                /* background-color: #dde9ed; */
                background-color: #f4f9fb;
                border-radius: 0px 35px 0px 25px;
                border: thick solid #1ea7df;
            }

            .btn-sty {
                text-align: right;
            }
        }

        @media only screen and (min-width: 1280px) and (max-width: 1300px) {
            #select_sty .multiselect {
                width: 150px;
                border: 1px solid #dcdddf;
            }

            .tabcontent {
                float: left;
                /* padding: 0px 12px; */
                padding: 0px 20px;
                width: 85%;
                border-left: none;
                height: 850px;
                /* background-color: #dde9ed; */
                background-color: #f4f9fb;
                border-radius: 0px 35px 0px 25px;
                border: thick solid #1ea7df;
            }

            .btn-sty {
                text-align: right;
            }
        }


        /* Large devices (laptops/desktops, 992px and up) */
        @media only screen and (min-width: 1300px) {
            .btn-sty {
                text-align: right;
            }

            #select_sty .multiselect {
                width: 175px;
                border: 1px solid #dcdddf;
            }

            /* Style the tab content */
            .tabcontent {
                float: left;
                /* padding: 0px 12px; */
                padding: 0px 20px;
                width: 85%;
                border-left: none;
                height: 850px;
                /* background-color: #dde9ed; */
                background-color: #f4f9fb;
                border-radius: 0px 35px 0px 25px;
                border: thick solid #1ea7df;
            }

        }


        .big_tab {
            max-height: 600px;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        li.multiselect-item .input-group-btn {
            display: none;
        }

        li.multiselect-item input.multiselect-search {
            margin: 0 10px 0 0;
        }

        .multiselect-container>li>a>label {
            padding: 3px 10px 3px 10px;
        }

        ul.multiselect-container {
            overflow-y: scroll;
            overflow-x: hidden;
            height: 250px;
        }

        ul.multiselect-container li input {
            margin: 0 5px 0 0;
        }

        @media (min-width: 320px) and (max-width: 480px) {

            /* CSS */
            .wizard>.steps>ul>li {
                width: auto !important;
            }

            .wizard>.steps>ul {
                overflow-x: scroll;
            }

            #steps-uid-0 section .col-lg-4,
            #steps-uid-0 section .col-lg-2 {
                margin: 0 10px 0 10px;
            }

            .wizard>.actions {}

        }

        * {
            box-sizing: border-box
        }

        body {
            font-family: "Lato", sans-serif;
            color: #265581;
        }

        /* Style the tab */
        .tab {
            float: left;
            /* border: 1px solid #ccc; */
            /* background-color: #f1f1f1; */
            background-color: #d8f4f7;
            width: 15%;
            height: 850px;
        }

        /* Style the buttons inside the tab */
        .tab button {
            display: block;
            /* background-color: inherit;*/
            background-color: #d8f4f7;
            color: black;
            padding: 10px 6px;
            width: 100%;
            border: none;
            outline: none;
            text-align: left;
            cursor: pointer;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #8fe7eb;
        }

        /* Create an active/current "tab button" class */
        .tab button.active {
            background-color: #14b1e5;
            border-radius: 25px 0px 0px 25px;
        }



        .wizard .content>.body .form-control {
            background-color: #F7FAFC;
            border: 1px solid #c9baba;
        }

        .wizard>.steps>ul>li {
            width: 14%;
        }

        /* @media (min-width: 1200px) */
        .wizard>.steps {
            width: 100%;
            margin-left: 0;
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
            Header start
        ***********************************-->
    <div class="nav-header">
        <div class="brand-logo">
            <a href="<?php echo base_url(); ?>index.php/Common/do_logo">
                <b class="logo-abbr"><img src="<?php echo asset_url(); ?>images/logo.png" alt=""> </b>
                <span class="logo-compact"><img src="<?php echo asset_url(); ?>images/logo-compact.png" alt=""></span>
                <span class="brand-title">
                    <img src="<?php echo asset_url(); ?>images/logo-text.png" alt="">
                </span>
            </a>
        </div>
    </div>
    <div class="header">
        <div class="header-content clearfix">
            <div class="nav-control">
                <div class="hamburger">
                    <a type="button" href="<?php echo base_url(); ?>index.php/ct/entered_form" class="btn btn-info "><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>
            <div class="header-left">
                <div class="input-group icons">
                    <div class="input-group-prepend">
                    </div>
                </div>
            </div>
            <div class="header-right">
                <ul class="clearfix">
                    <li class="icons dropdown">
                        <span id='ct7' style="background-color:'';"></span>
                    </li>
                    <li class="icons dropdown">
                        <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                            <span class="activity active"></span>
                            <img src="<?php echo asset_url(); ?>images/user/form-user.png" height="40" width="40" alt="">
                        </div>
                        <div class="drop-down dropdown-profile   dropdown-menu">
                            <div class="dropdown-content-body">
                                <ul>
                                    <li><a href="<?php echo base_url(); ?>index.php/common/change_password"><i class="icon-lock"></i> <span>Change Password</span></a></li>
                                    <li><a href="<?php echo base_url(); ?>index.php/LoginController/logout"><i class="icon-key"></i> <span>Logout</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>



    <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

    <!--**********************************
            Sidebar start
        ***********************************-->
    <!-- <!?php include('application/views/include/sidebar.php'); ?> -->
    <!--**********************************
            Sidebar end
        ***********************************-->

    <!--**********************************
            Content body start
        ***********************************-->
    <!-- <div class="container-fluid"> -->

    <!-- <div class="row page-titles mx-0">
               
            </div> -->
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

    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger ">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color:#fff;">×</button>
            <i class="fa fa-times-circle fa-fw fa-lg"></i>
            <strong></strong><?php echo $error; ?>
        </div>
        <?php $this->session->set_flashdata('error', ''); ?>

    <?php endif; ?>
    <!-- start: alert Message -->

    <br>
    <!-- <!?php  $data = $this->masters_model->get_funneled_row_data($idd); ?> -->
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="card w-100 h-100">
                    <div class="card-body " style="margin-bottom:90px;">
                        <form class="" action="<?php echo base_url('index.php/ct/update_user_information'); ?>" enctype="multipart/form-data" id="" data-parsley-validate method="post" autocomplete="off">
                            <div class="tab example">
                                <button type="button" id="tab1" class="tablinks active" onclick="openTab(event, 'level_of_interest')" id="defaultOpen">&nbsp; Level of Interest</button>
                                <button type="button" id="tab2" class="tablinks" onclick="openTab(event, 'passion')">&nbsp; Passion</button>
                                <button type="button" id="tab3" class="tablinks" onclick="openTab(event, 'after_taking')">&nbsp; After Taking</button>
                                <button type="button" id="tab4" class="tablinks" onclick="openTab(event, 'aspects')">&nbsp; Aspects</button>
                                <button type="button" id="tab5" class="tablinks" onclick="openTab(event, 'business_development')">&nbsp; Business Development</button>
                                <button type="button" id="tab6" class="tablinks" onclick="openTab(event, 'manpower_handling')">&nbsp; Manpower Handling</button>
                                <button type="button" id="tab7" class="tablinks" onclick="openTab(event, 'scenarios')">&nbsp; Scenarios</button>
                            </div>
                            <div id="level_of_interest" class="tabcontent">
                                <br>
                                <h3>Level of Interest</h3>
                                <br>
                                <input type="hidden" name="user_id" id="user_id" value="<?php echo $idd ?>">
                                <h5>Attendees :</h5>
                                <br>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>In person </label><br>
                                            <div id="select_sty">
                                                <select id='attendee_p' name="attendee_p[]" multiple class="form-control">
                                                    <option value="Emp001">Emp001</option>
                                                    <option value="Emp002">Emp002</option>
                                                    <option value="Emp003">Emp003</option>
                                                    <option value="Emp004">Emp004</option>
                                                    <option value="Emp005">Emp005</option>
                                                    <option value="Emp006">Emp006</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Virtual </label><br>
                                            <div id="select_sty">
                                                <select name="attendee_v[]" id="attendee_v" multiple class="form-control">
                                                    <option value="Emp001">Emp001</option>
                                                    <option value="Emp002">Emp002</option>
                                                    <option value="Emp003">Emp003</option>
                                                    <option value="Emp004">Emp004</option>
                                                    <option value="Emp005">Emp005</option>
                                                    <option value="Emp006">Emp006</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="">Images</label>
                                            <input type="file" id="fileupload" multiple="multiple" name="image_name[]" class="form-control" value="">
                                            <div class="validation" style="display:none;"> Upload Max 5 Files allowed </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>a) Who is the reason behind your Entrepreneurship?</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" name="entrepreneur_a" id="entrepreneur_a" rows="3" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>b) Reason for choosing H-Milk Parlour & Bakery :</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" name="entrepreneur_b" id="entrepreneur_b" rows="3" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>c) How did you come to know about brand & opening available ?</label>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" name="entrepreneur_c" id="entrepreneur_c" rows="3" class="form-control"></textarea>

                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>d) Have you tasted any of our products? (Yes/No)</label>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" name="entrepreneur_d" id="entrepreneur_d" rows="3" class="form-control"></textarea>

                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>e) Why H-Milk bakery? </label>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" name="entrepreneur_e" id="entrepreneur_e" rows="3" class="form-control"></textarea>

                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button type="button" class="btn btn-info float-right ml-2 mr-2 tablinks" id="next1" onclick="openTab(event, 'passion')">Next</button>
                            </div>

                            <div id="passion" class="tabcontent" style="display:none;">
                                <br>
                                <h3>Passion</h3>
                                <br>
                                <h5>If he/she </h5>
                                <br>
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <!-- <label for=""><p>If he/she <span style="color:red;">*</span></p> </label> -->
                                            <select name="f_employee" id="f_employee" class="form-control" onchange="myFunction()">
                                                <option value="select" disabled selected>Choose Salaried / Self-employed Person</option>
                                                <option value="Salaried">Salaried</option>
                                                <option value="Self-employed">Self-employed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="salaried">
                                    <h5>If he/she a salaried employee: </h5>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>a) What are you currently doing?</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="passion_a" id="passion_a" rows="2" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>b) How much do you earn? (month)</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="number" name="passion_b" id="passion_b" rows="2" class="form-control">

                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>c) Do you think it is worth to forgo the salary for this business?</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="passion_c" id="passion_c" rows="2" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="business">
                                    <h5>If it is business: </h5>
                                    <br>
                                    <div class="row">

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>a) How much are you earning?</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="passion_d" id="passion_d" rows="2" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>b) What is the Investment?</label>

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="passion_e" id="passion_e" rows="2" class="form-control"></textarea>

                                            </div>
                                        </div>



                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>c) How much time you spend in this business?</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="passion_f" id="passion_f" rows="2" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>d) When did you hit Breakeven?</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="passion_g" id="passion_g" rows="2" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-sty">
                                    <button type="button" class="btn btn-secondary" id="preview1" onclick="openTab(event, 'level_of_interest')">Preview</button>
                                    <button type="button" class="btn btn-info tablinks" id="next2" onclick="openTab(event, 'after_taking')">Next</button>
                                </div>
                            </div>

                            <div id="after_taking" class="tabcontent" style="display:none;">
                                <br>
                                <h3>After Taking</h3>
                                <br>
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>a) How much time will you be spending in Parlour?</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" name="takeover_a" id="takeover_a" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>b) What do you mean by Breakeven?</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" name="takeover_b" id="takeover_b" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>c) When do you expect Breakeven? (In months)</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="number" name="takeover_c" id="takeover_c" rows="2" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>d) Do you have money backup for 6months?</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <select name="takeover_d" id="takeover_d" class="form-control">
                                                <option value="select" disabled selected>Choose ..</option>
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>e) What is your ROI expectation? (In percentage) </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="number" name="takeover_e" id="takeover_e" min="0" max="100" class="form-control" placeholder="put in percentage ">
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-sty">
                                    <button type="button" class="btn btn-secondary" id="preview2" onclick="openTab(event, 'passion')">Preview</button>
                                    <button type="button" class="btn btn-info tablinks" id="next3" onclick="openTab(event, 'aspects')">Next</button>
                                </div>
                            </div>

                            <div id="aspects" class="tabcontent" style="display:none;">
                                <br>
                                <h3>Aspects</h3>
                                <h5><u>Net Worth Statement :</u></h5>
                                <br>
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>a. i) Total Assets </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="networth_a" id="networth_a" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>a. ii) Details of the asset (Remarks) </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" name="networth_aa" id="networth_aa" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>b. i) Total Liabilities </label>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="networth_b" id="networth_b" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>b. ii) Remarks </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" name="networth_bb" id="networth_bb" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>c) Net Worth (Total Assets-Total Liabilities)</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="networth_c" id="networth_c" class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <br>
                                <h5><u>Financial Aspects :</u></h5>
                                <br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h6>Mode of Investment : </h6>
                                    </div>
                                    <div class="row ml-3">
                                        <input type="radio" id="investment" name="investment" value="loan">&nbsp;
                                        <label>Loan </label><br>&nbsp;&nbsp;&nbsp;
                                        <input type="radio" id="investment2" name="investment" value="Own Fund">&nbsp;
                                        <label>Own Fund </label><br>&nbsp;
                                    </div>
                                    <br>
                                </div>
                                <div id="loan_type" class="row">
                                    <div class="col-lg-6">
                                        <label>Loan Type : </label>
                                    </div>
                                    <div class="row ml-3">
                                        <input type="radio" id="loan_type1" name="loan_type" value="Full Loan">&nbsp;
                                        <label>Full Loan </label><br>&nbsp;&nbsp;&nbsp;
                                        <input type="radio" id="loan_type2" name="loan_type" value="Partial Loan">&nbsp;
                                        <label>Partial Loan </label><br>&nbsp;
                                    </div>
                                </div>
                                <div id="investment_mood" class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>* Investment from Hand:</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="investment_a" id="investment_a" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-12"> -->
                                <div id="invest_bank" class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>* Loan from Bank:</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="investment_b" id="investment_b" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>* Bank Name:</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" name="investment_c" id="investment_c" rows="1" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- </div> -->
                                <!-- </div> -->
                                <div class="btn-sty">
                                    <button type="button" class="btn btn-secondary" id="preview3" onclick="openTab(event, 'after_taking')">Preview</button>
                                    <button type="button" class="btn btn-info tablinks" id="next4" onclick="openTab(event, 'business_development')">Next</button>
                                </div>
                            </div>

                            <div id="business_development" class="tabcontent" style="display:none;">
                                <br>
                                <h3>Business Devlopment</h3>
                                <br>
                                <h5>Scenarios : </h5>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>a) If for the first month store does only 3K ADS and Milk sales less than 100 LPD , and your loosing 15K a month. What will be your Action plan? </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" name="scenarios_to_a" id="scenarios_to_a" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>b) After the above efforts in case of non-Improvement for 3 months, store does only 3K ADS and Milk 100 LPD , and your loosing 15K a month adding up to 50k. What will be your Action plan?</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" name="scenarios_to_b" id="scenarios_to_b" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h5>Business Development : </h5>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>a) What will be your Morning Routine?</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" name="busi_dev_a" id="busi_dev_a" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>b) Are you a Localite?</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" name="busi_dev_b" id="busi_dev_b" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>c) What is your plan for outside store business in Trade area?.</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" name="busi_dev_c" id="busi_dev_c" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>d) How many customers will you speak to in a day?</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="busi_dev_d" id="busi_dev_d" rows="2" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-sty">
                                    <button type="button" class="btn btn-secondary" id="preview4" onclick="openTab(event, 'aspects')">Preview</button>
                                    <button type="button" class="btn btn-info tablinks" id="next5" onclick="openTab(event, 'manpower_handling')">Next</button>
                                </div>
                            </div>

                            <div id="manpower_handling" class="tabcontent" style="display:none;">
                                <br>
                                <h3>Manpower Handling</h3>
                                <br>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>a) Do you have any experience in managing team?</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <div class="row ml-1">
                                                <input type="radio" id="experience" name="experience" value="Yes">&nbsp;
                                                <label>Yes</label><br>&nbsp;&nbsp;&nbsp;
                                                <input type="radio" id="experience2" name="experience" value="No">&nbsp;
                                                <label>No</label><br>&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <label>Remark :</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <textarea type="text" name="manpower_a" id="manpower_a" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>b) Do you have any experience in handling dairy products ?</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <div class="row ml-1">
                                                <input type="radio" id="dairy" name="dairy" value="Yes">&nbsp;
                                                <label>Yes</label><br>&nbsp;&nbsp;&nbsp;
                                                <input type="radio" id="dairy2" name="dairy" value="No">&nbsp;
                                                <label>No</label><br>&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-group">
                                            <label>Remark : </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <textarea type="text" name="manpower_b" id="manpower_b" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>c) What is the salary level at which you handled a team?</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="manpower_c" id="manpower_c" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>d) How do you keep them motivated?</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" name="manpower_d" id="manpower_d" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>e) How many members in your team have you maintained with 1 year attrition?</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <textarea type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="manpower_e" id="manpower_e" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-sty">
                                    <button type="button" class="btn btn-secondary" id="preview5" onclick="openTab(event, 'business_development')">Preview</button>
                                    <button type="button" class="btn btn-info tablinks" id="next6" onclick="openTab(event, 'scenarios')">Next</button>
                                </div>
                            </div>

                            <div id="scenarios" class="tabcontent" style="display:none;">
                                <br>
                                <h3>Scenarios</h3>
                                <br>
                                <div class="big_tab">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>a) Morning your delivery boy calls and tell Leave and Milk needs to supply before 7 am ? What will be your action?</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="scenarios_a" id="scenarios_a" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>b) If you have a vehicle problem at the time of delivery ? what you will do ? </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="scenarios_b" id="scenarios_b" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>c) Are you approachable?</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="scenarios_c" id="scenarios_c" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>d) Since handling milk you should be available 24/7 & 365 .How will you manage?</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="scenarios_d" id="scenarios_d" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>e) What if your team member approaches you with a problem?</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="scenarios_e" id="scenarios_e" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>f) What will you do when the products expired?</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="scenarios_f" id="scenarios_f" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>g) What will you do when there is a power shut down in the outlet?</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="scenarios_g" id="scenarios_g" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>h) When you have 10k worth products with 1day shelf life, and if you throw this away you won't Have money to pay the staff? How will you react? </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="scenarios_h" id="scenarios_h" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>i) If you have personal issue with a retailer but he is High volume outlets do you supply our products to him or ignore ? </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="scenarios_i" id="scenarios_i" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>j) You are getting 5k worth special order from your regular customer, and delivery to be on the same day,But you don’t have enough Stocks with you. What will you do?</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="scenarios_j" id="scenarios_j" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>k) If your friend having shop in another area asking you to supply milk & milk products .what will you do?</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="scenarios_k" id="scenarios_k" class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>l) Retailer is giving 2nd order for 2 Lit of milk and he is 8km away from your parlour do you supply or ignore?</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="scenarios_l" id="scenarios_l" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>m) If you have an emergency or important function to attend .how will you manage the stock supply and business at that point of time. </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="scenarios_m" id="scenarios_m" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>n) If nearby 1 (or) 2 house hold is asking to do doorstep supply how you will manage?</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="scenarios_n" id="scenarios_n" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>o) If company vehicle is delayed regularly you complaint to the company staff but you’re not getting proper response how will you handle? </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="scenarios_o" id="scenarios_o" rows="2" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>p) If you’re getting repeated spoilage / wastage from the retailers/ Counter how will you handle? </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="scenarios_p" id="scenarios_p" rows="2" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <h5>Cluster Remark:</h5>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <textarea type="text" name="ct_remark_q" id="ct_remark_q" rows="2" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <input type="hidden" id="save_status" name="save_status" value="0">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4"></div>

                                            <div class="col-md-4"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="mt-5" style="text-align:center;">
                                    <button type="button" id="save_form" class="btn mb-1 btn-info"><b>Save</b></button>
                                    <button type="submit" id="form_submit_btn" class="btn mb-1 btn-success"><b>Submit</b></button>
                                </div>
                                <br>
                                <button type="button" class="btn btn-secondary float-right mr-2 ml-2 mt-2" id="preview6" onclick="openTab(event, 'manpower_handling')">Preview</button>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>









    <!-- #/ container -->
    <!-- </div> -->
    <!--**********************************
            Content body end
        ***********************************-->


    <!--**********************************
            Footer start
        ***********************************-->
    <!-- <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="http://hemas.in/">Hemas.in</a> 2018</p>
            </div>
        </div> -->
    <!--**********************************
            Footer end
        ***********************************-->
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
    <script src="<?php echo asset_url(); ?>plugins/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>

    <!-- Toastr -->
    <script src="<?php echo asset_url(); ?>plugins/toastr/js/toastr.min.js"></script>
    <script src="<?php echo asset_url(); ?>plugins/toastr/js/toastr.init.js"></script>

    <!-- added new -->
    <script src="<?php echo asset_url(); ?>new_add/js/franchisee_form.js"></script>
    <!-- <script src="<?php echo asset_url(); ?>new_add/js/total_count_tso.js"></script> -->
    <!-- <script src="<?php echo asset_url(); ?>new_add/js/ss_code_check.js"></script> -->

    <?php include('application/views/include/select_2_footer.php'); ?>



    <script>
        var BASE_URL = "<?php echo base_url(); ?>index.php/";
        var ASSET_URL = "<?php echo asset_url(); ?>";

        // function myFFunction() {
        //     var x = document.getElementById("proof").value;
        //     // alert(x);
        //     document.getElementById("demo").innerHTML = x;
        //     document.getElementById("demo1").innerHTML = x;
        // }

        function mobileValid() {
            var textInput = document.getElementById("mobile").value;
            textInput = textInput.replace(/[^0-9]/g, "");
            document.getElementById("mobile").value = textInput;
        }

        function mobileValid_2() {
            var textInput = document.getElementById("whatsapp_no").value;
            textInput = textInput.replace(/[^0-9]/g, "");
            document.getElementById("whatsapp_no").value = textInput;
        }



        //window.onbeforeunload = function(){
        // return 'Are you sure you want to leave?';
        //};
        $('#step-form-horizontal').data('serialize', $('#step-form-horizontal').serialize()); // On load save form current state

        $(window).bind('beforeunload', function(e) {
            if ($('#step-form-horizontal').serialize() != $('#step-form-horizontal').data('serialize')) return true;
            else e = null; // i.e; if form state change show warning box, else don't show it.

        });

        $(document).on("submit", "form", function(event) {
            // disable warning
            $(window).off('beforeunload');
        });


        $('.toast-success').delay(5000).fadeOut('slow');


        $(document).ready(function() {

            $("#next1").click(function() {
                $("#tab2").addClass('active');
            })
            $("#next2").click(function() {
                $("#tab3").addClass('active');
            })
            $("#next3").click(function() {
                $("#tab4").addClass('active');
            })
            $("#next4").click(function() {
                $("#tab5").addClass('active');
            })
            $("#next5").click(function() {
                $("#tab6").addClass('active');
            })
            $("#next6").click(function() {
                $("#tab7").addClass('active');
            })

            // for(var i=1;i<7;i++){
            //     $("#preview"+i).click(function(){
            //     $("#tab"+i).addClass('active');
            // })
            // }


            $("#preview1").click(function() {
                $("#tab1").addClass('active');
            })
            $("#preview2").click(function() {
                $("#tab2").addClass('active');
            })
            $("#preview3").click(function() {
                $("#tab3").addClass('active');
            })
            $("#preview4").click(function() {
                $("#tab4").addClass('active');
            })
            $("#preview5").click(function() {
                $("#tab5").addClass('active');
            })
            $("#preview6").click(function() {
                $("#tab6").addClass('active');
            })

            var page = "ct_insertion_form";

            if (page == "ct_insertion_form") {
                $(".ct_insertion_form").addClass("active");
            }

            $('#business').hide();
            $('#salaried').hide();
            $('#investment_mood').hide();
            $('#loan_type').hide();
            $("#invest_bank").hide();

            $('#investment').click(function() {
                if ($('#investment').is(':checked')) {
                    // alert('Checked');
                    $("#invest_bank").hide();
                    $('#loan_type').show();
                    $('#investment_mood').hide();
                }
            })
            $('#investment2').click(function() {
                if ($('#investment2').is(':checked')) {
                    // alert('Unchecked');
                    $('#investment_mood').show();
                    $("#invest_bank").hide();
                    $('#loan_type').hide();

                }
            })

            $('#loan_type1').click(function() {
                if ($('#loan_type1').is(':checked')) {
                    $('#investment_mood').hide();
                    $("#invest_bank").show();
                }
            })

            $('#loan_type2').click(function() {
                if ($('#loan_type2').is(':checked')) {
                    $('#investment_mood').show();
                    $("#invest_bank").show();
                }
            })

            $('#attendee_p').multiselect({
                nonSelectedText: 'Select Attendee',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                // buttonWidth:'155px'
                buttonWidth: 'auto'
            });

            $('#attendee_v').multiselect({
                nonSelectedText: 'Select Attendee',
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                buttonWidth: 'auto'
            });

        });

        function myFunction() {
            var emp = $('#f_employee').val();

            if (emp == "Salaried") {

                $('#salaried').show();
                $('#business').hide();
            } else {
                $('#salaried').hide();
                $('#business').show();
            }
        }

        function openTab(evt, tabname) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabname).style.display = "block";
            evt.currentTarget.className += " active";
        }

        // Get the element with id="defaultOpen" and click on it
        // document.getElementById("defaultOpen").click();
    </script>
</body>

</html>