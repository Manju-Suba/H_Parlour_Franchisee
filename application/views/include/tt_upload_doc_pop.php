 <!-- Modal for score approval-->
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

                 <form id="pop_tt_score_form" action="javascript:void(0);" enctype="multipart/form-data" method="post" autocomplete="off">
                    <input type="hidden" name="id" id="id" class="form-control" value="">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Assessment Score</label>
                            <input type="text" name="assess_score" id="assess_score" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Parlour Name </label>
                            <input type="text" name="parlour_name" id="parlour_name" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Date Of Visit</label>
                            <input type="text" name="visit_date" id="visit_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Remark</label>
                            <textarea name="remarks" id="remarks" class="form-control"></textarea>
                        </div>
                    </div>
                    <div id="form_respt"></div>
                   
                    <button type="submit" name="" id="submit_app_pop" class="btn mb-1 btn-success" style="float: right;">Submit</button>

                 </form>
             </div>
         </div> 
     </div>
 </div>
 <!-- score Modal approval -->
 