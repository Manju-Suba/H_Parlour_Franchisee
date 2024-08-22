(function($) {  
    "use strict" 

    var form = $("#step-form-horizontal");
    form.children('div').steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        autoFocus: true, 
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex)
        {
            var x = document.getElementById("email").value;
            if(x !=""){
                var mail = document.getElementById('email').value; 
                var email = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
                if (mail.match(email))
                {
                    $("input[name='email']").removeClass('error'); 

                    form.validate().settings.ignore = ":disabled,:hidden";
                    return form.valid();
                }
                else
                {
                    $("input[name='email']").addClass('error'); 
                }
            }else{
                form.validate().settings.ignore = ":disabled,:hidden";
                return form.valid();
            }
        }
    });


    var form2 = $("#step-form-tab");

    form2.children('div').steps({
        headerTag: "h4",
        bodyTag: "section",
        // Disables the finish button (required if pagination is enabled)
        enableFinishButton: false, 
        // Disables the next and previous buttons (optional)
        enablePagination: false, 
        // Enables all steps from the begining
        enableAllSteps: true, 
        // Removes the number from the title
        titleTemplate: "#title#" 
    });

    var form3 = $('#step-form-vertical');
    form3.children('div').steps({
        headerTag: "h4",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        stepsOrientation: "vertical" ,
        // onStepChanging: function (event, currentIndex, newIndex)
        // {
        //     form3.validate().settings.ignore = ":disabled,:hidden";
        //     return form.valid();
        // }
    });


})(jQuery);

