$(document).on('submit', '#pop_rej_ap_form', function() {
    $.ajax({
        url: BASE_URL+"sh/approval_locations",
        type: "post",
        dataType: 'json',
        data: $("#pop_rej_ap_form").serialize(),
        success: function(data) {
            if(data.res=="success"){
                $('#myModal').modal('hide');
                location_table();
            }
        }
    })
})

function get_id(id){
    $("#app_reg_id").val(id)
}

 
$(document).ready(function(){
    location_table();
})

function location_table(){
    $('#final_locations').DataTable({
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post', 
        "bDestroy": true,
 
        'ajax': {
            'url': BASE_URL + 'sh/get_final_locations',
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
            { "data": "time_schedule" },
            
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
            // { "data": "action" }, 
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
               $('.imgs').html(data.img);
            }
        }
    })
}