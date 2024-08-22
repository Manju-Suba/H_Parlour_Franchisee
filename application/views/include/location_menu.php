<div class="nk-sidebar">           
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu"> 
            <li class="nav-label">
                <u><?php echo $this->session->userdata('username'); ?> </u>
                <!-- <!?php echo $this->session->userdata('role'); ?></u> <!?php if($this->session->userdata('business')!=""){ ?>( <!?php echo $this->session->userdata('business');?> ) <!?php } ?> -->
            </li>

            <!--menu for SH-->
            <?php if ($this->session->userdata('role') == "SA"){  ?>
            <li>
                <a class="login_type" href="<?php echo base_url(); ?>index.php/sa/login_type">
                    <i class="fa fa-home"></i>
                    <span class="nav-text">Home
                    </span>
                </a>
            </li>
            <li>
                <a class="location_table" href="<?php echo base_url(); ?>index.php/sa/location_table">
                    <i class="fa fa-map"></i>
                    <span class="nav-text">Locations
                        <span class="badge badge-pill badge-outline-primary" id="sa_lt_count"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="location_table" href="<?php echo base_url(); ?>index.php/sa/allocate_location">
                    <i class="fa fa-map-marker"></i>
                    <span class="nav-text">Allocate Location
                        <span class="badge badge-pill badge-outline-primary" id="allocate_location_count"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="final_locations" href="<?php echo base_url(); ?>index.php/sa/final_locations">
                    <i class="fa fa-map-marker" style="color:green;"></i>
                    <span class="nav-text">Final Locations
                        <span class="badge badge-pill badge-outline-primary" id="final_location_sa"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="final_locations" href="<?php echo base_url(); ?>index.php/sa/sa_final_locations">
                    <i class="fa fa-map-marker" style="color:green;"></i>
                    <span class="nav-text">Doc Uploaded Locations
                        <span class="badge badge-pill badge-outline-primary" id="sa_final_location_count"></span>
                    </span>
                </a>
            </li>
            
            <?php } ?>

            
            <?php if ($this->session->userdata('role') == "REP"){  ?>
            <li>
                <a class="entered_form" href="<?php echo base_url(); ?>index.php/rep/location_table">
                    <i class="fa fa-map"></i>
                    <span class="nav-text">
                        Locations
                        <span class="badge badge-pill badge-outline-primary" id="location_rep"></span>
                    </span>
                </a>
            </li>
                <li>
                <a class="entered_form" href="<?php echo base_url(); ?>index.php/rep/completed_table">
                    <i class="fa fa-map-marker" style="color:green;"></i>
                    <span class="nav-text">Completed Locations
                        <span class="badge badge-pill badge-outline-primary" id="completed_location_rep"></span>
                    </span>
                </a>
            </li>
            <?php } ?>


            <!-- Operation Manager sidebar menu start -->
            <?php if ($this->session->userdata('role') == "OM"){  ?>
            <li>
                <a class="login_type" href="<?php echo base_url(); ?>index.php/opm/login_type">
                    <i class="fa fa-home"></i>
                    <span class="nav-text">Home
                    </span>
                </a>
            </li>
            <li>
                <a class="completed_location" href="<?php echo base_url(); ?>index.php/opm/completed_location">
                    <i class="fa fa-map-marker" style="color:blue;"></i>
                    <span class="nav-text">Completed Locations
                        <span class="badge badge-pill badge-outline-primary" id="completed_location_rep"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="approved_location" href="<?php echo base_url(); ?>index.php/opm/approved_location">
                    <i class="fa fa-map-marker" style="color:green;"></i>
                    <span class="nav-text">Approved Locations
                        <span class="badge badge-pill badge-outline-primary" id="app_location_om"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="rejected_location" href="<?php echo base_url(); ?>index.php/opm/rejected_location">
                    <i class="icon-ban menu-icon"></i>
                    <span class="nav-text">Future Prospects
                        <span class="badge badge-pill badge-outline-primary" id="rej_location_om"></span>
                    </span>
                </a>
            </li>
            
            <?php } ?>
            <!-- Operation Manager sidebar menu end -->


            <!-- RSM sidebar menu start -->
            <?php if ($this->session->userdata('role') == "RSM"){  ?>
            <li>
                <a class="login_type" href="<?php echo base_url(); ?>index.php/rsm/login_type">
                    <i class="fa fa-home"></i>
                    <span class="nav-text">Home</span>
                </a>
            </li>
            <li>
                <a class="om_approved_location" href="<?php echo base_url(); ?>index.php/rsm/om_approved_location">
                    <i class="fa fa-map-marker" style="color:blue;"></i>
                    <span class="nav-text">OM Approved Locations
                        <span class="badge badge-pill badge-outline-primary" id="completed_location_om"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="approved_location" href="<?php echo base_url(); ?>index.php/rsm/approved_location">
                    <i class="fa fa-map-marker" style="color:green;"></i>
                    <span class="nav-text">Approved Locations
                        <span class="badge badge-pill badge-outline-primary" id="app_location_rsm"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="rejected_location" href="<?php echo base_url(); ?>index.php/rsm/rejected_location">
                    <i class="icon-ban menu-icon"></i>
                    <span class="nav-text">Future Prospects
                        <span class="badge badge-pill badge-outline-primary" id="rejected_location_rsm"></span>
                    </span>
                </a>
            </li>
            <?php } ?>
            <!--RSM sidebar menu end -->

            <!-- Idhaya sidebar menu start -->
            <?php if ($this->session->userdata('role') == "IDHAYA"){  ?>
            <li>
                <a class="login_type" href="<?php echo base_url(); ?>index.php/cidhaya/login_type">
                    <i class="fa fa-home"></i>
                    <span class="nav-text">Home
                    </span>
                </a>
            </li>
            <li>
                <a class="entered_form" href="<?php echo base_url(); ?>index.php/cidhaya/completed_location">
                    <i class="fa fa-map-marker" style="color:blue;"></i>
                    <span class="nav-text">Completed Locations
                        <span class="badge badge-pill badge-outline-primary" id="completed_location_rsmi"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="approved_location" href="<?php echo base_url(); ?>index.php/cidhaya/approved_location">
                    <i class="fa fa-map-marker" style="color:green;"></i>
                    <span class="nav-text">Approved Locations
                        <span class="badge badge-pill badge-outline-primary" id="capp_location_count"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="rejected_location" href="<?php echo base_url(); ?>index.php/cidhaya/rejected_location">
                    <i class="icon-ban menu-icon"></i>
                    <span class="nav-text">Future Prospects
                        <span class="badge badge-pill badge-outline-primary" id="crej_location_count"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="entered_form" href="<?php echo base_url(); ?>index.php/cidhaya/final_locations">
                    <i class="fa fa-map-marker" style="color:green;"></i>
                    <span class="nav-text">Final Locations
                        <span class="badge badge-pill badge-outline-primary" id="final_location_rsmi"></span>
                    </span>
                </a>
            </li>
            
            <?php } ?>
            <!-- Idhaya sidebar menu end -->


            <!--menu for SH-->
            <?php if ($this->session->userdata('role') == "SH"){  ?>
            <li>
                <a class="login_type" href="<?php echo base_url(); ?>index.php/sh/login_type">
                    <i class="fa fa-home"></i>
                    <span class="nav-text">Home
                    </span>
                </a>
            </li>
            <li>
                <a class="completed_location" href="<?php echo base_url(); ?>index.php/sh/completed_location">
                    <i class="fa fa-map-marker" style="color:blue;"></i>
                    <span class="nav-text">Completed Locations
                        <span class="badge badge-pill badge-outline-primary" id="completed_location_count"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="final_locations" href="<?php echo base_url(); ?>index.php/sh/final_locations">
                    <i class="fa fa-map-marker" style="color:green;"></i>
                    <span class="nav-text">Final Locations
                        <span class="badge badge-pill badge-outline-primary" id="final_location_count"></span>
                    </span>
                </a>
            </li>
            <li>
                <a class="future_prospects" href="<?php echo base_url(); ?>index.php/sh/future_prospects">
                    <i class="icon-ban menu-icon"></i>
                    <span class="nav-text">Future Prospects
                        <span class="badge badge-pill badge-outline-primary" id="rejected_location_count"></span>
                    </span>
                </a>
            </li>
            <?php } ?>
            <!-- SH sidebar menu end -->
                


            <li>
                <a href="<?php echo base_url(); ?>index.php/LoginController/logout"><i class="icon-key"></i> <span class="nav-text">Logout</span></a>
            </li>
        </ul>
    </div>
</div>


<style>
    .badge-outline-primary {
        color: #405189;
        border: 1px solid #405189
    }
 
</style>