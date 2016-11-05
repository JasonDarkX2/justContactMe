
jQuery('document').ready(function(e){ 
jQuery('#sac-options').validate({
         rules: {
            toAddress: {
                required: true,
                email: true
            },
            fromAddress: {
                required: true,
                email: true
            },
        },
        messages: {
            toAddress: "Please enter a valid  To Adress.",
            fromAddress: "Please enter a valid from address.",
        },
            highlight: function(element, errorClass) {
        jQuery(element).removeClass(errorClass);
        jQuery(element).addClass('errorUI');
        
    },sucess: function(element){
        jQuery(element).removeClass('errorUI');
    },
    unhighlight: function(element) {
         jQuery(element).removeClass('errorUI');
    },
         errorElement: "span",
          errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
         submitHandler: function(form) {
                e.ajax({
                type: 'post',
                        url: e(form).attr('action'),
                        data: e(form).serialize(),
                        success: function(data){
                        notification = data;
                               jQuery('#msg').html(notification);
                                },
                        error: function(data)
                                {
                                     notification =data;
                               jQuery('#msg').html(notification);
                                        }
                        });
                    }
                    });
                        jQuery("#testMail").click(function(ex){   
                            ex.preventDefault();
                      jQuery.post(jQuery(this).attr('href'),
                      {
                          sendTest: 'true'
                      },
                      function(data,status){
           jQuery('#msg').html(data);
        });
                           
                    });
         
});
