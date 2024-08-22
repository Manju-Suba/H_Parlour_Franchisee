var BASE_URL = "<?php echo base_url();?>index.php/"; 
var ASSET_URL = "<?php echo asset_url();?>";

$(document).ready(function(){
    total_count_cod();
})


function total_count_cod(){ 
    $.ajax({
        url : BASE_URL + 'sa/get_details_count',
        method : 'POST', 
        dataType : 'JSON', 

        success: function(data){

            $('#sa_code_pending').html(data.sa_code_pending);
            $('#sa_code_created').html(data.sa_code_created);
            $('#sa_rejected_count').html(data.sa_rejected_count);
        }
    })
}