<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" id="edit_pop_trigger" data-toggle="modal" data-target="#edit_distributor_pop" style="display:none;">Open Modal</button>

<!-- Modal -->
<!-- <div id="edit_distributor_pop" class="modal fade" data-backdrop="static" role="dialog"> -->
<div id="edit_distributor_pop" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
 
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid"> 
                    <div class="row"> 
                        <div class="col-md-12">
                            <form class="step-form-horizontal pop_edit_form" action="javascript:void(0)"  enctype="multipart/form-data" id="step-form-horizontal" data-parsley-validate method="post" autocomplete="off">
                                <div>
                                    <h4>Details of Individual</h4>
                                    <section style="padding-top:0; max-height: calc(100vh - 210px);overflow-y: auto;" class="current">
                                        <br>
                                        <input type="hidden" id="id" name="id">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Name <span style="color:red;">*</span></label>
                                                    <input type="text" name="name" class="form-control readonly" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="SubD Proprietor Name" id="name" required readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="">Email <span style="color:red;">*</span></label>
                                                    <input type="email" name="email" id="email" class="form-control readonly" placeholder="Enter your email ..." required readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Mobile <span style="color:red;">*</span></label>
                                                    <input type="text" name="mobile" id="mobile" minlength="10" maxlength="10" oninput="mobileValid();" class="form-control" placeholder="Mobile" required mas>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Whatsapp No. <span style="color:red;">*</span></label>
                                                    <input type="text" name="whatsapp_no" id="whatsapp_no" minlength="10" maxlength="10" oninput="mobileValid_2();" class="form-control" required mas>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Landline(OPT)</label>
                                                    <input type="text" name="landline" id="landline" minlength="10" maxlength="12" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" placeholder="Landline" >
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group mt-2">
                                                    <p>Gender  <span style="color:red;">*</span></p>
                                                    <div class="row ml-2">
                                                        <input type="radio" id="gender" name="gender" value="Male" required>&nbsp;
                                                        <p >Male</p><br>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" id="gender2" name="gender" value="Female" required>&nbsp;
                                                        <p >Female</p><br>&nbsp;
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-lg-6">
                                                <div class="form-group mt-2">
                                                    <p>Marital Status  <span style="color:red;">*</span></p>
                                                    <div class="row ml-2">
                                                        <input type="radio" id="marital_status" name="marital_status" value="Married" required>&nbsp;
                                                        <p >Married</p><br>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" id="marital_status2" name="marital_status" value="Unmarried" required>&nbsp;
                                                        <p >Unmarried</p><br>&nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">  
                                                <div class="form-group mt-2">
                                                    <p>Language  <span style="color:red;">*</span></p>
                                                    <div class="row ml-2">
                                                        <input type="radio" id="language" name="language" value="English" required>&nbsp;
                                                        <p >English</p><br>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" id="language2" name="language" value="Tamil" required>&nbsp;
                                                        <p >Tamil</p><br>&nbsp;
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="col-lg-6">
                                                <div class="form-group mt-2">
                                                    <p>Occupation  <span style="color:red;">*</span></p>
                                                    <div class="row ml-1">
                                                        <input type="radio" id="occupation" name="occupation" value="Self run business" required>&nbsp;
                                                        <p >Self run business</p><br>&nbsp;&nbsp;&nbsp;
                                                        <input type="radio" id="occupation2" name="occupation" value="Employee" required>&nbsp;
                                                        <p >Employee</p><br>&nbsp;
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Educational Qualification <span style="color:red;">*</span></label>
                                                    <select name="education_q" id="education_q" class="form-control c-pointer">
                                                        <option value="">Select Education </option>
                                                        <option value="10th">10th</option>
                                                        <option value="12th">12th</option>
                                                        <option value="Degree Holder">Degree Holder</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Individual's Monthly Income<span style="color:red;">*</span></label>
                                                    <input type="number" name="monthly_income" id="monthly_income" onkeydown="return event.keyCode !== 69" class="form-control" placeholder="₹" required>
                                                </div>
                                            </div> 
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Family's total Monthly Income <span style="color:red;">*</span></label>
                                                    <input type="number" name="family_income" id="family_income" onkeydown="return event.keyCode !== 69" class="form-control" placeholder="₹" required>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group state_select">
                                                    <label for="">State</label>
                                                    <select name="shop_sate" id="shop_sate" class="form-control c-pointer" required>
                                                        <option value="">Select State</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group district_select">
                                                    <label for="">District</label>
                                                    <select id="shop_city" name="shop_city" id="shop_city" class="form-control c-pointer" required>
                                                        <option value="">Select District</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group town_select">
                                                    <label for="">Town</label>
                                                    <select id="shop_town" name="shop_town" class="form-control c-pointer" required>
                                                        <option value="">Select Town</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Town Code</label>
                                                    <input type="text" name="town_code" id="town_code" class="form-control readonly" placeholder="Town Code" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Population</label>
                                                    <input type="text" name="population" id="population" class="form-control readonly" placeholder="Population" readonly>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label for="">Address</label>
                                                    <textarea name="address" id="address" class="form-control" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" placeholder="Address" required></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-3"> 
                                                <div class="form-group">
                                                    <label for="">Pincode <span style="color:red;">*</span></label>
                                                    <input type="text" name="pincode" id="pincode" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="6" minlength="6" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-3"> 
                                                <div class="form-group">
                                                    <label for="">Residing since : (year) <span style="color:red;">*</span></label>
                                                    <input type="text" name="residing_year" id="residing_year" class="form-control readonly" required readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-3"> 
                                                <div class="form-group">
                                                    <label for="">Sourced By(Optional)</label>
                                                    <select name="sourced_by" id="sourced_by" class="form-control c-pointer" >
                                                        <option value="">Select</option>
                                                        <option value="Advertisement">Advertisement</option>
                                                        <option value="Facebook">Facebook</option>
                                                        <option value="WhatsApp">WhatsApp</option>
                                                        <option value="Newspaper">Newspaper</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-3"> 
                                                <div class="form-group">
                                                    <label for="">Referred Person(Optional)</label>
                                                    <input type="text" id="referred_person" name="referred_person" class="form-control" placeholder="Enter Referred Person">
                                                </div>
                                            </div>

                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                    </section>
                                    <h4>FRC</h4>
                                    <section style="padding-top:0; max-height: calc(100vh - 210px);overflow-y: auto;">
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
                                                <td class="row ml-1"> <input type="radio" id="area" name="area" value="5" required>&nbsp;
                                                    <p >Yes</p><br>&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" id="area2" name="area" value="0" required>&nbsp;
                                                    <p >No</p><br>&nbsp;
                                                </td>
                                                <td class="col-3">
                                                    <!-- <label><p>km difference</p></label> -->
                                                    <textarea name="area_remark" id="area_remark" class="form-control" rows="2" placeholder="Find out Km difference..." ></textarea>
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="if_any_remark1" id="if_any_remark1" class="form-control" rows="2" placeholder="If any remarks write here.." ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2.</td>
                                                <td>Age criteria 30 to 35 yrs</td>
                                                <td class="row ml-1"> <input type="radio" id="age" name="age" value="5" required>&nbsp;
                                                    <p >Yes</p><br>&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" id="age2" name="age" value="0" required>&nbsp;
                                                    <p >No</p><br>&nbsp;
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="age_remark" id="age_remark" class="form-control" rows="2" placeholder="Deviation in age in years..." ></textarea>
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="if_any_remark2" id="if_any_remark2" class="form-control" rows="2" placeholder="If any remarks write here.." ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>Should not do any other employment</td>
                                                <td class="row ml-1"> <input type="radio" id="business" name="business" value="10" required>&nbsp;
                                                    <p >Yes</p><br>&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" id="business2" name="business" value="0" required>&nbsp;
                                                    <p >No</p><br>&nbsp;
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="business_remark" id="business_remark" class="form-control" rows="2" placeholder="both yes & no - remarks mandatory.." ></textarea>
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="if_any_remark3" id="if_any_remark3" class="form-control" rows="2" placeholder="Fill the crisp summary of family earning history.." ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td>Should consider as a first income and family business</td>
                                                <td class="row ml-1"> <input type="radio" id="family_busi" name="family_busi" value="10" required>&nbsp;
                                                    <p >Yes</p><br>&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" id="family_busi2" name="family_busi" value="0" required>&nbsp;
                                                    <p >No</p><br>&nbsp;
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="family_busi_remark" id="fb_remark" class="form-control" rows="2" placeholder="both yes & no - remarks mandatory.." ></textarea>
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="if_any_remark4" id="if_any_remark4" class="form-control" rows="2" placeholder="Explain why it will not be 1st income or family business.." ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>5.</td>
                                                <td>Willing to work 365 days, 4 a.m onwards </td>
                                                <td class="row ml-1"> <input type="radio" id="busi_time" name="busi_time" value="20" required>&nbsp;
                                                    <p >Yes</p><br>&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" id="busi_time2" name="busi_time" value="0" required>&nbsp;
                                                    <p >No</p><br>&nbsp;
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="time_remark" id="time_remark" class="form-control" rows="2" placeholder="both yes & no - remarks mandatory.." ></textarea>
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="if_any_remark5" id="if_any_remark5" class="form-control" rows="2" placeholder="If any remarks write here.." ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>6.</td>
                                                <td>Previous experience in milk & related products distribution & management</td>
                                                <td class="row ml-1"> <input type="radio" id="pro_management" name="pro_management" value="10" required>&nbsp;
                                                    <p >Yes</p><br>&nbsp;&nbsp;&nbsp;
                                                    <input type="radio" id="pro_management2" name="pro_management" value="0" required>&nbsp;
                                                    <p >No</p><br>&nbsp;
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="pro_manage_remark" id="pro_manage_remark" class="form-control" rows="2" placeholder="both yes & no - remarks mandatory.." ></textarea>
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="if_any_remark6" id="if_any_remark6" class="form-control" rows="2" placeholder="If any remarks write here.." ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>7.</td>
                                                <td>If chosen as Franchisee, who is the support system</td>
                                                <td>
                                                    <input name="sperson_age" id="sperson_age" class="form-control" placeholder=" Age of the support person" >
                                                </td>
                                                <td class="col-3">
                                                    <select name="relation" id="relation" class="form-control c-pointer" required>
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
                                                    <textarea name="if_any_remark7" id="if_any_remark7" class="form-control" rows="2" placeholder="If any remarks write here.." ></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>8.</td>
                                                <td>Expected income from this H Parlour business If appointed as FRC</td>
                                                <td> 
                                                    <input type="text" name="expect_income" id="expect_income" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" placeholder="Below 6 months" minlength="4" required>
                                                </td>
                                                <td class="col-3" style="text-align: center;">
                                                    <input type="text" name="expect_income1" id="expect_income1" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" class="form-control" placeholder="After 6 months" minlength="4" required>
                                                </td>
                                                <td class="col-3">
                                                    <textarea name="if_any_remark8" id="if_any_remark8" class="form-control" rows="2" placeholder="If any remarks write here.." ></textarea>
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
                                                    <select name="cluster_id" id="cluster_id" class="form-control c-pointer" required>
                                                        <option value="">Select Cluster</option>
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
                                            <div class="col-lg-4"></div>
                                            <div class="col-lg-4" style="text-align:center;">
                                                <button type="button" id="save_form" class="btn mb-1 btn-primary"><b>Save</b></button>
                                                <button type="submit" id="form_submit_btn" class="btn mb-1 btn-success"><b>Submit</b></button>
                                            </div>
                                            <div class="col-lg-4"> <div id="form_resp"></div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                </section>
                                </div>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .form-group .form-control.readonly {
        cursor: not-allowed;
    }

    #cluster_id,#sourced_by{
        cursor: pointer;
    }
    
    p {
        margin-top: 0.7rem;
        margin-bottom: 0.5rem;
    }

    .wizard .content > .body label.error {
        position: absolute;
        top: 77%;
        margin-left: 0;
        font-size:13px ;

    }

    .wizard .content > .body label.error#expect_income1-error {
        position: absolute;
        top: 80%;
        margin-left: -102px;
        font-size: 13px;
    }

    .body label.error#relation-error {
        position: absolute;
        top: 80%;
        margin-left: 0;
        font-size: 13px;
    }

    .wizard .content > .body label.error#expect_income-error {
        position: absolute;
        top: 122%;
        margin-left: 0;
        font-size: 13px;
        width: 165px;
    }
   
   
    .wizard .content > .body label.error#pro_management-error {
        position: absolute;
        top: 94%;
        margin-left: 0;
        font-size: 13px;
    }

    .wizard .content > .body label.error#busi_time-error {
        position: absolute;
        top: 79%;
        margin-left: 0;
        font-size: 13px;
    }

    .wizard .content > .body label.error#family_busi-error {
        position: absolute;
        top: 64%;
        margin-left: 0;
        font-size: 13px;
    }

    .wizard .content > .body label.error#business-error {
        position: absolute;
        top: 49%;
        margin-left: 0;
        font-size: 13px;
    }

    .wizard .content > .body label.error#age-error {
        position: absolute;
        top: 34%;
        margin-left: 0;
        font-size: 13px;
    }

    .wizard .content > .body label.error#area-error {
        position: absolute;
        top: 19%;
        margin-left: 0;
        font-size: 13px;
    }


    .wizard .content > .body label.error#cluster_id-error {
        position: absolute;
        top: 75px;
        margin-left: 0;
        font-size: 13px;
    }

</style>
