$(document).ready(function () {
    total_count_rsm();
})

$("#app_btn").click(function(){
    $("#type").val("Approved");
    $(".form_hid_action").css("display","block");
    // $("#submit_app_pop").click();
})

$("#rej_btn").click(function(){
    $("#type").val("Rejected");
    $(".form_hid_action").css("display","block");
})

function approve_action(id){ 
    $("#approve_pop").click();
    $("#id").val(id);
}

$("#pop_rej_ap_form").submit(function(e){

    e.preventDefault();
    var formData = new FormData(this);

    var id=$("#id").val();
    var type=$("#type").val();

    var remarks="";
    if(type=="Rejected"){
        remarks=$("#remarks").val();
        if(remarks==""){
            $("#form_resp").css("display","block");
            $("#form_resp").html('<b style="color:green;">Need Remark field.</b>');
            $("#form_resp").delay(3000).fadeOut(500);
            return false;
        }
    }

    formData.append('type', type);

    $.ajax({   
        type: "POST",
        url: BASE_URL + 'rsm/form_approval',    
        data: formData, 
        dataType: "JSON", 
        cache:false,
        contentType: false,
        processData: false,

        success: function (data) {
            if (data.response == "Approved!") {
                $("#form_resp").css("display","block");
                $("#form_resp").html('<b style="color:green;">Approved Successfully!</b>');
                $("#form_resp").delay(3000).fadeOut(500);
                var explode = function(){
                    window.location.reload();
                };
                setTimeout(explode, 3000);
            } 
            else{
                $("#form_resp").css("display","block");
                $("#form_resp").html('<b style="color:red;">Hold ( Future Prospects )!</b>');
                $("#form_resp").delay(3000).fadeOut(500);
                var explode = function(){
                    window.location.reload();
                };
                setTimeout(explode, 3000);

            }
            
        }
    })
})


// Idhaya Approved Rejection action part
$("#ithaya_rej_ap_form").submit(function(e){

    e.preventDefault();
    var formData = new FormData(this);

    var id=$("#id").val();
    var type=$("#type").val();

    var remarks="";
    if(type=="Rejected"){
        remarks=$("#remarks").val();
        if(remarks==""){
            $("#form_resp").css("display","block");
            $("#form_resp").html('<b style="color:green;">Need Remark field.</b>');
            $("#form_resp").delay(3000).fadeOut(500);
            return false;
        }
    }

    formData.append('type', type);

    $.ajax({   
        type: "POST",
        url: BASE_URL + 'cidhaya/form_approval',    
        data: formData, 
        dataType: "JSON", 
        cache:false,
        contentType: false,
        processData: false,

        success: function (data) {
            if (data.response == "Approved!") {
                $("#form_resp").css("display","block");
                $("#form_resp").html('<b style="color:green;">Approved Successfully!</b>');
                $("#form_resp").delay(3000).fadeOut(500);
                var explode = function(){
                    window.location.reload();
                };
                setTimeout(explode, 3000);
            } 
            else{
                $("#form_resp").css("display","block");
                $("#form_resp").html('<b style="color:red;">Hold ( Future Prospects )!</b>');
                $("#form_resp").delay(3000).fadeOut(500);
                var explode = function(){
                    window.location.reload();
                };
                setTimeout(explode, 3000);

            }
            
        }
    })
})


// Idhaya Approved Rejection action part
$("#opm_rej_ap_form").submit(function(e){

    e.preventDefault();
    var formData = new FormData(this);

    var id=$("#id").val();
    var type=$("#type").val();

    var remarks="";
    if(type=="Rejected"){
        remarks=$("#remarks").val();
        if(remarks==""){
            $("#form_resp").css("display","block");
            $("#form_resp").html('<b style="color:green;">Need Remark field.</b>');
            $("#form_resp").delay(3000).fadeOut(500);
            return false;
        }
    }

    formData.append('type', type);

    $.ajax({   
        type: "POST",
        url: BASE_URL + 'opm/form_approval',    
        data: formData, 
        dataType: "JSON", 
        cache:false,
        contentType: false,
        processData: false,

        success: function (data) {
            if (data.response == "Approved!") {
                $("#form_resp").css("display","block");
                $("#form_resp").html('<b style="color:green;">Approved Successfully!</b>');
                $("#form_resp").delay(3000).fadeOut(500);
                var explode = function(){
                    window.location.reload();
                };
                setTimeout(explode, 3000);
            } 
            else{
                $("#form_resp").css("display","block");
                $("#form_resp").html('<b style="color:red;">Hold ( Future Prospects )!</b>');
                $("#form_resp").delay(3000).fadeOut(500);
                var explode = function(){
                    window.location.reload();
                };
                setTimeout(explode, 3000);
            }
        }
    })
})


// Total count

function total_count_rsm(){
    $.ajax({
        url : BASE_URL + 'rsm/get_details',
        method : 'POST',
        dataType : 'JSON',

        success: function(data){
            $('#ct_entered_details').html(data.ct_entered_details);
            $('#rsm_approved_details').html(data.rsm_approved_details);
            $('#rsm_rejected_details').html(data.rsm_rejected_details);
        }
    })
}



