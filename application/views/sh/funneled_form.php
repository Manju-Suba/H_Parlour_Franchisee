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
                        <button type="button" class="btn btn-round btn-sm btn-warning" data-target="tooltip" data-placement="left">BD<span class="tooltiptext" style="background-color:#f29d56;">Basic Details </span></button>&nbsp;
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
                                 
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered zero-configuration">
                                        <thead>
                                            <tr>
                                            	<th>S.NO</th>
                                                <th>Action</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Town Code</th>
                                                <th id="score">Score</th>
                                                <th>Proof Detail</th>
                                                <th>Created By</th>
                                                <!-- <th>SH</th> -->
                                            </tr>
                                        </thead> 
                                        <tbody>
                                        	<?php foreach($user_information as $k => $val) { ?>
                                            <tr>
                                            	<td><?php echo $k+1; ?></td>
                                                <td>
                                                    <div class="dropdown" >
                                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                                                           Action <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" style="min-width:0;">
                                                            <li><a href="#" style="width:70%;" class="dropdown-item  pl-0" onclick="view_image(<?php echo $val['id'];?>)"><i class="fa fa-picture-o pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Image</a></li>
                                                            <li><a href="#" style="width:70%;" class="dropdown-item pl-0" data-toggle="modal" data-target="#additionaview<?php echo $val['id'];?>"><i class="fa fa-eye pl-2" aria-hidden="true"></i>&nbsp;&nbsp;Details</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td><?php echo $val['name']; ?></td>
                                                <td><?php echo $val['mobile']; ?></td>
                                                <td><?php echo $val['shop_address']; ?></td>
                                                <td><?php echo $val['town_code']; ?></td>
                                                <td style="font-size: 14px;"> 
                                                    <div class="row">&nbsp;&nbsp;<span class="p-1">BD Score &nbsp;&nbsp;:</span>
                                                        <?php 
                                                            if( ($val['bd_score'] >= "80") && ($val['bd_score'] <= "100") ){
                                                                ?><b class="text-white bg-success p-1"><?php echo $val['bd_score']; ?></b><?php
                                                            } 
                                                            elseif( ($val['bd_score'] >= "50") && ($val['bd_score'] < "80")){
                                                                ?><b class="text-white bg-warning p-1"><?php echo $val['bd_score']; ?></b><?php
                                                            }else{
                                                                ?><b class="text-white bg-danger p-1"><?php echo $val['bd_score']; ?></b><?php
                                                            }
                                                        ?>
                                                    </div> 
                                                    <br>
                                                    <div class="row">&nbsp;&nbsp;<span class="p-1">FRC Score :</span>
                                                        <?php 
                                                            if( ($val['frc_score'] >= "80") && ($val['frc_score'] <= "100") ){
                                                                ?><b class="text-white bg-success p-1"><?php echo $val['frc_score']; ?></b><?php
                                                            } 
                                                            elseif( ($val['frc_score'] >= "50") && ($val['frc_score'] <"80")){
                                                                ?><b class="text-white bg-warning p-1"><?php echo $val['frc_score']; ?></b><?php
                                                            }else{
                                                                ?><b class="text-white bg-danger p-1"><?php echo $val['frc_score']; ?></b><?php
                                                            }
                                                        ?>
                                                    </div>
                                                    
                                                </td>
                                                <td style="font-size: 13px;"><span>Proof Type :</span>
                                                    <?php 
                                                    if($val['proof_type']!=""){
                                                        ?><b class="text-success"><?php echo $val['proof_type']; ?></b><?php
                                                    } 
                                                    else{
                                                        ?><b class="text-warning">Not verified</b><?php
                                                    } 
                                                    ?>
                                                     <br>
                                                     <br>
                                                    <span><?php echo $val['proof_type']; ?> No :</span>
                                                    <?php 
                                                    if($val['proof_no']!=""){
                                                        ?><b class="text-success"><?php echo $val['proof_no']; ?></b><?php
                                                    } 
                                                    else{
                                                        ?><b class="text-warning">Not verified</b><?php
                                                    } 
                                                    ?>
                                                </td>
                                                <td><?php echo $val['created_by']; ?></td>
                                                <!-- <td><?php echo $val['sh_remark']; ?></td> -->
                                            </tr> 

                                        <!--Modal for additionaview-->
                                            <div class="modal fade" id="additionaview<?php echo $val['id'];?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Additional Information</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                        </div>
                                                        <div class="modal-body" style="padding-top:0; max-height: calc(100vh - 210px);overflow-y: auto;">
                                                        <?php 
                                                        // $creator_row = $this->masters_model->get_table_row_condition('users','mobile',$val['created_by']);
 
                                                        $get_area = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Should be in the same area','points',$val['area']);
                                                        $get_age = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Age criteria 30 to 35 yrs','points',$val['age']);
                                                        
                                                        $get_busi = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Should not do any other Employeement & milk & other business','points',$val['business']);
                                                        $get_family_busi = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Should consider as a first income and family business','points',$val['family_business']);
                                                        $get_time = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Willing to work 24/7, 365days . Business timing : 5am to 10pm','points',$val['business_time']);
                                                        $get_manage = $this->masters_model->get_table_row_with_two_condition('additional_info','parameters','Previous experience in milk & related products distribution & management','points',$val['management']);
                                                        
                                                        ?>
                                                        <div class="row" style="padding:12px 0;">
                                                            <div class="col-4"><b>Name: </b><?php echo $val['name']; ?></div>
                                                            <div class="col-4"><b>Mobile: </b><?php echo $val['mobile']; ?></div>
                                                            <div class="col-4"><b>Educational Qualification: </b><?php echo $val['education']; ?></div>
                                                        </div>
                                                        <div class="row" style="padding:12px 0;">
                                                            <div class="col-4"><b>RSM Remark : </b><?php echo $val['rsm_remark']; ?></div>
                                                            <div class="col-4"><b>Ithaya Remark : </b><?php echo $val['rsmi_remark']; ?></div>
                                                            <div class="col-4"><b>Nethaji Remark : </b><?php echo $val['sh_remark']; ?></div>
                                                        </div>
                                                        <hr>
                                                        <div class="row" style="padding:12px 0; background:#c3b8e782; font-weight:bold; font-size:14px;">
                                                            <div class="col-7">BD Parameters</div>
                                                            <div class="col-3">Slab</div>
                                                            <div class="col-2">Points</div>
                                                        </div>
                                                        <div class="row" style="padding:8px 0; background:#fff;">
                                                            <div class="col-7">Marital Status</div>
                                                            <div class="col-3"><?php echo $val['marital_status']; ?></div>
                                                            <div class="col-2"><?php echo $val['marital_status_remark']; ?></div>
                                                        </div>
                                                        <div class="row" style="padding:8px 0; background:#f3f3f3;">
                                                            <div class="col-7">Educational Qualification</div>
                                                            <div class="col-3"><?php echo $val['education']; ?></div>
                                                            <div class="col-2"><?php echo $val['education_remark']; ?></div>
                                                        </div>
                                                        <div class="row" style="padding:8px 0; background:#fff;">
                                                            <div class="col-7">Individual's Monthly Income</div>
                                                            <div class="col-3"><?php echo $val['in_mon_income']; ?></div>
                                                            <div class="col-2"><?php echo $val['in_mon_income_remark']; ?></div>
                                                        </div>
                                                        <div class="row" style="padding:8px 0; background:#f3f3f3;">
                                                            <div class="col-7">Family's total Monthly Income</div>
                                                            <div class="col-3"><?php echo $val['family_income']; ?></div>
                                                            <div class="col-2"><?php echo $val['family_income_remark']; ?></div>
                                                        </div>
                                                        <div class="row" style="padding:8px 0; background:#fff;">
                                                            <div class="col-7">Residing since (YEAR)</div>
                                                            <div class="col-3"><?php echo $val['residing_year']; ?></div>
                                                            <div class="col-2"><?php echo $val['residing_year_remark']; ?></div>
                                                        </div>
                                                        <?php if( ($val['bd_score'] <= "100") && ($val['bd_score'] >= "80") ){ ?>
                                                            <div class="row" style="padding:8px 0; background:#e1f3da; font-weight:bold; font-size:14px;">
                                                                <div class="col-7">BD Total</div>
                                                                <div class="col-3"></div>
                                                                <div class="col-2">
                                                                    <b class="text-white bg-success p-1"><?php echo $val['bd_score']; ?></b>
                                                                </div>
                                                            </div>
                                                        <?php } elseif( ($val['bd_score'] >= "50") && ($val['bd_score'] < "80") ){?>
                                                            <div class="row" style="padding:8px 0; background:#f7d8b261; font-weight:bold; font-size:14px;">
                                                                <div class="col-7">BD Total</div>
                                                                <div class="col-3"></div>
                                                                <div class="col-2">
                                                                    <b class="text-white bg-warning p-1"><?php echo $val['bd_score']; ?></b>
                                                                </div>
                                                            </div>
                                                        <?php } else{?>
                                                            <div class="row" style="padding:8px 0; background:#eb6c5840; font-weight:bold; font-size:14px;">
                                                                <div class="col-7">BD Total</div>
                                                                <div class="col-3"></div>
                                                                <div class="col-2">
                                                                    <b class="text-white bg-danger p-1"><?php echo $val['bd_score']; ?></b>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <hr>
                                                        <div class="row" style="padding:12px 0; background:#c3b8e782; font-weight:bold; font-size:14px;">
                                                            <div class="col-7">FRC Parameters</div>
                                                            <div class="col-3">Review</div>
                                                            <div class="col-2">CC Points</div>
                                                        </div>
                                                        <div class="row" style="padding:8px 0; background:#fff;">
                                                            <div class="col-7">Should be in the same area</div>
                                                            <div class="col-3"><?php echo $get_area['slab']; ?></div>
                                                            <div class="col-2"><?php echo $val['area']; ?></div>
                                                        </div>
                                                        <div class="row" style="padding:8px 0; background:#f3f3f3;">
                                                            <div class="col-7"> Age criteria 30 to 35 yrs</div>
                                                            <div class="col-3"><?php echo $get_age['slab']; ?></div>
                                                            <div class="col-2"><?php echo $val['age']; ?></div>
                                                        </div>
                                                        <div class="row" style="padding:8px 0; background:#fff;">
                                                            <div class="col-7">Should not do any other Employeement & milk & other business</div>
                                                            <div class="col-3"><?php echo $get_busi['slab']; ?></div>
                                                            <div class="col-2"><?php echo $val['business']; ?></div>
                                                        </div>
                                                        <div class="row" style="padding:8px 0; background:#f3f3f3;">
                                                            <div class="col-7">Should consider as a first income and family business</div>
                                                            <div class="col-3"><?php echo $get_family_busi['slab']; ?></div>
                                                            <div class="col-2"><?php echo $val['family_business']; ?></div>
                                                        </div>
                                                        <div class="row" style="padding:8px 0; background:#fff;">
                                                            <div class="col-7">Willing to work 24/7, 365days . Business timing : 5am to 10pm</div>
                                                            <div class="col-3"><?php echo $get_time['slab']; ?></div>
                                                            <div class="col-2"><?php echo $val['business_time']; ?></div>
                                                        </div>
                                                        <div class="row" style="padding:8px 0; background:#f3f3f3;">
                                                            <div class="col-7">Previous experience in milk & related products distribution & management</div>
                                                            <div class="col-3"><?php echo $get_manage['slab']; ?></div>
                                                            <div class="col-2"><?php echo $val['management']; ?></div>
                                                        </div>
                                                        <div class="row" style="padding:8px 0; background:#fff;">
                                                            <div class="col-7">If chosen as Franchisee, who is the support system</div>
                                                            <div class="col-3"><?php echo $val['relationship']; ?></div>
                                                            <div class="col-2"><?php echo $val['relationship_remark']; ?></div>
                                                        </div>
                                                        <div class="row" style="padding:8px 0; background:#f3f3f3;">
                                                            <div class="col-7">Expected income from this H Parlour business If appointed as FRC</div>
                                                            <div class="col-3"><?php echo $val['expect_income']; ?></div>
                                                            <div class="col-2"><?php echo $val['expect_income_remark']; ?></div>
                                                        </div>
                                                        <!-- <hr> -->
                                                        <?php if( ($val['frc_score'] <= "100") && ($val['frc_score'] >= "80") ){ ?>
                                                            <div class="row" style="padding:8px 0; background:#e1f3da; font-weight:bold; font-size:14px;">
                                                                <div class="col-7">FRC Total</div>
                                                                <div class="col-3"></div>
                                                                <div class="col-2">
                                                                    <b class="text-white bg-success p-1"><?php echo $val['frc_score']; ?></b>
                                                                </div>
                                                            </div>
                                                        <?php } elseif( ($val['frc_score'] >= "50") && ($val['frc_score'] < "80") ){?>
                                                            <div class="row" style="padding:8px 0; background:#f7d8b261; font-weight:bold; font-size:14px;">
                                                                <div class="col-7">FRC Total</div>
                                                                <div class="col-3"></div>
                                                                <div class="col-2">
                                                                    <b class="text-white bg-warning p-1"><?php echo $val['frc_score']; ?></b>
                                                                </div>
                                                            </div>
                                                        <?php } else{?>
                                                            <div class="row" style="padding:8px 0; background:#eb6c5840; font-weight:bold; font-size:14px;">
                                                                <div class="col-7">FRC Total</div>
                                                                <div class="col-3"></div>
                                                                <div class="col-2">
                                                                    <b class="text-white bg-danger p-1"><?php echo $val['frc_score']; ?></b>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
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
                                                            <div class="col-2"><?php echo $val['shop_sate']; ?></div>
                                                            <div class="col-2"><?php echo $val['shop_city']; ?></div>
                                                            <div class="col-2"><?php echo $val['shop_town']; ?></div>
                                                            <div class="col-2"><?php echo $val['pincode']; ?></div>
                                                            <div class="col-2"><?php echo $val['population']; ?></div>
                                                            <div class="col-2"><?php echo $val['town_code']; ?></div>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <div class="col-md-12" style="text-align:center;">
                                                            <!-- <a href="<?php echo base_url(); ?>index.php/ct/ct_insertion_form" class="btn btn-success">Add More Details </a> -->
                                                        </div>
                                                        <!-- <div class="form-group col-md-4" style="float:right;">
                                                            <button type="button" class="btn btn-info btn-lg btn-block" >Add More Details 
                                                            </button> 
                                                        </div> -->

                                                        <p id="va_rev_resp" style="display:none;"></p>
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal end-->
                           
                                            <!-- Modal for approval-->
                                            <div class="modal fade" id="approval<?php echo $val['id'];?>">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Approval for this Form</h5>
                                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <form action="<?php echo base_url('index.php/asm/form_approval'); ?>" enctype="multipart/form-data" data-parsley-validate method="post" autocomplete="off">	
                                                        <input type="hidden" name="id" class="form-control" value="<?php echo $val['id'];?>">
                                                        <button type="submit" name="approval" class="btn mb-1 btn-success">Approve</button>
                                                        <button type="submit" name="reject" class="btn mb-1 btn-danger">Reject</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <!-- image Modal approval -->

                                            


                                            <?php  } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    
    <script src="<?php echo asset_url();?>new_add/js/detail_pop.js"></script> 
    <script src="<?php echo asset_url();?>new_add/js/total_count_sh.js"></script>

    <script src="<?php echo asset_url();?>plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/tables/js/datatable-init/datatable-basic.min.js"></script>
    
    <script>
        var BASE_URL = "<?php echo base_url(); ?>index.php/";
        var ASSET_URL = "<?php echo asset_url(); ?>";

        $(document).ready(function () {
		var  page="funneled_form";

		if(page=="funneled_form"){
			$(".funneled_form").addClass("active");
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