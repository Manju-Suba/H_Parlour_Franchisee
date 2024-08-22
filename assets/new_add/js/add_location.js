$(document).on('change', '#state', function() {
    var state = $('#state').val();
    $.ajax({
        url: BASE_URL+"sa/change_state",
        type: "post",
        dataType: 'json',
        data: {state:state},
        success: function(data) {
            if(data.res=="success"){
                    $('#city').html(data.city);
            }
        }
    })
})
 
$(document).on('change', '#city', function() {
    var city = $('#city').val();
    $.ajax({
        url: BASE_URL+"sa/change_city",
        type: "post",
        dataType: 'json',
        data: {city:city},
        success: function(data) {
            if(data.res=="success"){
                $('#town').html(data.town);
            }
        }
    })
})
 
$(document).on('submit', '#add_location_form', function() {
    $.ajax({
        url: BASE_URL+"sa/save_locations",
        type: "post",
        dataType: 'json',
        data: $("#add_location_form").serialize(),
        success: function(data) {
            if(data.res=="success"){
                $("#insert").fadeIn();
                $("#add_location_form")[0].reset();
                $("#insert").html('Location Added Successfully')
                setTimeout(function(){
                    window.location.href = BASE_URL + 'sa/location_table';
                }, 2000);
            }else{
                $("#insert").fadeIn();
                $("#insert").html('<b style="color:red;">This Location was already exists!</b>');
                $("#insert").delay(3000).fadeOut(500);
            }
        }
    })
})