$(document).ready(function() {
    $('#currentYear').text(new Date().getFullYear());

    function submitForm($form) {
        var $submitButton = $form.find('button[type="submit"]');
        $submitButton.prop('disabled', true);
        $submitButton.text('Sending...');

        var formData = $form.serialize();

        $.ajax({
            type: 'POST',
            url: '/wp-content/themes/inner-works-theme/mail/send.php',
            data: formData,
            success: function(response) {
                if (response === '1') {
                    $submitButton.text('Sent!');
                    $form[0].reset();
                } else {
                    $submitButton.text(response);
                }
                $submitButton.prop('disabled', false);
            },
            error: function() {
                $submitButton.text('Error. Try again later.');
                $submitButton.prop('disabled', false);
            }
        });

        return false;
    }

    $('form').submit(function() {
        return submitForm($(this));
    });
});