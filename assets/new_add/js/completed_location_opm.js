$(document).ready(function(){
    completed_location_table();
    approved_location_table();
    rejected_location_table();
    location_count_om();
}) 

function completed_location_table(){
    $('#completed_location').DataTable({
        // 'dom': 'Bfrtip',
        // 'buttons': ['copy', 'excel', 'pdf', 'print', 'colvis'], 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post', 
        "bDestroy": true,  
 
        'ajax': {
            'url': BASE_URL + 'opm/get_completed_location',
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
            {  
                "data": "review_date",  
                "render": function (data) {  
                var date = new Date(data);  
                var month = date.getMonth() + 1;  
                return date.getDate() + "-" +  (month.length > 1 ? month : "0" + month) + "-" + date.getFullYear();  
              }},
            { "data": "img" },
            { "data": "action" }, 
        ],
        "order": [
            [1, 'asc']
        ]
    });
}


function get_image(id){ 
    $.ajax({
        url: BASE_URL+"common/get_image",
        type: "post",
        dataType: 'json',
        data:{id:id},
        success: function(data) {
            if(data.res=="success"){
               $('.morn_imgs').html(data.morn_imgs);
               $('.after_imgs').html(data.after_imgs);
               $('.even_imgs').html(data.even_imgs);
            }
        }
    })
}

$("#app_btn").click(function(){
    $("#type").val("Approved");
    $(".form_hid_action").css("display","block");
    $(".form_hid_action_doc").css("display","block");
})

$("#rej_btn").click(function(){
    $("#type").val("Rejected");
    $(".form_hid_action_doc").css("display","none");
    $(".form_hid_action").css("display","block");
})


$(document).on('submit', '#pop_rej_ap_form', function() {

    var formData = new FormData(this);

    var id=$("#id").val();
    var type=$("#type").val();

    var approve_doc=$("#approve_doc").val();

    if($("#approve_doc").val()!== ''){
        formData.append('approve_doc', approve_doc.files);
    } 
    else{
        formData.append('approve_doc', "");
    }

    var rsm ="";
    var doc ="";
    if(type =="Approved"){
        rsm = $('#rsm_choosen').val();
        if(rsm =="" || rsm == null){

            $("#move_to_req").fadeIn();
            $("#move_to_req").css("display","block");
            $("#move_to_req").html('<b style="color:red; margin-left:14px;"><i class="fa fa-warning" style="color:red"></i>&nbsp;Need Move to field.</b>');
            $("#move_to_req").delay(3000).fadeOut(500);
            return false;
        }

        doc = $("#approve_doc").val();
        if(doc ==""){
            $("#doc_req").fadeIn();
            $("#doc_req").css("display","block");
            $("#doc_req").html('<b style="color:red; margin-left:14px;"><i class="fa fa-warning" style="color:red"></i>&nbsp;Need document field.</b>');
            $("#doc_req").delay(3000).fadeOut(500);
            return false;
        }
    }

    var remarks="";
    if(type=="Rejected"){
        remarks=$("#remarks").val();
        if(remarks==""){
            $("#form_resp").fadeIn();

            $("#form_resp").css("display","block");
            $("#form_resp").html('<b style="color:red;">Need Remark field.</b>');
            $("#form_resp").delay(3000).fadeOut(500);
            return false;
        }
    }

    formData.append('type', type);


    $.ajax({   
        type: "POST",
        url: BASE_URL+"opm/approval_locations",
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

function get_id(id){
    $("#app_reg_id").val(id)
}


function approved_location_table(){
    $('#approved_location').DataTable({
        // 'dom': 'Bfrtip',
        // 'buttons': ['copy', 'excel', 'pdf', 'print', 'colvis'], 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post', 
        "bDestroy": true, 
 
        'ajax': {
            'url': BASE_URL + 'opm/get_approved_locations',
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
            {  
                "data": "review_date",  
                "render": function (data) {  
                var date = new Date(data);  
                var month = date.getMonth() + 1;  
                return date.getDate() + "-" +  (month.length > 1 ? month : "0" + month) + "-" + date.getFullYear();  
              }},
            { "data": "img" },
        ],
        "order": [
            [1, 'asc']
        ]
    });
}


function rejected_location_table(){
    $('#rejected_location').DataTable({
        // 'dom': 'Bfrtip',
        // 'buttons': ['copy', 'excel', 'pdf', 'print', 'colvis'], 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post', 
        "bDestroy": true, 
 
        'ajax': {
            'url': BASE_URL + 'opm/get_rejected_locations',
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
            {  
                "data": "review_date",  
                "render": function (data) {  
                var date = new Date(data);  
                var month = date.getMonth() + 1;  
                return date.getDate() + "-" +  (month.length > 1 ? month : "0" + month) + "-" + date.getFullYear();  
              }},
            { "data": "img" },
            { "data": "action" },
        ],
        "order": [
            [1, 'asc']
        ]
    });
}



// total count //
function location_count_om(){
    $.ajax({
        url : BASE_URL + 'opm/get_location_count',
        method : 'POST',
        dataType : 'JSON',

        success: function(data){

            $('#completed_location_rep').html(data.completed_location_rep);
            $('#app_location_om').html(data.app_location_om);
            $('#rej_location_om').html(data.rej_location_om);
        }
    })
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
 