$(document).ready(function(){
    get_funneled_form_list();
})
 
function get_funneled_form_list(){
    var ct = $('#customer_entered_tbl').DataTable({
        // 'dom': 'Bfrtip',
        // 'buttons': ['copy', 'excel', 'pdf', 'print', 'colvis'], 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post', 
        "bDestroy": true,    
   
        'ajax': {
            'url': BASE_URL + 'cc/get_all_customer_data',
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

function edit_business_pop(id){
    $("#save_status").val("0");  

    $.ajax({ 
        type: "POST",
        url: BASE_URL + 'cc/get_funneled_row_data',
        data: { 'id': id},
        dataType: "JSON",

        success: function (data) {

            $("#id").val(id);
            $("#name").val(data["row"][0]['name']); 
            $("#email").val(data["row"][0]['email']); 
            $("#mobile").val(data["row"][0]['mobile']);
            $("#whatsapp_no").val(data["row"][0]['whatsapp_no']);
            $("#landline").val(data["row"][0]['landline']);
            $("#address").val(data["row"][0]['shop_address']);
            $("#annual_income").val(data["row"][0]['annual_income']);
            $("#education_q").val(data["row"][0]['education']);
            $("#shop_zipcode").val(data["row"][0]['shop_zipcode']);
            $("#population").val(data["row"][0]['population']);
            $("#town_code").val(data["row"][0]['town_code']);

            if((data["row"][0]['area']) == 10){
                $('#area').prop('checked',true);
            }
            if((data["row"][0]['area']) == 5){
                $('#area2').prop('checked',true);
            }

            if((data["row"][0]['age']) == 10){
                $('#age').prop('checked',true);
            }
            if((data["row"][0]['age']) == 5){
                $('#age2').prop('checked',true);
            }

            if((data["row"][0]['business']) == 10){
                $('#business').prop('checked',true);
            }
            if((data["row"][0]['business']) == 5){
                $('#business2').prop('checked',true);
            }

            if((data["row"][0]['family_business']) == 10){
                $('#family_busi').prop('checked',true);
            }
            if((data["row"][0]['family_business']) == 5){
                $('#family_busi2').prop('checked',true);
            }

            if((data["row"][0]['business_time']) == 10){
                $('#business_time').prop('checked',true);
            }
            if((data["row"][0]['business_time']) == 5){
                $('#business_time2').prop('checked',true);
            }

            var options = '';
			options +='<option value="">Select State</option>';
			for (var i = 0; i < data["sates"].length; i++) {
                if(data["row"][0]['shop_sate']==data["sates"][i].state_name){
                    options += '<option value="' + data["sates"][i].state_name + '" selected>' + data["sates"][i].state_name + '</option>';
                }
                else{
                    options += '<option value="' + data["sates"][i].state_name + '">' + data["sates"][i].state_name + '</option>';
                }
			}
			$("#shop_sate").html(options);

            // city
            var options = '';
			options +='<option value="">Select City</option>';
			for (var i = 0; i < data["city_set"].length; i++) {
                if(data["row"][0]['shop_city']==data["city_set"][i].district_name){
                    options += '<option value="' + data["city_set"][i].district_name + '" selected>' + data["city_set"][i].district_name + '</option>';
                }
                else{
                    options += '<option value="' + data["city_set"][i].district_name + '">' + data["city_set"][i].district_name + '</option>';
                }
			}
			$("#shop_city").html(options);
            // town
            var options = '';
			options +='<option value="">Select Town</option>';
			for (var i = 0; i < data["town_set"].length; i++) {
                if(data["row"][0]['shop_town']==data["town_set"][i].town_name){
                    options += '<option value="' + data["town_set"][i].town_name + '" selected>' + data["town_set"][i].town_name + '</option>';
                }
                else{
                    options += '<option value="' + data["town_set"][i].town_name + '">' + data["town_set"][i].town_name + '</option>';
                }
			}
			$("#shop_town").html(options);

            $("#steps-uid-0-t-0").click();
            
            $("#edit_pop_trigger").click();

        }
    })
}


// $("#save_form").click(function(){
//     $("#save_status").val("1");
//     $("#form_submit_btn").click();
// })

// $("#step-form-horizontal").submit(function(){

//     $("#form_submit_btn").attr("disabled","true"); 
    
//     $.ajax({  
//         type: "POST",
//         url: BASE_URL + 'cc/update_user_information',  
//         data: $("#step-form-horizontal").serialize(), 
//         dataType: "JSON",

//         success: function (data) {
//             if (data.response == "success") {
//                 $("#form_resp").css("display","block");
//                 $("#form_resp").html('<b style="color:green;">Updated Successfully.</b>');
//                 $("#form_resp").delay(3000).fadeOut(500);
//                 var explode = function(){
//                     $(".close").click();
//                     get_funneled_form_list();
//                 };
//                 setTimeout(explode, 3000);
//             } 
            
//             $("#form_submit_btn").removeAttr("disabled");
//         }
//     })
    
// })

