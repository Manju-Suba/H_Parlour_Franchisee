$(document).ready(function(){
    // $("#ct_post_doc_upload").hide();
    // $("#ct_pre_doc").hide();
    $('#ct_doc_upload').hide();
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

// function ct_post_doc_upload(){
//     var x = document.getElementById("ct_post_doc_upload");
//     var y = document.getElementById("ct_pre_doc");
//     if (x.style.display === "none") {
//     x.style.display = "block";
//     y.style.display = "none";
//     } else {
//     x.style.display = "none";
//     }
// }


function enter_code(id,name,distributor_code){
    $("#pop_shop_name").html(name);
    $("#user_id").val(id);
    $("#user_code").val(distributor_code);
    $("#edit_pop_trigger").click();
} 

$("#filter_form").submit(function(){
    get_approved_datas();
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
 
function get_approved_datas(){
    from_date = $('#from_date').val();
    to_date = $('#to_date').val();

    // if ((Date.parse(from_date) <= Date.parse(to_date))) {
    //     alert("End date should be greater than Start date");
    // }

    var ct = $('#approved_list').DataTable({

        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy', 
                className: 'btn-outline-primary btn-sm' ,
                exportOptions: {
                    columns: [  0,2,3,4,5,6,7,8,9,10]
                },
                action: newexportaction
            },
            { extend: 'csv', 
                className: 'btn-outline-primary  btn-sm' ,
                exportOptions: {
                    columns: [  0,2,3,4,5,6,7,8,9,10]
                },
                action: newexportaction
            },
            { extend: 'excel', 
                className: 'btn-outline-primary  btn-sm' ,
                exportOptions: {
                    columns: [  0,2,3,4,5,6,7,8,9,10]
                },
                action: newexportaction
            },
            { extend: 'pdf', 
                className: 'btn-outline-primary  btn-sm' ,
                exportOptions: {
                    columns: [  0,2,3,4,5,6,7,8,9,10]
                },
                action: newexportaction
            },
            { extend: 'print', 
                className: 'btn-outline-primary  btn-sm' ,
                exportOptions: {
                    columns: [  0,2,3,4,5,6,7,8,9,10]
                },
                action: newexportaction
            },
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
            // { 'visible': false, 'targets': [14] }
        ],
        'ajax': { 
            'url': BASE_URL + 'ct/ct_approved_form', 
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
            // { "data": "town_code" }, 
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

function insert_pre_doc(){
    var sign_agree= $("#sign_agree").val();
    var profile = $("#profile").val();
    var challan = $("#challan").val();
    var fassai= $("#fassai").val();
    var gst= $("#gst").val();
    var pan = $("#pan").val();
    var aadhar = $("#aadhar").val();
    var current_acc = $("#current_acc").val();
    var a_img=$("#asset_img").val();
    var t_img=$("#team_img").val();
    var retail_img=$("#team_img").val();

    if(a_img !="" || t_img !="" || sign_agree !="" || profile !="" || challan !="" || fassai !="" || gst !="" || pan!="" || aadhar!="" || current_acc !="" || retail_img!=""){

        var sign_agree= $("#sign_agree")[0].files[0];
        var profile = $("#profile")[0].files[0];
        var challan = $("#challan")[0].files[0];
        var fassai= $("#fassai")[0].files[0];
        var gst= $("#gst")[0].files[0];
        var pan = $("#pan")[0].files[0];
        var aadhar = $("#aadhar")[0].files[0];
        var current_acc = $("#current_acc")[0].files[0];
        var asset_img= $("#asset_img")[0].files[0];
        var team_img = $("#team_img")[0].files[0];
        var retail_outlet = $("#retail_outlet")[0].files[0];
        var id_val=$("#id_val").val();

        var fd = new FormData();
        fd.append("sign_agree", sign_agree);
        fd.append("profile", profile);
        fd.append("challan", challan);
        fd.append("fassai", fassai);
        fd.append("gst", gst);
        fd.append("pan", pan);
        fd.append("aadhar", aadhar);
        fd.append("current_acc", current_acc);
        fd.append("retail_outlet", retail_outlet);
        fd.append("asset_img", asset_img);
        fd.append("team_img", team_img);
        
        fd.append("id_val", id_val); 
 
        $.ajax({  
            type: "post",
            url: BASE_URL + 'ct/insert_pre_document',
            data: fd,
            processData: false,
            contentType: false, 
            dataType: "json",

            success: function(data) {
                if (data.responce == "success") {
                    $("#success").fadeIn();
                    $("#success").html('<b style="color:green;">Uploaded Successfully..!</b>');
                    $("#success").delay(3000).fadeOut(500);
                    
                    var id = data.id ;
                    fetch_all_detail(id);
                    // $("#ct_post_doc_upload").hide();
                    // $('#ct_pre_doc').hide();
                }
                else{
                    $("#success").fadeIn();
                    $("#success").html('<b style="color:red;">Upload has an Error..!</b>');
                    $("#success").delay(3000).fadeOut(500);

                }
            },
        }); 
    }else{
        alert("No data found in Pre-Onboarding!");
    }
}

function update_pre_doc(){

    if( ($("#sign_agree").val() ) !="0" ){
        var sign_agree= $("#sign_agree")[0].files[0];
    }else{
        var sign_agree ="";
    }
    if( ($("#profile").val() ) !="0" ){
        var profile = $("#profile")[0].files[0];
    }else{
        var profile="";
    } 
    if( ($("#challan").val() ) !="0" ){
        var challan = $("#challan")[0].files[0];
    }else{
        var challan ="";
    }
    if( ($("#fassai").val() ) !="0" ){
        var fassai= $("#fassai")[0].files[0];
    }else{
        var fassai="";
    } 
    if( ($("#gst").val() ) !="0" ){
        var gst= $("#gst")[0].files[0];
    }else{
        var gst="";
    } 
    if( ($("#pan").val() ) !="0" ){
        var pan = $("#pan")[0].files[0];
    }else{
        var pan="";
    } 
    if( ($("#aadhar").val() ) !="0" ){
        var aadhar = $("#aadhar")[0].files[0];
    }else{
        var aadhar="";
    }  
    if( ($("#current_acc").val() ) !="0" ){
        var current_acc = $("#current_acc")[0].files[0];
    }else{
        var current_acc=""; 
    }   
    if( ($("#retail_outlet").val() ) !="0" ){
        var retail_outlet = $("#retail_outlet")[0].files[0];
    }else{
        var retail_outlet=""; 
    }  
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
      fd.append("sign_agree", sign_agree);
      fd.append("profile", profile);
      fd.append("challan", challan);
      fd.append("fassai", fassai);
      fd.append("gst", gst);
      fd.append("pan", pan);
      fd.append("aadhar", aadhar);
      fd.append("current_acc", current_acc);
      fd.append("retail_outlet", retail_outlet);
      fd.append("asset_img", asset_img);
      fd.append("team_img", team_img);
       
      fd.append("id_val", id_val); 
      $.ajax({   
          type: "post",
          url: BASE_URL + 'ct/update_sh_document',
          data: fd,
          processData: false, 
          contentType: false,
          dataType: "json",
          success: function(data) {
            if (data.responce == "success") {
                $("#success").fadeIn();
                $("#success").html('<b style="color:green;">Uploaded Successfully..!</b>');
                $("#success").delay(3000).fadeOut(500);

                var id = data.id ;
                fetch_all_detail(id);
                // $("#ct_post_doc_upload").hide();
                // $('#ct_pre_doc').hide();
                   
            }else{
                $("#success").fadeIn();
                $("#success").html('<b style="color:red;">Upload has an Error..!(Please check file format to upload.)</b>');
                $("#success").delay(3000).fadeOut(500);

            }
        },
    }); 
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


// function move_doc(id){

//     $.ajax({ 
//         type: "post",
//         url: BASE_URL + 'ct/move_doc',
//         data: { 'id': id},
//         dataType: "json", 

//         success: function(data) {
//             if (data.responce == "success") {
//                 $("#success").fadeIn();
//                 $("#success").html('<b style="color:green;">Updated Successfully..!</b>');
//                 $("#success").delay(3000).fadeOut(500);
                
//                 var id = data.id ;
//                 fetch_all_detail(id);
//                 // $("#ct_post_doc_upload").hide();
//                 // $('#ct_pre_doc').hide();

//             } else{
//                 $("#success").fadeIn();
//                 $("#success").html('<b style="color:red;">Updation Error..!</b>');
//                 $("#success").delay(3000).fadeOut(500);

//             }
//         },
//     });
// }


// post doc part
// function insert_post_doc(){
//     var a_img=$("#asset_img").val();
//     var t_img=$("#team_img").val();

//     if(a_img !="" || t_img !=""){
//         var asset_img= $("#asset_img")[0].files[0];
//         var team_img = $("#team_img")[0].files[0];
//         var id_val=$("#id_val").val();

//         var fd = new FormData();
//         fd.append("asset_img", asset_img);
//         fd.append("team_img", team_img);
//         fd.append("id_val", id_val); 

//         $.ajax({ 
//             type: "post",
//             url: BASE_URL + 'ct/insert_post_document',
//             data: fd,
//             processData: false,
//             contentType: false,
//             dataType: "json",
//             success: function(data) {
//                 if (data.responce == "success") {
//                     $("#success").fadeIn();
//                     $("#success").html('<b style="color:green;">Uploaded Successfully..!</b>');
//                     $("#success").delay(3000).fadeOut(500);

//                   // setTimeout(function() { 
//                   //     $("#ct_post_doc_upload").hide();
//                   // }, 2000)
  
//                     var id = data.id ;
//                     fetch_all_detail(id);
//                     // $("#ct_post_doc_upload").hide();
//                     // $('#ct_pre_doc').hide();
   
//                 }else{
//                     $("#success").fadeIn();
//                     $("#success").html('<b style="color:red;">Upload has an Error..!</b>');
//                     $("#success").delay(3000).fadeOut(500);

//                 }
//             },
//         });
//     }else{
//         alert("No data found in Post-Onboarding!");
//     }
    
// }

// function update_post_doc(){

//     if( ($("#asset_img").val() ) !="0" ){
//         var asset_img= $("#asset_img")[0].files[0];
//     }else{
//         var asset_img ="";
//     }

//     if( ($("#team_img").val() ) !="0" ){
//         var team_img = $("#team_img")[0].files[0];
//     }else{
//         var team_img ="";
//     }
//     var id_val=$("#id_val").val();

//     var fd = new FormData();
//     fd.append("asset_img", asset_img);
//     fd.append("team_img", team_img);
//     fd.append("id_val", id_val); 
//     $.ajax({ 
//         type: "post",
//         url: BASE_URL + 'ct/update_post_doc',
//         data: fd,
//         processData: false,
//         contentType: false,
//         dataType: "json",
//         success: function(data) {
//             if (data.responce == "success") {
//                 $("#success").fadeIn();
//                 $("#success").html('<b style="color:green;">Uploaded Successfully..!</b>');
//                 $("#success").delay(3000).fadeOut(500);
//                 // var explode = function(){
//                 //     window.location.reload();
//                 // };
//                 // setTimeout(explode, 3000);

//                 var id = data.id ;
//                 fetch_all_detail(id);
//                 // $("#ct_post_doc_upload").hide();
//                 // $('#ct_pre_doc').hide();

//             }
//             else{
//                 $("#success").fadeIn();
//                 $("#success").html('<b style="color:red;">Upload has an Error..!</b>');
//                 $("#success").delay(3000).fadeOut(500);

//             }
//         },
//     });

// }

   
