
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
         errorElement: "div",
          errorPlacement: function(error, element) {
            element.attr('class','error');
            jQuery('#msg').html(error.text());
            
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
