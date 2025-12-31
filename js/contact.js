function submitForm() {
    $.ajax({
        type: 'POST',
        url: 'contact.php',
        data: $('#contactForm').serialize(),
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                $('#errorMessage').hide();
                $('#successMessage').show().text('Form submitted successfully.');

                $('#contactForm')[0].reset();
                setTimeout(() => $('#successMessage').fadeOut('slow'), 5000);
            } else {
                $('#successMessage').hide();
                $('#errorMessage').show().text(response.message || 'An error occurred!');
            }
        },
        error: function() {
            // In case of error, hide success message and show default error
            $('#successMessage').hide();
            $('#errorMessage').show().text('An error occurred!');
        }
    });
}