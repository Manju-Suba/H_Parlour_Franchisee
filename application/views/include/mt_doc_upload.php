<!--  approval doc-->
<button type="button" class="btn btn-primary" id="mt_approve_pop" data-toggle="modal" style="display:none;" data-target="#approval">Approval</button>
    <div class="modal fade" id="approval">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Approval for this Form (Document Upload)</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="mt_upload_form" action="javascript:void(0);" enctype="multipart/form-data" method="post" autocomplete="off">
                        <input type="hidden" name="id" id="id" class="form-control" value="">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Upload Multiple Images</label>
                                <input type="file" id="mt_doc" multiple="multiple" name="mt_doc[]" class="form-control" value="" required>
                                <div class="validation" style="display:none;"> Upload Max 5 Files allowed </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Upload Video</label>
                                <input type="file" id="mt_vdo" multiple="multiple" name="mt_vdo[]" class="form-control" value="" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Upload Excel</label>
                                <input type="file" name="uploadFile" id="uploadFile" class="form-control" required >
                            </div>
                        </div>
                        <!-- <div class="col-lg-12">
                            <div class="form-group">
                            <video width="320" height="240" controls>

                                <source src="<?php echo base_url(); ?>/uploads/Approved_Vdo/Aspirants_Motivational_Video।।SK_sir।।TVF_UPSC_Aspirants।।_Status।।_Aspirants_status.mp4" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>

                            </div>
                        </div> -->

                        <div id="form_respt"></div>

                        <button type="submit" name="" id="submit_app_pop" class="btn mb-1 btn-success" style="float: right;">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
 <!--  approval doc -->



 <!-- Uploaded doc-->
<button type="button" class="btn btn-primary" id="mt_uploaded_pop" data-toggle="modal" style="display:none;" data-target="#uploaded">Approval</button>
<div class="modal fade" id="uploaded">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title">Maintanance Team Uploaded Document </h5> -->
                <h5 class="modal-title">Documents View </h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div> 
            <div class="modal-body">
                <div class="col-lg-10">
                    <h5><span class=""> Multiple Images :</span></h5>
                    <div class="bootstrap-carousel">
                        <div id="img_div" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <a class="carousel-control-prev" href="#img_div" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span> </a>
                                <a class="carousel-control-next" href="#img_div" data-slide="next"><span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <video width="320" height="240" controls>

                            <source src="<?php echo base_url(); ?>/uploads/Approved_Vdo/Aspirants_Motivational_Video।।SK_sir।।TVF_UPSC_Aspirants।।_Status।।_Aspirants_status.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div> -->
                </div>
                <div class="col-lg-12 mt-5">
                    <h5> Maintanance Team Uploaded Video :</h5>
                    <div id="vdo_div">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- uploaded doc -->