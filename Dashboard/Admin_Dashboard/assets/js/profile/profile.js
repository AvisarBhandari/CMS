$(document).ready(function() {
    // Send AJAX request to fetch user data
    $.ajax({
        url: '../php/profile/profile.php',  // Adjusted path to profile.php
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Check if response is not empty and contains data
            if (response && !response.error) {
                // Inject the data into the profile card
                $('.status').html(`
                    <div class="row" style="padding-bottom: 9px;">
                        <div class="col-md-6 col-xxl-5"><strong class="text-primary-emphasis">Full Name:</strong></div>
                        <div class="col"><strong class="text-primary-emphasis">${response.name || 'N/A'}</strong></div>
                    </div>
                    <div class="row" style="padding-bottom: 9px;">
                        <div class="col-md-6 col-xxl-5"><strong class="text-primary-emphasis">Role:</strong></div>
                        <div class="col"><strong class="text-primary-emphasis">${response.role || 'N/A'}</strong></div>
                    </div>
                    <div class="row" style="padding-bottom: 9px;">
                        <div class="col-md-6 col-xxl-5"><strong class="text-primary-emphasis">Phone NO.:</strong></div>
                        <div class="col"><strong class="text-primary-emphasis">${response.phone_number || 'N/A'}</strong></div>
                    </div>
                    <div class="row" style="padding-bottom: 9px;">
                        <div class="col-md-6 col-xxl-5"><strong class="text-primary-emphasis">D.O.B:</strong></div>
                        <div class="col"><strong class="text-primary-emphasis">${response.dob || 'N/A'}</strong></div>
                    </div>
                    <div class="row" style="padding-bottom: 9px;">
                        <div class="col-md-6 col-xxl-5"><strong class="text-primary-emphasis">Gender:</strong></div>
                        <div class="col"><strong class="text-primary-emphasis">${response.gender || 'N/A'}</strong></div>
                    </div>
                `);
                
                                
            } else {
                // Handle error response if no data found
                $('.card-body').html(`<p>Error fetching data.</p>`);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error: " + error);
            $('.card-body').html(`<p>Failed to load profile data.</p>`);
        }
    });
});
