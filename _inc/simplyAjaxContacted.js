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
            message: "cool story, Please enter something here o.O"
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
            element.attr("placeholder", error.text())
        }
    })
    jQuery('#contactForm').submit(function(e){
        e.preventDefault();
        jQuery.post( controller.emailController,jQuery("#msg").serialize(),function(response){
if(response==="sent"){
jQuery('#success').html("Message Sent!");
jQuery('#success').prop('class','sucessmsg');
}
else{
jQuery('#success').html("Invalid E-Mail address,Please enter a valid E-mail");
jQuery('#success').prop('class','failedmsg');
}
});
    });
});


