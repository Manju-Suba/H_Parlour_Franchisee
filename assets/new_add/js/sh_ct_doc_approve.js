$(document).ready(function(){
    $("#ct_doc_upload").hide();
    get_ct_doc_uploaded_datas();
    get_approved_datas();
})

function ct_doc_upload(){
    var x = document.getElementById("ct_doc_upload");
    if (x.style.display === "none") {
    x.style.display = "block";
    } else {
    x.style.display = "none";
    }
}

$("#filter_form").submit(function(){
    get_ct_doc_uploaded_datas();
})

$('#doc_filter_form').submit(function(){
    get_approved_datas();
})



// for export all data
function newexportaction(e, dt, button, config) {
    var self = this;
    var oldStart = dt.settings()[0]._iDisplayStart;
    dt.one('preXhr', function (e, s, data) {
        // Just this once, load all data from the server...
        data.start = 0;
        data.length = 2147483647;
        dt.one('preDraw', function (e, settings) {
            // Call the original action function
            if (button[0].className.indexOf('buttons-copy') >= 0) {
                $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                    $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
            } else if (button[0].className.indexOf('buttons-print') >= 0) {
                $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
            }
            dt.one('preXhr', function (e, s, data) {
                // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                // Set the property to what it was before exporting.
                settings._iDisplayStart = oldStart;
                data.start = oldStart;
            });
            // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
            setTimeout(dt.ajax.reload, 0);
            // Prevent rendering of the full data to the DOM
            return false;
        });
    });
    // Requery the server with the new one-time export settings
    dt.ajax.reload();
}

function get_ct_doc_uploaded_datas(){
    var ct = $('#doc_approved_list').DataTable({

        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy', className: 'btn-outline-primary btn-sm' },
            { extend: 'csv', className: 'btn-outline-primary  btn-sm' },
            { extend: 'excel', className: 'btn-outline-primary  btn-sm' },
            { extend: 'pdf', className: 'btn-outline-primary  btn-sm' },
            { extend: 'print', className: 'btn-outline-primary  btn-sm' },
          ],
          initComplete: function() {
            $('.buttons-copy').html('<span><i class="fa fa-copy"/> Copy</span>')
            $('.buttons-copy').css('font-size', '10px')
            $('.buttons-csv').html('<span><i class="fa fa-file-text-o" /> CSV</span>')
            $('.buttons-csv').css('font-size', '10px')
            $('.buttons-excel').html('<span><i class="fa fa-file-excel-o" /> Excel</span>')
            $('.buttons-excel').css('font-size', '10px')
            $('.buttons-pdf').html('<span><i class="fa fa-file-pdf-o" /> PDF</span>')
            $('.buttons-pdf').css('font-size', '10px')
            $('.buttons-print').html('<span><i class="fa fa-print" /> Print</span>')
            $('.buttons-print').css('font-size', '10px')
           },
        'processing': true,
        'serverSide': true, 
        'serverMethod': 'post',
        "bDestroy": true,
        "aoColumnDefs": [
            // { 'visible': false, 'targets': [14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40] }
        ],
        'ajax': { 
            'url': BASE_URL + 'sh/ct_doc_uploaded_form', 
            'data': function(data) {  
                data.from_date = $('#from_date').val();
                data.to_date = $('#to_date').val();
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
            // { "data": "distributor_code" }, 
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
 
//approve
function approve_action(id){
    $("#approve_pop").click();
    $("#id").val(id);
}

$("#pop_tt_choosen").submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    var id=$("#id").val();
    $.ajax({   
        type: "POST",
        url: BASE_URL + 'sh/move_doc',   
        data: formData, 
        dataType: "JSON", 
        cache:false,
        contentType: false,
        processData: false,

        success: function (data) {
            if (data.response == "success") {
                $("#form_respt").html('<b style="color:green;">Updated Successfully!</b>');
                $("#form_respt").delay(3000).fadeOut(2000);
                var explode = function(){
                    window.location.reload();
                };
                setTimeout(explode, 3000);
            } 
            
        }
    })
})


// onboarding_doc_approved_list

function get_approved_datas(){
    var ct = $('#onboarding_doc_approved_list').DataTable({

        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy', className: 'btn-outline-primary btn-sm' },
            { extend: 'csv', className: 'btn-outline-primary  btn-sm' },
            { extend: 'excel', className: 'btn-outline-primary  btn-sm' },
            { extend: 'pdf', className: 'btn-outline-primary  btn-sm' },
            { extend: 'print', className: 'btn-outline-primary  btn-sm' },
          ],
          initComplete: function() {
            $('.buttons-copy').html('<span><i class="fa fa-copy"/> Copy</span>')
            $('.buttons-copy').css('font-size', '10px')
            $('.buttons-csv').html('<span><i class="fa fa-file-text-o" /> CSV</span>')
            $('.buttons-csv').css('font-size', '10px')
            $('.buttons-excel').html('<span><i class="fa fa-file-excel-o" /> Excel</span>')
            $('.buttons-excel').css('font-size', '10px')
            $('.buttons-pdf').html('<span><i class="fa fa-file-pdf-o" /> PDF</span>')
            $('.buttons-pdf').css('font-size', '10px')
            $('.buttons-print').html('<span><i class="fa fa-print" /> Print</span>')
            $('.buttons-print').css('font-size', '10px')
           },
        'processing': true,
        'serverSide': true, 
        'serverMethod': 'post',
        "bDestroy": true,
        "aoColumnDefs": [
            // { 'visible': false, 'targets': [14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40] }
        ],
        'ajax': {  
            'url': BASE_URL + 'sh/onboarding_doc_approved_list', 
            'data': function(data) { 
                data.from_date = $('#from_date').val();
                data.to_date = $('#to_date').val();
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
            { "data": "trainee" }, 

        ], 
        "order": [
            [1, 'asc']
        ] 
    });
}

