<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" id="edit_pop_trigger" data-toggle="modal" data-target="#edit_distributor_pop" style="display:none;">Open Modal</button>

<!-- Modal -->
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
                        <form action="javascript:void(0)" class="step-form-horizontal pop_edit_form"   enctype="multipart/form-data" id="step-form-horizontal"  data-parsley-validate method="post" autocomplete="off"> 
                            <div>
                                <h4>Basic Details</h4>
                                <section>
                                    <input type="hidden" id="id" name="id">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">SubD Proprietor Name</label>
                                                <input type="text" name="name" class="form-control low_to_upper_case" placeholder="SubD Proprietor Name" id="name" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">SubD Mobile</label>
                                                <input type="number" name="mobile" id="mobile" maxlength="13" oninput="mobileValid();" class="form-control" placeholder="SubD Mobile" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">SubD Firm Name</label>
                                                <input type="text" name="shop_name" id="shop_name" class="form-control low_to_upper_case" placeholder="SubD Firm Name" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">SubD Firm Landline</label>
                                                <input type="text" name="shop_landline" id="shop_landline" maxlength="13" oninput="mobileValid_2();" class="form-control" placeholder="SubD Firm Landline">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">SubD Firm Address 1</label>
                                                <textarea name="shop_address_1" id="shop_address_1" class="form-control low_to_upper_case" placeholder="SubD Firm Address 1" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">SubD Firm Address 2</label>
                                                <textarea name="shop_address_2" id="shop_address_2" class="form-control low_to_upper_case" placeholder="SubD Firm Address 2"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="">SubD Firm Address 3</label>
                                                <textarea name="shop_address_3" id="shop_address_3" class="form-control low_to_upper_case" placeholder="SubD Firm Address 3"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                        	<div class="form-group state_select">
                                            <label for="">State</label>
                                            	 <select name="shop_sate" id="shop_sate" class="form-control nice_select" required>
                                                    <option value="">Select State</option>
                                                     
                                                </select>
                                             </div>
                                        </div>
                                        <div class="col-lg-4">
                                        	<div class="form-group district_select">
                                            <label for="">District</label>
                                            	<select id="shop_city" name="shop_city" id="shop_city" class="form-control nice_select" required>      
                                                    <option value="">Select District</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                        	<div class="form-group town_select">
                                            <label for="">Town</label>
                                            	<select id="shop_town" name="shop_town" class="form-control nice_select" required>      
                                                    <option value="">Select Town</option>
                                                </select>
                                             </div>
                                        </div>
                                        <!-- <div class="col-lg-6">
                                            <div class="form-group">
                                                <input type="text" name="shop_zipcode" id="shop_zipcode" class="form-control" placeholder="Zip Code" required>
                                            </div>
                                        </div> 
                                         -->
                                         
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                            <label for="">Town Code</label>
                                                <input type="text" name="town_code" id="town_code" class="form-control" placeholder="Town Code" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                            <label for="">Population</label>
                                                <input type="text" name="population" id="population" class="form-control" placeholder="Population" readonly>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-group">
                                            <label for="">GST Number</label>
                                                <input type="text" name="gst" id="gst" class="form-control low_to_upper_case" placeholder="GST Number">
                                            </div>
                                        </div>
                                        
                                       
                                        
                                        <div class="col-lg-6">
                                            <!--<div class="custom-file">
                                                    <input type="file" class="custom-file-input">
                                                    <label class="custom-file-label">Choose Images</label>
                                                </div>-->
                                       </div>
                                            
                                    </div>
                                </section>
                                <h4>Additional Details</h4>
                                <section>
                                    <div class="row">
                                        <div class="form-group col-lg-4">
                                                <label>No. of Years of exp. In Distribution</label>
                                                <select name="years_of_exp" id="years_of_exp" class="form-control" required>
                                                    <option value="">Choose...</option>
                                                     
                                                </select> 
                                        </div>
                                        <div class="form-group col-lg-4">
                                                <label>Existing Company Business</label>
                                                <select name="existing_company" id="existing_company" class="form-control" required>
                                                	<option value="">Choose...</option> 
                                                     
                                                </select>
                                        </div>
                                        <div class="form-group col-lg-4">
                                                <label>Investment Capacity</label>
                                                <select name="investment_capacity" id="investment_capacity" class="form-control" required>
                                                	<option value="">Choose...</option>
                                                     
                                                </select>
                                        </div>
                                        <div class="form-group col-lg-4">
                                                <label>Son of the Soil</label>
                                                <select name="son_of_soil" id="son_of_soil" class="form-control" required>
                                                    <option value="">Choose...</option>
                                                    
                                                </select>
                                        </div>
                                        <div class="form-group col-lg-4">
                                                <label>Vehicle</label>
                                                <select name="vehicle" id="vehicle" class="form-control" required>
                                                    <option value="">Choose...</option>
                                                     
                                                </select>
                                        </div>
                                        <div class="form-group col-lg-4">
                                                <label>Godown</label>
                                                <select name="godown" id="godown" class="form-control" required>
                                                    <option value="">Choose...</option>
                                                    
                                                </select>
                                        </div>
                                        <div class="form-group col-lg-12">
                                                <label>Remark If Any</label>
                                               <input type="text" name="remark" id="remark" class="form-control low_to_upper_case" placeholder="">
                                               <br><p id="geolocation"></p>
                                               <input type="hidden" name="latitude" id="latitude" class="form-control" >
                                       		   <input type="hidden" name="longitude" id="longitude" class="form-control" >
                                        </div>
                                    </div>
                                </section>
                                
                                <h4>Confirmation</h4>
                                <section>
                                    <div class="row">
                                    	<div class="col-lg-4">
                                            <div class="form-group">
                                            	<label>SS Code</label>
                                                <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  name="ss_code" id="ss_code" class="form-control" placeholder="SS Code"  maxlength="7" pattern="\d{7}" title="Please enter exactly 7 digits" required >
                                            </div>

                                        	<!-- <div class="form-group">
                                            	<label>SS Code</label>
                                                <input type="number" id="ss_code" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  name="ss_code" class="form-control" placeholder="SS Code"  maxlength="7" pattern="\d{7}" title="Please enter exactly 7 digits">
                                            </div> -->
                                        </div>
                                        <div class="col-lg-4">
                                             <div class="form-group">
                                             	<label>RSP (SSFA Number)</label>
                                                <input type="number" id="rst_ssta" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="rst_ssta" class="form-control" placeholder="RSP (SSFA Number)"  maxlength="10" pattern="\d{10}" title="Please enter exactly 10 digits" required>
                                              </div>
                                        </div>
                                    	<div class="form-group col-lg-4">
                                                <label>Type of SubD</label>
                                                <select name="swd" id="swd" class="form-control" required>
                                                    <option value="">Choose...</option>
														<option value="New">New</option>
                                                        <option value="Replacement">Replacement</option>
                                                </select>
                                        </div>
                                        
                                        <div class="col-12" style="text-align:center; margin-top:50px; margin-bottom:20px;">
                                            <h2>Are you sure that you want to submit the form ?</h2>
                                        </div>
                                    </div>
                                    <input type="hidden" id="save_status" name="save_status" value="0">
                                    <div class="col-md-12">
                                        <div class="row">

                                        <div class="col-md-4">
                                            <p id="form_resp" style="display:none;"></p>
                                        </div>
                                        <div class="col-md-4" style="text-align:center;">
                                                <button type="button" id="save_form" class="btn mb-1 btn-primary"><b>Save</b></button>
                                                <button type="submit" id="form_submit_btn" class="btn mb-1 btn-success"><b>Submit</b></button>
                                        </div>
                                        <div class="col-md-4">
                                        </div>

                                           
                                        </div>
                                    </div>
                                    
                                </section>
                            </div>
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
<!-- <script>
     function myFunction() {
                var inpObj = document.getElementById("gfg");
                if (!inpObj.checkValidity()) {
                    document.getElementById("geeks")
                              .innerHTML = inpObj.validationMessage;
                } else {
                    document.getElementById("geeks")
                              .innerHTML = "Input is ALL RIGHT";
                }
            }
</script> -->