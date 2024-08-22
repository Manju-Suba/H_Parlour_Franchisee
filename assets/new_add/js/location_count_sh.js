$(document).ready(function(){
    location_count_sh();
    location_count_sa();
})

// total count //
function location_count_sh(){
    $.ajax({
        url : BASE_URL + 'sh/get_location_count',
        method : 'POST',
        dataType : 'JSON',

        success: function(data){

            $('#completed_location_count').html(data.completed_location_count);
            $('#final_location_count').html(data.final_location_count);
            $('#rejected_location_count').html(data.rejected_location_count);
        }
    })
}

function location_count_sa(){
    $.ajax({
        url : BASE_URL + 'sa/get_location_count',
        method : 'POST',
        dataType : 'JSON',

        success: function(data){

            $('#sa_lt_count').html(data.sa_lt_count);
            $('#allocate_location_count').html(data.allocate_location_count);
            $('#final_location_sa').html(data.final_location_sa);
            $('#sa_final_location_count').html(data.sa_final_location_count);
        }
    })
}