$(document).ready(function(){
    get_funneled_form_list();
})

function get_funneled_form_list(){


    var ct = $('#funneled_tbl').DataTable({
        // 'dom': 'Bfrtip',
        // 'buttons': ['copy', 'excel', 'pdf', 'print', 'colvis'], 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post', 
        "bDestroy": true,
 
        'ajax': { 
            'url': BASE_URL + 'ct/get_all_funneled_data',
            'data': function(data) {
            } 
        },
        
        "columns": [
            {
                title: 'S.No',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "name" },
            { "data": "mobile" },
            { "data": "shop_address" },
            { "data": "town_code" },
            { "data": "score" },
            { "data": "proof_type" },
            { "data": "created_by" },
            { "data": "rsm_status" },
            { "data": "remarks" },
            { "data": "action" }, 
        ],
        "order": [
            [1, 'asc']
        ]
    });
}

 
// $("#save_form").click(function(){

//     $("#save_status").val("1");
//     $("#form_submit_btn").click();
// })

 
// $("#step-form-horizontal").submit(function(){
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
//                     // get_funneled_form_list();
//                     window.location.reload();
//                 };
//                 setTimeout(explode, 3000);
//             } 
            
//             $("#form_submit_btn").removeAttr("disabled");
//         }
//     })
// })