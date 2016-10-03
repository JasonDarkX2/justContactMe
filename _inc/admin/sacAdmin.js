
jQuery('document').ready(function(e){ 

var sacForm = e('#sac-options');
        sacForm.submit(function(ex){
        var formdata = sacForm.serialize();
                var formurl =sacForm.attr('action');
                e.ajax({
                type: 'post',
                        url: formurl,
                        data: formdata,
                        success: function(XMLHttpRequest, data, textStatus){
                        notification = XMLHttpRequest;
                               jQuery('#msg').html(notification);
                                },
                        error: function(XMLHttpRequest, textStatus, errorThrown)
                                {
                                     notification = XMLHttpRequest;
                               jQuery('#msg').html(notification);
                                        }
                        });
                        ex.preventDefault();
                        });
});
