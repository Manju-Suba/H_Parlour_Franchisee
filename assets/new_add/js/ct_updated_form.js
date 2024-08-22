$(document).ready(function(){
    get_updated_form_list();
})

function get_updated_form_list(){

    var ct = $('#updated_tbl').DataTable({
        // 'dom': 'Bfrtip',
        // 'buttons': ['copy', 'excel', 'pdf', 'print', 'colvis'], 
        'processing': true, 
        'serverSide': true,
        'serverMethod': 'post', 
        "bDestroy": true, 
 
        'ajax': { 
            'url': BASE_URL + 'ct/get_all_updated_data',
            'data': function(data) {
                // data.filter_activity_date = $('#filter_activity_date').val();
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




// $("#save_form").click(function(){
//     // alert("save");

//     $("#save_status").val("1");
//     $("#form_submit_btn").click();
// })


// $("#step-form-horizontal").submit(function(){
//     // alert("submit");
//     // exit();

//     $("#form_submit_btn").attr("disabled","true"); 
    
//     $.ajax({  
//         type: "POST",
//         url: BASE_URL + 'ct/update_user_information',  
//         data: $("#step-form-horizontal").serialize(), 
//         dataType: "JSON",
 
//         success: function (data) {
//             if (data.response == "success") {
//                 $("#form_resp").css("display","block");
//                 $("#form_resp").html('<b style="color:green;">Updated Successfully.</b>');
//                 $("#form_resp").delay(3000).fadeOut(500);
//                 var explode = function(){
//                     $(".close").click();
//                     get_updated_form_list(); 
//                     // window.location.reload();
//                 };
//                 setTimeout(explode, 3000);
//             } 
            
//             $("#form_submit_btn").removeAttr("disabled");
//         }
//     })
// })