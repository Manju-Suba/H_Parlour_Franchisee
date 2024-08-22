var BASE_URL = "<?php echo base_url();?>index.php/"; 
var ASSET_URL = "<?php echo asset_url();?>";

$(document).ready(function(){
    total_count_rsmi();
})


function total_count_rsmi(){
    $.ajax({
        url : BASE_URL + 'cidhaya/get_details_count',
        method : 'POST',
        dataType : 'JSON',

        success: function(data){

            $('#rsm_entered_details').html(data.rsm_entered_details);
            $('#idhaya_approved_details').html(data.idhaya_approved_details);
            $('#idhaya_rejected_details').html(data.idhaya_rejected_details);
          
        }
    })
}