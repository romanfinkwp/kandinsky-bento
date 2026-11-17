jQuery(document).ready(function($) {
    $('#kandinskybento-notice .notice-dismiss').on('click', function() {
        $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                action: 'kandinskybento_dismiss_notice',
                nonce: window.kandinskybentoNotice ? window.kandinskybentoNotice.nonce : ''
            }
        });
    });
});