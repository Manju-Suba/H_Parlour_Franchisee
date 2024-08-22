$(document).on('change', '#state', function() {
    var state = $('#state').val();
    $.ajax({
        url: BASE_URL+"sa/change_state",
        type: "post",
        dataType: 'json',
        data: {state:state},
        success: function(data) {
            if(data.res=="success"){
                $('#city').html(data.city);
            }
        }
    })
})

$(document).on('change', '#city', function() {
    var city = $('#city').val();
    $.ajax({
        url: BASE_URL+"sa/change_city",
        type: "post",
        dataType: 'json',
        data: {city:city},
        success: function(data) {
            if(data.res=="success"){
                $('#town').html(data.town);
            }
        }
    })
})

function edit_location(id){
    $.ajax({
        url: BASE_URL+"sa/edit_location",
        type: "post",
        dataType: 'json',
        data: {id:id},
        success: function(data) {
            if(data.res=="success"){
                $('#exampleModal').modal('show');
                $('#town').html(data.town);
                $('#city').html(data.city);
                $('#state').val(data.loc[0].state_id);
                $('#city').val(data.loc[0].city_id);
                $('#town').val(data.loc[0].town_id);
                $('#area').val(data.loc[0].area);
                $('#c_shopname').val(data.loc[0].c_shopname);
                $('#address').val(data.loc[0].address);
                $('#edit_id').val(data.loc[0].id);
            }
        }
    })
} 

$(document).on('submit', '#edit_location_form', function() {
    $.ajax({
        url: BASE_URL+"sa/update_location",
        type: "post",
        dataType: 'json',
        data: $("#edit_location_form").serialize(),
        success: function(data) {
            if(data.res=="success"){
                $("#update").html('Location Updated Successfully')
                setTimeout(function(){
                    location_table();
                    $("#update").html('');
                    $('#exampleModal').modal('hide');
                }, 2000);
            }
        }
    })
})

$(document).ready(function(){
    location_table();
    final_location_table(); 
    sa_doc_final_location_table();
})

function location_table(){
    $('#location_table').DataTable({
        // 'dom': 'Bfrtip',
        // 'buttons': ['copy', 'excel', 'pdf', 'print', 'colvis'], 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',  
        "bDestroy": true,
 
        'ajax': {
            'url': BASE_URL + 'sa/get_location_table',
        },
        
        "columns": [
            {
                title: 'S.No',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "state_name" },
            { "data": "city_name" },
            { "data": "town_name" },
            { "data": "area" },
            { "data": "c_shopname" },
            { "data": "address" },
            { "data": "action" }, 
        ],
        "order": [
            [1, 'asc']
        ]
    });
}

 
function delete_location(id){
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger mr-2'
      },
      buttonsStyling: false
    })
    swalWithBootstrapButtons.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {
          $.ajax({
            url: BASE_URL+"sa/delete_location",
            type: "post",
            dataType: "json",
            data: {
                id: id
            },
            success: function(data){
              if (data.res == "success") {
                location_table();
                toastr.success('Deleted Successfully')
              }
            }
          });
      } 
    });
   
}


// final location
function final_location_table(){
    $('#final_location').DataTable({
        // 'dom': 'Bfrtip',
        // 'buttons': ['copy', 'excel', 'pdf', 'print', 'colvis'], 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post', 
        "bDestroy": true,
  
        'ajax': {
            'url': BASE_URL + 'sa/get_final_locations',
        },
        
        "columns": [
            {
                title: 'S.No',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "state_name" },
            { "data": "city_name" }, 
            { "data": "town_name" },
            { "data": "area" },
            { "data": "c_shopname" },
            { "data": "address" },
            { "data": "time_schedul" },
            {  
                "data": "review_date",  
                "render": function (data) {  
                var date = new Date(data);  
                var month = date.getMonth() + 1;  
                return date.getDate() + "-" +  (month.length > 1 ? month : "0" + month) + "-" + date.getFullYear();  
              }},
            { "data": "img" },
            { "data": "action" },
        ],
        "order": [
            [1, 'asc']
        ]
    });
}

