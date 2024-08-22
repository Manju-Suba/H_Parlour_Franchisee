$(document).ready(function(){
    free_location_();
    allocates_location_();
})

function free_location_(){ 
    $('#free_location').DataTable({
        // 'dom': 'Bfrtip',
        // 'buttons': ['copy', 'excel', 'pdf', 'print', 'colvis'], 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post', 
        "bDestroy": true,
 
        'ajax': {
            'url': BASE_URL + 'sa/get_free_locations',
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
            { "data": "allocate_act" }, 
        ],
        "order": [
            [1, 'asc']
        ]
    });
}

function allocate_locate(id,name){
    $("#allocate_location_id").val(id);
    $("#c_name").html(name);
}

$(document).on('submit', '#rep_allocate_form', function() {
    $.ajax({
        url: BASE_URL+"sa/rep_allocation_action",
        type: "post",
        dataType: 'json',
        data: $("#rep_allocate_form").serialize(),
        success: function(data) {
            if(data.res=="success"){
                $("#form_resp").fadeIn();
                $("#form_resp").css("display","block");
                $("#form_resp").html('<b style="color:green;">Allocated Successfully.</b>');
                $("#form_resp").delay(3000).fadeOut(500);

                var explode = function(){
                    $('#myModal').modal('hide');
                    free_location_();
                    allocates_location_();
                };
                setTimeout(explode, 3000);
            }
        }
    })
})
 

//Allocated location 

function allocates_location_(){
    $('#allocated_location').DataTable({
        // 'dom': 'Bfrtip',
        // 'buttons': ['copy', 'excel', 'pdf', 'print', 'colvis'], 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post', 
        "bDestroy": true,
 
        'ajax': {
            'url': BASE_URL + 'sa/get_allocated_locations',
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
            { "data": "allocated_person" }, 
        ],
        "order": [
            [1, 'asc']
        ]
    });
}