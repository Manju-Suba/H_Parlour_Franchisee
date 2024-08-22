function view_image(id){
    $.ajax({  
        type: "POST",
        url: BASE_URL + 'common/view_business_img',  
        data: {'id':id,}, 
        dataType: "JSON",
        success: function (data) {
			$("#carouselExampleControls").html(data.response);
            $("#image_view_trigger").click();
        }
    })  
}  

function view_ct_upload_images(id){
    $.ajax({  
        type: "POST",
        url: BASE_URL + 'common/view_ct_upload_images',  
        data: {'id':id,}, 
        dataType: "JSON",
        success: function (data) {
			$("#carouselExampleControls").html(data.response);
            $("#image_view_trigger").click();
        }
    }) 
} 

function view_sh_image(id){
    $.ajax({   
        type: "POST",
        url: BASE_URL + 'common/view_sh_img',  
        data: {'id':id,}, 
        dataType: "JSON",
        success: function (data) {
			$("#asm_img_pop_carouselExampleControls").html(data.response);
            $("#asm_image_view_trigger").click();
        }
    })
}
 
function view_detail(id){
    $.ajax({  
        type: "POST",
        url: BASE_URL + 'common/view_detail',  
        data: {'id':id,}, 
        dataType: "JSON",
        success: function (data) {
            
            // append values
            $("#pop_user_id").html(data.val[0]['id']);

            $("#pop_name").html(data.val[0]['name']);
            $("#pop_mobile").html(data.val[0]['mobile']);
            $("#pop_education").html(data.val[0]['education']);

            $("#pop_marital_status").html(data.val[0]['marital_status']);
            $("#pop_marital_remark").html(data.val[0]['marital_status_remark']);

            $("#pop_edu").html(data.val[0]['education']);
            $("#pop_edu_remark").html(data.val[0]['education_remark']);

            $("#pop_occup").html(data.val[0]['occupation']);
            $("#pop_occup_remark").html(data.val[0]['occup_remark']);

            $("#pop_ind_inco").html(data.val[0]['in_mon_income']);
            $("#pop_ind_inco_remark").html(data.val[0]['in_mon_income_remark']);

            $("#pop_fam_inco").html(data.val[0]['family_income']);
            $("#pop_fam_inco_remark").html(data.val[0]['family_income_remark']);

            $("#pop_resi").html(data.val[0]['residing_year']);
            $("#pop_resi_remark").html(data.val[0]['residing_year_remark']);

            $("#pop_bd_score").html(data.val[0]['bd_score']);

            bd_scor = data.val[0]['bd_score'];

            if( (bd_scor >= 80) && (bd_scor <= 100) ){ 
                $('#bd_bg').css('background-color','#e1f3da'); 
                $('#pop_bd_score').css({'color':'white','background-color':'#5bc75b'}); 
            }
            if( (bd_scor >= 50) && (bd_scor < 80) ){ 
                $('#bd_bg').css('background-color','#f7d8b261'); 
                $('#pop_bd_score').css({'color':'white','background-color':'rgb(235 140 23)'}); 
            }
            if( (bd_scor >= 0) && (bd_scor < 50) ){
                $('#bd_bg').css('background-color','#eb6c5840'); 
                $('#pop_bd_score').css({'color':'white','background-color':'rgb(215 76 61)'}); 
            }

            $("#pop_area_slub").html(data.get_area['slab']);
            $("#pop_area").html(data.val[0]['area']);

            $("#pop_age_slub").html(data.get_age['slab']);
            $("#pop_age").html(data.val[0]['age']);

            $("#pop_busi_slub").html(data.get_busi['slab']);
            $("#pop_busi").html(data.val[0]['business']);

            $("#pop_fam_slab").html(data.get_family_busi['slab']);
            $("#pop_fam_busi").html(data.val[0]['family_business']);

            $("#pop_time_slab").html(data.get_time['slab']);
            $("#pop_time").html(data.val[0]['business_time']);

            $("#pop_manage_slab").html(data.get_manage['slab']);
            $("#pop_management").html(data.val[0]['management']);

            $("#pop_sperson_slab").html(data.val[0]['relationship']);
            $("#pop_sperson").html(data.val[0]['relationship_remark']);
           
            $("#pop_expect_income_slab").html(`<span>Before 6 months : ${data.val[0]['expect_income'] }</span>`);
            $("#pop_expect_income").html(data.val[0]['expect_income_remark']);

            $("#pop_expect_income_slab1").html(`<span>After 6 months : ${data.val[0]['expect_income1'] }</span>`);
            $("#pop_expect_income1").html(data.val[0]['expect_income_remark1']);

            $("#pop_score").html(data.val[0]['frc_score']);
            frc_scor = data.val[0]['frc_score'];

            if( (frc_scor >= 80) && (frc_scor <= 100) ){ 
                $('#frc_bg').css('background-color','#e1f3da'); 
                $('#pop_score').css({'color':'white','background-color':'#5bc75b'}); 
            }
            if( (frc_scor >= 50) && (frc_scor < 80) ){ 
                $('#frc_bg').css('background-color','#f7d8b261'); 
                $('#pop_score').css({'color':'white','background-color':'rgb(235 140 23)'}); 
            }
            if( (frc_scor >= 0) && (frc_scor < 50) ){
                $('#frc_bg').css('background-color','#eb6c5840'); 
                $('#pop_score').css({'color':'white','background-color':'rgb(215 76 61)'}); 
            }


            // Cluster Parameters Provides Score //
            $("#pop_breakeven_slub").html(`${data.val[0]['6c']} months`); //1
            breakeven = data.val[0]['6c'];
            if( breakeven == 0){
                breakeven_score = '10';
            }else{
                breakeven_score = '0';
            }
            $("#pop_breakeven").html(breakeven_score); 
           

            $("#pop_mbackup_slub").html(data.val[0]['6d']); //2
            money_bup = data.val[0]['6d'];
            if(money_bup == "Yes"){
                money_bup_score ='10';
            }else{
                money_bup_score = '0';
            }
            $("#pop_mbackup").html(money_bup_score);
            

            $("#pop_roi_slub").html(data.val[0]['6e']); //3
            var roi_score = "0";

            roi = data.val[0]['6e'];
            if(roi <= "30"){
                roi_score ='10';
            }
            if(roi >30 && roi <50){
                roi_score = '5';
            }
            if(roi > 50 ){
                roi_score ='0';
            }
            $("#pop_roi").html(roi_score);


            $("#pop_networth_slab").html(data.val[0]['7c']); //4
            var networth_score ='0';

            networth = data.val[0]['7c'];
            if(networth >= "500000"){
                networth_score ='20';
            }
            if(networth > "299999" && networth < "500000"){
                networth_score = '10';
            }
            if(networth <= "299999"){
                networth_score ='0';
            }
            $("#pop_networth").html(networth_score);
            

            $("#pop_loan_slab").html(data.val[0]['8a']); //5
            var lt_score ='0';

            loan_type = data.val[0]['8a'];
            loan_type1 = data.val[0]['8aa'];
            if(loan_type == "Own Fund"){
                lt_score ='10';
            }
            if(loan_type1 == "Partial Loan"){
                lt_score = '5';
            }
            if(loan_type1 == "Full Loan"){
                lt_score ='0';
            }
            $("#pop_loan").html(lt_score);
            

            $('#pop_expmt_slab').html(data.val[0]['11aa']); //6
            exp_manage = data.val[0]['11aa'];
            if( exp_manage == "Yes"){
                exp_manage_score = "20";
            }else{
                exp_manage_score = "0";
            }
            $('#pop_expmt').html(exp_manage_score);
            
            
            $('#pop_dairy_slab').html(data.val[0]['11bb']);
            dairy = data.val[0]['11bb'];
            if(dairy == "Yes"){
                dairy_score = "20" ;
            }else{
                dairy_score = "0" ;
            }
           
            $('#pop_dairy').html(dairy_score);

            $("#pop_ct_score").html(data.val[0]['ct_score']);
            ct_scor = data.val[0]['ct_score'];

            if( (ct_scor >= 80) && (ct_scor <= 100) ){ 
                $('#ct_bg').css('background-color','#e1f3da'); 
                $('#pop_ct_score').css({'color':'white','background-color':'#5bc75b'}); 
            }
            if( (ct_scor >= 50) && (ct_scor < 80) ){ 
                $('#ct_bg').css('background-color','#f7d8b261'); 
                $('#pop_ct_score').css({'color':'white','background-color':'rgb(235 140 23)'}); 
            }
            if( (ct_scor >= 0) && (ct_scor < 50) ){
                $('#ct_bg').css('background-color','#eb6c5840'); 
                $('#pop_ct_score').css({'color':'white','background-color':'rgb(215 76 61)'}); 
            }


            $("#pop_sh_remark").html(data.val[0]['sh_remark']);

            $("#pop_state").html(data.val[0]['shop_sate']);
            $("#pop_city").html(data.val[0]['shop_city']);
            $("#pop_town").html(data.val[0]['shop_town']);
            $("#pop_pincode").html(data.val[0]['pincode']);
            $("#pop_population").html(data.val[0]['population']);
            $("#pop_town_code").html(data.val[0]['town_code']);


            $("#pop_button").html(`<a href=${BASE_URL}ct/ct_edit_form/${data.val[0]['id']} class='btn btn-success'>Verify More Details </a>`);

            $("#detail_view_trigger").click();
        } 
    })
}

