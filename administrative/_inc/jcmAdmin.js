var changes=false;
var saved=false;
jQuery('document').ready(function(e){
    if(typeof(localStorage['currentTab']) != "undefined"){
        var panel=localStorage['currentTab'];
jQuery('.active').removeClass("active");
                        jQuery(panel.replace("Settings","")).addClass("active"); 
                        jQuery('.panelSection').each(function(){
                            jQuery(this).hide();
                        });
                         jQuery(panel).show();
        jQuery(panel).find('form').attr('id','activeForm');

    }
 jQuery('input,textarea').change(function() {
    changes=true;
    jQuery('#msg').html('<span class="error blink">You have unsaved changes</span>');
});
    jQuery('input,textarea').on("change",function() {
        changes=true;
        jQuery(form).closest('#msg').html('<span class="error blink">You have unsaved changes</span>');
    });
jQuery("[name=reCaptchaEnabled]").change(function(){
    if(this.checked){
jQuery("[name=siteKey]").prop('disabled', false);
   jQuery("[name=secretKey]").prop('disabled', false);
   jQuery('#recatphaConfig input').prop('disabled', false);
    }else{
        jQuery("[name=siteKey]").prop('disabled', true);
        jQuery("[name=secretKey]").prop('disabled', true);
        jQuery('#recatphaConfig input[type=radio]').prop('disabled', true);
    }
});

    jQuery(".sbuttons input").attr("disabled",true);
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
    jQuery(".TagClick").click(function(ex){

    var body= jQuery('#msgBody');
    var pos= body[0].selectionStart;
    var textArea= body.val();
            body.val(
                            textArea.substring(0, pos)+
                             jQuery(this).html() +
                             textArea.substring(pos)
                                    );
});
                        jQuery("#testMail, #AttachmentTest").click(function(ex){  
                            ex.preventDefault();
                          //send
                      jQuery.get(jQuery(this).attr('href'),function(data,status){
                            jQuery('#msg').html(data);
                       });
                           
                    });
    jQuery(".actionLink").click(function(ex){
        ex.preventDefault();
        var element= " #"+jQuery(this).parent().children(":first").attr('id');
        var reloadThis= element + " > *";
        //send
        jQuery.get(jQuery(this).attr('href'),function(data,status){
            jQuery('#msg').html(data);
            jQuery(element).load(reloadThis);

        });

    });
    jQuery(".actionLinkSelect").click(function(ex){
        ex.preventDefault();
        var element= " #"+jQuery(this).parent().find('select').attr('id');
        var reloadThis= element + " > *";
        //send
        jQuery.get(jQuery(this).attr('href'),function(data,status){
            jQuery('#msg').html(data);
            jQuery(element).load(reloadThis);

        });

    });

    jQuery('.tabLinks').click(function(ex){
                        ex.preventDefault();  
                        if(changes==true && saved==false){
                        jQuery('#msg').html('<span class="error blink">You have unsaved changes</span>');
                        }else{ 
                            saved=false;
                        var panel= '#' + jQuery(this).attr('id') + 'Settings';
                        jQuery('.active').removeClass("active");
                        jQuery(this).addClass("active");
                        jQuery('#activeForm').removeAttr('id');
                      jQuery('.panelSection').each(function(){
                            jQuery(this).hide();
                        });
                        localStorage['currentTab'] =panel;
                        jQuery(panel).show();
                        jQuery(panel).find('form').attr('id','activeForm');
                          jQuery('#msg').html('');
                    }
                    });
                    //log controls
jQuery("#logLeftBtn").click(function () {
    var selectedItem = jQuery(' #blackListedLog option:selected');
    jQuery('#whiteListedLog').append(selectedItem);
});
jQuery("#logRightBtn").click(function () {
    var selectedItem = jQuery(' #whiteListedLog option:selected');
    jQuery('#blackListedLog').append(selectedItem);
});

    jQuery(".blackListDomain").click(function () {
        var element= " #"+jQuery(this).parent().find('select').attr('id');
        var selectInput= element + " option:selected";
        var selectedItem = jQuery(selectInput);
        var domain=selectedItem.text().match(/(?<=@)[a-z0-9]*.[a-z]*/);

        if(jQuery('#blackListedDomainLog option[value="' + domain + '"]').length ==0) {
            var newItem = jQuery('<option></option>');
            newItem.text(domain);
            newItem.attr('value', domain)
            jQuery('#blackListedDomainLog').append(newItem);
        }else{
            alert('The selected domain is already Blacklisted');
        }
    });

    jQuery(".removeEntry").click(function(){
        var entry=jQuery(this).parent('div').find(':selected');
        entry.remove();
    });



    jQuery(document).on('submit', '[id^="activeForm"]', function(e){
        e.preventDefault();
        jQuery('#whiteListedLog option').prop('selected', true);
        jQuery('#blackListedLog option').prop('selected', true);
        jQuery('#blackListedDomainLog option').prop('selected', true);
        jQuery.ajax({
            type: 'post',
            url: jQuery(this).attr('action'),
            data:  jQuery(this).serialize(),
            success: function(data){
                notification = data;
                jQuery('#msg').html(notification);
                saved=true;
                changes=false;
                jQuery('#whiteListedLog option').prop('selected', false);
                jQuery('#blackListedLog option').prop('selected', false);
            },
            error: function(data)
            {
                notification =data;
                jQuery('#msg').html(notification);
            }
        });
    });

});

