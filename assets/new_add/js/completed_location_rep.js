$(document).ready(function(){
    com_location_table();
    location_count_rep();
}) 

function com_location_table(){
    $('#completed_location').DataTable({
        // 'dom': 'Bfrtip',
        // 'buttons': ['copy', 'excel', 'pdf', 'print', 'colvis'], 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post', 
        "bDestroy": true,   
 
        'ajax': {
            'url': BASE_URL + 'rep/get_completed_location',
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
               $('.morn_imgs').html(data.morn_imgs);
               $('.after_imgs').html(data.after_imgs);
               $('.even_imgs').html(data.even_imgs);
            }
        }
    })
}


function get_id(id){
    $("#app_reg_id").val(id)
}

 

function location_count_rep(){
    $.ajax({
        url : BASE_URL + 'rep/get_location_count',
        method : 'POST',
        dataType : 'JSON',

        success: function(data){

            $('#location_rep').html(data.location_rep);
            $('#completed_location_rep').html(data.completed_location_rep);
        }
    })
}