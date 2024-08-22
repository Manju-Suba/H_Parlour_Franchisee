<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" id="edit_pop_trigger" data-toggle="modal" data-target="#edit_distributor_pop" style="display:none;">Open Modal</button>

<!-- Modal -->
<div id="edit_distributor_pop" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Franchisee Code - <b id="pop_shop_name"></b></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <form action="javascript:void(0)" class=""   enctype="multipart/form-data" id="distributor_code_form" autocomplete="off"> 
                            <section>
                              <button type="button" name="approval" id="app_btn" class="btn mb-1 btn-success">Approve for Code Creation</button>
                              <button type="button" name="reject" id="rej_btn" class="btn mb-1 btn-danger">Hold (Future Prospects)</button>
                                <div class="form_hid_action_doc" style="display:none;"> 
                                    <div class="form-group">
                                        <label class="col-md-6 control-label" for="Department">Franchisee Code</label>
                                        <div class="col-md-12">
                                          <input type="text" name="user_code" class="form-control low_to_upper_case" placeholder="Franchisee Code" id="user_code" >
                                        </div> 
                                    </div> 
                                    <p id="doc_resp" class="ml-2" style="display:none;"></p>
                                </div>

                                <div class="form_hid_action" style="display:none;"> 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="Department">Remarks</label>
                                        <div class="col-md-12">
                                            <textarea name="remarks" id="remarks" class="form-control" required></textarea>
                                        </div>
                                    </div>

                                    <input type="hidden" id="user_id" name="user_id">
                                    <input type="hidden" id="type" name="type">
                                    <p id="form_resp" style="display:none;"></p>
                                    <div class="col-md-12">
                                        <div class="form-group" style="text-align:right">
                                            <button type="submit" id="distributor_code_submit" class="btn mb-1 btn-success">update</button>
                                        </div>
                                    </div>
                                </div>

                               
                            </section>
                        </form>
                    </div>
                </div> 
            </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
    </div>

  </div>
</div>