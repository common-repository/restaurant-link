jQuery(document).ready(function () {

    var personne = 0;

    personne = jQuery('select[name="resrv_person"] option:selected').val();

    reload_table(personne);

    jQuery('select[name="resrv_person"]').on('change', function () {

        personne = this.value;

        reload_table(personne);

    });

    jQuery('#rest_link_resv').submit(function () {
        if (jQuery('select[name="resrv_table"]').find(':selected').prop('disabled')) {
            jQuery('select[name="resrv_table"]').css('border-color', '#C80000');
            jQuery([document.documentElement, document.body]).animate({
                scrollTop: jQuery('select[name="resrv_person"]').offset().top - 150
            }, 2000);
            return false;
        }
    })
});

function reload_table(personne) {

    var minPersonne = 0;
    var maxPersonne = 0;


    jQuery('select[name="resrv_table"] option').each(function () {

        minPersonne = jQuery(this).data("min");
        maxPersonne = jQuery(this).data("max");

        if ((personne <= maxPersonne) && (personne >= minPersonne)) {
            this.disabled = false;
            jQuery(this).css('color', 'initial');

        } else {
            this.disabled = true;
            jQuery(this).css('color', 'red');
        }
        if (maxPersonne === undefined) {
            this.disabled = false;
            jQuery(this).css('color', 'initial');
        }

    });
}