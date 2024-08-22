var BASE_URL = "<?php echo base_url();?>index.php/"; 
var ASSET_URL = "<?php echo asset_url();?>";

$(document).ready(function(){
    total_count_ct();
})


function total_count_ct(){
    $.ajax({
        url : BASE_URL + 'ct/get_details_count',
        method : 'POST',
        dataType : 'JSON',

        success: function(data){

            $('#cc_entered_details').html(data.cc_entered_details);
            $('#ct_verified_details').html(data.ct_verified_details);
            $('#ct_funnel_details').html(data.ct_funnel_details);
            $('#ct_upload_details').html(data.ct_upload_details);
            $('#mt_upload_details').html(data.mt_upload_details);
            $('#sa_rejected_count').html(data.sa_rejected_count);
        }
    })
}