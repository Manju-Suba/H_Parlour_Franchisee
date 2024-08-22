function edit_location(id){
   
    $.ajax({
        url: BASE_URL+"rep/edit_location",
        type: "post",
        dataType: 'json', 
        data: {id:id},
        success: function(data) {
            if(data.res=="success"){
                $('#myModal').modal('show');
                $('#morning').val(data.loc[0].morning);
                $('#afternoon').val(data.loc[0].afternoon); 
                $('#evening').val(data.loc[0].evening);
                $('#town').html(data.town);
                $('#city').html(data.city);
                $('#state').html(data.state);
                $('#c_shopname').html(data.loc[0].c_shopname);
                $('#address').html(data.loc[0].address);
                $('#edit_id').val(data.loc[0].id);
                $('#btn').html(data.btn);
                var m= $('#morning').val() 
                var a= $('#afternoon').val()
                var e= $('#evening').val()
                if( m!= ""){
                    $("#morn_pri").attr('hidden',false);
                }else{
                    $("#morn_pri").attr('hidden',true);
                }

                if( a!= ""){
                    $("#after_pri").attr('hidden',false);
                }else{
                    $("#after_pri").attr('hidden',true);
                }

                if(m !="" && a !="" && e != ""){
                    $("#even_pri").attr('hidden',false);
                }else{
                    $("#even_pri").attr('hidden',true);
                }

                if(e !=""){
                    $("#morning").prop('disabled', true);
                    $("#evening").prop('disabled', true);
                    $("#afternoon").prop('disabled', true);
                }else{
                    $("#morning").prop('disabled', false);
                    mor = $('#morning').val();

                    if(mor !=""){
                        $("#afternoon").prop('disabled', false);
                        aft = $('#afternoon').val();

                        if(aft !=""){
                            $("#evening").prop('disabled', false);
                        }else{
                            $("#evening").prop('disabled', true);
                        }

                    }else{
                        $("#afternoon").prop('disabled', true);
                        $("#evening").prop('disabled', true);
                    }
                }
                morn_img = data.loc[0].morn_review_image;
                after_img = data.loc[0].after_review_image;
                even_img = data.loc[0].even_review_image;
               
                if(morn_img !=""){ 
                    $("#morn_review_image").prop('hidden', true);

                    $("#morn_img").html(`
                        <a target="_blank" href="../../uploads/place_review_image/${data.loc[0]['morn_review_image']}" ><img src="../../uploads/place_review_image/${data.loc[0]['morn_review_image']}" width="150" height="100"></a>
                    `);
                }
                if(after_img !=""){
                    $("#after_review_image").prop('hidden', true);

                    $("#after_img").html(`
                        <a target="_blank" href="../../uploads/place_review_image/${data.loc[0]['after_review_image']}" ><img src="../../uploads/place_review_image/${data.loc[0]['after_review_image']}" width="150" height="100"></a>
                    `);
                }
                if(even_img !=""){
                    $("#even_review_image").prop('hidden', true);

                    $("#even_img").html(`
                        <a target="_blank" href="../../uploads/place_review_image/${data.loc[0]['even_review_image']}" ><img src="../../uploads/place_review_image/${data.loc[0]['even_review_image']}" width="150" height="100"></a>
                    `);
                }

                if(morn_img !="" && after_img !="" && even_img !=""){
                    $("#update_location").prop('hidden', true);
                }

                edit_location();

            }
        }
    }) 
}

$("#edit_location_review_form").submit(function(e){
 
    e.preventDefault();
    var formData = new FormData(this);
    var morn_review_image = $("#morn_review_image")[0].files[0];
    var after_review_image = $("#after_review_image")[0].files[0];
    var even_review_image = $("#even_review_image")[0].files[0];

    var id=$("#edit_id").val();
    var morning =$("#morning").val();
    var afternoon =$("#afternoon").val();
    var evening =$("#evening").val();

    formData.append('morning', morning);
    formData.append('afternoon', afternoon);
    formData.append('evening', evening);
    formData.append('morn_review_image', morn_review_image);
    formData.append('after_review_image', after_review_image);
    formData.append('even_review_image', even_review_image);
 
    $.ajax({   
        type: "POST",
        url: BASE_URL + 'rep/update_location',   
        data: formData, 
        dataType: "JSON",
        cache:false,
        contentType: false,
        processData: false,
 
        success: function (data) {
            if(data.res=="success"){
                $("#update").fadeIn();
                $("#update").html('<b style="color:green";>Place Review Updated Successfully</b>');
                $("#update").delay(3000).fadeOut(500);
                var explode = function(){
                    window.location.reload();
                };
                setTimeout(explode, 3000);
            }
            if(data.res=="error1"){
                $("#update").fadeIn();
                $("#update").html('<b style="color:red";> Evening value must be greater than or equal to Afternoon value!  & Afternoon value must be greater than equal to Morning value!</b>');
                $("#update").delay(3000).fadeOut(500);
                
            }
            if(data.res=="error2"){
                $("#after_error").fadeIn();
                $("#after_error").html('<b style="color:red";> Afternoon value must be greater than or equal to Morning value!</b>');
                $("#after_error").delay(3000).fadeOut(500);
           
            }
            
        }
    })
})
 
$(document).ready(function(){
    location_table();
}) 

function location_table(){
    $('#location_table').DataTable({
        // 'dom': 'Bfrtip',
        // 'buttons': ['copy', 'excel', 'pdf', 'print', 'colvis'], 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post', 
        "bDestroy": true,
 
        'ajax': {
            'url': BASE_URL + 'rep/get_location_table',
        },
         
        "columns": [ 
            {
                title: 'S.No',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "state_name" },
            { "data": "city_name" },
            { "data": "town_name" },
            { "data": "area" },
            { "data": "c_shopname" },
            { "data": "address" },
            { "data": "time_schedul" },
            { "data": "action" }, 
        ],
        "order": [
            [1, 'asc']
        ]
    });
}



var _validFileExtensions = [".jpg", ".jpeg", ".gif", ".png"];    
function ValidateSingleInput(oInput) {
    if (oInput.type == "file") {
        var sFileName = oInput.value;
         if (sFileName.length > 0) {
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                alert("Sorry,Invalid Filename, allowed extensions are: " + _validFileExtensions.join(", "));
                oInput.value = "";
                return false;
            }
        }
    }
    return true;
}
 