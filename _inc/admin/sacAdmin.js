
jQuery('document').ready(function(e){ 
       jQuery('input[name=attachment]:radio').change(function(e){
           if(jQuery(this).val()=='true')
jQuery('#attachmentOpt').show();
else{
 jQuery('#attachmentOpt').hide();   
}
});
    jQuery.validator.addMethod("regex", function(value, element, regexpr) {
 if(value.length!==0){
    return regexpr.test(value);
 }else{
     return true;
 }
});
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
            copyAddress:{
                required: false,
                regex: /^[BCbc][cC]*:/
            }
        },
        messages: {
            toAddress: "Please enter a valid  To Address.",
            fromAddress: "Please enter a valid from address.",
            copyAddress: "Please enter proper format eg: Cc: email@domain.com"
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
                        jQuery(".TagClick").click(function(ex){
        ex.preventDefault();
    alert(jQuery(this).html());
    var body= jQuery('#msgBody');
    var pos= body[0].selectionStart;
    var textArea= body.val();
            body.val(
                            textArea.substring(0, pos)+
                             jQuery(this).html() +
                             textArea.substring(pos)
                                    );
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