function view_doc_detail(id){
    $.ajax({  
        type: "POST",
        url: BASE_URL + 'common/view_doc_detail',  
        data: {'id':id,}, 
        dataType: "JSON",
        success: function (data) {

            $("#pop_name").html(data.val[0]['name']);
            $("#pop_mobile").html(data.val[0]['mobile']);
            $("#pop_education").html(data.val[0]['education']);

            rsm_remark = data.val[0]['rsm_remark'];
            if(rsm_remark !=""){
                $('#rsm_remark_shown').show();
            }else{
                $('#rsm_remark_shown').hide();
            }

            sh_remark = data.val[0]['sh_remark'];
            if(sh_remark !=""){
                $('#nethaji_remark').show();
            }else{
                $('#nethaji_remark').hide();
            }

            $("#pop_rsm_remark").html(data.val[0]['rsm_remark']);
            $("#pop_om_remark").html(data.val[0]['opm_remark']);
            $("#pop_rsmi_remark").html(data.val[0]['rsmi_remark']);
            $("#pop_sh_remark").html(data.val[0]['sh_remark']);

            $("#pop_marital_status").html(data.val[0]['marital_status']);
            $("#pop_marital_remark").html(data.val[0]['marital_status_remark']);

            $("#pop_edu").html(data.val[0]['education']);
            $("#pop_edu_remark").html(data.val[0]['education_remark']);

            $("#pop_occup").html(data.val[0]['occupation']);
            $("#pop_occup_remark").html(data.val[0]['occup_remark']);

            $("#pop_ind_inco").html(data.val[0]['in_mon_income']);
            $("#pop_ind_inco_remark").html(data.val[0]['in_mon_income_remark']);

            $("#pop_fam_inco").html(data.val[0]['family_income']);
            $("#pop_fam_inco_remark").html(data.val[0]['family_income_remark']);

            $("#pop_resi").html(data.val[0]['residing_year']);
            $("#pop_resi_remark").html(data.val[0]['residing_year_remark']);

            $("#pop_bd_score").html(data.val[0]['bd_score']);
            //
            bd_scor = data.val[0]['bd_score'];

            if( (bd_scor >= 80) && (bd_scor <= 100) ){ 
                $('#bd_bg').css('background-color','#e1f3da'); 
                $('#pop_bd_score').css({'color':'white','background-color':'#5bc75b'}); 
            }
            if( (bd_scor >= 50) && (bd_scor < 80) ){ 
                $('#bd_bg').css('background-color','#f7d8b261'); 
                $('#pop_bd_score').css({'color':'white','background-color':'rgb(235 140 23)'}); 
            }
            if( (bd_scor >= 0) && (bd_scor < 50) ){
                $('#bd_bg').css('background-color','#eb6c5840'); 
                $('#pop_bd_score').css({'color':'white','background-color':'rgb(215 76 61)'}); 
            }
            //

            $("#pop_area_slub").html(data.get_area['slab']);
            $("#pop_area").html(data.val[0]['area']);

            $("#pop_age_slub").html(data.get_age['slab']);
            $("#pop_age").html(data.val[0]['age']);

            $("#pop_busi_slub").html(data.get_busi['slab']); 
            $("#pop_busi").html(data.val[0]['business']);

            $("#pop_fam_slab").html(data.get_family_busi['slab']);
            $("#pop_fam_busi").html(data.val[0]['family_business']);

            $("#pop_time_slab").html(data.get_time['slab']);
            $("#pop_time").html(data.val[0]['business_time']);

            $("#pop_manage_slab").html(data.get_manage['slab']);
            $("#pop_management").html(data.val[0]['management']);

            $("#pop_sperson_slab").html(data.val[0]['relationship']);
            $("#pop_sperson").html(data.val[0]['relationship_remark']);
           
            // $("#pop_expect_income_slab").html(data.val[0]['expect_income']);
            // $("#pop_expect_income").html(data.val[0]['expect_income_remark']);

            $("#pop_expect_income_slab").html(`<span>Before 6 months : ${data.val[0]['expect_income'] }</span>`);
            $("#pop_expect_income").html(data.val[0]['expect_income_remark']);

            $("#pop_expect_income_slab1").html(`<span>After 6 months : ${data.val[0]['expect_income1'] }</span>`);
            $("#pop_expect_income1").html(data.val[0]['expect_income_remark1']);

            $("#pop_score").html(data.val[0]['frc_score']);


            frc_scor = data.val[0]['frc_score'];

            if( (frc_scor >= 80) && (frc_scor <= 100) ){ 
                $('#frc_bg').css('background-color','#e1f3da'); 
                $('#pop_score').css({'color':'white','background-color':'#5bc75b'}); 
            }
            if( (frc_scor >= 50) && (frc_scor < 80) ){ 
                $('#frc_bg').css('background-color','#f7d8b261'); 
                $('#pop_score').css({'color':'white','background-color':'rgb(235 140 23)'}); 
            }
            if( (frc_scor >= 0) && (frc_scor < 50) ){
                $('#frc_bg').css('background-color','#eb6c5840'); 
                $('#pop_score').css({'color':'white','background-color':'rgb(215 76 61)'}); 
            }

            // Cluster Parameters Provides Score //
            $("#pop_breakeven_slub").html(`${data.val[0]['6c']} months`); //1
            breakeven = data.val[0]['6c'];
            if( breakeven == 0){
                breakeven_score = '10';
            }else{
                breakeven_score = '0';
            }
            $("#pop_breakeven").html(breakeven_score); 
           

            $("#pop_mbackup_slub").html(data.val[0]['6d']); //2
            money_bup = data.val[0]['6d'];
            if(money_bup == "Yes"){
                money_bup_score ='10';
            }else{
                money_bup_score = '0';
            }
            $("#pop_mbackup").html(money_bup_score);
            

            $("#pop_roi_slub").html(data.val[0]['6e']); //3
            var roi_score ='0';

            roi = data.val[0]['6e'];
            if(roi <= "30"){
                roi_score ='10';
            }
            if(roi >30 && roi <50){
                roi_score = '5';
            }
            if(roi > 50 ){
                roi_score ='0';
            }
            $("#pop_roi").html(roi_score);


            $("#pop_networth_slab").html(data.val[0]['7c']); //4
            var networth_score ='0';

            networth = data.val[0]['7c'];
            if(networth >= "500000"){
                networth_score ='20';
            }
            if(networth > "299999" && networth < "500000"){
                networth_score = '10';
            }
            if(networth <= "299999"){
                networth_score ='0';
            }
            $("#pop_networth").html(networth_score);
            

            $("#pop_loan_slab").html(data.val[0]['8a']); //5
            var lt_score ='0';

            loan_type = data.val[0]['8a'];
            loan_type1 = data.val[0]['8aa'];
            if(loan_type == "Own Fund"){
                lt_score ='10';
            }
            if(loan_type1 == "Partial Loan"){
                lt_score = '5';
            }
            if(loan_type1 == "Full Loan"){
                lt_score ='0';
            }
            $("#pop_loan").html(lt_score);
            

            $('#pop_expmt_slab').html(data.val[0]['11aa']); //6
            exp_manage = data.val[0]['11aa'];
            if( exp_manage == "Yes"){
                exp_manage_score = "20";
            }else{
                exp_manage_score = "0";
            }
            $('#pop_expmt').html(exp_manage_score);
            
            
            $('#pop_dairy_slab').html(data.val[0]['11bb']);
            dairy = data.val[0]['11bb'];
            if(dairy == "Yes"){
                dairy_score = "20" ;
            }else{
                dairy_score = "0" ;
            }
            $('#pop_dairy').html(dairy_score);
            

            $("#pop_ct_score").html(data.val[0]['ct_score']);
            ct_scor = data.val[0]['ct_score'];

            if( (ct_scor >= 80) && (ct_scor <= 100) ){ 
                $('#ct_bg').css('background-color','#e1f3da'); 
                $('#pop_ct_score').css({'color':'white','background-color':'#5bc75b'}); 
            }
            if( (ct_scor >= 50) && (ct_scor < 80) ){ 
                $('#ct_bg').css('background-color','#f7d8b261'); 
                $('#pop_ct_score').css({'color':'white','background-color':'rgb(235 140 23)'}); 
            }
            if( (ct_scor >= 0) && (ct_scor < 50) ){
                $('#ct_bg').css('background-color','#eb6c5840'); 
                $('#pop_ct_score').css({'color':'white','background-color':'rgb(215 76 61)'}); 
            }

            $("#pop_sh_remark").html(data.val[0]['sh_remark']);

            $("#pop_state").html(data.val[0]['shop_sate']);
            $("#pop_city").html(data.val[0]['shop_city']);
            $("#pop_town").html(data.val[0]['shop_town']);
            $("#pop_pincode").html(data.val[0]['pincode']);
            $("#pop_population").html(data.val[0]['population']);
            $("#pop_town_code").html(data.val[0]['town_code']);

            $("#3a").val(data.val[0]['3a']);
            $("#3b").val(data.val[0]['3b']);
            $("#3c").val(data.val[0]['3c']);
            $("#3d").val(data.val[0]['3d']);
            $("#3e").val(data.val[0]['3e']);

            temp = data.val[0]['franc_emp'];
            if(temp == 'Salaried'){
                 $('#employee').show();
                 $('#business').hide();
            }else{
                 $('#employee').hide();
                 $('#business').show();
            }
 
            $("#4a").val(data.val[0]['4a']);
            $("#4b").val(data.val[0]['4b']);
            $("#4c").val(data.val[0]['4c']);

            $("#5a").val(data.val[0]['5a']);
            $("#5b").val(data.val[0]['5b']);
            $("#5c").val(data.val[0]['5c']);
            $("#5d").val(data.val[0]['5d']);

            $("#6a").val(data.val[0]['6a']);
            $("#6b").val(data.val[0]['6b']);
            $("#6c").val(data.val[0]['6c']);
            $("#6d").val(data.val[0]['6d']);
            $("#6e").val(data.val[0]['6e']);

            $("#7a").val(data.val[0]['7a']);
            $("#7b").val(data.val[0]['7b']);
            $("#7c").val(data.val[0]['7c']);

            $("#8a").val(data.val[0]['8a']);

            loan = data.val[0]['8a'] ;
            loantype = data.val[0]['8aa'] ;
            
            if(loan == "loan"){
                $('#from_bank').hide();
                $('#from_hand').hide();
                $('#loantype').show();
            }

            if(loantype == "Partial Loan"){
                $('#from_bank').show();
                $('#from_hand').show();
                $('#loantype').show();
            }

            if(loantype == "Full Loan"){
                $('#from_bank').show();
                $('#from_hand').hide();
                $('#loantype').show();
            }

            if(loan == "Own Fund"){
                $('#from_bank').hide();
                $('#from_hand').show();
                $('#loantype').hide();
            }

            $("#8aa").val(data.val[0]['8aa']);
            $("#8b").val(data.val[0]['8b']);
            $("#8c").val(data.val[0]['8c']);
            $("#8d").val(data.val[0]['8d']);

            $("#9a").val(data.val[0]['9a']);
            $("#9b").val(data.val[0]['9b']);

            $("#10a").val(data.val[0]['10a']);
            $("#10b").val(data.val[0]['10b']);
            $("#10c").val(data.val[0]['10c']);
            $("#10d").val(data.val[0]['10d']);

            $("#11a").val(data.val[0]['11a']);
            $("#11aa").val(data.val[0]['11aa']);
            $("#11b").val(data.val[0]['11b']);
            $("#11bb").val(data.val[0]['11bb']);
            $("#11c").val(data.val[0]['11c']);
            $("#11d").val(data.val[0]['11d']);
            $("#11e").val(data.val[0]['11e']);

            $("#12a").val(data.val[0]['12a']);
            $("#12b").val(data.val[0]['12b']);
            $("#12c").val(data.val[0]['12c']);
            $("#12d").val(data.val[0]['12d']);
            $("#12e").val(data.val[0]['12e']);
            $("#12f").val(data.val[0]['12f']);
            $("#12g").val(data.val[0]['12g']);
            $("#12h").val(data.val[0]['12h']);
            $("#12i").val(data.val[0]['12i']);
            $("#12j").val(data.val[0]['12j']);
            $("#12k").val(data.val[0]['12k']);
            $("#12l").val(data.val[0]['12l']);
            $("#12m").val(data.val[0]['12m']);
            $("#12n").val(data.val[0]['12n']);
            $("#12o").val(data.val[0]['12o']);
            $("#12p").val(data.val[0]['12p']);

             {/* end */}
            $("#detail_view_trigger").click();

            if(data.doc !=""){
                // APPPATH . '../uploads/shDocument
                $("#show_img1").html(` 
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['signed_agree']}" ><img src="../../uploads/shDocument/${data.doc[0]['signed_agree']}" width="150" height="100"></a>
                `);
                $("#show_img2").html(`
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['profile']}" ><img src="../../uploads/shDocument/${data.doc[0]['profile']}" width="150" height="100"></a>
                `);
                $("#show_img3").html(`
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['challan']}" ><img src="../../uploads/shDocument/${data.doc[0]['challan']}" width="150" height="100"></a>
                `);
                $("#show_img4").html(`
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['gst']}" ><img src="../../uploads/shDocument/${data.doc[0]['gst']}" width="150" height="100"></a>
                `);
                $("#show_img5").html(`
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['fassai']}" ><img src="../../uploads/shDocument/${data.doc[0]['fassai']}" width="150" height="100"></a>
                `);
                $("#show_img6").html(`
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['pan']}" ><img src="../../uploads/shDocument/${data.doc[0]['pan']}" width="150" height="100"></a>
                `);
                $("#show_img7").html(`
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['aadhar']}" ><img src="../../uploads/shDocument/${data.doc[0]['aadhar']}" width="150" height="100"></a>
                `);
                $("#show_img8").html(`
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['current_acc']}" ><img src="../../uploads/shDocument/${data.doc[0]['current_acc']}" width="150" height="100"></a>
                `);
                $("#show_img9").html(`
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['retail_outlet']}" ><img src="../../uploads/shDocument/${data.doc[0]['retail_outlet']}" width="150" height="100"></a>
                `);
            }
            


        }
    })
}

