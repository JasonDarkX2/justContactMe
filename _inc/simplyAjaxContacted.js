 jQuery(document).ready(function($) {
        jQuery('#contactForm').validate({
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
            },
           mailAttachment:{
              required: false,
              extension: controller.extensions,
            },
 
        },
        messages: {
            cname: "Please enter in your name.",
            email: "Please enter a valid email address.",
             subject: "Please enter a subject.",
            message: "Please enter something here",
            mailAttachment: "invalid file type",
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
            element.attr("placeholder", error.text())
        },
        submitHandler: function(form) {
              e.ajax({
                type: 'post',
                        url: e(form).attr('action'),
                        data: e(form).serialize(),
                        success: function(data){
                            jQuery('#success').html(response);
                        }
        });
    }
    });
});
 jQuery('#sacAttachment').click(function(){
jQuery('#file').click();
 });
function ChangeText(fileInput, targetId) {
       jQuery(targetId).attr('value', fileInput.value);
  if(! jQuery(targetId).valid()){
      jQuery(targetId).attr('value', '');
  }
  if(fileInput.files[0].size>=controller.sizeLimit){
     jQuery(targetId).attr('value', '');
     jQuery(targetId).attr('placeholder', 'File was too big');
  }
}