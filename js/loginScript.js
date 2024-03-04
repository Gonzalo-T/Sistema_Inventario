document.addEventListener('DOMContentLoaded', function() {
        $(document).ready(function() {
            $.ajax({
                url: 'php/error_message.php',
                type: 'GET',
                success: function(response) {
                    if (response) {
                        $('#error-message').text(response);
                    }
                }
            });
        });
    });