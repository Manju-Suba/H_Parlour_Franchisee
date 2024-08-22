 <!-- Modal for approval-->
                    <button type="button" class="btn btn-primary" id="approve_pop" data-toggle="modal" style="display:none;" data-target="#approval">Approval</button>
                    <div class="modal fade" id="approval">
                    <div class="modal-dialog" role="document"> 
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Approval for this Form</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form id="pop_rej_ap_form" action="javascript:void(0);" enctype="multipart/form-data" method="post" autocomplete="off">	
                            <input type="hidden" name="id" id="id" class="form-control" value="">
                            <input type="hidden" id="type">
                            <button type="button" name="approval" id="app_btn" class="btn mb-1 ml-3 btn-success">Approve for Code Creation</button>
                            <button type="button" name="reject" id="rej_btn" class="btn mb-1 btn-danger">Hold (Future Prospects)</button>

                                <div class="form_hid_action_doc" style="display:none;"> 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="Department">Document</label>
                                        <div class="col-md-12">
                                            <input type="file" name="approve_doc[]" id="approve_doc" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">
                                        </div> 
                                    </div>
                                </div>
                                <p id="doc_resp" style="display:none;" class="ml-3"></p>
                                <div class="form_hid_action" style="display:none;"> 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="Department">Remarks</label>
                                        <div class="col-md-12">
                                            <textarea name="remarks" id="remarks" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" name="" id="submit_app_pop" class="btn mb-1 btn-success" style="float: right;">Submit</button>
                                </div>

                                <p id="form_resp" style="display:none;"></p>
                            </form>
                        </div>
                    </div>
                    </div>
                    </div>
                    <!-- image Modal approval -->