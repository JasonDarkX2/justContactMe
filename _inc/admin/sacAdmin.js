
jQuery('document').ready(function(e){ 

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
