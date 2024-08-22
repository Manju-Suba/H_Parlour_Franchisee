<div class="nav-header">
    <div class="brand-logo">
        <a href = "<?php echo base_url();?>index.php/Common/do_logo">
            <b class="logo-abbr"><img src="<?php echo asset_url();?>images/logo.png" alt=""> </b>
            <span class="logo-compact"><img src="<?php echo asset_url();?>images/logo-compact.png" alt=""></span>
            <span class="brand-title">
                <img src="<?php echo asset_url();?>images/logo-text.png" alt="">
            </span>
        </a>
    </div>
</div>
 
<div class="header">    
    <div class="header-content clearfix">
        
        <div class="nav-control">
            <div class="hamburger">
                <span class="toggle-icon"><i class="icon-menu"></i></span>
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
                <?php if ($this->session->userdata('role') == "CC"){  ?>
                    <li class="icons dropdown">
                        <!-- <span id='ct7' style="background-color:;"></span> -->
                        <a type="button" target="blank" title="Share Open form link here!" href="<?php echo base_url(); ?>index.php/register_page" class="btn btn-primary btn-s pt-1 mb-2"><i class="fa fa-share-alt"></i></a>
                    </li>&nbsp;

                    <style>
                        .header-right .icons > a {
                            color: #e2e5ed;
                        }

                        .header-right .icons {
                            padding: 0 0.5125rem;
                        }

                        .icons > a i {
                            font-size: 1.25rem;
                            color: #0b0c0c;
                        }
                        .btn-primary.btn-s {
                            color: #fff;
                            background-color: #d9d9e9;
                            border-color: #7571f9;
                        }
                    </style>
                <?php } ?>
                <li class="icons dropdown" style="width:70px;">
                    <div class="user-img c-pointer position-relative" title="click me!" data-toggle="dropdown">
                        <span class="activity active"></span>
                        <img src="<?php echo asset_url();?>images/user/form-user.png" height="40" width="40" alt="">
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

<style>

    .header-right .icons .user-img img:hover {
        height: 45px;
        width: 45px;
        border: 3px solid #fff;
        border-radius: 50%;
        margin: 0;
        padding: 0;
        box-shadow: 0px 0px 20px 0px rgb(0 0 0 / 10%);
    }

    /* li .c-pointer:hover {
            color: #fff;
            font-size: 15px;
        } */

</style>

