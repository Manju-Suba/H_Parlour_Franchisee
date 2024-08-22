var BASE_URL = "<?php echo base_url();?>index.php/"; 
var ASSET_URL = "<?php echo asset_url();?>";

$(document).ready(function(){
    total_count_sh();
})


function total_count_sh(){
    $.ajax({
        url : BASE_URL + 'sh/get_details_count',
        method : 'POST',
        dataType : 'JSON',

        success: function(data){

            $('#ct_entered_details').html(data.ct_entered_details);
            $('#sh_approved_details').html(data.sh_approved_details);
            $('#sh_rejected_details').html(data.sh_rejected_details);
            $('#ct_uploaded_details').html(data.ct_uploaded_details);
            $('#onboarding_dcount').html(data.onboarding_dcount);
            $('#mt_uploaded_details').html(data.mt_uploaded_details);
            $('#cc_funnel_details').html(data.cc_funnel_details);
            $('#sa_rejected_count').html(data.sa_rejected_count);
        }
    })
}