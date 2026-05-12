"use strict";

$(".pwstrength").pwstrength();

// Handle register form submission
$(document).ready(function() {
    const $form = $('form');
    const $submitBtn = $form.find('button[type="submit"]');
    const originalBtnText = $submitBtn.html();

    $form.on('submit', function(e) {
        // Disable button and show loading state
        $submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');
    });
});