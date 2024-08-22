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
    <!-- <link href="<?php echo asset_url();?>plugins/jqueryui/css/jquery-ui.min.css" rel="stylesheet"> -->
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- bar --- link -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
		
        .ui-datepicker.ui-widget.ui-widget-content.ui-helper-clearfix.ui-corner-all{
            width: auto;
        }
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

        .small {
            font-variant: small-caps;
            font-size:20px;
        }

        *, *::before, *::after {
            box-sizing: border-box;
        }

        body { 
            padding: 0;
            margin: 0;
        }

        .progress-bar {
            position: relative;
            width: 500px;
            height: 2em;
            border-radius: 1.5em;
            color: #080707;
            border-right: 1px solid white;
            border: 1px solid black;
            /* font-size:100%; */
        }

        .progress-bar::before {
            display: flex;
            align-items: center;
            position: absolute;
            left: .5em;
            top: .5em;
            bottom: .5em;
            background-color: #069;
            border-radius: 1em;
            padding: 1em;
        }

        #filter_form .my-4{
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
                            <div class="col-12">

                                <!--<h4 class="card-title">Entered Form</h4>-->
                                <div class="basic-form" style="padding:1.88rem 1.81rem 0 1.81rem">
                                    <form class="step-form-horizontal" id="filter_form"  action="javascript:void(0)" enctype="multipart/form-data"  method="post" data-parsley-validate autocomplete="off">
                                        <div class="form-row">
                                            <div class="form-group col-md-2">
                                                <label>From Date</label>
                                                <input type="text" class="form-control" name="from_date" id="from_date" placeholder="0000-00-00">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label>To Date</label>
                                                <input type="text" class="form-control" name="to_date" id="to_date" placeholder="0000-00-00">
                                            </div>

                                            <div class="form-group col-md-1">
                                                <button type="submit" class="btn btn-dark my-4 ml-3">Filter</button>
                                            </div>
                                            <div class="form-group col-md-1 my-4">
                                                <a href="<?php echo base_url(); ?>index.php/ct/ct_doc_upload" class="btn btn-success">Reset</a>
                                            </div>
                                            <div class="form-group col-md-1">
                                            </div> 
                                        </div>
                                    </form>
                                 </div>
                                 
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration" id="approved_list">
                                        <thead>
                                            <tr> 
                                            	<th>S.NO</th> 
                                                <th>Action</th>
                                                <th>Name</th>
                                                <th>Createddate</th>
                                                <th>Code</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <!-- <th>Town Code</th> -->
                                                <th id="score">Score</th> 
                                                <th>Proof Detail</th>
                                                <th>Created By</th>
                                                <th>Approval</th>
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" id="detail_view_trigger" data-target="#detailview" style="display:none;">View</button>

                                <!-- image Modal -->
                                <div class="modal fade" id="detailview">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content"> 
                                            <div class="modal-header">
                                                <h5 class="modal-title"> Details of Individual or Representative:</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body" style="padding-top:0; max-height: calc(100vh - 210px);overflow-y: auto;">
                                                <div class="row" style="padding:12px 0;">
                                                    <div class="col-3"><b>Name: </b><p id="pop_name"></p></div>
                                                    <div class="col-3"><b>Mobile: </b><p id="pop_mobile"></p></div>
                                                    <div class="col-3"><b>Educational Qualification: </b><p id="pop_education"></p></div>
                                                    <div class="col-2"><button class="btn  btn-primary" onclick="ct_doc_upload()">Onboarding</button></div>
                                                
                                                </div>  
                                                <div class="row" style="padding:12px 0;">
                                                    <div class="col-3"><b>RSM Remark : </b><p id="pop_rsm_remark"></p></div>
                                                    <div class="col-3"><b>OM Remark : </b><p id="pop_om_remark"></p></div>
                                                    <div class="col-3"><b>Idhaya Remark : </b><p id="pop_rsmi_remark"></p></div>
                                                    <div class="col-3"><b>Nethaji Remark : </b><p id="pop_sh_remark"></p> </div>
                                                </div>
                                                <hr> 
                                                <div class="row" style="padding:12px 0; background:#F3F1FA; font-weight:bold; font-size:14px;" id="bar_div">
                                                    <div class="col-12">
                                                        <label> Uploading Progress Status</label>
                                                        <div class="row">
                                                            <div class="col-11">
                                                                <div class="progress p-1" style="height:30px;">
                                                                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100"> 
                                                                    </div>
                                                                </div>
                                                            </div>    
                                                            <div class="col-1">
                                                                <!-- <div style="height:30px;"> -->
                                                                <button type="button" style="width:30px; height: 30px;" class="btn btn-warning" data-container="body" data-toggle="popover" data-placement="top" 
                                                                data-content="Complete 100% & Move to next">
                                                                    <i class="fa fa-exclamation pr-4"></i>
                                                                </button>
                                                                <!-- </div> -->
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row" style="padding:12px 0; background:#F3F1FA; font-weight:bold; font-size:14px;" id="ct_doc_upload">
                                                    <h5 class="ml-4 small" ><u>Pre-Onboarding :</u></h5>
                                                    <br>
                                                    <div class="row" style="background:#F3F1FA; font-weight:bold; font-size:14px;" id="ct_pre_doc">
                                                        <div class="row col-12 ml-3">
                                                            <div class="col-4">
                                                                <label for="" ><em>i) Signed Agreement</em></label>
                                                                <div id="show_img1"></div> 
                                                            </div>
                                                            <div class="col-4"> 
                                                                <label for=""><em>ii) 100% Completed Profile</em></label>
                                                                <div id="show_img2"></div>
                                                            </div>
                                                            <div class="col-4">
                                                                <label for="" ><em>iii) Deposite Challan</em></label>
                                                                <div id="show_img3"></div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row col-12 m-3">
                                                            <div class="col-4">
                                                                <label for=""><em>iv) GST</em></label>
                                                                <div id="show_img4"></div>
                                                            </div>
                                                            <div class="col-4">
                                                                <label for=""><em>v) FSSAI</em></label>
                                                                <div id="show_img5"></div>
                                                            </div>
                                                            <div class="col-4">
                                                                <label for=""><em>vi) PAN Card</em></label>
                                                                <div id="show_img6"></div>
                                                            </div>
                                                        </div>
                                                        <div class="row col-12 m-3">
                                                            <div class="col-4">
                                                                <label for=""><em>vii) Aadhar Card</em></label>
                                                                 <div id="show_img7"></div>
                                                            </div>
                                                            <div class="col-4">
                                                                <label for=""><em>viii) Current Account Details</em></label>
                                                                <div id="show_img8"></div>
                                                            </div>
                                                          
                                                            <div class="col-4">
                                                                <label for=""><em>ix) List Of Retail Outlet</em></label>
                                                                <div id="show_img9"></div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <input type="hidden" id="id_val"  name="id_val">
                                                        <!-- <div class="col-4 m-4"> 
                                                            <div id="saveor_update_btn"></div>
                                                        </div> -->
                                                        <!-- <div class="col-4 m-2" >
                                                            <div id="success"></div>
                                                        </div> -->
                                                    </div>
                                                    <hr> 
                                                    <h5 class="ml-4 small"><u>Post-Onboarding :</u></h5>
                                                    <div class="row" style="padding:12px 0; background:#F3F1FA; font-weight:bold; font-size:14px;" id="ct_post_doc_upload">
                                                        <div class="row col-12 ml-3">
                                                            <div class="col-4"> 
                                                                <label for=""><em>i) List of Asset Pics</em></label>
                                                                <div id="asset_div"></div> 
                                                            </div>
                                                            <div class="col-4">
                                                                <label for=""><em>ii) PICS with FRC & TEAM</em></label>
                                                                <div id="team_div"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4 m-4"> 
                                                            <div id="saveor_update_btn"></div>

                                                        </div>
                                                        
                                                        <div class="col-4 m-2" >
                                                            <div id="success"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row" style="padding:12px 0; background:#c3b8e782; font-weight:bold; font-size:14px;">
                                                    <div class="col-7">BD Parameters</div>
                                                    <div class="col-3">Slab</div>
                                                    <div class="col-2">Points</div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#fff;">
                                                    <div class="col-7">Marital Status</div>
                                                    <div class="col-3" id="pop_marital_status"></div>
                                                    <div class="col-2" id="pop_marital_remark"></div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#f3f3f3;">
                                                    <div class="col-7">Educational Qualification</div>
                                                    <div class="col-3" id="pop_edu"></div>
                                                    <div class="col-2" id="pop_edu_remark"></div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#fff;">
                                                    <div class="col-7">Occupation</div>
                                                    <div class="col-3" id="pop_occup"></div>
                                                    <div class="col-2" id="pop_occup_remark"></div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#f3f3f3;">
                                                    <div class="col-7">Individual's Monthly Income</div>
                                                    <div class="col-3" id="pop_ind_inco"></div>
                                                    <div class="col-2" id="pop_ind_inco_remark"></div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#fff;">
                                                    <div class="col-7">Family's total Monthly Income</div>
                                                    <div class="col-3" id="pop_fam_inco"></div>
                                                    <div class="col-2" id="pop_fam_inco_remark"></div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#f3f3f3;">
                                                    <div class="col-7">Residing since (YEAR)</div>
                                                    <div class="col-3" id="pop_resi"></div> 
                                                    <div class="col-2" id="pop_resi_remark"></div>
                                                </div>
                                                <div class="row" id="bd_bg" style="padding:8px 0; font-weight:bold; font-size:14px;">
                                                    <div class="col-7">BD Total</div>
                                                    <div class="col-3"></div>
                                                    <div class="col-2"><b class="p-1" id="pop_bd_score"></b></div>
                                                </div>
                                                <hr> 
                                                <div class="row" style="padding:12px 0; background:#c3b8e782; font-weight:bold; font-size:14px;">
                                                    <div class="col-7">FRC Parameters</div>
                                                    <div class="col-3">Slab</div>
                                                    <div class="col-2">Points</div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#fff;">
                                                    <div class="col-7">Should be in the same area</div>
                                                    <div class="col-3" id="pop_area_slub"></div>
                                                    <div class="col-2" id="pop_area"></div>

                                                </div>
                                                <div class="row" style="padding:8px 0; background:#f3f3f3;">
                                                    <div class="col-7"> Age criteria 30 to 35 yrs</div>
                                                    <div class="col-3" id="pop_age_slub"></div>
                                                    <div class="col-2" id="pop_age"></div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#fff;">
                                                    <div class="col-7">Should not do any other Employeement & milk & other business</div>
                                                    <div class="col-3" id="pop_busi_slub"></div>
                                                    <div class="col-2" id="pop_busi"></div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#f3f3f3;">
                                                    <div class="col-7">Should consider as a first income and family business</div>
                                                    <div class="col-3" id="pop_fam_slab"></div>
                                                    <div class="col-2" id="pop_fam_busi"></div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#fff;">
                                                    <div class="col-7">Willing to work 24/7, 365days . Business timing : 5am to 10pm</div>
                                                    <div class="col-3" id="pop_time_slab"></div>
                                                    <div class="col-2" id="pop_time"></div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#f3f3f3;">
                                                    <div class="col-7">Previous experience in milk & related products distribution & management</div>
                                                    <div class="col-3" id="pop_manage_slab"></div>
                                                    <div class="col-2" id="pop_management"></div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#fff;">
                                                    <div class="col-7">If chosen as Franchisee, who is the support system</div>
                                                    <div class="col-3" id="pop_sperson_slab"></div>
                                                    <div class="col-2" id="pop_sperson"></div>
                                                </div> 
                                                <div class="row" style="padding:8px 0; background:#f3f3f3;">
                                                    <div class="col-7">Expected income from this H Parlour business If appointed as FRC</div>
                                                    <div class="col-3" id="pop_expect_income_slab"></div>
                                                    <div class="col-2" id="pop_expect_income"></div>
                                                    <div class="col-7"></div>
                                                    <div class="col-3" id="pop_expect_income_slab1"></div>
                                                    <div class="col-2" id="pop_expect_income1"></div>
                                                </div>
                                                <div class="row" id="frc_bg" style="padding:12px 0; font-weight:bold; font-size:14px;">
                                                    <div class="col-7">FRC Total</div>
                                                    <div class="col-3"></div>
                                                    <div class="col-2"><b class="p-1" id="pop_score"></b></div>
                                                </div>
                                                <hr>
                                                <div class="row" style="padding:12px 0; background:#c3b8e782; font-weight:bold; font-size:14px;">
                                                    <div class="col-7">CT Parameters</div>
                                                    <div class="col-3">Slab</div>
                                                    <div class="col-2">CT Points</div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#fff;">
                                                    <div class="col-7">When do you expect Breakeven? (In months)</div>
                                                    <div class="col-3" id="pop_breakeven_slub"></div>
                                                    <div class="col-2" id="pop_breakeven"></div>
                                                                                
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#f3f3f3;">
                                                    <div class="col-7">Do you have money backup for 6months?</div>
                                                    <div class="col-3" id="pop_mbackup_slub"></div>
                                                    <div class="col-2" id="pop_mbackup"></div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#fff;">
                                                    <div class="col-7">What is your ROI expectation? (In percentage)</div>
                                                    <div class="col-3" id="pop_roi_slub"></div>
                                                    <div class="col-2" id="pop_roi"></div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#f3f3f3;">
                                                    <div class="col-7">Net Worth (Total Assets-Total Liabilities)</div>
                                                    <div class="col-3" id="pop_networth_slab"></div>
                                                    <div class="col-2" id="pop_networth"></div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#fff;">
                                                    <div class="col-7">Mode of Investment (Loan / Own fund)</div>
                                                    <div class="col-3" id="pop_loan_slab"></div> 
                                                    <div class="col-2" id="pop_loan"></div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#f3f3f3;">
                                                    <div class="col-7">Do you have any experience in managing team?</div>
                                                    <div class="col-3" id="pop_expmt_slab"></div>
                                                    <div class="col-2" id="pop_expmt"></div>
                                                </div>
                                                <div class="row" style="padding:8px 0; background:#fff;">
                                                    <div class="col-7">Do you have any experience in handling dairy products ?</div>
                                                    <div class="col-3" id="pop_dairy_slab"></div>
                                                    <div class="col-2" id="pop_dairy"></div> 
                                                </div> 
                                                <div class="row" id="ct_bg" style="padding:12px 0; font-weight:bold; font-size:14px;">
                                                    <div class="col-7">CT Total</div>
                                                    <div class="col-3"></div>
                                                    <div class="col-2"><b class="p-1" id="pop_ct_score"></b></div>
                                                </div> 
                                                <hr>
                                                <div class="row" style="padding:12px 0; background:#F3F1FA; font-weight:bold; font-size:14px;">
                                                    <div class="col-2">State</div>
                                                    <div class="col-2">City</div>
                                                    <div class="col-2">Town</div>
                                                    <div class="col-2">Pin Code</div>
                                                    <div class="col-2">Population</div>
                                                    <div class="col-2">Town Code</div>
                                                </div>
                                                <div class="row" style="padding:12px 0; background:#fff;">
                                                    <div class="col-2" id="pop_state"></div>
                                                    <div class="col-2" id="pop_city"></div>
                                                    <div class="col-2" id="pop_town"></div>
                                                    <div class="col-2" id="pop_pincode"></div>
                                                    <div class="col-2" id="pop_population"></div>
                                                    <div class="col-2" id="pop_town_code"></div>
                                                </div>
                                                <br>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <!-- End Modal -->
 
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

    <script src="<?php echo asset_url();?>new_add/js/detail_pop.js"></script> 
    <script src="<?php echo asset_url();?>new_add/js/ct_sh_approved.js"></script>
    <script src="<?php echo asset_url();?>new_add/js/total_count_ct.js"></script>
    <script src="<?php echo asset_url();?>plugins/jqueryui/js/jquery-ui.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/jquery-validation/jquery.validate.min.js"></script>

    <!-- <script src="<?php echo asset_url();?>cdn/jquery-3.5.1.js"></script> -->
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
            var  page="sh_approved_form";

            if(page=="sh_approved_form"){
                $(".sh_approved_form").addClass("active");
            }
        });

        $('[data-toggle="popover"]').popover();   

		$('#toast-container').delay(5000).fadeOut('slow');	
		$(document).on("click", ".toast-close-button", function (e) {
			$('#toast-container').hide();
		});
		
	</script>

    <script type="text/javascript">
        (function($) { 

            $("#from_date").datepicker({
                dateFormat: "yy-mm-dd",
                maxDate: 0,
                onSelect: function () {
                    var dt2 = $('#to_date');
                    var startDate = $(this).datepicker('getDate');

                    var minDate = $(this).datepicker('getDate');
                    var dt2Date = dt2.datepicker('getDate');
                    // var dateDiff = (dt2Date - minDate)/(86400 * 1000);
                    var dateDiff = (dt2Date )/(86400 * 1000);
                    
                    startDate.setDate(startDate.getDate() );
                    // alert(startDate);

                    if (dt2Date == null || dateDiff < 0) {
                            dt2.datepicker('setDate', null);
                    }
                    else if (dateDiff > 30){
                            dt2.datepicker('setDate', dt2Date);
                    }
                    dt2.datepicker('option', 'maxDate', 'today');
                    dt2.datepicker('option', 'minDate', startDate);
                }
            });
            $('#to_date').datepicker({
                dateFormat: "yy-mm-dd",
                maxDate: 0,
            });
        })(jQuery)
        
    </script>

</body>

</html>