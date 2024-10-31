jQuery(document).ready(function(){
    var val = jQuery('input[type=radio][name=insta_option]:checked').val();
    if (val == 'carousel') {
        jQuery(".carousel").show();
        jQuery(".gallery").hide();
        jQuery(".masonry").hide();
    }
    if (val == 'masonry') {
        jQuery(".carousel").hide();
        jQuery(".gallery").hide();
        jQuery(".masonry").show();
    }
    if (val == 'gallery') {
        jQuery(".gallery").show();
        jQuery(".carousel").hide();
        jQuery(".masonry").hide();
    }
  


    jQuery('body').on('change', '.insta_option', function () {
        if (this.value == 'gallery') {
            jQuery(".gallery").show();
            jQuery(".carousel").hide();
            jQuery(".masonry").hide();
        }else if (this.value == 'carousel') {
            jQuery(".carousel").show();
            jQuery(".gallery").hide();
            jQuery(".masonry").hide();
        }else if(this.value == 'masonry') {
            jQuery(".carousel").hide();
            jQuery(".gallery").hide();
            jQuery(".masonry").show();
        }
    });


    jQuery('ul.tabs li').click(function(){
        var tab_id = jQuery(this).attr('data-tab');
        jQuery('ul.tabs li').removeClass('current');
        jQuery('.tab-content').removeClass('current');
        jQuery(this).addClass('current');
        jQuery("#"+tab_id).addClass('current');
    });



    jQuery(".galtem").change(function(){
        var template = jQuery(this).children("option:selected").val();
        if(template == "galtem2"){
            jQuery(".space_betwwen").hide();
            
        }else{
            jQuery(".space_betwwen").show();
        }

    });
});



function ocinsta_select_data() {
    var copyText = document.getElementById("ocinsta-selectdata");
    copyText.select();
    document.execCommand("copy");
}
