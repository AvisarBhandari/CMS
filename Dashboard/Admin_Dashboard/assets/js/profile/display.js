  function fetchImage() {
            // The ID and Role of the image you want to retrieve (use your dynamic values here)

            // AJAX request to get the image from the server
            $.ajax({
                url: '../php/image/display.php', // Path to the PHP file that retrieves the image
                success: function(response) {
                    // Parse the JSON response from the server
                    const data = JSON.parse(response);

                    // If an image is returned
                    if (data.image) {
                        // Store the base64-encoded image string in a JS variable
                        const img = data.image;

                        // Display the image in an HTML <img> tag
                        $('#display-image').html('<img src="' + img + '" alt="Image" />');
                    } else {
                        // If no image is found, show the message
                        $('#message').text(data.message);
                    }
                },
                error: function() {
                    // Handle errors
                    $('#message').text('An error occurred while retrieving the image.');
                }
            });
        }

        // Call the function to fetch the image when the page loads
        $(document).ready(function() {
            fetchImage();
        });