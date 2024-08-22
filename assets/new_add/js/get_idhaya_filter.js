$("#rsm").change(function(){
    var rsm=$("#rsm").val();
    $.ajax({  
        type: "POST",
        url: BASE_URL + 'common/get_bdm_b_b',  
        data: {'rsm':rsm,}, 
        dataType: "JSON",

        success: function (data) {

            var options = '';
			options +='<option value="">Choose BDM...</option>';
			for (var i = 0; i < data["bdm"].length; i++) {
                options += '<option value="' + data["bdm"][i].BDM_name + '">' + data["bdm"][i].BDM_name + '</option>';
			}
			$("#bdm").html(options);

        }
    })

})

