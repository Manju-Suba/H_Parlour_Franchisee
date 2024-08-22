<button type="button" class="btn btn-primary" data-toggle="modal" id="detail_view_trigger" data-target="#detailview" style="display:none;">View</button>

 <!-- image Modal --> 
 <div class="modal fade" id="detailview">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Details of Individual or Representative:</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="padding-top:0;">
                    <div class="row" style="padding:12px 0;">
                        <div class="col-4" >Name: <p id="pop_name"></p></div>
                        <div class="col-4" >Mobile: <p id="pop_mobile"></p></div>
                        <div class="col-4" >Educational Qualification: <p id="pop_education"></p></div>
                    </div>
                    <!-- <h5>BD Score :</h5> -->
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
                    <!-- <h5>FRC Score :</h5> -->
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
    <!-- image Modal ends -->