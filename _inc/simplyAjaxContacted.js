 jQuery(document).ready(function($) {
    jQuery('#msg').validate({
        rules: {
            cname: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
             subject: {
                required: true,
                minlength: 2
            },
            message: {
                required: true,
                minlength: 1
            }
        },
       
        messages: {
            cname: "Please enter in your name.",
            email: "Please enter a valid email address.",
             subject: "Please enter a subject.",
            message: "Please enter something here"
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
            element.attr("placeholder", error.text())
        }
    })
    jQuery('#contactForm').submit(function(e){
        e.preventDefault();
        jQuery.post( controller.emailController,jQuery("#msg").serialize(),function(response){
jQuery('#success').html(response);
});
    });
});
 jQuery('#sacAttachment').click(function(){
jQuery('#file').click();
 });
function ChangeText(FileInput, TargetID) {

    document.getElementById(TargetID).value = FileInput.value;
}