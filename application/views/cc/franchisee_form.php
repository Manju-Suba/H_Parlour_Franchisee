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
    <link href="<?php echo asset_url();?>css/style.css" rel="stylesheet">
    <!-- <link href="<?php echo asset_url();?>plugins/jqueryui/css/jquery-ui.min.css" rel="stylesheet"> -->
    <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">

    <?php include('application/views/include/select_2_head.php'); ?>

    <style>  

/* //year picker start */

        .ui-datepicker-div{
            position: fixed;
            top: 758.796px;
            left: 1135.66px;
            z-index: 1;
            display: block;
        }
        
        .ui-datepicker-prev.ui-corner-all,.ui-datepicker-next.ui-corner-all,.ui-datepicker-month,.ui-datepicker-calendar,.ui-datepicker-current{
            display: none;
        }

        /* .ui-datepicker-year{
            width:183px;
            height: 40px;
            padding: 0px 60px;
        
        }

        .ui-datepicker-close.ui-state-default.ui-priority-primary.ui-corner-all{
            width:70px;
            float: right;
            background-color: #e5e4f1;
            margin-top: 1px;
            border-radius: 5px 5px 5px 5px;

        } */
/* //year picker end */

        
        .select2-container--default .select2-selection--single .select2-selection__clear {
            cursor: pointer;
            float: right;
            font-weight: bold;
            display: none;
        }
