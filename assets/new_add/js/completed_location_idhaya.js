$(document).ready(function(){
    completed_location_table();
    approved_location_table();
    rejected_location_table();
    final_location_table();
    location_count_idhaya();
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
            'url': BASE_URL + 'cidhaya/get_completed_location',
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
    $.ajax({
        url: BASE_URL+"cidhaya/approval_locations",
        type: "post",
        dataType: 'json',
        data: $("#pop_rej_ap_form").serialize(),
        success: function(data) {
            if(data.res=="success"){
                $("#form_resp").css("display","block");
                $("#form_resp").html('<b style="color:green;">Approved Successfully!</b>');
                $("#form_resp").delay(3000).fadeOut(500);
                var explode = function(){
                    window.location.reload();
                };
                setTimeout(explode, 3000);
            }else{
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

//APPROVED LOCATION
function approved_location_table(){
    $('#approved_location').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post', 
        "bDestroy": true,
  
        'ajax': {
            'url': BASE_URL + 'cidhaya/get_approved_locations',
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
            {  
                "data": "updated_at",  
                "render": function (data) {  
                var date = new Date(data);  
                var month = date.getMonth() + 1;  
                return date.getDate() + "-" +  (month.length > 1 ? month : "0" + month) + "-" + date.getFullYear();  
              }}, 
            { "data": "img" },
            { "data": "remarks" },
            // { "data": "action" }, 
        ],  
        "order": [ 
            [1, 'asc']
        ]
    });
}


// REJECTED LOCATION
function rejected_location_table(){
    $('#rejected_location').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post', 
        "bDestroy": true,
 
        'ajax': {
            'url': BASE_URL + 'cidhaya/get_rejected_locations',
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
                "data": "updated_at",  
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


// final location
function final_location_table(){
    $('#final_location').DataTable({
        // 'dom': 'Bfrtip',
        // 'buttons': ['copy', 'excel', 'pdf', 'print', 'colvis'], 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post', 
        "bDestroy": true,
  
        'ajax': {
            'url': BASE_URL + 'cidhaya/get_final_locations',
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



// total count //
function location_count_idhaya(){
    $.ajax({
        url : BASE_URL + 'cidhaya/get_location_count',
        method : 'POST',
        dataType : 'JSON',

        success: function(data){

            $('#completed_location_rsmi').html(data.completed_location_rsmi);
            $('#capp_location_count').html(data.capp_location_count);
            $('#crej_location_count').html(data.crej_location_count);
            $('#final_location_rsmi').html(data.final_location_rsmi);
        }
    })
}