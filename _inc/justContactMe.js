/*! justContactMePlugin - v1.xx.xx - 7/15/2019
 * https://jasondarkx2.com/
 * https://github.com/JasonDarkX2/SimplyAJAXContacted
 * Copyright (c) 2019 JasonDarkX2;*/
$(document).ready(function(e) {
     var msg=controller.extensions;
     if(msg){
      msg = controller.extensions.replace(/\|/g,'|.');
         }
        $('#contactForm').validate({
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
              extensions: controller.extensions,
        
            },
 
        },
        messages: {
            cname: "Please enter in your name.",
            email: "Please enter a valid email address.",
             subject: "Please enter a subject.",
            message: "Please enter something here",
            mailAttachment: "Error: only attach ." + msg + " files" ,
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
            element.attr("placeholder", error.text())
        },
        submitHandler: function(form) {
              e.ajax({
                type: 'post',
                        url: controller.emailController,
                        data: e(form).serialize(),
                        success: function(data){
                           $('#success').html(data);
                        },
        });
    }
    });
});
 $('#jcmAttachment').click(function(){
$('#file').click();
 });
function ChangeText(fileInput, targetId) {
       $(targetId).attr('value', fileInput.value);
  if(! $(targetId).valid()){
      $(targetId).attr('value', '');
  }
  if(fileInput.files[0].size>=controller.sizeLimit){
     $(targetId).attr('value', '');
     var limit= (controller.sizeLimit / (1024*1024));
     $(targetId).addClass('error');
     $(targetId).attr('placeholder', 'Error: The file was larger than '+ limit + 'MB');
  }
}