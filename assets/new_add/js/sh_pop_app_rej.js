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

function approve_action(id){
    $("#approve_pop").click();
    $("#id").val(id);
} 

$("#pop_rej_ap_form").submit(function(e){

    e.preventDefault();
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

    var doc="";
    if(type=="Approved"){
        doc=$("#approve_doc").val();
        if(doc ==""){
            $("#doc_resp").fadeIn();
            $("#doc_resp").css("display","block");
            $("#doc_resp").html('<b style="color:red;">Need Document field.</b>');
            $("#doc_resp").delay(3000).fadeOut(500);
            return false;
        }
    }

    formData.append('type', type);

    $.ajax({   
        type: "POST",
        url: BASE_URL + 'sh/form_approval',   
        data: formData, 
        dataType: "JSON", 
        cache:false,
        contentType: false,
        processData: false,

        success: function (data) {
            if (data.response == "Nethaji Approved!") {
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

//datatable 
$(document).ready(function(){
    var urlParams = new URLSearchParams(window.location.search);
    get_approved_list();
    get_rejected_list();
    get_entered_list();
})

$("#filter_form").submit(function(){
    get_approved_list();
})

function get_approved_list(){ 
    var ct = $('#approved_form').DataTable({

        dom: 'Bfrtip', 
			buttons: [
				{
					// extend: 'print',
					// exportOptions: {
					// 	columns: [  0, 1, 2,3,4,5,6]
					// },
                    // action: newexportaction
				},
			],
        'processing': true,
        'serverSide': true, 
        'serverMethod': 'post',
        "bDestroy": true,
        "aoColumnDefs": [
            // { 'visible': false, 'targets': [6,7,8,9,10,11,12,13] }
        ],
        'ajax': {
            'url': BASE_URL + 'sh/get_approved_list', 
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
            { "data": "approval" }, 
        ],
        "order": [
            [1, 'asc']
        ]
    });
}


$("#rej_filter_form").submit(function(){
    get_rejected_list();
})

function get_rejected_list(){ 
    var ct = $('#rejected_form').DataTable({

        dom: 'Bfrtip', 
		buttons: [
			],
        'processing': true,
        'serverSide': true, 
        'serverMethod': 'post',
        "bDestroy": true,
        "aoColumnDefs": [
            // { 'visible': false, 'targets': [6,7,8,9,10,11,12,13] }
        ],
        'ajax': {
            'url': BASE_URL + 'sh/get_rejected_list', 
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


$("#rsmi_filter_form").submit(function(){
    get_entered_list();
})

function get_entered_list(){ 
    var ct = $('#rsmi_entered_list').DataTable({

        dom: 'Bfrtip', 
        'processing': true,
        'serverSide': true, 
        'serverMethod': 'post',
        "bDestroy": true, 
        "aoColumnDefs": [
            // { 'visible': false, 'targets': [6,7,8,9,10,11,12,13] }
        ],
        'ajax': {
            'url': BASE_URL + 'sh/get_rsmi_entered_list', 
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