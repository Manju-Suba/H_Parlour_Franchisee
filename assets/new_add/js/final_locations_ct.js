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
            'url': BASE_URL + 'common/get_final_locations',
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

        ],
        "order": [
            [1, 'des']
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