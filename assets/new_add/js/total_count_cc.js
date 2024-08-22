var BASE_URL = "<?php echo base_url();?>index.php/"; 
var ASSET_URL = "<?php echo asset_url();?>";

$(document).ready(function(){
    total_count_cc();
})


function total_count_cc(){
    $.ajax({
        url : BASE_URL + 'cc/get_details',
        method : 'POST',
        dataType : 'JSON',

        success: function(data){
 
            $('#cc_entered_details').html(data.cc_entered_details);
            $('#cc_funnel_details').html(data.cc_funnel_details);
            $('#cus_entered_details').html(data.cus_entered_details);
            $('#cus_funnel_details').html(data.cus_funnel_details);
        }
    })
}