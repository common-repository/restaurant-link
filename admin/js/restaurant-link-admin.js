jQuery(function () {
    var removeLink = '<a class="remove" href="#" onclick="jQuery(this).parent().slideUp(function(){ jQuery(this).remove() }); return false"><span class="dashicons dashicons-minus"></span></a>';

    jQuery('a.add').relCopy({append: removeLink});
});

jQuery(function () {
    var table_count = 1;
    jQuery('.rest-link-content a.add').click(function () {

        table_count = table_count + 1;

        jQuery('.rest-link-content .count:last').text(table_count);
    })
});

jQuery(function () {

    jQuery('a.show-block-elemnt').click(function () {
        jQuery('div.hide-block-elemnt').show();
        jQuery('a.show-block-elemnt').hide();

    })
});


/*======-Modal Box-========*/

jQuery(function () {

    jQuery(".rest-link-modal-open").on("click", function () {
        jQuery("#rest-link-modal-" + jQuery(this).attr('data-target')).show();
    });

    jQuery(".rest-link-modal-close").on("click", function () {
        jQuery(".rest-link-modal-container").hide();
    });

});


/*==========-Remove table BO-===========*/

jQuery(function () {
    jQuery('.rest-link-jq-remove-table').on('click', function () {
        if (!confirm(jQuery(this).attr("data-message") + ' ' + jQuery(this).attr("datafld"))) return false;
        else {
            jQuery(this).prev("input").val("");
            jQuery(this).prev().hide();
            jQuery("label#" + jQuery(this).attr("datafld")).hide();
            jQuery(this).hide();
        }
    });
});


/*==========-Check validet date-===========*/

jQuery(function () {

    jQuery('select#open_time_midday').change(function () {
        jQuery(this).css('border', '1px solid #7e8993');
        jQuery("select#close_time_midday").css('border', '1px solid #7e8993');
        jQuery('.rest-link-content input[type="submit"]').removeAttr('disabled');
        var close_time = jQuery("select#close_time_midday").children("option:selected").val();
        var open_time = jQuery(this).val();
        if (close_time != '00:00') {
            if (open_time > close_time) {
                jQuery(this).css('border', '2px solid #dd0a0a');
                jQuery('.rest-link-content input[type="submit"]').attr('disabled', 'disabled');
                jQuery("#rest-link-error-modal h3").html(jQuery("select#open_time_midday").attr("title"));
                jQuery("#rest-link-error-modal").show();
            }
        }
    });

    jQuery('select#close_time_midday').change(function () {
        jQuery(this).css('border', '1px solid #7e8993');
        jQuery("select#open_time_midday").css('border', '1px solid #7e8993');
        jQuery('.rest-link-content input[type="submit"]').removeAttr('disabled');
        var open_time = jQuery("select#open_time_midday").children("option:selected").val();
        var close_time = jQuery(this).val();
        if (open_time != '00:00') {
            if (open_time > close_time) {
                jQuery(this).css('border', '2px solid #dd0a0a');
                jQuery('.rest-link-content input[type="submit"]').attr('disabled', 'disabled');
                jQuery("#rest-link-error-modal h3").html(jQuery("select#close_time_midday").attr("title"));
                jQuery("#rest-link-error-modal").show();
            }
        }
    });

    jQuery('select#open_time_evening').change(function () {
        jQuery(this).css('border', '1px solid #7e8993');
        jQuery("select#close_time_evening").css('border', '1px solid #7e8993');
        jQuery('.rest-link-content input[type="submit"]').removeAttr('disabled');
        var close_time = jQuery("select#close_time_evening").children("option:selected").val();
        var open_time = jQuery(this).val();
        if (close_time != '00:00') {
            if (open_time > close_time) {
                jQuery(this).css('border', '2px solid #dd0a0a');
                jQuery('.rest-link-content input[type="submit"]').attr('disabled', 'disabled');
                jQuery("#rest-link-error-modal h3").html(jQuery("select#open_time_evening").attr("title"));
                jQuery("#rest-link-error-modal").show();
            }
        }
    });

    jQuery('select#close_time_evening').change(function () {
        jQuery(this).css('border', '1px solid #7e8993');
        jQuery("select#open_time_evening").css('border', '1px solid #7e8993');
        jQuery('.rest-link-content input[type="submit"]').removeAttr('disabled');
        var open_time = jQuery("select#open_time_evening").children("option:selected").val();
        var close_time = jQuery(this).val();
        if (open_time != '00:00') {
            if (open_time > close_time) {
                jQuery(this).css('border', '2px solid #dd0a0a');
                jQuery('.rest-link-content input[type="submit"]').attr('disabled', 'disabled');
                jQuery("#rest-link-error-modal h3").html(jQuery("select#close_time_evening").attr("title"));
                jQuery("#rest-link-error-modal").show();

            }
        }
    });

    jQuery("form#rest-link-form-settings").on("submit", function () {

        var close_time_midday = jQuery("select#close_time_midday").children("option:selected").val();
        var open_time_midday = jQuery("select#open_time_midday").children("option:selected").val();
        if (open_time_midday > close_time_midday) {
            jQuery("#rest-link-error-modal h3").html(jQuery("select#open_time_midday").attr("title"));
            jQuery("#rest-link-error-modal").show();
            return false;
        }
        var close_time_evening = jQuery("select#close_time_evening").children("option:selected").val();
        var open_time_evening = jQuery("select#open_time_evening").children("option:selected").val();
        if (open_time_evening > close_time_evening) {
            jQuery("#rest-link-error-modal h3").html(jQuery("select#open_time_evening").attr("title"));
            jQuery("#rest-link-error-modal").show();
            return false
        }

    })

});