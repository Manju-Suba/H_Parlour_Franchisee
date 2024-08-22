$(document).ready(function(){
    var urlParams = new URLSearchParams(window.location.search);
    get_list();
    get_rejected_list();
    get_rsm_entered_list();
})

$("#filter_form").submit(function(){
    get_list();
})

$("#rej_filter_form").submit(function(){
    get_rejected_list();
}) 

$("#rsm_filter_form").submit(function(){
    get_rsm_entered_list();
}) 

function get_list(){ 
    var ct = $('#approved_form').DataTable({

        dom: 'Bfrtip', 
        'processing': true,
        'serverSide': true, 
        'serverMethod': 'post',
        "bDestroy": true,
        "aoColumnDefs": [
            // { 'visible': false, 'targets': [6,7,8,9,10,11,12,13] }
        ],
        'ajax': {
            'url': BASE_URL + 'cidhaya/get_approved_list', 
            'data': function(data) {
                data.rsm = $('#rsm').val();
                data.bdm = $('#bdm').val();
            }
        },
        createdRow: function( row, data, dataIndex ) {
            if (data.row_bg_c == "red") {
                $(row).addClass('danger');
            }
        },
        "columns": [ 
            {
                title: 'S.No',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "details" },
            { "data": "name" },
            { "data": "mobile" },
            { "data": "shop_address" },
            { "data": "town_code" },
            { "data": "score" },
            { "data": "proof_type" },
            { "data": "created_by" },
            { "data": "approval" }, 
        ],
        "order": [
            [1, 'asc']
        ]
    });
}


 

function get_rejected_list(){ 
    var ct = $('#rejected_form').DataTable({

        dom: 'Bfrtip', 
        'processing': true,
        'serverSide': true, 
        'serverMethod': 'post',
        "bDestroy": true,
        "aoColumnDefs": [
            // { 'visible': false, 'targets': [6,7,8,9,10,11,12,13] }
        ],
        'ajax': {
            'url': BASE_URL + 'cidhaya/get_rejected_list', 
            'data': function(data) {
                data.rsm = $('#rsm').val();
                data.bdm = $('#bdm').val();
            }
        },
        createdRow: function( row, data, dataIndex ) {
            if (data.row_bg_c == "red") {
                $(row).addClass('danger');
            }
        },
        "columns": [ 
            {
                title: 'S.No',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "details" },
            { "data": "name" },
            { "data": "mobile" },
            { "data": "shop_address" },
            { "data": "town_code" },
            { "data": "score" },
            { "data": "proof_type" },
            { "data": "created_by" },
            { "data": "action" }, 
        ],
        "order": [
            [1, 'asc']
        ]
    });
}

function approve_action(id){
    $("#approve_pop").click();
    $("#id").val(id);
}


function get_rsm_entered_list(){ 
    var ct = $('#entered_list').DataTable({

        dom: 'Bfrtip', 
		buttons: [ ],
        'processing': true,
        'serverSide': true, 
        'serverMethod': 'post',
        "bDestroy": true,
        "aoColumnDefs": [
            // { 'visible': false, 'targets': [6,7,8,9,10,11,12,13] }
        ],
        'ajax': {
            'url': BASE_URL + 'cidhaya/get_entered_list', 
            'data': function(data) {
                data.rsm = $('#rsm').val();
                data.bdm = $('#bdm').val();
            }
        },
        createdRow: function( row, data, dataIndex ) {
            if (data.row_bg_c == "red") {
                $(row).addClass('danger');
            }
        },
        "columns": [ 
            {
                title: 'S.No',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "details" },
            { "data": "name" },
            { "data": "mobile" },
            { "data": "shop_address" },
            { "data": "town_code" },
            { "data": "score" },
            { "data": "proof_type" },
            { "data": "created_by" },
            { "data": "ct_verify" },
            { "data": "action" }, 
        ],
        "order": [
            [1, 'asc']
        ]
    });
}
