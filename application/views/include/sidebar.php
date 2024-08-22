<div class="nk-sidebar">           
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu"> 
            <li class="nav-label"><i class="fa fa-user-circle-o"> Welcome !</i>
				<span class="mt-3 mb-2" style="font-family:'Courier New'"><?php echo $this->session->userdata('username'); ?></span>
            </li>
            <!--menu for CC-->
            <?php if ($this->session->userdata('role') == "CC"){  ?>
            <li>
                <a class="franchisee_form" href="<?php echo base_url(); ?>index.php/cc/franchisee_form">
                    <i class="icon-note menu-icon"></i>
                    <span class="nav-text">Franchisee Form</span>
                </a>
            </li> 
            <li> 
                <a class="entered_form" href="<?php echo base_url(); ?>index.php/cc/entered_form">
                    <i class="icon-menu menu-icon"></i>
                    <span class="nav-text">Entered Forms
                        <span class="badge badge-pill badge-outline-primary" id="cc_entered_details"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="funneled_form" href="<?php echo base_url(); ?>index.php/cc/funneled_form_view">
                    <i class="fa fa-filter"></i>
                    <span class="nav-text">Funnel Form
                        <span class="badge badge-pill badge-outline-primary" id="cc_funnel_details"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="customer_entered_form" href="<?php echo base_url(); ?>index.php/cc/customer_entered_form">
                    <i class="icon-menu menu-icon"></i>
                    <span class="nav-text">Customer Entered Form
                        <span class="badge badge-pill badge-outline-primary" id="cus_entered_details"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="customer_funneled_form" href="<?php echo base_url(); ?>index.php/cc/customer_funneled_form">
                <i class="fa fa-filter"></i>
                <span class="nav-text">Customer Funnel Form
                    <span class="badge badge-pill badge-outline-primary" id="cus_funnel_details"></span>
                </span>
                </a>
            </li>
            <?php } ?>
            <!--menu for CC-->

            <!-- menu for CT -->
            <?php if ($this->session->userdata('role') == "CT"){  ?>
            <li>
                <a class="entered_form" href="<?php echo base_url(); ?>index.php/ct/entered_form">
                    <i class="icon-menu menu-icon"></i>
                    <span class="nav-text">CC Entered Forms
                        <span class="badge badge-pill badge-outline-primary" id="cc_entered_details"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="ct_updated_form" href="<?php echo base_url(); ?>index.php/ct/ct_updated_form">
                    <i class="icon-check menu-icon"></i>
                    <span class="nav-text">CT Verified
                        <span class="badge badge-pill badge-outline-primary" id="ct_verified_details"></span>
                    </span>
                </a> 
            </li>
            <li>
                <a class="funneled_form" href="<?php echo base_url(); ?>index.php/ct/funneled_form_view">
                    <i class="fa fa-filter"></i>
                    <span class="nav-text">Funnel Form
                        <span class="badge badge-pill badge-outline-primary" id="ct_funnel_details"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="sh_approved_form" href="<?php echo base_url(); ?>index.php/ct/ct_doc_upload">
                    <i class="icon-check menu-icon"></i>
                    <span class="nav-text">
                        CT Doc Upload
                        <span class="badge badge-pill badge-outline-primary" id="ct_upload_details"></span>
                    </span>
                </a>
            </li>
            <!-- <li>
                <a class="post_upload_form" href="<?php echo base_url(); ?>index.php/ct/post_upload_form">
                    <i class="icon-check menu-icon"></i>
                    <span class="nav-text">
                        CT Post Upload
                    </span>
                </a>
            </li> -->
            <li>
                <a class="sales_admin_rejected" href="<?php echo base_url(); ?>index.php/common/sa_rejected_form">
                <i class="icon-ban menu-icon"></i>
                    <span class="nav-text">
                        SA Rejected Forms
                        <span class="badge badge-pill badge-outline-primary" id="sa_rejected_count"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="mt_uploaded_form" href="<?php echo base_url(); ?>index.php/ct/mt_uploaded_form">
                    <i class="fa fa-list-alt"></i>
                    <span class="nav-text">
                        MT Upoladed Form
                        <span class="badge badge-pill badge-outline-primary" id="mt_upload_details"></span>
                    </span>
                </a>
            </li>

            <?php } ?>
            <!-- end menu for CT -->
                         
            <!-- menu for RSM -->
            <?php if ($this->session->userdata('role') == "RSM"){  ?>
            <li>
                <a class="login_type" href="<?php echo base_url(); ?>index.php/rsm/login_type">
                    <i class="fa fa-home"></i>
                    <span class="nav-text">Home</span>
                </a>
            </li>
            <li>
                <a class="entered_form" href="<?php echo base_url(); ?>index.php/rsm/entered_form">
                    <i class="icon-menu menu-icon"></i>
                    <span class="nav-text">
                        CT Entered Forms
                        <span class="badge badge-pill badge-outline-primary" id="ct_entered_details"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="approved_form" href="<?php echo base_url(); ?>index.php/rsm/approved_form">
                    <i class="icon-check menu-icon"></i>
                    <span class="nav-text">
                        Approved Forms
                        <span class="badge badge-pill badge-outline-primary" id="rsm_approved_details"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="rejected_form" href="<?php echo base_url(); ?>index.php/rsm/rejected_form">
                    <i class="icon-ban menu-icon"></i>
                    <span class="nav-text">
                        Future Prospects Forms
                        <span class="badge badge-pill badge-outline-primary" id="rsm_rejected_details"></span>
                    </span>
                </a>
            </li>
           
           
            <?php } ?>
            <!-- end menu for RSM --> 

            <!-- menu for OPERATION MANAGER -->
            <?php if ($this->session->userdata('role') == "OM"){  ?>
            <li>
                <a class="login_type" href="<?php echo base_url(); ?>index.php/opm/login_type">
                    <i class="fa fa-home"></i>
                    <span class="nav-text">Home</span>
                </a>
            </li>
            <li>
                <a class="entered_form" href="<?php echo base_url(); ?>index.php/opm/entered_form">
                    <i class="icon-menu menu-icon"></i>
                    <span class="nav-text">
                        RSM Entered Forms
                        <span class="badge badge-pill badge-outline-primary" id="rsm_entered_form_count"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="approved_form" href="<?php echo base_url(); ?>index.php/opm/approved_form">
                    <i class="icon-check menu-icon"></i>
                    <span class="nav-text">
                        Approved Forms
                        <span class="badge badge-pill badge-outline-primary" id="opm_approved_details"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="rejected_form" href="<?php echo base_url(); ?>index.php/opm/rejected_form">
                    <i class="icon-ban menu-icon"></i>
                    <span class="nav-text">
                        Future Prospects Forms
                        <span class="badge badge-pill badge-outline-primary" id="opm_rejected_details"></span>
                    </span>
                </a>
            </li>
           
           
            <?php } ?>
            <!-- end menu for OPERATION MANAGER -->

            <!-- menu for Idhaya -->
            <?php if ($this->session->userdata('role') == "IDHAYA"){  ?>
            <li>
                <a class="login_type" href="<?php echo base_url(); ?>index.php/cidhaya/login_type">
                    <i class="fa fa-home"></i>
                    <span class="nav-text">Home</span>
                </a>
            </li>
            <li>
                <a class="entered_form" href="<?php echo base_url(); ?>index.php/cidhaya/entered_form">
                    <i class="icon-menu menu-icon"></i>
                    <span class="nav-text">
                        RSM Entered Forms
                        <span class="badge badge-pill badge-outline-primary" id="rsm_entered_details"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="approved_form" href="<?php echo base_url(); ?>index.php/cidhaya/approved_form">
                    <i class="icon-check menu-icon"></i>
                    <span class="nav-text">
                        Approved Forms
                        <span class="badge badge-pill badge-outline-primary" id="idhaya_approved_details"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="rejected_form" href="<?php echo base_url(); ?>index.php/cidhaya/rejected_form">
                    <i class="icon-ban menu-icon"></i>
                    <span class="nav-text">
                        Future Prospects Forms
                        <span class="badge badge-pill badge-outline-primary" id="idhaya_rejected_details"></span>
                    </span>
                </a>
            </li>
           
           
            <?php } ?>
            <!-- end menu for Idhaya -->

            <!-- menu for SH -->
            <?php if ($this->session->userdata('role') == "SH"){  ?>
            <li>
                <a class="login_type" href="<?php echo base_url(); ?>index.php/sh/login_type">
                    <i class="fa fa-home"></i>
                    <span class="nav-text">Home</span>
                </a>
            </li>
            <li>
                <a class="entered_form" href="<?php echo base_url(); ?>index.php/sh/entered_form">
                    <i class="icon-menu menu-icon"></i>
                    <span class="nav-text">
                        Entered Forms
                        <span class="badge badge-pill badge-outline-primary" id="ct_entered_details"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="approved_form" href="<?php echo base_url(); ?>index.php/sh/approved_form">
                    <i class="icon-check menu-icon"></i>
                    <span class="nav-text">
                        Approved Forms
                        <span class="badge badge-pill badge-outline-primary" id="sh_approved_details"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="rejected_form" href="<?php echo base_url(); ?>index.php/sh/rejected_form">
                    <i class="icon-ban menu-icon"></i>
                    <span class="nav-text">
                        Future Prospects Forms
                        <span class="badge badge-pill badge-outline-primary" id="sh_rejected_details"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="ct_uploaded_form" href="<?php echo base_url(); ?>index.php/sh/ct_uploaded_form">
                <i class="icon-menu menu-icon"></i>
                    <span class="nav-text">
                        CT Doc Upoladed Forms
                        <span class="badge badge-pill badge-outline-primary" id="ct_uploaded_details"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="onboarding_doc_approved_form" href="<?php echo base_url(); ?>index.php/sh/onboarding_doc_approved_form">
                <i class="icon-menu menu-icon"></i>
                    <span class="nav-text">
                        Doc Approved Forms
                        <span class="badge badge-pill badge-outline-primary" id="onboarding_dcount"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="sales_admin_rejected" href="<?php echo base_url(); ?>index.php/common/sa_rejected_form">
                <i class="icon-ban menu-icon"></i>
                    <span class="nav-text">
                        SA Rejected Forms
                    <span class="badge badge-pill badge-outline-primary" id="sa_rejected_count"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="mt_uploaded_form" href="<?php echo base_url(); ?>index.php/sh/mt_uploaded_form">
                    <i class="fa fa-list-alt"></i>
                    <span class="nav-text">
                        MT Upoladed Forms
                        <span class="badge badge-pill badge-outline-primary" id="mt_uploaded_details"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="funneled_form" href="<?php echo base_url(); ?>index.php/sh/funneled_form_view">
                    <i class="fa fa-filter"></i>
                    <span class="nav-text">
                        Funnel Forms
                        <span class="badge badge-pill badge-outline-primary" id="cc_funnel_details"></span>
                    </span>
                </a>
            </li>
            <?php } ?>
            <!-- end menu for SH -->
            
            <!-- menu for SA -->
            <?php if ($this->session->userdata('role') == "SA"){  ?>

            <li>
                <a class="login_type" href="<?php echo base_url(); ?>index.php/sa/login_type">
                    <i class="fa fa-home"></i>
                    <span class="nav-text">Home</span>
                </a>
            </li>
            <li>
                <a class="code_pending_form" href="<?php echo base_url(); ?>index.php/sa/code_pending_form">
                    <i class="fa fa-list-alt"></i>
                    <span class="nav-text">
                        Code Creation SPOC
                        <span class="badge badge-pill badge-outline-primary" id="sa_code_pending"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="code_created_form" href="<?php echo base_url(); ?>index.php/sa/code_created_form">
                    <i class="icon-check menu-icon"></i>
                    <span class="nav-text">
                        Code Created SPOC
                        <span class="badge badge-pill badge-outline-primary" id="sa_code_created"></span>
                    </span>
                </a> 
            </li>
            <li>
                <a class="sales_admin_rejected" href="<?php echo base_url(); ?>index.php/sa/sa_rejected_form">
                <i class="icon-ban menu-icon"></i>
                    <span class="nav-text">
                        Rejected Forms
                        <span class="badge badge-pill badge-outline-primary" id="sa_rejected_count"></span>
                    </span>
                </a>
            </li>
            <?php } ?>

            <!-- menu for SA -->

            <!-- menu for TT -->

            <?php if ($this->session->userdata('role') == "TT"){  ?>
            <li>
                <a class="tt_approve_form" href="<?php echo base_url(); ?>index.php/tt/approve_form">
                    <i class="fa fa-list-alt"></i>
                    <span class="nav-text">
                        CT -ONBOARD DOC
                        <span class="badge badge-pill badge-outline-primary" id="tt_approve_details"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="scored_form" href="<?php echo base_url(); ?>index.php/tt/scored_form">
                    <i class="fa fa-list-alt"></i>
                    <span class="nav-text">
                        Completed Assessment
                        <span class="badge badge-pill badge-outline-primary" id="scored_form_count"></span>
                    </span>
                </a>
            </li>
            <?php } ?>
            <!-- menu for TT -->

            <!-- menu for MT -->

            <?php if ($this->session->userdata('role') == "MT"){  ?>
            <li>
                <a class="mt_approved_form" href="<?php echo base_url(); ?>index.php/mt/approved_form">
                    <i class="fa fa-list-alt"></i>
                    <span class="nav-text">
                        Mt Upload Form
                        <span class="badge badge-pill badge-outline-primary" id="mt_upload_details"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="uploaded_view" href="<?php echo base_url(); ?>index.php/mt/uploaded_view">
                    <i class="fa fa-list-alt"></i>
                    <span class="nav-text">
                        Mt Upoladed Form View
                        <span class="badge badge-pill badge-outline-primary" id="mt_uploaded_details"></span>
                    </span>
                </a>
            </li>
            <?php } ?>
            <!-- menu for MT -->

            <!-- menu for MARKETING PERSON -->

            <?php if ($this->session->userdata('role') == "MP"){  ?>
            <li>
                <a class="franchisee_form" href="<?php echo base_url(); ?>index.php/mp/franchise_form">
                    <i class="icon-note menu-icon"></i>
                    <span class="nav-text">
                        Franchise Form
                    </span>
                </a>
            </li>
            <li>
                <a class="entered_form" href="<?php echo base_url(); ?>index.php/mp/entered_form">
                    <i class="fa fa-list-alt"></i>
                    <span class="nav-text">
                       Entered Forms
                        <span class="badge badge-pill badge-outline-primary" id="mp_entered"></span>
                    </span>
                </a>
            </li>
            <?php } ?>
            <!-- menu for MARKETING PERSON -->

            <li>
                <a href="<?php echo base_url(); ?>index.php/common/change_password"><i class="icon-lock"></i> <span class="nav-text">Change Password</span></a>
            </li>
                
            <li>
                <a href="<?php echo base_url(); ?>index.php/LoginController/logout"><i class="icon-key"></i> <span class="nav-text">Logout</span></a>
            </li>
        </ul>
        <!-- <ul class="metismenu navbar pt-3 nav-text" id="expands">
            <li class="ml-2">
                <span class="row"><b class="col-1">FCC</b><em class="col-9">- ( Franchise Code Creation -Status ) </em></span>
                <span class="row"><b class="col-1">CC </b><em class="col-9">- ( Call Center Person ) </em></span>
                <span class="row"><b class="col-1">MT </b><em class="col-9">- ( Maintenance Team ) </em></span>
                <span class="row"><b class="col-1">TT </b><em class="col-9">- ( Training Team ) </em></span>
                <span class="row"><b class="col-1">CT </b><em class="col-9">- ( Cluster Team ) </em></span>
                <span class="row"><b class="col-1">SA </b><em class="col-9">- ( Sales Admin ) </em></span>
                <span class="row"><b class="col-1">SH </b><em class="col-9">- ( Nethaji ) </em></span><br>
            </li>
        </ul> -->
        <br>
    </div>
        
</div>
<style>
   
    @media only screen and (min-width: 1030px) {
        .navbar#expands {
            overflow: hidden;
            background-color: #e4e6e787;
            position: fixed;
            bottom: 0;
        }
    }

    /* @media only screen and (max-width:1020px)  {
        .navbar#expands {
            overflow: hidden;
            background-color: #e4e6e787;
            position: absolute;
            bottom: 0;
        }
    }   */

    .badge-outline-primary {
        color: #405189;
        border: 1px solid #405189
    }

    .navbar#expands {
        font-size: 85%;
    }

    
</style>

        