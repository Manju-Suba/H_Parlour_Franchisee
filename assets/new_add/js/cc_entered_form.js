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
            'url': BASE_URL + 'cc/get_all_funneled_data', 
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
            
            if((data["row"][0]['gender']) == 'Male'){
                $('#gender').prop('checked',true);
            }
            if((data["row"][0]['gender']) == 'Female'){
                $('#gender2').prop('checked',true);
            }

            if((data["row"][0]['marital_status']) == 'Married'){
                $('#marital_status').prop('checked',true);
            }
            if((data["row"][0]['marital_status']) == 'Unmarried'){
                $('#marital_status2').prop('checked',true);
            }

            if((data["row"][0]['language']) == 'English'){
                $('#language').prop('checked',true);
            }
            if((data["row"][0]['language']) == 'Tamil'){
                $('#language2').prop('checked',true);
            }

            $("#education_q").val(data["row"][0]['education']);
            
            if((data["row"][0]['occupation']) == 'Self run business'){
                $('#occupation').prop('checked',true);
            }
            if((data["row"][0]['occupation']) == 'Employee'){
                $('#occupation2').prop('checked',true);
            }
            
            $("#monthly_income").val(data["row"][0]['in_mon_income']);
            $("#family_income").val(data["row"][0]['family_income']);
            $("#address").val(data["row"][0]['shop_address']);
            $("#pincode").val(data["row"][0]['pincode']);
            $("#residing_year").val(data["row"][0]['residing_year']);
            $("#shop_zipcode").val(data["row"][0]['shop_zipcode']);
            $("#population").val(data["row"][0]['population']);
            $("#town_code").val(data["row"][0]['town_code']);
            $("#sourced_by").val(data["row"][0]['sourced_by']);
            $("#referred_person").val(data["row"][0]['referred_person']);
            $("#cluster_id").val(data["row"][0]['cluster_id']);

            if((data["row"][0]['area']) == 5){
                $('#area').prop('checked',true);
            }
            if((data["row"][0]['area']) == 0){
                $('#area2').prop('checked',true);
            }

            $("#area_remark").val(data["row"][0]['area_remark']);
            $("#if_any_remark1").val(data["row"][0]['any_remark1']);


            if((data["row"][0]['age']) == 5){
                $('#age').prop('checked',true);
            }
            if((data["row"][0]['age']) == 0){
                $('#age2').prop('checked',true);
            }
            $("#age_remark").val(data["row"][0]['age_remark']);
            $("#if_any_remark2").val(data["row"][0]['any_remark2']);


            if((data["row"][0]['business']) == 10){
                $('#business').prop('checked',true);
            }
            if((data["row"][0]['business']) == 0){
                $('#business2').prop('checked',true);
            }
            $("#business_remark").val(data["row"][0]['business_remark']);
            $("#if_any_remark3").val(data["row"][0]['any_remark3']);


            if((data["row"][0]['family_business']) == 10){
                $('#family_busi').prop('checked',true);
            }
            if((data["row"][0]['family_business']) == 0){
                $('#family_busi2').prop('checked',true);
            }
            $("#fb_remark").val(data["row"][0]['fb_remark']);
            $("#if_any_remark4").val(data["row"][0]['any_remark4']);


            if((data["row"][0]['business_time']) == 20){
                $('#busi_time').prop('checked',true);
            }
            if((data["row"][0]['business_time']) == 0){
                $('#busi_time2').prop('checked',true);
            }
            $("#time_remark").val(data["row"][0]['time_remark']);
            $("#if_any_remark5").val(data["row"][0]['any_remark5']);


            if((data["row"][0]['management']) == 10){
                $('#pro_management').prop('checked',true);
            }
            if((data["row"][0]['management']) == 0){
                $('#pro_management2').prop('checked',true);
            }
            $("#pro_manage_remark").val(data["row"][0]['manage_remark']);
            $("#if_any_remark6").val(data["row"][0]['any_remark6']);

            $("#sperson_age").val(data["row"][0]['sperson_age']);
            $("#relation").val(data["row"][0]['relationship']);
            $("#if_any_remark7").val(data["row"][0]['any_remark7']);

            $("#expect_income").val(data["row"][0]['expect_income']);
            $("#expect_income1").val(data["row"][0]['expect_income1']);
            $("#if_any_remark8").val(data["row"][0]['any_remark8']);
            $("#cluster_id").val(data["row"][0]['cluster_id']);


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


$("#save_form").click(function(){
    $("#save_status").val("1");
    $("#form_submit_btn").click();
})

$("#step-form-horizontal").submit(function(){

    $("#form_submit_btn").attr("disabled","true"); 
    
    $.ajax({  
        type: "POST",
        url: BASE_URL + 'cc/update_user_information',  
        data: $("#step-form-horizontal").serialize(), 
        dataType: "JSON",

        success: function (data) {
            if (data.response == "success") {
                $("#form_resp").css("display","block");
                $("#form_resp").html('<b style="color:green;">Updated Successfully.</b>');
                $("#form_resp").delay(3000).fadeOut(500);
                var explode = function(){
                    window.location.reload();
                };
                setTimeout(explode, 3000);
            } 
            
            $("#form_submit_btn").removeAttr("disabled");
        }
    })
    
})