//p check

function view_all_detail(id){
    // $('#detail_view_trigger').trigger('reset');

    $.ajax({  
        type: "POST",
        url: BASE_URL + 'common/view_doc_detail',  
        data: {'id':id,}, 
        dataType: "JSON",
        success: function (data) {

            tmp = data.val[0]['id'];
            // append values 
            // $id =
            $("#pop_user_id").html(data.val[0]['id']);

            $("#pop_name").html(data.val[0]['name']);
            $("#pop_mobile").html(data.val[0]['mobile']);
            $("#pop_education").html(data.val[0]['education']);

            $("#pop_rsm_remark").html(data.val[0]['rsm_remark']);
            $("#pop_om_remark").html(data.val[0]['opm_remark']);
            $("#pop_rsmi_remark").html(data.val[0]['rsmi_remark']);
            $("#pop_sh_remark").html(data.val[0]['sh_remark']);

            $("#pop_marital_status").html(data.val[0]['marital_status']);
            $("#pop_marital_remark").html(data.val[0]['marital_status_remark']);

            $("#pop_edu").html(data.val[0]['education']);
            $("#pop_edu_remark").html(data.val[0]['education_remark']);

            $("#pop_occup").html(data.val[0]['occupation']);
            $("#pop_occup_remark").html(data.val[0]['occup_remark']);

            $("#pop_ind_inco").html(data.val[0]['in_mon_income']);
            $("#pop_ind_inco_remark").html(data.val[0]['in_mon_income_remark']);

            $("#pop_fam_inco").html(data.val[0]['family_income']);
            $("#pop_fam_inco_remark").html(data.val[0]['family_income_remark']);

            $("#pop_resi").html(data.val[0]['residing_year']);
            $("#pop_resi_remark").html(data.val[0]['residing_year_remark']);

            $("#pop_bd_score").html(data.val[0]['bd_score']);

            bd_scor = data.val[0]['bd_score'];

            if( (bd_scor >= 80) && (bd_scor <= 100) ){ 
                $('#bd_bg').css('background-color','#e1f3da'); 
                $('#pop_bd_score').css({'color':'white','background-color':'#5bc75b'}); 
            }
            if( (bd_scor >= 50) && (bd_scor < 80) ){ 
                $('#bd_bg').css('background-color','#f7d8b261'); 
                $('#pop_bd_score').css({'color':'white','background-color':'rgb(235 140 23)'}); 
            }
            if( (bd_scor >= 0) && (bd_scor < 50) ){
                $('#bd_bg').css('background-color','#eb6c5840'); 
                $('#pop_bd_score').css({'color':'white','background-color':'rgb(215 76 61)'}); 
            }

            $("#pop_area_slub").html(data.get_area['slab']);
            $("#pop_area").html(data.val[0]['area']);

            $("#pop_age_slub").html(data.get_age['slab']);
            $("#pop_age").html(data.val[0]['age']);

            $("#pop_busi_slub").html(data.get_busi['slab']);
            $("#pop_busi").html(data.val[0]['business']);

            $("#pop_fam_slab").html(data.get_family_busi['slab']);
            $("#pop_fam_busi").html(data.val[0]['family_business']);

            $("#pop_time_slab").html(data.get_time['slab']);
            $("#pop_time").html(data.val[0]['business_time']);

            $("#pop_manage_slab").html(data.get_manage['slab']);
            $("#pop_management").html(data.val[0]['management']);

            $("#pop_sperson_slab").html(data.val[0]['relationship']);
            $("#pop_sperson").html(data.val[0]['relationship_remark']);
           
            // $("#pop_expect_income_slab").html(data.val[0]['expect_income']);
            // $("#pop_expect_income").html(data.val[0]['expect_income_remark']);

            $("#pop_expect_income_slab").html(`<span>Before 6 months : ${data.val[0]['expect_income'] }</span>`);
            $("#pop_expect_income").html(data.val[0]['expect_income_remark']);

            $("#pop_expect_income_slab1").html(`<span>After 6 months : ${data.val[0]['expect_income1'] }</span>`);
            $("#pop_expect_income1").html(data.val[0]['expect_income_remark1']);

            $("#pop_score").html(data.val[0]['frc_score']);
            frc_scor = data.val[0]['frc_score'];

            if( (frc_scor >= 80) && (frc_scor <= 100) ){ 
                $('#frc_bg').css('background-color','#e1f3da'); 
                $('#pop_score').css({'color':'white','background-color':'#5bc75b'}); 
            }
            if( (frc_scor >= 50) && (frc_scor < 80) ){ 
                $('#frc_bg').css('background-color','#f7d8b261'); 
                $('#pop_score').css({'color':'white','background-color':'rgb(235 140 23)'}); 
            }
            if( (frc_scor >= 0) && (frc_scor < 50) ){
                $('#frc_bg').css('background-color','#eb6c5840'); 
                $('#pop_score').css({'color':'white','background-color':'rgb(215 76 61)'}); 
            }


            // Cluster Parameters Provides Score //
            $("#pop_breakeven_slub").html(`${data.val[0]['6c']} months`); //1
            breakeven = data.val[0]['6c'];
            if( breakeven == 0){
                breakeven_score = '10';
            }else{
                breakeven_score = '0';
            }
            $("#pop_breakeven").html(breakeven_score); 
           

            $("#pop_mbackup_slub").html(data.val[0]['6d']); //2
            money_bup = data.val[0]['6d'];
            if(money_bup == "Yes"){
                money_bup_score ='10';
            }else{
                money_bup_score = '0';
            }
            $("#pop_mbackup").html(money_bup_score);
            

            $("#pop_roi_slub").html(data.val[0]['6e']); //3
            var roi_score ='0';

            roi = data.val[0]['6e'];
            if(roi <= "30"){
                roi_score ='10';
            }
            if(roi >30 && roi <50){
                roi_score = '5';
            }
            if(roi > 50 ){
                roi_score ='0';
            }
            $("#pop_roi").html(roi_score);


            $("#pop_networth_slab").html(data.val[0]['7c']); //4
            var networth_score ='0';

            networth = data.val[0]['7c'];
            if(networth >= "500000"){
                networth_score ='20';
            }
            if(networth > "299999" && networth < "500000"){
                networth_score = '10';
            }
            if(networth <= "299999"){
                networth_score ='0';
            }
            $("#pop_networth").html(networth_score);
            

            $("#pop_loan_slab").html(data.val[0]['8a']); //5
            var lt_score ='0';

            loan_type = data.val[0]['8a'];
            loan_type1 = data.val[0]['8aa'];
            if(loan_type == "Own Fund"){
                lt_score ='10';
            }
            if(loan_type1 == "Partial Loan"){
                lt_score = '5';
            }
            if(loan_type1 == "Full Loan"){
                lt_score ='0';
            }
            $("#pop_loan").html(lt_score);
            

            $('#pop_expmt_slab').html(data.val[0]['11aa']); //6
            exp_manage = data.val[0]['11aa'];
            if( exp_manage == "Yes"){
                exp_manage_score = "20";
            }else{
                exp_manage_score = "0";
            }
            $('#pop_expmt').html(exp_manage_score);
            
            
            $('#pop_dairy_slab').html(data.val[0]['11bb']);
            dairy = data.val[0]['11bb'];
            if(dairy == "Yes"){
                dairy_score = "20" ;
            }else{
                dairy_score = "0" ;
            }
            $('#pop_dairy').html(dairy_score);

            $("#pop_ct_score").html(data.val[0]['ct_score']);
            ct_scor = data.val[0]['ct_score'];

            if( (ct_scor >= 80) && (ct_scor <= 100) ){ 
                $('#ct_bg').css('background-color','#e1f3da'); 
                $('#pop_ct_score').css({'color':'white','background-color':'#5bc75b'}); 
            }
            if( (ct_scor >= 50) && (ct_scor < 80) ){ 
                $('#ct_bg').css('background-color','#f7d8b261'); 
                $('#pop_ct_score').css({'color':'white','background-color':'rgb(235 140 23)'}); 
            }
            if( (ct_scor >= 0) && (ct_scor < 50) ){
                $('#ct_bg').css('background-color','#eb6c5840'); 
                $('#pop_ct_score').css({'color':'white','background-color':'rgb(215 76 61)'}); 
            }

            $("#pop_sh_remark").html(data.val[0]['sh_remark']);

            $("#pop_state").html(data.val[0]['shop_sate']);
            $("#pop_city").html(data.val[0]['shop_city']);
            $("#pop_town").html(data.val[0]['shop_town']);
            $("#pop_pincode").html(data.val[0]['pincode']);
            $("#pop_population").html(data.val[0]['population']);
            $("#pop_town_code").html(data.val[0]['town_code']);

            $("#3a").val(data.val[0]['3a']);
            $("#3b").val(data.val[0]['3b']);
            $("#3c").val(data.val[0]['3c']);
            $("#3d").val(data.val[0]['3d']);
            $("#3e").val(data.val[0]['3e']);

           temp = data.val[0]['franc_emp'];
           if(temp == 'Salaried'){
                $('#employee').show();
                $('#business').hide();
           }else{
                $('#employee').hide();
                $('#business').show();
           }

            $("#4a").val(data.val[0]['4a']);
            $("#4b").val(data.val[0]['4b']);
            $("#4c").val(data.val[0]['4c']);

            $("#5a").val(data.val[0]['5a']);
            $("#5b").val(data.val[0]['5b']);
            $("#5c").val(data.val[0]['5c']);
            $("#5d").val(data.val[0]['5d']);

            $("#6a").val(data.val[0]['6a']);
            $("#6b").val(data.val[0]['6b']);
            $("#6c").val(data.val[0]['6c']);
            $("#6d").val(data.val[0]['6d']);
            $("#6e").val(data.val[0]['6e']);

            $("#7a").val(data.val[0]['7a']);
            $("#7b").val(data.val[0]['7b']);
            $("#7c").val(data.val[0]['7c']);

            $("#8a").val(data.val[0]['8a']);

            loan = data.val[0]['8a'] ;
            
            if(loan == "loan"){
                $('#from_bank').show();
                $('#from_hand').show();
            }
            if(loan == "Own Fund"){
                $('#from_bank').hide();
                $('#from_hand').show();
            }

            $("#8b").val(data.val[0]['8b']);
            $("#8c").val(data.val[0]['8c']);
            $("#8d").val(data.val[0]['8d']);

            $("#9a").val(data.val[0]['9a']);
            $("#9b").val(data.val[0]['9b']);

            $("#10a").val(data.val[0]['10a']);
            $("#10b").val(data.val[0]['10b']);
            $("#10c").val(data.val[0]['10c']);
            $("#10d").val(data.val[0]['10d']);

            $("#11a").val(data.val[0]['11a']);
            $("#11aa").val(data.val[0]['11aa']);
            $("#11b").val(data.val[0]['11b']);
            $("#11bb").val(data.val[0]['11bb']);
            $("#11c").val(data.val[0]['11c']);
            $("#11d").val(data.val[0]['11d']);
            $("#11e").val(data.val[0]['11e']);

            $("#12a").val(data.val[0]['12a']);
            $("#12b").val(data.val[0]['12b']);
            $("#12c").val(data.val[0]['12c']);
            $("#12d").val(data.val[0]['12d']);
            $("#12e").val(data.val[0]['12e']);
            $("#12f").val(data.val[0]['12f']);
            $("#12g").val(data.val[0]['12g']);
            $("#12h").val(data.val[0]['12h']);
            $("#12i").val(data.val[0]['12i']);
            $("#12j").val(data.val[0]['12j']);
            $("#12k").val(data.val[0]['12k']);
            $("#12l").val(data.val[0]['12l']);
            $("#12m").val(data.val[0]['12m']);
            $("#12n").val(data.val[0]['12n']);
            $("#12o").val(data.val[0]['12o']);
            $("#12p").val(data.val[0]['12p']);

            $("#id_val").val(data.val[0]['id']);
            $("#id_dval").val(data.val[0]['id']);

            // $("#pop_button").html(`<a href=http://localhost/H_Parlour_Franchisee/index.php/ct/ct_edit_form/${data.val[0]['id']} class='btn btn-success'>Add More Details </a>`);
            pre_doc = (data.val[0]['ct_pre_doc_upload']);
             {/* end */}
            if(data.doc !=""){

                a = data.doc[0]['signed_agree'] ;
                b = data.doc[0]['profile'] ;
                c = data.doc[0]['challan'] ;
                d = data.doc[0]['gst'] ;
                e = data.doc[0]['fassai'] ;
                f = data.doc[0]['pan'] ;
                g = data.doc[0]['aadhar'] ;
                h = data.doc[0]['current_acc'] ;
                i = data.doc[0]['retail_outlet'] ;
                if( a !="Nil" && b !="Nil" && c !="Nil" && d !="Nil" && e!="Nil" && f!="Nil" && g!="Nil" && h!="Nil" && i!="Nil"){
                    $("#show_img1").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['signed_agree']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                        <input type="hidden" id="sign_agree" name="sign_agree" value="0">
                    `);
                    $("#show_img2").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['profile']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                        <input type="hidden" id="profile" name="profile" value="0">
                    `);
                    $("#show_img3").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['challan']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                        <input type="hidden" id="challan" name="challan" value="0">
                    `);
                    $("#show_img4").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['gst']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                        <input type="hidden" id="gst" name="gst" value="0">
                    `);
                    $("#show_img5").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['fassai']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i> </a>
                        <input type="hidden" id="fassai" name="fassai" value="0">
                    `);
                    $("#show_img6").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['pan']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i> </a>
                        <input type="hidden" id="pan" name="pan" value="0">
                    `);
                    $("#show_img7").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['aadhar']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                        <input type="hidden" id="aadhar" name="aadhar" value="0">
                    `);
                    $("#show_img8").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['current_acc']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i> </a>
                        <input type="hidden" id="current_acc" name="current_acc" value="0">
                    `);
                    $("#show_img9").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['retail_outlet']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i> </a>
                        <input type="hidden" id="retail_outlet" name="retail_outlet" value="0">
                    `);

                    if(data.post_doc !=""){
                        a = data.post_doc[0]['asset_img'];
                        b = data.post_doc[0]['team_img'];
        
                        if(a!="Nil" && b!="Nil"){
                            $("#asset_div").html(`
                                <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                <input type="hidden" id="asset_img" name="asset_img" value="0">
                            `);
                            $("#team_div").html(`
                                <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                <input type="hidden" id="team_img" name="team_img" value="0">
                            `);
        
                        }
                        else{
                            
                            if( a != "Nil"){
                                $("#asset_div").html(`
                                    <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                    <input type="hidden" id="asset_img" name="asset_img" value="0">
                                `);
                            }else{
                                $("#asset_div").html(`<input type="file" name="asset_img" id="asset_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                            }
        
                            if ( b != "Nil"){
                                $("#team_div").html(`
                                    <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                    <input type="hidden" id="team_img" name="team_img" value="0">
                                `);
                            }else{
                                $("#team_div").html(`<input type="file" name="team_img" id="team_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                            }
                            $("#saveor_update_btn").html(`<button class="btn btn-primary" onclick="update_pre_doc()">Upload</button>`);
                           
                        }

                    }else{
        
                        $("#asset_div").html(`<input type="file" name="asset_img" id="asset_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                        $("#team_div").html(`<input type="file" name="team_img" id="team_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
            
                        $("#saveor_update_btn").html(`<button class="btn btn-primary" onclick="update_pre_doc()">Upload</button>`);
                    }

                    a_img = data.post_doc[0]['asset_img'];
                    b_img = data.post_doc[0]['team_img'];

                    if(data.val[0]['ct_pre_doc_upload'] == "uploaded" && data.val[0]['ct_post_doc_upload'] == "uploaded" && a_img !="Nil" && b_img !="Nil" ){
                        $("#saveor_update_btn").html("");
                    }else{
                        $("#saveor_update_btn").html(`<button class="btn btn-primary" onclick="update_pre_doc()">Upload</button>`);
                    }

                }else{

                    if(a != "Nil"){
                        $("#show_img1").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['signed_agree']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                            <input type="hidden" id="sign_agree" name="sign_agree" value="0">
                        `);
                    }else{
                        $("#show_img1").html(`<input type="file" name="sign_agree" id="sign_agree" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }
                
                    if(b != "Nil"){
                        $("#show_img2").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['profile']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                            <input type="hidden" id="profile" name="profile" value="0">
                        `);
                    }else{
                        $("#show_img2").html(`<input type="file" name="profile" id="profile" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }
    
                    if(c != "Nil"){
                        $("#show_img3").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['challan']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                            <input type="hidden" id="challan" name="challan" value="0">
                        `);
                    }else{
                        $("#show_img3").html(`<input type="file" name="challan" id="challan" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }
    
                    if(d != "Nil"){
                        $("#show_img4").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['gst']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                            <input type="hidden" id="gst" name="gst" value="0">
                        `);
                    }else{
                        $("#show_img4").html(`<input type="file" name="gst" id="gst" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }
    
                    if(e != "Nil"){
                        $("#show_img5").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['fassai']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i> </a>
                            <input type="hidden" id="fassai" name="fassai" value="0">
                        `);
                    }else{
                        $("#show_img5").html(`<input type="file" name="fassai" id="fassai" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }
    
                    if(f != "Nil"){
                        $("#show_img6").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['pan']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i> </a>
                            <input type="hidden" id="pan" name="pan" value="0">
                        `);
                    }else{
                        $("#show_img6").html(`<input type="file" name="pan" id="pan" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }
    
                    if(g != "Nil"){
                        $("#show_img7").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['aadhar']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                            <input type="hidden" id="aadhar" name="aadhar" value="0">
                        `);
                    }else{
                        $("#show_img7").html(`<input type="file" name="aadhar" id="aadhar" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }
    
                    if(h != "Nil"){
                        $("#show_img8").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['current_acc']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i> </a>
                            <input type="hidden" id="current_acc" name="current_acc" value="0">
                        `);
                    }else{
                        $("#show_img8").html(`<input type="file" name="current_acc" id="current_acc" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }

                    if(i != "Nil"){
                        $("#show_img9").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['retail_outlet']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i> </a>
                            <input type="hidden" id="retail_outlet" name="retail_outlet" value="0">
                        `);
                    }else{
                        $("#show_img9").html(`<input type="file" name="retail_outlet" id="retail_outlet" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }

                    if(data.post_doc !=""){
                        aa = data.post_doc[0]['asset_img'];
                        bb = data.post_doc[0]['team_img'];
        
                        if(aa!="Nil" && bb!="Nil"){
                            $("#asset_div").html(`
                                <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                <input type="hidden" id="asset_img" name="asset_img" value="0">
                            `);
                            $("#team_div").html(`
                                <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                <input type="hidden" id="team_img" name="team_img" value="0">
                            `);
        
                        }else{
                            
                            if( aa != "Nil"){
                                $("#asset_div").html(`
                                    <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                    <input type="hidden" id="asset_img" name="asset_img" value="0">
                                `);
                            }else{
                                $("#asset_div").html(`<input type="file" name="asset_img" id="asset_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                            }
        
                            if ( bb != "Nil"){
                                $("#team_div").html(`
                                    <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                    <input type="hidden" id="team_img" name="team_img" value="0">
                                `);
                            }else{
                                $("#team_div").html(`<input type="file" name="team_img" id="team_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                            }
                        }
                    }else{
        
                        $("#asset_div").html(`<input type="file" name="asset_img" id="asset_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                        $("#team_div").html(`<input type="file" name="team_img" id="team_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }
                    $("#saveor_update_btn").html(`<button class="btn btn-primary" onclick="update_pre_doc()">Upload</button>`);
    
                }

                
            }else{
                $("#show_img1").html(`<input type="file" name="sign_agree" accept="image/*" onchange="ValidateSingleInput(this);" id="sign_agree" class="form-control">`);
                $("#show_img2").html(`<input type="file" name="profile" accept="image/*" onchange="ValidateSingleInput(this);" id="profile" class="form-control">`);
                $("#show_img3").html(`<input type="file" name="challan" accept="image/*" onchange="ValidateSingleInput(this);" id="challan" class="form-control">`);
                $("#show_img4").html(`<input type="file" name="gst" accept="image/*" onchange="ValidateSingleInput(this);" id="gst" class="form-control">`);
                $("#show_img5").html(`<input type="file" name="fassai" accept="image/*" onchange="ValidateSingleInput(this);" id="fassai" class="form-control">`);
                $("#show_img6").html(`<input type="file" name="pan" id="pan" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                $("#show_img7").html(`<input type="file" name="aadhar" id="aadhar" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                $("#show_img8").html(`<input type="file" name="current_acc" id="current_acc" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                $("#show_img9").html(`<input type="file" name="retail_outlet" id="retail_outlet" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);

                if(data.post_doc !=""){
                    aa = data.post_doc[0]['asset_img'];
                    bb = data.post_doc[0]['team_img'];
    
                    if(aa!="Nil" && bb!="Nil"){
                        $("#asset_div").html(`
                            <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                            <input type="hidden" id="asset_img" name="asset_img" value="0">
                        `);
                        $("#team_div").html(`
                            <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                            <input type="hidden" id="team_img" name="team_img" value="0">
                        `);
    
                    }else{ 
                        
                        if( aa != "Nil"){
                            $("#asset_div").html(`
                                <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                <input type="hidden" id="asset_img" name="asset_img" value="0">
                            `);
                        }else{
                            $("#asset_div").html(`<input type="file" name="asset_img" id="asset_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                        }
    
                        if ( bb != "Nil"){ 
                            $("#team_div").html(`
                                <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                <input type="hidden" id="team_img" name="team_img" value="0">
                            `);
                        }else{
                            $("#team_div").html(`<input type="file" name="team_img" id="team_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                        }
                    }
    
                    
                }else{
    
                    $("#asset_div").html(`<input type="file" name="asset_img" id="asset_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    $("#team_div").html(`<input type="file" name="team_img" id="team_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
        
                }
                $("#saveor_update_btn").html(`<button class="btn btn-primary" onclick="insert_pre_doc()">Upload</button>`);
               
            }

            var progress_val = 0;
            var bar = document.querySelector(".progress-bar");

            if(data.post_doc !=""){
                if(data.post_doc[0]['asset_img'] !="Nil"){ progress_j = 9; }else{ progress_j = 0 ; }
                if(data.post_doc[0]['team_img'] !="Nil"){ progress_k = 9; }else{ progress_k = 0 ; }
            }else{
                progress_j = 0 ; progress_k = 0 ;
            }
            if(data.doc !=""){
                if( data.doc[0]['signed_agree'] !="Nil"){ progress_a = 9; }else{ progress_a = 0 ; }
                if(data.doc[0]['profile'] !="Nil"){ progress_b = 9; }else{ progress_b = 0 ; }
                if(data.doc[0]['challan'] !="Nil"){ progress_c = 9; }else{ progress_c = 0 ; }
                if(data.doc[0]['gst'] !="Nil"){ progress_d = 9; }else{ progress_d = 0 ; }
                if(data.doc[0]['fassai'] !="Nil"){ progress_e = 9; }else{ progress_e = 0 ; }
                if(data.doc[0]['pan'] !="Nil"){ progress_f = 9; }else{ progress_f = 0 ; }
                if(data.doc[0]['aadhar'] !="Nil"){ progress_g = 9; }else{ progress_g = 0 ; }
                if(data.doc[0]['current_acc'] !="Nil"){ progress_h = 9; }else{ progress_h = 0 ; }
                if(data.doc[0]['retail_outlet'] !="Nil"){ progress_i = 10; }else{ progress_i = 0 ; }
            }else{
                progress_a = 0 ; progress_b = 0 ; progress_c = 0 ; progress_d = 0; progress_e = 0 ; progress_f = 0 ; progress_g = 0 ; progress_h = 0; progress_i = 0;
            }
                progress_val =(progress_a + progress_b + progress_c + progress_d + progress_e + progress_f + progress_g + progress_h + progress_i + progress_j + progress_k );
                if(progress_val <= 100){
                    bar.style.width = progress_val + "%";
                    bar.innerText = progress_val + "%";
                }

                if( (progress_val >= 9) && (progress_val <= 59) ){ 
                    bar.style.backgroundColor = "#aadbaa" ;
                }
                if( (progress_val >= 60) && (progress_val <= 99) ){
                    bar.style.backgroundColor = "#67df49" ;
                }
                if( progress_val == 100 ){
                    bar.style.backgroundColor = "green" ;
                }

            $("#detail_view_trigger").click();

        }
    })
}

 
function view_tt_score_details(id){

    $.ajax({  
        type: "POST",
        url: BASE_URL + 'common/view_doc_detail',  
        data: {'id':id,}, 
        dataType: "JSON",
        success: function (data) {
 
            $("#pop_user_id").html(data.val[0]['id']);

            $("#pop_name").html(data.val[0]['name']);
            $("#pop_mobile").html(data.val[0]['mobile']);
            $("#pop_education").html(data.val[0]['education']);

            $("#pop_rsm_remark").html(data.val[0]['rsm_remark']);
            $("#pop_om_remark").html(data.val[0]['opm_remark']);
            $("#pop_rsmi_remark").html(data.val[0]['rsmi_remark']);
            $("#pop_sh_remark").html(data.val[0]['sh_remark']);

            $("#pop_marital_status").html(data.val[0]['marital_status']);
            $("#pop_marital_remark").html(data.val[0]['marital_status_remark']);

            $("#pop_edu").html(data.val[0]['education']);
            $("#pop_edu_remark").html(data.val[0]['education_remark']);

            $("#pop_occup").html(data.val[0]['occupation']);
            $("#pop_occup_remark").html(data.val[0]['occup_remark']);

            $("#pop_ind_inco").html(data.val[0]['in_mon_income']);
            $("#pop_ind_inco_remark").html(data.val[0]['in_mon_income_remark']);

            $("#pop_fam_inco").html(data.val[0]['family_income']);
            $("#pop_fam_inco_remark").html(data.val[0]['family_income_remark']);

            $("#pop_resi").html(data.val[0]['residing_year']);
            $("#pop_resi_remark").html(data.val[0]['residing_year_remark']);

            $("#pop_bd_score").html(data.val[0]['bd_score']);

            bd_scor = data.val[0]['bd_score'];

            if( (bd_scor >= 80) && (bd_scor <= 100) ){ 
                $('#bd_bg').css('background-color','#e1f3da'); 
                $('#pop_bd_score').css({'color':'white','background-color':'#5bc75b'}); 
            }
            if( (bd_scor >= 50) && (bd_scor < 80) ){ 
                $('#bd_bg').css('background-color','#f7d8b261'); 
                $('#pop_bd_score').css({'color':'white','background-color':'rgb(235 140 23)'}); 
            }
            if( (bd_scor >= 0) && (bd_scor < 50) ){
                $('#bd_bg').css('background-color','#eb6c5840'); 
                $('#pop_bd_score').css({'color':'white','background-color':'rgb(215 76 61)'}); 
            }


            tt_score = data.val[0]['parlour_name'];
            if(tt_score != ""){
                $('#tt_score').show();
            }else{
                $('#tt_score').hide();
            }

            $("#pop_assess_score").html(data.val[0]['assess_score']);
            $("#pop_parlour_name").html(data.val[0]['parlour_name']);
            $("#pop_dfv").html(data.val[0]['date_of_visit']);
            $("#pop_remark").html(data.val[0]['tt_remarks']);

            $("#pop_area_slub").html(data.get_area['slab']);
            $("#pop_area").html(data.val[0]['area']);

            $("#pop_age_slub").html(data.get_age['slab']);
            $("#pop_age").html(data.val[0]['age']);

            $("#pop_busi_slub").html(data.get_busi['slab']);
            $("#pop_busi").html(data.val[0]['business']);

            $("#pop_fam_slab").html(data.get_family_busi['slab']);
            $("#pop_fam_busi").html(data.val[0]['family_business']);

            $("#pop_time_slab").html(data.get_time['slab']);
            $("#pop_time").html(data.val[0]['business_time']);

            $("#pop_sh_remark").html(data.val[0]['sh_remark']);

            $("#pop_state").html(data.val[0]['shop_sate']);
            $("#pop_city").html(data.val[0]['shop_city']);
            $("#pop_town").html(data.val[0]['shop_town']);
            $("#pop_pincode").html(data.val[0]['pincode']);
            $("#pop_population").html(data.val[0]['population']);
            $("#pop_town_code").html(data.val[0]['town_code']);

            $("#pop_manage_slab").html(data.get_manage['slab']);
            $("#pop_management").html(data.val[0]['management']);

            $("#pop_sperson_slab").html(data.val[0]['relationship']);
            $("#pop_sperson").html(data.val[0]['relationship_remark']);
           
            // $("#pop_expect_income_slab").html(data.val[0]['expect_income']);
            // $("#pop_expect_income").html(data.val[0]['expect_income_remark']);

            $("#pop_expect_income_slab").html(`<span>Before 6 months : ${data.val[0]['expect_income'] }</span>`);
            $("#pop_expect_income").html(data.val[0]['expect_income_remark']);

            $("#pop_expect_income_slab1").html(`<span>After 6 months : ${data.val[0]['expect_income1'] }</span>`);
            $("#pop_expect_income1").html(data.val[0]['expect_income_remark1']);

            $("#pop_score").html(data.val[0]['frc_score']);
            frc_scor = data.val[0]['frc_score'];

            if( (frc_scor >= 80) && (frc_scor <= 100) ){ 
                $('#frc_bg').css('background-color','#e1f3da'); 
                $('#pop_score').css({'color':'white','background-color':'#5bc75b'}); 
            }
            if( (frc_scor >= 50) && (frc_scor < 80) ){ 
                $('#frc_bg').css('background-color','#f7d8b261'); 
                $('#pop_score').css({'color':'white','background-color':'rgb(235 140 23)'}); 
            }
            if( (frc_scor >= 0) && (frc_scor < 50) ){
                $('#frc_bg').css('background-color','#eb6c5840'); 
                $('#pop_score').css({'color':'white','background-color':'rgb(215 76 61)'}); 
            }


            // Cluster Parameters Provides Score //
            $("#pop_breakeven_slub").html(`${data.val[0]['6c']} months`); //1
            breakeven = data.val[0]['6c'];
            if( breakeven == 0){
                breakeven_score = '10';
            }else{
                breakeven_score = '0';
            }
            $("#pop_breakeven").html(breakeven_score); 
           

            $("#pop_mbackup_slub").html(data.val[0]['6d']); //2
            money_bup = data.val[0]['6d'];
            if(money_bup == "Yes"){
                money_bup_score ='10';
            }else{
                money_bup_score = '0';
            }
            $("#pop_mbackup").html(money_bup_score);
            

            $("#pop_roi_slub").html(data.val[0]['6e']); //3
            var roi_score ='0';

            roi = data.val[0]['6e'];
            if(roi <= "30"){
                roi_score ='10';
            }
            if(roi >30 && roi <50){
                roi_score = '5';
            }
            if(roi > 50 ){
                roi_score ='0';
            }
            $("#pop_roi").html(roi_score);


            $("#pop_networth_slab").html(data.val[0]['7c']); //4
            var networth_score ='0';

            networth = data.val[0]['7c'];
            if(networth >= "500000"){
                networth_score ='20';
            }
            if(networth > "299999" && networth < "500000"){
                networth_score = '10';
            }
            if(networth <= "299999"){
                networth_score ='0';
            }
            $("#pop_networth").html(networth_score);
            

            $("#pop_loan_slab").html(data.val[0]['8a']); //5
            var lt_score ='0';

            loan_type = data.val[0]['8a'];
            loan_type1 = data.val[0]['8aa'];
            if(loan_type == "Own Fund"){
                lt_score ='10';
            }
            if(loan_type1 == "Partial Loan"){
                lt_score = '5';
            }
            if(loan_type1 == "Full Loan"){
                lt_score ='0';
            }
            $("#pop_loan").html(lt_score);
            

            $('#pop_expmt_slab').html(data.val[0]['11aa']); //6
            exp_manage = data.val[0]['11aa'];
            if( exp_manage == "Yes"){
                exp_manage_score = "20";
            }else{
                exp_manage_score = "0";
            }
            $('#pop_expmt').html(exp_manage_score);
            
            
            $('#pop_dairy_slab').html(data.val[0]['11bb']);
            dairy = data.val[0]['11bb'];
            if(dairy == "Yes"){
                dairy_score = "20" ;
            }else{
                dairy_score = "0" ;
            }
            $('#pop_dairy').html(dairy_score);

            $("#pop_ct_score").html(data.val[0]['ct_score']);
            ct_scor = data.val[0]['ct_score'];

            if( (ct_scor >= 80) && (ct_scor <= 100) ){ 
                $('#ct_bg').css('background-color','#e1f3da'); 
                $('#pop_ct_score').css({'color':'white','background-color':'#5bc75b'}); 
            }
            if( (ct_scor >= 50) && (ct_scor < 80) ){ 
                $('#ct_bg').css('background-color','#f7d8b261'); 
                $('#pop_ct_score').css({'color':'white','background-color':'rgb(235 140 23)'}); 
            }
            if( (ct_scor >= 0) && (ct_scor < 50) ){
                $('#ct_bg').css('background-color','#eb6c5840'); 
                $('#pop_ct_score').css({'color':'white','background-color':'rgb(215 76 61)'}); 
            }

            $("#3a").val(data.val[0]['3a']);
            $("#3b").val(data.val[0]['3b']);
            $("#3c").val(data.val[0]['3c']);
            $("#3d").val(data.val[0]['3d']);
            $("#3e").val(data.val[0]['3e']);

            temp = data.val[0]['franc_emp'];
            if(temp == 'Salaried'){
                $('#employee').show();
                $('#business').hide();
            }else{
                $('#employee').hide();
                $('#business').show();
            }

            $("#4a").val(data.val[0]['4a']);
            $("#4b").val(data.val[0]['4b']);
            $("#4c").val(data.val[0]['4c']);

            $("#5a").val(data.val[0]['5a']);
            $("#5b").val(data.val[0]['5b']);
            $("#5c").val(data.val[0]['5c']);
            $("#5d").val(data.val[0]['5d']);

            $("#6a").val(data.val[0]['6a']);
            $("#6b").val(data.val[0]['6b']);
            $("#6c").val(data.val[0]['6c']);
            $("#6d").val(data.val[0]['6d']);
            $("#6e").val(data.val[0]['6e']);

            $("#7a").val(data.val[0]['7a']);
            $("#7b").val(data.val[0]['7b']);
            $("#7c").val(data.val[0]['7c']);

            $("#8a").val(data.val[0]['8a']);
            
            loan = data.val[0]['8a'] ;
             
            if(loan == "loan"){
                $('#from_bank').show();
                $('#from_hand').show();
            }
            if(loan == "Own Fund"){
                $('#from_bank').hide();
                $('#from_hand').show();
            }

            $("#8b").val(data.val[0]['8b']);
            $("#8c").val(data.val[0]['8c']);
            $("#8d").val(data.val[0]['8d']);

            $("#9a").val(data.val[0]['9a']);
            $("#9b").val(data.val[0]['9b']);

            $("#10a").val(data.val[0]['10a']);
            $("#10b").val(data.val[0]['10b']);
            $("#10c").val(data.val[0]['10c']);
            $("#10d").val(data.val[0]['10d']);

            $("#11a").val(data.val[0]['11a']);
            $("#11aa").val(data.val[0]['11aa']);
            $("#11b").val(data.val[0]['11b']);
            $("#11bb").val(data.val[0]['11bb']);
            $("#11c").val(data.val[0]['11c']);
            $("#11d").val(data.val[0]['11d']);
            $("#11e").val(data.val[0]['11e']);

            $("#12a").val(data.val[0]['12a']);
            $("#12b").val(data.val[0]['12b']);
            $("#12c").val(data.val[0]['12c']);
            $("#12d").val(data.val[0]['12d']);
            $("#12e").val(data.val[0]['12e']);
            $("#12f").val(data.val[0]['12f']);
            $("#12g").val(data.val[0]['12g']); 
            $("#12h").val(data.val[0]['12h']);
            $("#12i").val(data.val[0]['12i']);
            $("#12j").val(data.val[0]['12j']);
            $("#12k").val(data.val[0]['12k']);
            $("#12l").val(data.val[0]['12l']);
            $("#12m").val(data.val[0]['12m']);
            $("#12n").val(data.val[0]['12n']);
            $("#12o").val(data.val[0]['12o']);
            $("#12p").val(data.val[0]['12p']);

            $("#id_val").val(data.val[0]['id']);

            // APPPATH . '../uploads/shDocument
            $("#show_img1").html(`
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['signed_agree']}" ><img src="../../uploads/shDocument/${data.doc[0]['signed_agree']}" width="150" height="100"></a>
            `);
            $("#show_img2").html(`
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['profile']}" ><img src="../../uploads/shDocument/${data.doc[0]['profile']}" width="150" height="100" ></a>
            `);
            $("#show_img3").html(`
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['challan']}" ><img src="../../uploads/shDocument/${data.doc[0]['challan']}" width="150" height="100" ></a>
            `);
            $("#show_img4").html(`
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['gst']}" ><img src="../../uploads/shDocument/${data.doc[0]['gst']}" width="150" height="100" ></a>
            `);
            $("#show_img5").html(`
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['fassai']}" ><img src="../../uploads/shDocument/${data.doc[0]['fassai']}" width="150" height="100" ></a>
            `);
            $("#show_img6").html(`
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['pan']}" ><img src="../../uploads/shDocument/${data.doc[0]['pan']}" width="150" height="100"></a>
            `);
            $("#show_img7").html(`
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['aadhar']}" ><img src="../../uploads/shDocument/${data.doc[0]['aadhar']}" width="150" height="100"></a>
            `);
            $("#show_img8").html(`
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['current_acc']}" ><img src="../../uploads/shDocument/${data.doc[0]['current_acc']}" width="150" height="100"></a>
            `);
            $("#show_img9").html(`
                <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['retail_outlet']}" ><img src="../../uploads/shDocument/${data.doc[0]['retail_outlet']}" width="150" height="100"></a>
            `);

            if(data.post_doc !=""){
                a = data.post_doc[0]['asset_img'];
                b = data.post_doc[0]['team_img'];

                if(a!="Nil" && b!="Nil"){
                    $("#asset_div").html(`
                        <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" ><img src="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" width="150" height="100""></a>
                    `);
                    $("#team_div").html(`
                        <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" ><img src="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" width="150" height="100"></a>
                    `);
                    $("#save_btn").html("");

                }else{
                    
                    if( a != "Nil"){
                        $("#asset_div").html(`
                            <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" ><img src="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" width="150" height="100"></a>
                            <input type="hidden" id="asset_img" name="asset_img" value="0">
                        `);
                    }else{
                        $("#asset_div").html(`<input type="file" name="asset_img" id="asset_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }

                    if ( b != "Nil"){
                        $("#team_div").html(`
                            <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" ><img src="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" width="150" height="100"></a>
                            <input type="hidden" id="team_img" name="team_img" value="0">
                        `);
                    }else{
                        $("#team_div").html(`<input type="file" name="team_img" id="team_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }
                    // $("#save_btn").html(`<button class="btn btn-info" onclick="update_post_doc()">Upload</button>`);
                    
                    // pre_doc = (data.val[0]['ct_pre_doc_upload']);
                    // if(pre_doc == "uploaded"){
                    //     $("#saveor_update_btn").html(`<button class="btn btn-primary" onclick="update_pre_doc()">Upload</button>`);
                    // }else{
                    //     $("#saveor_update_btn").html("");
                    // }
                    
                    $("#saveor_update_btn").html(`<button class="btn btn-primary" onclick="update_pre_doc()">Upload</button>`);

                }

                
            }else{
                $("#asset_div").html(`<input type="file" name="asset_img" id="asset_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                $("#team_div").html(`<input type="file" name="team_img" id="team_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
    
                pre_doc = (data.val[0]['ct_pre_doc_upload']);
                a_img = data.post_doc[0]['asset_img'];
                b_img = data.post_doc[0]['team_img'];

                if(pre_doc == "uploaded" && a_img !="Nil" && b_img !="Nil"){
                    $("#saveor_update_btn").html(`<button class="btn btn-primary" onclick="update_pre_doc()">Upload</button>`);
                }else{
                    $("#saveor_update_btn").html("");
                }
            }

            $("#detail_view_trigger").click();

        }
    })
}


//**mt uploaded document**//

function uploaded_view_action(id){

    $.ajax({
        type: "POST",
        url: BASE_URL +'Common/view_uploaded_vdo',
        data : {'id': id},
        dataType : "JSON",

        success: function(data){
           $("#img_div").html(data.response);
           
           $("#vdo_div").html(`
            <video width="350" height="240" controls>
                <source src="../../uploads/Approved_Vdo/${data.get_vdo[0]['video']}" width="350" height="240" type="video/mp4"></a>
            </video>

            `);

            $("#mt_uploaded_pop").click();
        }
    })
}

function fetch_all_detail(id){
    // $('#detail_view_trigger').trigger('reset');

    $.ajax({  
        type: "POST",
        url: BASE_URL + 'common/view_doc_detail',  
        data: {'id':id,}, 
        dataType: "JSON",
        success: function (data) {

            tmp = data.val[0]['id'];
            // append values 
            // $id =
            $("#pop_user_id").html(data.val[0]['id']);

            $("#pop_name").html(data.val[0]['name']);
            $("#pop_mobile").html(data.val[0]['mobile']);
            $("#pop_education").html(data.val[0]['education']);

            $("#pop_marital_status").html(data.val[0]['marital_status']);
            $("#pop_marital_remark").html(data.val[0]['marital_status_remark']);

            $("#pop_edu").html(data.val[0]['education']);
            $("#pop_edu_remark").html(data.val[0]['education_remark']);

            $("#pop_ind_inco").html(data.val[0]['in_mon_income']);
            $("#pop_ind_inco_remark").html(data.val[0]['in_mon_income_remark']);

            $("#pop_fam_inco").html(data.val[0]['family_income']);
            $("#pop_fam_inco_remark").html(data.val[0]['family_income_remark']);

            $("#pop_resi").html(data.val[0]['residing_year']);
            $("#pop_resi_remark").html(data.val[0]['residing_year_remark']);

            $("#pop_bd_score").html(data.val[0]['bd_score']);

            $("#pop_area_slub").html(data.get_area['slab']);
            $("#pop_area").html(data.val[0]['area']);

            $("#pop_age_slub").html(data.get_age['slab']);
            $("#pop_age").html(data.val[0]['age']);

            $("#pop_busi_slub").html(data.get_busi['slab']);
            $("#pop_busi").html(data.val[0]['business']);

            $("#pop_fam_slab").html(data.get_family_busi['slab']);
            $("#pop_fam_busi").html(data.val[0]['family_business']);

            $("#pop_time_slab").html(data.get_time['slab']);
            $("#pop_time").html(data.val[0]['business_time']);

            $("#pop_sh_remark").html(data.val[0]['sh_remark']);

            $("#pop_state").html(data.val[0]['shop_sate']);
            $("#pop_city").html(data.val[0]['shop_city']);
            $("#pop_town").html(data.val[0]['shop_town']);
            $("#pop_pincode").html(data.val[0]['pincode']);
            $("#pop_population").html(data.val[0]['population']);
            $("#pop_town_code").html(data.val[0]['town_code']);

            $("#pop_manage_slab").html(data.get_manage['slab']);
            $("#pop_management").html(data.val[0]['management']);

            $("#pop_sperson_slab").html(data.val[0]['relationship']);
            $("#pop_sperson").html(data.val[0]['relationship_remark']);
           
            // $("#pop_expect_income_slab").html(data.val[0]['expect_income']);
            // $("#pop_expect_income").html(data.val[0]['expect_income_remark']);

            $("#pop_expect_income_slab").html(`<span>Before 6 months : ${data.val[0]['expect_income'] }</span>`);
            $("#pop_expect_income").html(data.val[0]['expect_income_remark']);

            $("#pop_expect_income_slab1").html(`<span>After 6 months : ${data.val[0]['expect_income1'] }</span>`);
            $("#pop_expect_income1").html(data.val[0]['expect_income_remark1']);


            $("#pop_score").html(data.val[0]['frc_score']);
            frc_scor = data.val[0]['frc_score'];

            if( (frc_scor >= 80) && (frc_scor <= 100) ){ 
                $('#frc_bg').css('background-color','#e1f3da'); 
                $('#pop_score').css({'color':'white','background-color':'#5bc75b'}); 
            }
            if( (frc_scor >= 50) && (frc_scor < 80) ){ 
                $('#frc_bg').css('background-color','#f7d8b261'); 
                $('#pop_score').css({'color':'white','background-color':'rgb(235 140 23)'}); 
            }
            if( (frc_scor >= 0) && (frc_scor < 50) ){
                $('#frc_bg').css('background-color','#eb6c5840'); 
                $('#pop_score').css({'color':'white','background-color':'rgb(215 76 61)'}); 
            }

            // Cluster Parameters Provides Score //
            $("#pop_breakeven_slub").html(`${data.val[0]['6c']} months`); //1
            breakeven = data.val[0]['6c'];
            if( breakeven == 0){
                breakeven_score = '10';
            }else{
                breakeven_score = '0';
            }
            $("#pop_breakeven").html(breakeven_score); 
           

            $("#pop_mbackup_slub").html(data.val[0]['6d']); //2
            money_bup = data.val[0]['6d'];
            if(money_bup == "Yes"){
                money_bup_score ='10';
            }else{
                money_bup_score = '0';
            }
            $("#pop_mbackup").html(money_bup_score);
            

            $("#pop_roi_slub").html(data.val[0]['6e']); //3
            var roi_score ='0';

            roi = data.val[0]['6e'];
            if(roi <= "30"){
                roi_score ='10';
            }
            if(roi >30 && roi <50){
                roi_score = '5';
            }
            if(roi > 50 ){
                roi_score ='0';
            }
            $("#pop_roi").html(roi_score);


            $("#pop_networth_slab").html(data.val[0]['7c']); //4
            var networth_score ='0';

            networth = data.val[0]['7c'];
            if(networth >= "500000"){
                networth_score ='20';
            }
            if(networth > "299999" && networth < "500000"){
                networth_score = '10';
            }
            if(networth <= "299999"){
                networth_score ='0';
            }
            $("#pop_networth").html(networth_score);
            

            $("#pop_loan_slab").html(data.val[0]['8a']); //5
            var lt_score ='0';

            loan_type = data.val[0]['8a'];
            loan_type1 = data.val[0]['8aa'];
            if(loan_type == "Own Fund"){
                lt_score ='10';
            }
            if(loan_type1 == "Partial Loan"){
                lt_score = '5';
            }
            if(loan_type1 == "Full Loan"){
                lt_score ='0';
            }
            $("#pop_loan").html(lt_score);
            

            $('#pop_expmt_slab').html(data.val[0]['11aa']); //6
            exp_manage = data.val[0]['11aa'];
            if( exp_manage == "Yes"){
                exp_manage_score = "20";
            }else{
                exp_manage_score = "0";
            }
            $('#pop_expmt').html(exp_manage_score);
            
            
            $('#pop_dairy_slab').html(data.val[0]['11bb']);
            dairy = data.val[0]['11bb'];
            if(dairy == "Yes"){
                dairy_score = "20" ;
            }else{
                dairy_score = "0" ;
            }
            $('#pop_dairy').html(dairy_score);

            $("#pop_ct_score").html(data.val[0]['ct_score']);
            ct_scor = data.val[0]['ct_score'];

            if( (ct_scor >= 80) && (ct_scor <= 100) ){ 
                $('#ct_bg').css('background-color','#e1f3da'); 
                $('#pop_ct_score').css({'color':'white','background-color':'#5bc75b'}); 
            }
            if( (ct_scor >= 50) && (ct_scor < 80) ){ 
                $('#ct_bg').css('background-color','#f7d8b261'); 
                $('#pop_ct_score').css({'color':'white','background-color':'rgb(235 140 23)'}); 
            }
            if( (ct_scor >= 0) && (ct_scor < 50) ){
                $('#ct_bg').css('background-color','#eb6c5840'); 
                $('#pop_ct_score').css({'color':'white','background-color':'rgb(215 76 61)'}); 
            }
            
            $("#3a").val(data.val[0]['3a']);
            $("#3b").val(data.val[0]['3b']);
            $("#3c").val(data.val[0]['3c']);
            $("#3d").val(data.val[0]['3d']);
            $("#3e").val(data.val[0]['3e']);

            temp = data.val[0]['franc_emp'];
            if(temp == 'Salaried'){
                $('#employee').show();
                $('#business').hide();
            }else{
                $('#employee').hide();
                $('#business').show();
            }

            $("#4a").val(data.val[0]['4a']);
            $("#4b").val(data.val[0]['4b']);
            $("#4c").val(data.val[0]['4c']);

            $("#5a").val(data.val[0]['5a']);
            $("#5b").val(data.val[0]['5b']);
            $("#5c").val(data.val[0]['5c']);
            $("#5d").val(data.val[0]['5d']);

            $("#6a").val(data.val[0]['6a']);
            $("#6b").val(data.val[0]['6b']);
            $("#6c").val(data.val[0]['6c']);
            $("#6d").val(data.val[0]['6d']);
            $("#6e").val(data.val[0]['6e']);

            $("#7a").val(data.val[0]['7a']);
            $("#7b").val(data.val[0]['7b']);
            $("#7c").val(data.val[0]['7c']);

            $("#8a").val(data.val[0]['8a']);

            loan = data.val[0]['8a'] ;
            
            if(loan == "loan"){
                $('#from_bank').show();
                $('#from_hand').show();
            }
            if(loan == "Own Fund"){
                $('#from_bank').hide();
                $('#from_hand').show();
            }

            $("#8b").val(data.val[0]['8b']);
            $("#8c").val(data.val[0]['8c']);
            $("#8d").val(data.val[0]['8d']);

            $("#9a").val(data.val[0]['9a']);
            $("#9b").val(data.val[0]['9b']);

            $("#10a").val(data.val[0]['10a']);
            $("#10b").val(data.val[0]['10b']);
            $("#10c").val(data.val[0]['10c']);
            $("#10d").val(data.val[0]['10d']);

            $("#11a").val(data.val[0]['11a']);
            $("#11aa").val(data.val[0]['11aa']);
            $("#11b").val(data.val[0]['11b']);
            $("#11bb").val(data.val[0]['11bb']);
            $("#11c").val(data.val[0]['11c']);
            $("#11d").val(data.val[0]['11d']);
            $("#11e").val(data.val[0]['11e']);

            $("#12a").val(data.val[0]['12a']);
            $("#12b").val(data.val[0]['12b']);
            $("#12c").val(data.val[0]['12c']);
            $("#12d").val(data.val[0]['12d']);
            $("#12e").val(data.val[0]['12e']);
            $("#12f").val(data.val[0]['12f']);
            $("#12g").val(data.val[0]['12g']);
            $("#12h").val(data.val[0]['12h']);
            $("#12i").val(data.val[0]['12i']);
            $("#12j").val(data.val[0]['12j']);
            $("#12k").val(data.val[0]['12k']);
            $("#12l").val(data.val[0]['12l']);
            $("#12m").val(data.val[0]['12m']);
            $("#12n").val(data.val[0]['12n']);
            $("#12o").val(data.val[0]['12o']);
            $("#12p").val(data.val[0]['12p']);

            $("#id_val").val(data.val[0]['id']);
            $("#id_dval").val(data.val[0]['id']);

            // $("#pop_button").html(`<a href=http://localhost/H_Parlour_Franchisee/index.php/ct/ct_edit_form/${data.val[0]['id']} class='btn btn-success'>Add More Details </a>`);
            pre_doc = (data.val[0]['ct_pre_doc_upload']);
                {/* end */}
            if(data.doc !=""){

                a = data.doc[0]['signed_agree'] ;
                b = data.doc[0]['profile'] ;
                c = data.doc[0]['challan'] ;
                d = data.doc[0]['gst'] ;
                e = data.doc[0]['fassai'] ;
                f = data.doc[0]['pan'] ;
                g = data.doc[0]['aadhar'] ;
                h = data.doc[0]['current_acc'] ;
                i = data.doc[0]['retail_outlet'] ;
                if( a !="Nil" && b !="Nil" && c !="Nil" && d !="Nil" && e!="Nil" && f!="Nil" && g!="Nil" && h!="Nil" && i!="Nil"){
                    $("#show_img1").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['signed_agree']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                        <input type="hidden" id="sign_agree" name="sign_agree" value="0">
                    `);
                    $("#show_img2").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['profile']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                        <input type="hidden" id="profile" name="profile" value="0">
                    `);
                    $("#show_img3").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['challan']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                        <input type="hidden" id="challan" name="challan" value="0">
                    `);
                    $("#show_img4").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['gst']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                        <input type="hidden" id="gst" name="gst" value="0">
                    `);
                    $("#show_img5").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['fassai']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i> </a>
                        <input type="hidden" id="fassai" name="fassai" value="0">
                    `);
                    $("#show_img6").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['pan']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i> </a>
                        <input type="hidden" id="pan" name="pan" value="0">
                    `);
                    $("#show_img7").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['aadhar']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                        <input type="hidden" id="aadhar" name="aadhar" value="0">
                    `);
                    $("#show_img8").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['current_acc']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i> </a>
                        <input type="hidden" id="current_acc" name="current_acc" value="0">
                    `);
                    $("#show_img9").html(`
                        <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['retail_outlet']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i> </a>
                        <input type="hidden" id="retail_outlet" name="retail_outlet" value="0">
                    `);

                    if(data.post_doc !=""){
                        a = data.post_doc[0]['asset_img'];
                        b = data.post_doc[0]['team_img'];
        
                        if(a!="Nil" && b!="Nil"){
                            $("#asset_div").html(`
                                <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                <input type="hidden" id="asset_img" name="asset_img" value="0">
                            `);
                            $("#team_div").html(`
                                <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                <input type="hidden" id="team_img" name="team_img" value="0">
                            `);
                            $("#saveor_update_btn").html("");
                        }
                        else{
                            
                            if( a != "Nil"){
                                $("#asset_div").html(`
                                    <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                    <input type="hidden" id="asset_img" name="asset_img" value="0">
                                `);
                            }else{
                                $("#asset_div").html(`<input type="file" name="asset_img" id="asset_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                            }
         
                            if ( b != "Nil"){
                                $("#team_div").html(`
                                    <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                    <input type="hidden" id="team_img" name="team_img" value="0">
                                `);
                            }else{
                                $("#team_div").html(`<input type="file" name="team_img" id="team_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                            }
                            $("#saveor_update_btn").html(`<button class="btn btn-primary" onclick="update_pre_doc()">Upload</button>`);
                            
                        }
                        
                    }else{
        
                        $("#asset_div").html(`<input type="file" name="asset_img" id="asset_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                        $("#team_div").html(`<input type="file" name="team_img" id="team_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
            
                        $("#saveor_update_btn").html(`<button class="btn btn-primary" onclick="update_pre_doc()">Upload</button>`);
                    }


                    a_img = data.post_doc[0]['asset_img'];
                    b_img = data.post_doc[0]['team_img'];

                    if(data.val[0]['ct_pre_doc_upload'] == "uploaded" && data.val[0]['ct_post_doc_upload'] == "uploaded" && a_img!="Nil" && b_img !="Nil"){
                        $("#saveor_update_btn").html("");
                    }else{
                        $("#saveor_update_btn").html(`<button class="btn btn-primary" onclick="update_pre_doc()">Upload</button>`);
                    }


                }else{

                    if(a != "Nil"){
                        $("#show_img1").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['signed_agree']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                            <input type="hidden" id="sign_agree" name="sign_agree" value="0">
                        `);
                    }else{
                        $("#show_img1").html(`<input type="file" name="sign_agree" id="sign_agree" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }
                
                    if(b != "Nil"){
                        $("#show_img2").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['profile']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                            <input type="hidden" id="profile" name="profile" value="0">
                        `);
                    }else{
                        $("#show_img2").html(`<input type="file" name="profile" id="profile" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }
    
                    if(c != "Nil"){
                        $("#show_img3").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['challan']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                            <input type="hidden" id="challan" name="challan" value="0">
                        `);
                    }else{
                        $("#show_img3").html(`<input type="file" name="challan" id="challan" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }
    
                    if(d != "Nil"){
                        $("#show_img4").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['gst']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                            <input type="hidden" id="gst" name="gst" value="0">
                        `);
                    }else{
                        $("#show_img4").html(`<input type="file" name="gst" id="gst" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }
    
                    if(e != "Nil"){
                        $("#show_img5").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['fassai']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i> </a>
                            <input type="hidden" id="fassai" name="fassai" value="0">
                        `);
                    }else{
                        $("#show_img5").html(`<input type="file" name="fassai" id="fassai" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }
    
                    if(f != "Nil"){
                        $("#show_img6").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['pan']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i> </a>
                            <input type="hidden" id="pan" name="pan" value="0">
                        `);
                    }else{
                        $("#show_img6").html(`<input type="file" name="pan" id="pan" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }
    
                    if(g != "Nil"){
                        $("#show_img7").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['aadhar']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                            <input type="hidden" id="aadhar" name="aadhar" value="0">
                        `);
                    }else{
                        $("#show_img7").html(`<input type="file" name="aadhar" id="aadhar" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }
    
                    if(h != "Nil"){
                        $("#show_img8").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['current_acc']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i> </a>
                            <input type="hidden" id="current_acc" name="current_acc" value="0">
                        `);
                    }else{
                        $("#show_img8").html(`<input type="file" name="current_acc" id="current_acc" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }
                    if(i != "Nil"){
                        $("#show_img9").html(`
                            <a target="_blank" href="../../uploads/shDocument/${data.doc[0]['retail_outlet']}"><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i> </a>
                            <input type="hidden" id="retail_outlet" name="retail_outlet" value="0">
                        `);
                    }else{
                        $("#show_img9").html(`<input type="file" name="retail_outlet" id="retail_outlet" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                    }

                    if(data.post_doc !=""){
                        aa = data.post_doc[0]['asset_img'];
                        bb = data.post_doc[0]['team_img'];
        
                        if(aa!="Nil" && bb!="Nil"){
                            $("#asset_div").html(`
                                <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                <input type="hidden" id="asset_img" name="asset_img" value="0">
                            `);
                            $("#team_div").html(`
                                <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                <input type="hidden" id="team_img" name="team_img" value="0">
                            `);
        
                        }else{
                            
                            if( aa != "Nil"){
                                $("#asset_div").html(`
                                    <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                    <input type="hidden" id="asset_img" name="asset_img" value="0">
                                `);
                            }else{
                                $("#asset_div").html(`<input type="file" name="asset_img" id="asset_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                            }
        
                            if ( bb != "Nil"){
                                $("#team_div").html(`
                                    <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                    <input type="hidden" id="team_img" name="team_img" value="0">
                                `);
                            }else{
                                $("#team_div").html(`<input type="file" name="team_img" id="team_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                            }
                        }
        
                        
                    }else{
        
                        $("#asset_div").html(`<input type="file" name="asset_img" id="asset_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                        $("#team_div").html(`<input type="file" name="team_img" id="team_img" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
            
                    }
        
                    $("#saveor_update_btn").html(`<button class="btn btn-primary" onclick="update_pre_doc()">Upload</button>`);
    
                }

                
            }else{
                $("#show_img1").html(`<input type="file" name="sign_agree" id="sign_agree" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                $("#show_img2").html(`<input type="file" name="profile" id="profile" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                $("#show_img3").html(`<input type="file" name="challan" id="challan" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                $("#show_img4").html(`<input type="file" name="gst" id="gst" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                $("#show_img5").html(`<input type="file" name="fassai" id="fassai" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                $("#show_img6").html(`<input type="file" name="pan" id="pan" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                $("#show_img7").html(`<input type="file" name="aadhar" id="aadhar" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                $("#show_img8").html(`<input type="file" name="current_acc" id="current_acc" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);
                $("#show_img9").html(`<input type="file" name="retail_outlet" id="retail_outlet" accept="image/*" onchange="ValidateSingleInput(this);" class="form-control">`);

                if(data.post_doc !=""){
                    aa = data.post_doc[0]['asset_img'];
                    bb = data.post_doc[0]['team_img'];
    
                    if(aa!="Nil" && bb!="Nil"){
                        $("#asset_div").html(`
                            <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                            <input type="hidden" id="asset_img" name="asset_img" value="0">
                        `);
                        $("#team_div").html(`
                            <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                            <input type="hidden" id="team_img" name="team_img" value="0">
                        `);
    
                    }else{
                        
                        if( aa != "Nil"){
                            $("#asset_div").html(`
                                <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                <input type="hidden" id="asset_img" name="asset_img" value="0">
                            `);
                        }else{
                            $("#asset_div").html(`<input type="file" name="asset_img" id="asset_img" class="form-control">`);
                        }
    
                        if ( bb != "Nil"){
                            $("#team_div").html(`
                                <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                                <input type="hidden" id="team_img" name="team_img" value="0">
                            `);
                        }else{
                            $("#team_div").html(`<input type="file" name="team_img" id="team_img" class="form-control">`);
                        }
                    }
    
                    
                }else{
    
                    $("#asset_div").html(`<input type="file" name="asset_img" id="asset_img" class="form-control">`);
                    $("#team_div").html(`<input type="file" name="team_img" id="team_img" class="form-control">`);
        
                }
                $("#saveor_update_btn").html(`<button class="btn btn-primary" onclick="insert_pre_doc()">Upload</button>`);
                
            }

    
                // if(data.post_doc !=""){
                //     a = data.post_doc[0]['asset_img'];
                //     b = data.post_doc[0]['team_img'];
    
                //     if(a!="Nil" && b!="Nil"){
                //         $("#asset_div").html(`
                //             <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                //         `);
                //         $("#team_div").html(`
                //             <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                //         `);
                //         $("#save_btn").html("");
    
                //     }else{
                        
                //         if( a != "Nil"){
                //             $("#asset_div").html(`
                //                 <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['asset_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                //                 <input type="hidden" id="asset_img" name="asset_img" value="0">
                //             `);
                //         }else{
                //             $("#asset_div").html(`<input type="file" name="asset_img" id="asset_img" class="form-control">`);
                //         }
    
                //         if ( b != "Nil"){
                //             $("#team_div").html(`
                //                 <a target="_blank" href="../../uploads/Asset_and_Team/${data.post_doc[0]['team_img']}" ><i class="fa fa-file-text-o" style="padding: 12px 1px 0px 20px; font-size:60px;"></i></a>
                //                 <input type="hidden" id="team_img" name="team_img" value="0">
                //             `);
                //         }else{
                //             $("#team_div").html(`<input type="file" name="team_img" id="team_img" class="form-control">`);
                //         }
                //         if(pre_doc == "uploaded"){
                //             $("#save_btn").html(`<button class="btn btn-info" onclick="update_post_doc()">Upload</button>`);
                //         }else{
                //             $("#save_btn").html("");
                //         }
                //     }
    
                    
                // }else{
    
                //     $("#asset_div").html(`<input type="file" name="asset_img" id="asset_img" class="form-control">`);
                //     $("#team_div").html(`<input type="file" name="team_img" id="team_img" class="form-control">`);
        
                //     pre_doc = (data.val[0]['ct_pre_doc_upload']);
                //     if(pre_doc == "uploaded"){
                //         $("#save_btn").html(`<button class="btn btn-primary" onclick="insert_post_doc()">Upload</button>`);
                //     }else{
                //         $("#save_btn").html("");
                //     }
                // }
    
    
            var progress_val = 0;
            var bar = document.querySelector(".progress-bar");

            if(data.post_doc !=""){
                if(data.post_doc[0]['asset_img'] !="Nil"){ progress_j = 9; }else{ progress_j = 0 ; }
                if(data.post_doc[0]['team_img'] !="Nil"){ progress_k = 9; }else{ progress_k = 0 ; }
            }else{
                progress_j = 0 ; progress_k = 0 ;
            }
            if(data.doc !=""){
                if( data.doc[0]['signed_agree'] !="Nil"){ progress_a = 9; }else{ progress_a = 0 ; }
                if(data.doc[0]['profile'] !="Nil"){ progress_b = 9; }else{ progress_b = 0 ; }
                if(data.doc[0]['challan'] !="Nil"){ progress_c = 9; }else{ progress_c = 0 ; }
                if(data.doc[0]['gst'] !="Nil"){ progress_d = 9; }else{ progress_d = 0 ; }
                if(data.doc[0]['fassai'] !="Nil"){ progress_e = 9; }else{ progress_e = 0 ; }
                if(data.doc[0]['pan'] !="Nil"){ progress_f = 9; }else{ progress_f = 0 ; }
                if(data.doc[0]['aadhar'] !="Nil"){ progress_g = 9; }else{ progress_g = 0 ; }
                if(data.doc[0]['current_acc'] !="Nil"){ progress_h = 9; }else{ progress_h = 0 ; }
                if(data.doc[0]['retail_outlet'] !="Nil"){ progress_i = 10; }else{ progress_i = 0 ; }
            }else{
                progress_a = 0 ; progress_b = 0 ; progress_c = 0 ; progress_d = 0; progress_e = 0 ; progress_f = 0 ; progress_g = 0 ; progress_h = 0;  progress_i = 0;
            }
                progress_val =(progress_a + progress_b + progress_c + progress_d + progress_e + progress_f + progress_g + progress_h + progress_i + progress_j +  progress_k);
                if(progress_val <= 100){
                    bar.style.width = progress_val + "%";
                    bar.innerText = progress_val + "%";
                }

                if( (progress_val >= 9) && (progress_val <= 59) ){ 
                    bar.style.backgroundColor = "#aadbaa" ;
                }
                if( (progress_val >= 60) && (progress_val <= 99) ){
                    bar.style.backgroundColor = "#67df49" ;
                }
                if( progress_val == 100 ){
                    bar.style.backgroundColor = "green" ;
                }

        }
    })
}
    