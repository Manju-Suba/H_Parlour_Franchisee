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
                    <div class="col-3"><b>Name: </b><p id="pop_name"></p>
                    </div>
                    <div class="col-3"><b>Mobile: </b><p id="pop_mobile"></p>
                    </div>
                    <div class="col-3"><b>Educational Qualification: </b><p id="pop_education"></p>
                    </div>
                    <div class="col-2"><button class="btn  btn-primary" onclick="ct_doc_upload()">Onboarding</button></div>
                </div>
                <div class="row" style="padding:12px 0;">
                    <div class="col-3"><b>RSM Remark: </b><p id="pop_rsm_remark"></p></div>
                    <div class="col-3"><b>OM Remark: </b><p id="pop_om_remark"></p></div>
                    <div class="col-3"><b>Idhaya Remark: </b><p id="pop_rsmi_remark"></p></div>
                    <div class="col-3"><b>Nethaji Remark : </b><p id="pop_sh_remark"></p></div>
                </div>
                <div class="row" style="padding:12px 0;" id="tt_score">
                    <div class="col-3"><b>Assessment Score : </b><p id="pop_assess_score"></p>
                    </div>
                    <div class="col-3"><b> Parlour Name : </b><p id="pop_parlour_name"></p>
                    </div>
                    <div class="col-3"><b>Date Of Visit : </b><p id="pop_dfv"></p> 
                    </div>
                    <div class="col-3"><b>TT Remark : </b><p id="pop_remark"></p>
                    </div>
                </div>
                <div class="row" style="padding:12px 0; background:#F3F1FA; font-weight:bold; font-size:14px;" id="ct_doc_upload">
                    <h5 class="ml-4"><u>Pre-Onboarding :</u></h5>
                    <br>
                    <div class="row" id="ct_pre_doc">
                        <div class="row col-12 ml-1">
                            <div class="col-4" >
                                <label for=""><em> i) Signed Agreement Copy</em></label>
                                <div id="show_img1"></div>
                            </div>
                            <div class="col-4"> 
                                <label for=""><em> ii) 100% Completed Profile</em></label>
                                <div id="show_img2"></div>
                            </div>
                            <div class="col-4">
                                <label for=""><em> iii) Deposite Challan</em></label>
                                <div id="show_img3"></div>
                            </div>
                        </div>
                        <br>
                        <div class="row col-12 ml-1">
                            <div class="col-4 mt-4"> 
                                <label for=""><em> iv) GST</em></label>
                                <div id="show_img4"></div>
                            </div>
                            <div class="col-4 mt-4" > 
                                <label for=""><em> v) FSSAI </em></label>
                                <div id="show_img5"></div>
                            </div>
                            <div class="col-4 mt-4"> 
                                <label for=""><em> vi) PAN </em></label>
                                <div id="show_img6"></div>
                            </div>
                        </div>
                        <div class="row col-12 ml-1">
                            <div class="col-4 mt-4"> 
                                <label for=""><em> vii) Aadhar </em></label>
                                <div id="show_img7"></div>
                            </div>
                            <div class="col-4 mt-4"> 
                                <label for=""><em> viii) Current Account Details </em></label>
                                <div id="show_img8"></div>
                            </div>
                            <div class="col-4 mt-4"> 
                                <label for=""><em> ix) List Of Retail Outlet </em></label>
                                <div id="show_img9"></div>
                            </div>
                        </div>  
                    </div>
                    <hr>
                    <h5 class="ml-4"><u>Post-Onboarding :</u></h5>
                    <br>
                    <div class="row" id="ct_post_doc_upload">
                        <div class="row col-12 ml-1">
                            <div class="col-4">
                                <label for=""><em>i) List of Asset Pics </em></label>
                                <div id="asset_div"></div> 
                            </div>
                            <div class="col-4">
                                <label for=""><em>ii) PICS with FRC & TEAM </em></label>
                                <div id="team_div"></div>
                            </div>
                            <div class="col-4 mt-2">
                                <input type="hidden" id="id_val"  name="id_val">
                            </div>
                        </div>
                        <!-- <div class="col-4 mt-2"> 
                            <div id="save_btn"></div>
                        </div>
                        <div class="col-4 md-2" >
                            <div id="success"></div>
                        </div> -->
                    </div>
                </div>
                <hr>
                <div class="row" style="padding:12px 0; background:#c3b8e782; font-weight:bold; font-size:14px;">
                    <div class="col-7">BD Parameters</div>
                    <div class="col-3">Slab</div>
                    <div class="col-2">CC Points</div>
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
                    <div class="col-2">CC Points</div>
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
<!-- End Modal -->