/* ///new today */

        .wizard > .steps > ul > li {
            width: 50%;
        }


        /* //next previous btn style */
        .wizard > .actions{
            position: absolute;
            top: 62rem;
            left: 0;
            padding: 1rem 2rem;
        }
                
        .wizard .content > .body label.error {
            position: absolute;
            top: 77%;
            margin-left: 0;
            font-size:13px ;

        }

        .wizard .content > .body label.error#expect_income1-error {
            position: absolute;
            top: 77%;
            margin-left: -140px;
            font-size: 13px;
        }

        @media (min-width: 1020px) and (max-width: 1380px) {
            .wizard .content > .body label.error#expect_income1-error {
                position: absolute;
                top: 77%;
                margin-left: -101px;
                font-size: 13px;
            }
        }

        .wizard .content > .body label.error#expect_income-error {
            position: absolute;
            top: 2177%;
            margin-left: 0;
            font-size: 13px;
        }

        .wizard .content > .body label.error#pro_management-error {
            position: absolute;
            top: 1599%;
            margin-left: 0;
            font-size: 13px;
        }

        .wizard .content > .body label.error#busi_time-error {
            position: absolute;
            top: 1360%;
            margin-left: 0;
            font-size: 13px;
        }

        .wizard .content > .body label.error#family_busi-error {
            position: absolute;
            top: 1100%;
            margin-left: 0;
            font-size: 13px;
        }

        .wizard .content > .body label.error#business-error {
            position: absolute;
            top: 840%;
            margin-left: 0;
            font-size: 13px;
        }

        .wizard .content > .body label.error#age-error {
            position: absolute;
            top: 590%;
            margin-left: 0;
            font-size: 13px;
        }

        .wizard .content > .body label.error#area-error {
            position: absolute;
            top: 330%;
            margin-left: 0;
            font-size: 13px;
        }

        .wizard .content > .body label.error#address-error {
            position: absolute;
            top: 80%;
            margin-left: 0;
            font-size: 13px;
        }

        /* .wizard .content > .body label#email.error1 {
            background: rgb(251, 227, 228);
            border: 1px solid #aaa;
        } */

        .wizard .content {
            /* min-height: 48.75rem; */
            min-height: 64.75rem;
            margin: 0;
        }

        /* .content-body{
            min-height: 780px;
        } */

        .wizard .content > .body .form-group label.error#shop_sate-error ,
        .wizard .content > .body .form-group label.error#shop_city-error ,
        .wizard .content > .body .form-group label.error#shop_town-error,
        .wizard .content > .body .form-group label.error#proof-error{
            top: 77%;
            left:5%;
            margin-left: 0;
            display: inline-block;
            
        }

        /* .select2-container--default .select2-selection--single {
            background-color: #f5d1d1d9;
            border: 1px solid #dbabab;
            border-radius: 4px;
        } */

        /* form-control nice_select select2-hidden-accessible error */

        .wizard > .content > .body .form-group label.error .select2-container--default .select2-selection--single{
            background: rgb(251, 227, 228);
            border: 1px solid #aaa;
            /* color: #8a1f11; */ 
        }

        #residing_year-error{
            font-size:13px ;
        }

        /* .select2-container--default .select2-selection--single {
            background-color: #f3d8d8;
            border: 1px solid #aaa;
            border-radius: 4px;
        } */


        @media (min-width: 320px) and (max-width: 480px) {
            /* CSS */
            .wizard > .steps > ul > li {
                width: auto !important;
            }
            .wizard > .steps > ul  {
                overflow-x: scroll;
            }
            #steps-uid-0 section .col-lg-4{
                margin: 0 10px 0 10px;
            }
        }

        .wizard > .actions ul [aria-hidden="false" ][aria-disabled="false"] {
            display:block;
        }
 
        .wizard > .actions ul [aria-hidden="false"]{
            display:none;
        }

        .wizard > .actions ul .disabled[aria-disabled="true"] {
            display:none;
        }

        p {
            margin-top: 0.7rem;
            margin-bottom: 0.5rem;
        }
        .wizard .content > .body textarea.form-control.error{
            background-color: #ebcbcb8c;
            border: 1px solid #dfadad;
        }

        /* .select2-container--default .select2-selection--single {
            background-color: #f5d1d1d9;
            border: 1px solid #dbabab;
            border-radius: 4px;
        } */

        .wizard .content > .body select.form-control.nice_select.select2-hidden-accessible.error .select2-container--default.select2-selection--single{
            background-color: #ebcbcb8c;
            border: 1px solid #dfadad;
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
                <div class="alert alert-danger ">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="color:#fff;">×</button>
                    <i class="fa fa-times-circle fa-fw fa-lg"></i>
                    <strong></strong><?php echo $error; ?>
                </div>
                <?php $this->session->set_flashdata('error', ''); ?>

            <?php endif; ?>
            <!-- start: alert Message -->
                    
  
            <div class="container-fluid"> 
                <div class="row">
                    <div class="col-md-12"> 
                        <form class="step-form-horizontal" action="<?php echo base_url('index.php/cc/user_info'); ?>" enctype="multipart/form-data" id="step-form-horizontal"  data-parsley-validate method="post" autocomplete="off"> 
                            <div>
                                <h4>Details of Individual or Representative </h4>
                                <section style="padding-top:0; max-height: calc(100vh - 3110px);" id="tab1">
                                <!-- <section style="padding-top:0; max-height: calc(100vh - 210px); overflow-y: auto;"> -->
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Name <span style="color:red;">*</span></label>
                                                <input type="text" name="name" id="f_name" class="form-control" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="User Name"  required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Email <span style="color:red;">*</span></label>
                                                <input type="email" name="email" id="email" class="form-control" pattern="/^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i" placeholder="Enter your email ..."  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4"> 
                                            <div class="form-group">
                                                <label for="">Mobile <span style="color:red;">*</span></label>
                                                <input type="text" name="mobile" id="mobile" minlength="10" maxlength="10" oninput="mobileValid();" class="form-control" placeholder="Mobile no."  required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Whatsapp No. ( &nbsp;<input type="checkbox" id="mobile_same" name="mobile_same" onclick="myFunction()">&nbsp; same as mobile no.)&nbsp;<span style="color:red;">*</span></label>
                                                <input type="text" name="whatsapp_no" id="whatsapp_no" class="form-control" minlength="10" maxlength="10" oninput="mobileValid_2();" placeholder="Whatsapp no."  required>
                                            </div>
                                        </div> 
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Landline (Optional)</label>
                                                <input type="text" name="landline" id="landline" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" placeholder="Landline no." minlength="10" maxlength="12" >
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <p>Gender  <span style="color:red;">*</span></p>
                                                <div class="row ml-2">
                                                    <input type="radio" id="gender" name="gender" value="Male"  required>&nbsp;
                                                    <p>Male</p><br>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" id="gender2" name="gender" value="Female"  required>&nbsp;
                                                    <p>Female</p><br>&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <p>Marital Status  <span style="color:red;">*</span></p>
                                                <div class="row ml-2">
                                                    <input type="radio" id="marital_status" name="marital_status" value="Married"  required>&nbsp;
                                                    <p>Married</p><br>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" id="marital_status2" name="marital_status" value="Unmarried"  required>&nbsp;
                                                    <p>Unmarried</p><br>&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                       
                                        <div class="col-lg-3">  
                                            <div class="form-group">
                                                <p>Language  <span style="color:red;">*</span></p>
                                                <div class="row ml-2">
                                                    <input type="radio" id="language" name="language" value="English"  required>&nbsp;
                                                    <p>English</p><br>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" id="language2" name="language" value="Tamil"  required>&nbsp;
                                                    <p>Tamil</p><br>&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <p>Occupation  <span style="color:red;">*</span></p>
                                                <div class="row ml-1">
                                                    <input type="radio" id="occupation" name="occupation" value="Self run business"  required>&nbsp;
                                                    <p>Self run business</p><br>&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" id="occupation2" name="occupation" value="Employee"  required>&nbsp;
                                                    <p>Employee</p><br>&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4"> 
                                            <div class="form-group">
                                                <label>Educational Qualification <span style="color:red;">*</span></label>
                                                <select name="education_q" class="form-control c-pointer"  required>
                                                    <option value="" selected disabled>Select Education </option>
                                                    <option value="10th">10th</option>
                                                    <option value="12th">12th</option>
                                                    <option value="Degree Holder">Degree Holder</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Individual's Monthly Income<span style="color:red;">*</span></label>
                                                <input type="number" name="monthly_income" id="monthly_income" onkeydown="return event.keyCode !== 69" class="form-control" placeholder="₹"  required>
                                            </div>
                                        </div> 
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Family's total Monthly Income <span style="color:red;">*</span></label>
                                                <input type="number" name="family_income" id="family_income" onkeydown="return event.keyCode !== 69" class="form-control" placeholder="₹"  required>
                                            </div>
                                        </div> 
                                        <div class="col-lg-3"></div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-lg-4"> 
                                            <div class="form-group">
                                                <label for="">State <span style="color:red;">*</span></label>
                                                <select name="shop_sate" id="shop_sate" class="form-control nice_select" onchange="stateLine()"  required>
                                                    <option value="">Select State</option>
                                                    <?php foreach($sates as $sates ){ ?>
                                                        <option value="<?php echo $sates['state_name']; ?>"><?php echo $sates['state_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div> 
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">District <span style="color:red;">*</span></label>
                                                <select id="shop_city" name="shop_city" class="form-control nice_select" onchange="cityLine()"  required>      
                                                    <option value="">Select District</option>
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Town <span style="color:red;">*</span></label>
                                                <select id="shop_town" name="shop_town" class="form-control nice_select" onchange="townLine()"  required>      
                                                    <option value="">Select Town</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="town_code" id="town_code" class="form-control" placeholder="Town Code">
                                        <input type="hidden" name="population" id="population" class="form-control" placeholder="Population"/>

                                        <div class="col-lg-4"> 
                                            <div class="form-group">
                                                <label for="">Address <span style="color:red;">*</span></label>
                                                <textarea name="address" class="form-control" rows="2" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Type your address here..."  required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-4"> 
                                            <div class="form-group">
                                                <label for="">Pincode <span style="color:red;">*</span></label>
                                                <input type="text" name="pincode" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"  maxlength="6" minlength="6" class="form-control" placeholder="Enter pincode.."  required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4"> 
                                            <div class="form-group">
                                                <label for="">Residing since : (year) <span style="color:red;">*</span></label>
                                                <input type="text" name="residing_year" id="residing_year" class="form-control date-picker-year" placeholder="Select year" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4"> 
                                            <div class="form-group">
                                                <label for="">Sourced By(Optional)</label>
                                                <select name="sourced_by" class="form-control c-pointer">
                                                    <option value="">Select</option>
                                                    <option value="Advertisement">Advertisement</option>
                                                    <option value="Facebook">Facebook</option>
                                                    <option value="WhatsApp">WhatsApp</option>
                                                    <option value="Newspaper">Newspaper</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4"> 
                                            <div class="form-group">
                                                <label for="">Referred Person(Optional)</label>
                                                <input type="text" name="referred_person" class="form-control" placeholder="Enter Referred Person">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">Proof Type <span style="color:red;">*</span></label>
                                                <select name="proof" id="proof" class="form-control nice_select" onchange="myFFunction()"  required>
                                                    <option value="select" disabled selected>select</option>
                                                    <option value="Aadhar">Aadhar</option>
                                                    <option value="Pan">Pan</option>
                                                    <option value="Driving Licence">Driving Licence</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label id="demo">Proof </label>&nbsp;No.<span style="color:red;">*</span>
                                                <input type="text" id="proof_no" name="proof_no" class="form-control" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Enter your id number..."   required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label id="demo1">Proof</label>&nbsp;Attachment
                                                <input type="file" name="image_proof" id="image_proof" class="form-control" value="" >
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <!-- <br>
                                    <br>
                                    <br> -->
                                </section>
                                <h4>FRC</h4> 
                                <!-- <section style="padding-top:0; max-height: calc(100vh - 210px);overflow-y: auto;"> -->
                                <section style="padding-top:0; max-height: calc(100vh -  4110px);" id="tab2">
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                        <thead>
                                            <tr> 
                                                <th class="col-1">SI No</th>
                                                <th class="col-3">Question</th>
                                                <th class="col-2">Yes / No<span style="color:red;">*</span></th>
                                                <th class="col-3">If No</th>
                                                <th class="col-3">Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1.</td>
                                                <td>Should be in the area</td>
                                                <td class="row ml-1"> <input type="radio" id="area" name="area" value="5"  required>&nbsp;
                                                    <p >Yes</p><br>&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" id="area2" name="area" value="0"  required>&nbsp;
                                                    <p >No</p><br>&nbsp;
                                                </td>
                                                <td class="col-3">
                                                    <!-- <label><p>km difference</p></label> -->
                                                    <textarea name="area_remark" class="form-control" rows="2" placeholder="Find out Km difference..." ></textarea>
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="if_any_remark1" class="form-control" rows="2" placeholder="If any remarks write here.." ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Age criteria 30 to 35 yrs</td>
                                                <td class="row ml-1"> <input type="radio" id="age" name="age" value="5"  required>&nbsp;
                                                    <p >Yes</p><br>&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" id="age2" name="age" value="0"  required>&nbsp;
                                                    <p >No</p><br>&nbsp;
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="age_remark" class="form-control" rows="2" placeholder="Deviation in age in years..." ></textarea>
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="if_any_remark2" class="form-control" rows="2" placeholder="If any remarks write here.." ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>Should not do any other employment</td>
                                                <td class="row ml-1"> <input type="radio" id="business" name="business" value="10"  required>&nbsp;
                                                    <p >Yes</p><br>&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" id="business2" name="business" value="0"  required>&nbsp;
                                                    <p >No</p><br>&nbsp;
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="business_remark" class="form-control" rows="2" placeholder="both yes & no - remarks mandatory.." ></textarea>
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="if_any_remark3" class="form-control" rows="2" placeholder="Fill the crisp summary of family earning history.." ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td>Should consider as a first income and family business</td>
                                                <td class="row ml-1"> <input type="radio" id="family_busi" name="family_busi" value="10"  required>&nbsp;
                                                    <p >Yes</p><br>&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" id="family_busi2" name="family_busi" value="0"  required>&nbsp;
                                                    <p >No</p><br>&nbsp;
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="family_busi_remark" class="form-control" rows="2" placeholder="both yes & no - remarks mandatory.." ></textarea>
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="if_any_remark4" class="form-control" rows="2" placeholder="Explain why it will not be 1st income or family business.." ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5.</td>
                                                <td>Willing to work 365 days, 4 a.m onwards </td>
                                                <td class="row ml-1"> <input type="radio" id="busi_time" name="busi_time" value="20"  required>&nbsp;
                                                    <p >Yes</p><br>&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" id="busi_time2" name="busi_time" value="0"  required>&nbsp;
                                                    <p >No</p><br>&nbsp;
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="time_remark" class="form-control" rows="2" placeholder="both yes & no - remarks mandatory.." ></textarea>
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="if_any_remark5" class="form-control" rows="2" placeholder="If any remarks write here.." ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6.</td>
                                                <td>Previous experience in milk & related products distribution & management</td>
                                                <td class="row ml-1"> <input type="radio" id="pro_management" name="pro_management" value="10"  required>&nbsp;
                                                    <p >Yes</p><br>&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" id="pro_management2" name="pro_management" value="0"  required>&nbsp;
                                                    <p >No</p><br>&nbsp;
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="pro_manage_remark" class="form-control" rows="2" placeholder="both yes & no - remarks mandatory.." ></textarea>
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="if_any_remark6" class="form-control" rows="2" placeholder="If any remarks write here.." ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>7.</td>
                                                <td>If chosen as Franchisee, who is the support system</td>
                                                <td>
                                                    <input name="sperson_age" class="form-control" placeholder=" Age of the support person" >
                                                </td>
                                                <td class="col-3">
                                                    <select name="relation" id="relation" class="form-control c-pointer"  required>
                                                        <option value="" selected disabled>Relationship with you</option>
                                                        <option value="Father">Father</option>
                                                        <option value="Mother">Mother</option>
                                                        <option value="Husband">Husband</option>
                                                        <option value="Wife">Wife</option>
                                                        <option value="Brother">Brother</option>
                                                        <option value="Sister">Sister</option>
                                                        <option value="Friend">Friend</option>
                                                        <option value="Neighbour">Neighbour</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="if_any_remark7" class="form-control" rows="2" placeholder="If any remarks write here.." ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>8.</td>
                                                <td>Expected income from this H Parlour business If appointed as FRC</td>
                                                <td> 
                                                    <input name="expect_income" class="form-control" placeholder="Below 6 months" required>
                                                </td>
                                                <td class="col-3" style="text-align: center;">
                                                    <input name="expect_income1" class="form-control expect_income1" placeholder="After 6 months"  required>
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="if_any_remark8" class="form-control" rows="2" placeholder="If any remarks write here.." ></textarea>
                                                </td>
                                            </tr>

                                        </tbody>
                                        </table>
                                    </div>
                                    <input type="hidden" id="save_status" name="save_status" value="0">
                                    <br>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-4">
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for=""><b>Select Cluster </b><span style="color:red;">*</span></label>
                                                    <select name="cluster_id" id="cluster_id" class="form-control c-pointer"  required>
                                                        <option value="" selected disabled>Select Cluster</option>
                                                        <option value="1014133">GANAPATHY</option>
                                                        <option value="1014689">RAVIKUMAR</option>
                                                        <option value="1014136">SELVAKUMAR V</option>
                                                        <option value="1014800">SELVAKUMAR G</option>
                                                        <option value="KCSL1331">PANDIAN</option>
                                                        <option value="1014840">SRIDHARAN</option>
                                                        <option value="1013061">SURESH BALU</option>
                                                        <option value="1012444">YUSUF</option>
                                                        <option value="1011766">RUTHRA KUMAR</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-4">
                                            </div>
                                            <div class="col-lg-4" style="text-align:center;">
                                                <button type="button" id="save_form" class="btn mb-1 btn-primary"><b>Save</b></button>
                                                <button type="submit" id="form_submit_btn" class="btn mb-1 btn-success"><b>Submit</b></button>
                                            </div>
                                            <div class="col-lg-4">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <br>
                                    <br>
                                    <br>
                                    <br> -->
                                </section>
                            </div>
                        </form>
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
    <script src="<?php echo asset_url();?>plugins/jqueryui/js/jquery-ui.min.js"></script>
    <script src="<?php echo asset_url();?>js/plugins-init/jquery-steps-init.js"></script>
    
    <!-- Toastr -->
    <script src="<?php echo asset_url();?>plugins/toastr/js/toastr.min.js"></script>
    <script src="<?php echo asset_url();?>plugins/toastr/js/toastr.init.js"></script>

    <!-- added new --> 
    <script src="<?php echo asset_url();?>new_add/js/franchisee_form.js"></script> 
    <script src="<?php echo asset_url();?>new_add/js/total_count_cc.js"></script>

    <?php include('application/views/include/select_2_footer.php'); ?>

    <script> 

        var BASE_URL = "<?php echo base_url();?>index.php/"; 
        var ASSET_URL = "<?php echo asset_url();?>";

		$(document).on("click", ".toast-close-button", function (e) {
			$('#toast-container').hide();
		});
        $('.toast-success').delay(5000).fadeOut('slow');

        // $("#first-field").on("keyup", function(){
        //     var value = $(this).val();
        //     $("#second-field").val(value + "@gmail.com");
        // });

        function myFunction() {
            var checkBox = document.getElementById("mobile_same");
            if (checkBox.checked == true){
                // getMobile();
                var mobile = $('#mobile').val();
                $('#whatsapp_no').val(mobile);

                $("#mobile").on("keyup", function(){
                    var value = $(this).val();
                    $("#whatsapp_no").val(value);
                });

            } else {
                var mobile = "";
                $('#whatsapp_no').val(mobile);
            }

        }

        function myFFunction() {
            var x = document.getElementById("proof").value;
            // alert(x);
            document.getElementById("demo").innerHTML = x;
            document.getElementById("demo1").innerHTML = x;
            $('#proof-error').hide();

            if( x == "Pan"){
                $("#proof_no").attr('maxlength','10');
                $("#proof_no").attr('minlength','10');
            }else if( x == "Aadhar"){
                $("#proof_no").attr('maxlength','12');
                $("#proof_no").attr('minlength','12');
            }else{
                $("#proof_no").attr('maxlength','13');
                $("#proof_no").attr('minlength','10');
            }
        }

        function stateLine(){
            $('#shop_sate-error').hide();
        }

        function cityLine(){
            $('#shop_city-error').hide();
        }

        function townLine(){
            $('#shop_town-error').hide();
        }

        function mobileValid(){
            var textInput = document.getElementById("mobile").value;
            textInput = textInput.replace(/[^0-9]/g, "");
            document.getElementById("mobile").value = textInput;
        }

        function mobileValid_2(){
            var textInput = document.getElementById("whatsapp_no").value;
            textInput = textInput.replace(/[^0-9]/g, "");
            document.getElementById("whatsapp_no").value = textInput;
        }
		
		
		
		//window.onbeforeunload = function(){
		// return 'Are you sure you want to leave?';
		//};
		$('#step-form-horizontal').data('serialize',$('#step-form-horizontal').serialize()); // On load save form current state

		$(window).bind('beforeunload', function(e){
			if($('#step-form-horizontal').serialize()!=$('#step-form-horizontal').data('serialize'))return true;
			else e=null; // i.e; if form state change show warning box, else don't show it.
			 
		});
		
		    $(document).on("submit", "form", function(event){
				// disable warning
				$(window).off('beforeunload');
			});
		
		
		
			
		$(document).ready(function () {
            var  page="franchisee_form";

            if(page=="franchisee_form"){
                $(".franchisee_form").addClass("active");
            }
            
            // document.getElementById("mobile_same").disabled = true;
		});
		
        // $('#mobile').keypress(function(){
        //     var mob = $('#mobile').val();

        //     if(mob.maxlength == 10){
        //         alert('10');
        //     }else{
        //         alert('1');
        //     }
        //     document.getElementById("mobile_same").disabled = false;
        // })

       
/////////////////

		// get city
		jQuery(document).on('change', 'select#shop_sate', function (e) {
			e.preventDefault();
			var stateID = jQuery(this).val();
			getCityList(stateID);
		 
		});
		
		// function get All Cities
		function getCityList(stateID) {
			$.ajax({
				url: BASE_URL + 'cc/getcities',
				type: 'post',
				data: {stateID: stateID},
				dataType: 'json',
				beforeSend: function () {
					jQuery('select#shop_city').find("option:eq(0)").html("Please wait..");
				},
				complete: function () {
					// code
				},
				success: function (json) {
					var options = '';
					options +='<option value="">Select District</option>';
					for (var i = 0; i < json.length; i++) {
						options += '<option value="' + json[i].district_name + '">' + json[i].district_name + '</option>';
					}
					jQuery("select#shop_city").html(options);

                    // town list
                    var options = '';
					options +='<option value="">Select Town</option>';
					jQuery("select#shop_town").html(options);
		 
				},
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
		
		// get town
		jQuery(document).on('change', 'select#shop_city', function (e) {
			e.preventDefault();
			var cityID = jQuery(this).val();
			getTownList(cityID);
		 
		});

        
		
		// function get All town
		function getTownList(cityID) {
			$.ajax({
				url: BASE_URL + 'cc/gettowns',
				type: 'post',
				data: {cityID: cityID},
				dataType: 'json',
				beforeSend: function () {
					jQuery('select#shop_town').find("option:eq(0)").html("Please wait..");
				},
				complete: function () {
					// code
				},
				success: function (json) {
					var options = '';
					options +='<option value="">Select Town</option>';
					for (var i = 0; i < json.length; i++) {
						options += '<option value="' + json[i].town_name + '">' + json[i].town_name + '</option>';
					}
					jQuery("select#shop_town").html(options);
		 
				},
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
		
		
		// get zip code
		jQuery(document).on('change', 'select#shop_town', function (e) {
			e.preventDefault();
			var townID = jQuery(this).val();
			getZipList(townID);
		 
		});
		
		// function get All town
		function getZipList(townID) {
			$.ajax({
				url: BASE_URL + 'cc/getzip',
				type: 'post',
				data: {townID: townID},
				dataType: 'json',
				success: function (json) {
					//alert(json.zip_code);
					console.log(json);
					$('#town_code').val(json.town_code);
				},
			});

            $.ajax({
				url: BASE_URL + 'cc/get_population',
				type: 'post',
				data: {townID: townID},
				dataType: 'json',
				success: function (json) {
					//alert(json.zip_code);
					console.log(json);
					$('#population').val(json.population);
				},
			});
		}


	</script>

    <script>

        // $('#f_name').bind('input', function() {
        //     var c = this.selectionStart,
        //         r = /[^a-z0-9 .]/gi,
        //         v = $(this).val();
        //     if(r.test(v)) {
        //         $(this).val(v.replace(r, ''));
        //         c--;
        //     }
        //     this.setSelectionRange(c, c);
        // });

        function testInput(event) {
            var value = String.fromCharCode(event.which);
            var pattern = new RegExp(/[a-zåäö ]/i);
            return pattern.test(value);
        }

        $('#f_name').bind('keypress', testInput);


    </script>

    <script type="text/javascript">

        $(function() { 
            $('#residing_year').datepicker( {
                yearRange: "c-30:c",
                changeDate: false,
                changeMonth: false,
                changeYear: true,
                showButtonPanel: true, 
                closeText:'Select',
                currentText: 'This year',
                onClose: function(dateText, inst) {
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).val($.datepicker.formatDate("yy", new Date(year, 0, 1)));
                },
                beforeShow: function(input, inst){
                if ($(this).val()!=''){
                    var tmpyear = $(this).val();
                    $(".ui-datepicker-month").hide();
                    $(".ui-datepicker-calendar").hide();
                    $(this).datepicker('option','defaultDate',new Date(tmpyear, 0, 1));
                }
                }
            }).focus(function () {
                $(".ui-datepicker-month").hide();
                $(".ui-datepicker-calendar").hide();
                $(".ui-datepicker-current").hide();
                $(".ui-datepicker-prev").hide();
                $(".ui-datepicker-next").hide();
                // $("#ui-datepicker-div").position({
                // my: "left top",
                // at: "left bottom",
                // of: $(this)
                // });
            }).attr("readonly", false);
        });
                
        $("#residing_year").blur(function(){
            $('#residing_year').removeClass('error');
            $('#residing_year-error').hide();
        });

    </script>
   
</body>

</html>