function get_id(id){
    // $id = $("#doc_id").val(id);
    $.ajax({
        url: BASE_URL+"common/get_sa_doc_image",
        type: "post",
        dataType: 'json',
        data:{id:id},
        success: function(data) {
            if(data.res=="success"){
                $('#doc_id').val(data.id);
                // $('#doc_1').val(data.l_check[0].doc_1);
                // $('#doc_2').val(data.l_check[0].doc_2);
                // $('#doc_3').val(data.l_check[0].doc_3);

                doc_id = data.id;
                doc_1 = data.l_check[0].doc_1;
                doc_2 = data.l_check[0].doc_2;
                doc_3 = data.l_check[0].doc_3;

                if(doc_1 !="Nil" ){
                    $("#doc_1").prop('hidden', true);
                    $("#doc_1_img").prop('hidden', false);
                    $("#doc_1_img").html(`
                        <a target="_blank" title="click me to open" href="../../uploads/SA_upload_document/${data.l_check[0]['doc_1']}" ><i class="fa fa-file-text-o" style="font-size:66px;"></i></a>
                    `);
                }else{
                    $("#doc_1").prop('hidden', false);
                    $("#doc_1_img").prop('hidden', true);
                }

                if(doc_2 !="Nil"){
                    $("#doc_2").prop('hidden', true);
                    $("#doc_2_img").prop('hidden', false);
                    $("#doc_2_img").html(`
                        <a target="_blank" title="click me to open" href="../../uploads/SA_upload_document/${data.l_check[0]['doc_2']}" ><i class="fa fa-file-text-o" style="font-size:66px;"></i></a>
                    `);
                }else{
                    $("#doc_2").prop('hidden', false);
                    $("#doc_2_img").prop('hidden', true);
                }

                if(doc_3 !="Nil"){
                    $("#doc_3").prop('hidden', true);
                    $("#doc_3_img").prop('hidden', false);
                    $("#doc_3_img").html(`
                        <a target="_blank" title="click me to open" href="../../uploads/SA_upload_document/${data.l_check[0]['doc_3']}" ><i class="fa fa-file-text-o" style="font-size:66px;"></i></a>
                    `);
                }else{
                    $("#doc_3").prop('hidden', false);
                    $("#doc_3_img").prop('hidden', true);
                }

                if(doc_1 !="Nil" && doc_2 !="Nil" && doc_3 !="Nil"){
                    $('#submit_pop').prop('hidden', true);
                    doc_id = data.id;
                    update_sa_doc(doc_id);
                }else{
                    $('#submit_pop').prop('hidden', false);
                }
            }else{
                $('#doc_id').val(data.id);
                $("#doc_1").prop('hidden', false);
                $("#doc_1_img").prop('hidden', true);
                $("#doc_2").prop('hidden', false);
                $("#doc_2_img").prop('hidden', true);
                $("#doc_3").prop('hidden', false);
                $("#doc_3_img").prop('hidden', true);
                $('#submit_pop').prop('hidden', false);

            }
        }
    })

}

function update_sa_doc(id){
    $.ajax({
        url: BASE_URL+"sa/update_sa",
        type: "post",
        dataType: 'json',
        data:{id:id},
        success: function(data) {
        }
    })
}


function get_image(id){ 
    $.ajax({
        url: BASE_URL+"common/get_image",
        type: "post",
        dataType: 'json',
        data:{id:id},
        success: function(data) {
            if(data.res=="success"){
               $('.morn_imgs').html(data.morn_imgs);
               $('.after_imgs').html(data.after_imgs);
               $('.even_imgs').html(data.even_imgs);
            }
        }
    })
}


$("#upload_doc_form").submit(function(e){
    e.preventDefault();
   
    var doc_11=$("#doc_1").val();
    var doc_21=$("#doc_2").val();
    var doc_31=$("#doc_3").val();

    if (doc_11 == "" && doc_21 == "" && doc_31 == "" ) {
        $("#form_resp").css("display","block");
        $("#form_resp").html('<b style="color:red;">No file choosen!</b>');
        $("#form_resp").delay(3000).fadeOut(500);
    }else{
        var formData = new FormData(this);
        var doc_1 = $("#doc_1")[0].files[0];
        var doc_2 = $("#doc_2")[0].files[0];
        var doc_3 = $("#doc_3")[0].files[0];
    
        var id=$("#doc_id").val();

        formData.append('doc_1', doc_1);
        formData.append('doc_2', doc_2);
        formData.append('doc_3', doc_3);
     
        $.ajax({    
            type: "POST", 
            url: BASE_URL + 'sa/upload_doc_form',   
            data: formData, 
            dataType: "JSON",
            cache:false,
            contentType: false,
            processData: false,
     
            success: function (data) {
                if(data.responce=="success"){
                    var id = data.id ;
                    if(id !=""){
                        update_sa_doc(id); 
                    }
                    $("#form_resp").css("display","block");
                    $("#form_resp").html('<b style="color:green;">Uploaded Successfully!</b>');
                    $("#form_resp").delay(3000).fadeOut(500);
                    var explode = function(){
                        window.location.reload();
                    };
                    setTimeout(explode, 3000);
                }else{
                    $("#form_resp").css("display","block");
                    $("#form_resp").html('<b style="color:red;">Upload Has an Error!</b>');
                    $("#form_resp").delay(3000).fadeOut(500);
                }
             
            }
        })
    }

    
})




// final location
function sa_doc_final_location_table(){
    $('#sa_final_location').DataTable({
        // 'dom': 'Bfrtip',
        // 'buttons': ['copy', 'excel', 'pdf', 'print', 'colvis'], 
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post', 
        "bDestroy": true,
  
        'ajax': {
            'url': BASE_URL + 'sa/get_sa_doc_final_locations',
        },
        
        "columns": [
            {
                title: 'S.No',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "state_name" },
            { "data": "city_name" }, 
            { "data": "town_name" },
            { "data": "area" },
            { "data": "c_shopname" },
            { "data": "address" },
            { "data": "time_schedul" },
            {  
                "data": "review_date",  
                "render": function (data) {  
                var date = new Date(data);  
                var month = date.getMonth() + 1;  
                return date.getDate() + "-" +  (month.length > 1 ? month : "0" + month) + "-" + date.getFullYear();  
              }},
            { "data": "img" },
            { "data": "view" },
        ],
        "order": [
            [1, 'asc']
        ]
    });
}

var _validFileExtensions = [".jpg", ".jpeg", ".gif", ".png" ,".doc" ,".docx"];    
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
