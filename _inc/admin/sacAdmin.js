
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
    },
         errorElement: "span",
          errorPlacement: function(error, element) {
            error.insertAfter(element);
            element.addClass('errorUI');
        }
         
});
var sacForm = e('#sac-options');
        sacForm.submit(function(ex){
        var formdata = sacForm.serialize();
                var formurl =sacForm.attr('action');
                e.ajax({
                type: 'post',
                        url: formurl,
                        data: formdata,
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
                        ex.preventDefault();
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
