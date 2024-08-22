<button type="button" class="btn btn-primary" data-toggle="modal" id="detail_view_trigger" data-target="#detailview" style="display:none;">View</button>

 <div class="modal fade" id="detailview">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> Details of Individual or Representative:</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" style="padding-top:0; max-height: calc(100vh - 210px);overflow-y: auto;">
                    <div class="row" style="padding:12px 0;">
                        <div class="col-4" >Name: <p id="pop_name"></p></div>
                        <div class="col-4" >Mobile: <p id="pop_mobile"></p></div>
                        <div class="col-4" >Business: <p id="pop_business"></p></div>
                    </div>
                                                
                    <div class="row" style="padding:12px 0; background:#F3F1FA; font-weight:bold; font-size:14px;">
                        <div class="col-6">Parameters</div>
                        <div class="col-4">Slab</div>
                        <div class="col-2">CC Points</div>
                        <!-- <div class="col-2">VA Points</div> -->
                    </div>
                    <div class="row" style="padding:8px 0; background:#fff;">
                        <div class="col-6">Should be in the same area</div>
                        <div class="col-4" id="pop_area_slub"></div>
                        <div class="col-2" id="pop_area"></div>
                                                    
                    </div>
                    <div class="row" style="padding:8px 0; background:#f3f3f3;">
                        <div class="col-6"> Age criteria 30 to 35 yrs</div>
                        <div class="col-4" id="pop_age_slub"></div>
                        <div class="col-2" id="pop_age"></div>
                    </div>
                    <div class="row" style="padding:8px 0; background:#fff;">
                        <div class="col-6">Should not do any other Employeement & milk & other business</div>
                        <div class="col-4" id="pop_busi_slub"></div>
                        <div class="col-2" id="pop_busi"></div>
                    </div>
                    <div class="row" style="padding:8px 0; background:#f3f3f3;">
                        <div class="col-6">Should consider as a first income and family business</div>
                        <div class="col-4" id="pop_fam_slab"></div>
                        <div class="col-2" id="pop_fam_busi"></div>
                    </div>
                    <div class="row" style="padding:8px 0; background:#fff;">
                        <div class="col-6">Willing to work 24/7, 365days . Business timing : 5am to 10pm</div>
                        <div class="col-4" id="pop_time_slab"></div>
                        <div class="col-2" id="pop_time"></div>
                    </div>

                    <hr>
                    <div class="col-md-12">
                        <h4>Level of Interest and root cause to be an entrepreneur:</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Who is the reason behind your Entrepreneurship?</p>
                                <textarea class="form-control" disabled id="3a"></textarea>

                            </div>
                            <div class="col-md-6">
                                    <p>Reason for choosing H-Milk Parlour & Bakery</p>
                                    <textarea class="form-control" id="3b" disabled></textarea>
                            </div>
                            <div class="col-md-6 mt-3">
                                <p>How did you come to know about brand & opening available ?</p>
                                <textarea class="form-control" id="3c" disabled></textarea>
                            </div>
                            <div class="col-md-6 mt-4">
                                <p class="mt-2">Have you tasted any of our products??</p>
                                <textarea class="form-control" id="3d" disabled></textarea>
                            </div>
                            <div class="col-md-6 mt-3">
                                <p>Why H-Milk bakery?</p>
                                <textarea class="form-control" id="3e" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <h4>Passion towards starting a Business:</h4>
                        <div id="employee">
                            <h5>If he/she a salaried employee:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                        <p>What are you currently doing?</p>
                                        <textarea class="form-control" id="4a" disabled></textarea>
                                </div>
                                <div class="col-md-6">
                                        <p>How much do you earn? (month)</p>
                                        <textarea class="form-control" id="4b"  disabled></textarea>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <p>Do you think it is worth to forgo the salary for this business?</p>
                                    <textarea class="form-control" id="4c"  disabled></textarea>
                                </div>
                                <div class="col-md-6 mt-4"></div>
                                
                                
                            </div>
                        </div>
                        <div id="business">
                            <div class="row">
                                <div class="col-md-6 mt-4">
                                    <h5>If it is business:</h5>
                                    <p class="mt-2">How much are you earning?</p>
                                    <textarea class="form-control" id="5a"  disabled></textarea>
                                </div>
                                <div class="col-md-6 mt-5">
                                    <p class="mt-2">What is the Investment?</p>
                                    <textarea class="form-control" id="5b"  disabled></textarea>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <p class="mt-2">How much time you spend in this business?</p>
                                    <textarea class="form-control" id="5c"  disabled></textarea>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <p class="mt-2">When did you hit Breakeven?</p>
                                    <textarea class="form-control" id="5d" disabled></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <h4>After taking H-Milk Parlour &  Bakery:</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <p>How much time will you be spending in Parlour?</p>
                                <textarea class="form-control" id="6a"  disabled></textarea>
                            </div> 
                            <div class="col-md-6">
                                <p>What  do you mean by Breakeven?</p>
                                <textarea class="form-control" id="6b" disabled></textarea>
                            </div>
                            <div class="col-md-6 mt-3">
                                <p>When do you expect Breakeven? (In months)</p>
                                <textarea class="form-control" id="6c" disabled></textarea>
                            </div>
                            <div class="col-md-6 mt-3">
                                <p >Do you have money backup for 6months?</p>
                                <textarea class="form-control" id="6d" disabled></textarea>
                            </div>
                            <div class="col-md-6 mt-3">
                                <p>What is your ROI expectation?( % )</p>
                                <textarea class="form-control"  id="6e" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <h4>Net Worth Statement:</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Total Assets</p>
                                <textarea class="form-control" id="7a" disabled></textarea>
                            </div>
                            <div class="col-md-6">
                                <p>Total Liabilities</p>
                                <textarea class="form-control" id="7b" disabled></textarea>
                            </div>
                            <div class="col-md-6 mt-3">
                                <p>Net Worth (Total Assets-Total Liabilities)</p>
                                <textarea class="form-control" id="7c" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <h4>Financial Aspects:</h4>
                            <h5>Mode of Investment:</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Loan / Own Fund</p>
                                <input class="form-control" id="8a" disabled>
                            </div>
                            <div class="col-md-6">
                                <div id="from_hand">
                                    <p>Investment from Hand :</p>
                                    <input class="form-control" id="8b" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="from_bank">
                            <div class="col-md-6 mt-3">
                                <p>Loan from Bank </p>
                                <textarea class="form-control" id="8c" disabled></textarea>
                            </div>
                            <div class="col-md-6 mt-3">
                                <p> Bank Name </p>
                                <textarea class="form-control" id="8d" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <h4>Scenarios to look for:</h4>
                        <div class="row">
                            <div class="col-md-6">
                                    <p class="mt-2">If for the first month store does only 3K ADS and Milk sales less than 100 LPD , and your loosing 15K  a month. What will be your Action plan? </p>
                                    <textarea class="form-control" id="9a" disabled></textarea>
                            </div>
                            <div class="col-md-6">
                                    <p>After the above efforts in case of non-Improvement  for 3 months, store does only 3K ADS and Milk 100 LPD , and your loosing 15K a month adding up to 50k. What will be your Action plan?</p>
                                    <textarea class="form-control" id="9b" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <h4>Business Development</h4>
                        <div class="row">
                            <div class="col-md-6">
                                    <p >What will be your Morning Routine?</p>
                                    <textarea class="form-control" id="10a" disabled></textarea>
                            </div>
                            <div class="col-md-6">
                                    <p>Are you a Localite?</p>
                                    <textarea class="form-control" id="10b" disabled></textarea>
                            </div>
                            <div class="col-md-6 mt-2">
                                    <p>What is your plan for outside store business in Trade area?</p>
                                    <textarea class="form-control" id="10c" disabled></textarea>
                            </div>
                            <div class="col-md-6 mt-4">
                                    <p>How many customers will you speak to in a day?</p>
                                    <textarea class="form-control" id="10d" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <h4>Manpower Handling</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mt-3">a. Do you have any experience in managing team?</p>
                                <p class="mt-2">( Yes / No )</p>
                                <input type="text" id="11aa" value="" class="form-control" disabled>
                                <p class="mt-2">Remark</p>
                                <textarea class="form-control" id="11a" disabled></textarea>

                            </div>
                            <div class="col-md-6">
                                <p>b. Do you have any experience in handling dairy products?</p>
                                <p class="mt-2">( Yes / No )</p>
                                <input type="text" id="11bb" value="" class="form-control" disabled>
                                <p class="mt-2">Remark</p>
                                <textarea class="form-control" id="11b" disabled></textarea>
                            </div>
                            <div class="col-md-6 mt-2">
                                    <p>c. What is the salary level at which you handled a team?</p>
                                    <textarea class="form-control" id="11c" disabled></textarea>
                            </div>
                            <div class="col-md-6 mt-2">
                                    <p>d. How do you keep them motivated?</p>
                                    <textarea class="form-control" id="11d" disabled></textarea>
                            </div>

                            <div class="col-md-6 mt-4">
                                    <p>e. How many members in your team have you maintained with 1 year attrition?</p>
                                    <textarea class="form-control" id="11e" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <h4>Scenarios:</h4>
                        <div class="row">
                            <div class="col-md-6">
                                    <p>Morning your delivery boy calls and tell Leave and Milk needs to supply before 7 am ? What will be your action?</p>
                                    <textarea class="form-control" id="12a" disabled></textarea>
                            </div>
                            <div class="col-md-6">
                                    <p>If you have a vehicle problem at the time of delivery ? what you will do ?</p>
                                    <textarea class="form-control" id="12b" disabled></textarea>
                            </div>
                            <div class="col-md-6 mt-4">
                                <p class="mt-2">1)  Are you approachable?</p>
                                <textarea class="form-control" id="12c" disabled></textarea>
                            </div>
                            <div class="col-md-6">
                                <p class="mt-2">2)  Since handling milk you should be available 24/7 & 365 .How will you manage?</p>
                                <textarea class="form-control" id="12d" disabled></textarea>
                            </div>
                            
                            <div class="col-md-6 mt-3">
                                <p class="mt-3">3)  What if your team member approaches you with a problem?</p>
                                <textarea class="form-control" id="12e" disabled></textarea>
                            </div>

                            <div class="col-md-6 mt-3">
                                <p class="mt-3">4)  What  will you do when the products  expired?</p>
                                <textarea class="form-control" id="12f" disabled>></textarea>
                            </div>

                            <div class="col-md-6 mt-3">
                                <p>5)  When you have 10k worth products with 1day shelf life, and if you throw this away you won't Have money to pay the staff? How will you react?</p>
                                <textarea class="form-control" id="12g" disabled></textarea>
                            </div>

                            <div class="col-md-6 mt-3">
                                <p class="mt-3">6)  What will you do when there is a power shut down in the outlet?</p>
                                <textarea class="form-control" id="12h" disabled></textarea>
                            </div>

                            <div class="col-md-6 mt-3">
                                <p>7)  If you have personal issue with a retailer but he is High volume outlets  do you supply our products to him or ignore ?</p>
                                <textarea class="form-control" id="12i" disabled></textarea>
                            </div>

                            <div class="col-md-6 mt-3">
                                <p>8)  You are getting 5k worth special order from your regular customer, and delivery to be on the same day,But you don’t have enough Stocks with you. What will you do?</p>
                                <textarea class="form-control" id="12j" disabled></textarea>
                            </div>

                            <div class="col-md-6 mt-3">
                                <p class="mt-4">9)  If your friend having shop in another area asking you to supply milk & milk products .what will you do?</p>
                                <textarea class="form-control" id="12k" disabled></textarea>
                            </div>

                            <div class="col-md-6 mt-3">
                                <p>10)  Retailer is giving 2nd order for 2 Lit of milk and he is 8km away from your parlour do you supply or ignore?</p>
                                <textarea class="form-control" id="12l" disabled></textarea>
                            </div>

                            <div class="col-md-6 mt-3">
                                <p>11) If you have an emergency or important function to attend .how will you manage the stock supply and business at that point of time.</p>
                                <textarea class="form-control" id="12m" disabled></textarea>
                            </div>

                            <div class="col-md-6 mt-3">
                                <p>12) If nearby 1 or 2 house hold is asking to do doorstep supply how you will manage?</p>
                                <textarea class="form-control" id="12n" disabled></textarea>
                            </div>

                            <div class="col-md-6 mt-3">
                                <p>13) If company vehicle is delayed regularly you complaint to the company staff but you’re not getting proper response how will you handle?</p>
                                <textarea class="form-control" id="12o" disabled></textarea>
                            </div>

                            <div class="col-md-6 mt-3">
                                <p>14) If you’re getting repeated spoilage / wastage from the retailers/ Counter how will you handle?</p>
                                <textarea class="form-control" id="12p" disabled></textarea>
                            </div>
                            
                        </div>
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
                    <!-- <input type="text" name="pop_user_id" id="pop_user_id" value="">
                    <div class="col-md-12" style="text-align:center;">
                        <a href="<?php echo base_url(); ?>'index.php/ct/ct_insertion_form/" class="btn btn-success">Add More Details </a>
                    </div>   -->
                    <div id="pop_button"></div>                   
                    </div>
                </div>
            </div>
        </div>
        <!-- {{id="pop_user_id"}} -->
    <!-- image Modal ends -->