$(document).ready(function(){
    $("#ct_post_doc_upload").hide();
    $("#ct_pre_doc").hide();
    post_upload_form_datas(); 
})

function ct_pre_doc(){
    var x = document.getElementById("ct_pre_doc");
    var y = document.getElementById("ct_post_doc_upload");
    if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    } else {
    x.style.display = "none";
    }
}

function ct_post_doc_upload(){
    var x = document.getElementById("ct_post_doc_upload");
    var y = document.getElementById("ct_pre_doc");
    if (x.style.display === "none") {
    x.style.display = "block";
    y.style.display = "none";
    } else {
    x.style.display = "none";
    }
}

function enter_code(id,name,distributor_code){
    $("#pop_shop_name").html(name);
    $("#user_id").val(id);
    $("#user_code").val(distributor_code);
    $("#edit_pop_trigger").click();
} 

$("#filter_form").submit(function(){
    post_upload_form_datas();
})

$("#upload_inv_num_file").click(function(){
    $("#upload_inv_num_file_trigger").click();
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

function post_upload_form_datas(){
    var ct = $('#post_upload_form_list').DataTable({

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
        ],
        'ajax': {
            'url': BASE_URL + 'ct/post_upload_form_list', 
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
             
            { "data": "action" }, 
            { "data": "name" }, 
            { "data": "createddate" }, 
            { "data": "distributor_code" }, 
            { "data": "mobile" },
            { "data": "shop_address" }, 
            { "data": "town_code" }, 
            { "data": "score" }, 
            { "data": "proof_type" }, 
            { "data": "created_by" }, 
            { "data": "approval" }, 
            // { "data": "action_btn" }, 

        ], 
        "order": [
            [1, 'asc']
        ]
    });
}

function insert_post_doc(){
    var a_img=$("#asset_img").val();
    var t_img=$("#team_img").val();

    if(a_img !="" || t_img !=""){
        var asset_img= $("#asset_img")[0].files[0];
        var team_img = $("#team_img")[0].files[0];
        var id_val=$("#id_val").val();

        var fd = new FormData();
        fd.append("asset_img", asset_img);
        fd.append("team_img", team_img);
        fd.append("id_val", id_val); 

        $.ajax({ 
            type: "post",
            url: BASE_URL + 'ct/insert_post_document',
            data: fd,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(response) {
                if (response.responce == "success") {
                    $("#success").html('<b style="color:green;">Uploaded Successfully..!</b>');
                  // setTimeout(function() { 
                  //     $("#ct_post_doc_upload").hide();
                  // }, 2000)
  
                  var explode = function(){
                      window.location.reload();
                  };
                  setTimeout(explode, 3000);
  
                }else{
                    $("#success").html('<b style="color:red;">Upload has an Error..!</b>');
                    $("#success").delay(3000).fadeOut(500);

                }
            },
        });
    }else{
        alert("No data found!");
    }
    
}

function update_post_doc(){

    if( ($("#asset_img").val() ) !="0" ){
        var asset_img= $("#asset_img")[0].files[0];
    }else{
        var asset_img ="";
    }

    if( ($("#team_img").val() ) !="0" ){
        var team_img = $("#team_img")[0].files[0];
    }else{
        var team_img ="";
    }
    var id_val=$("#id_val").val();

    var fd = new FormData();
        fd.append("asset_img", asset_img);
        fd.append("team_img", team_img);
        fd.append("id_val", id_val); 
        $.ajax({ 
            type: "post",
            url: BASE_URL + 'ct/update_post_doc',
            data: fd,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(response) {
                if (response.responce == "success") {
                    $("#success").html('<b style="color:green;">Uploaded Successfully..!</b>');
                    $("#success").delay(3000).fadeOut(500);
                    var explode = function(){
                        window.location.reload();
                    };
                    setTimeout(explode, 3000);

                }
                else{
                    $("#success").html('<b style="color:red;">Upload has an Error..!</b>');
                    $("#success").delay(3000).fadeOut(500);

                }
            },
        });

}



   
