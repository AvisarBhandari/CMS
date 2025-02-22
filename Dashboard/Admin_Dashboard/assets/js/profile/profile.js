console.log("profile.js loaded");
$(document).ready(function() {
    // Send AJAX request to fetch user data
    $.ajax({
        url: '../php/profile/profile.php',  // Adjusted path to profile.php
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Check if response is not empty and contains data
            console.log(response);
            if (response && !response.error) {
                // Inject the data into the profile card
                $('.status_profile').html(`
                                            <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold"><strong>Basic Information</strong></p>
                        </div>

                        <div class="card-body">
                            <div class="row" style="padding-bottom: 9px;">
                                <div class="col-md-6 col-xxl-5"><strong class="text-primary-emphasis">Full Name:</strong></div>
                                <div class="col"><strong class="text-primary-emphasis" id="user-name">${response.name || 'N/A'}</strong></div>
                            </div>
                            <div class="row" style="padding-bottom: 9px;">
                                <div class="col-md-6 col-xxl-5"><strong class="text-primary-emphasis">Role:</strong></div>
                                <div class="col"><strong class="text-primary-emphasis" id="user-role">${response.role || 'N/A'}</strong></div>
                            </div>
                            <div class="row" style="padding-bottom: 9px;">
                                <div class="col-md-6 col-xxl-5"><strong class="text-primary-emphasis">Phone NO.:</strong></div>
                                <div class="col"><strong class="text-primary-emphasis" id="user-phone">${response.phone_number || 'N/A'}</strong></div>
                            </div>
                            <div class="row" style="padding-bottom: 9px;">
                                <div class="col-md-6 col-xxl-5"><strong class="text-primary-emphasis">D.O.B:</strong></div>
                                <div class="col"><strong class="text-primary-emphasis" id="user-dob">${response.dob || 'N/A'}</strong></div>
                            </div>
                            
                        </div>
                `);

                
                                
            } else {
                // Handle error response if no data found
                $('.status_profile').html(`<p>Error fetching data.</p>`);
                $('.placeholder_profile').html(`<p>Error fetching data.</p>`);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error: " + error);
            $('.status_profile').html(`<p>Failed to load profile data.</p>`);
            $('.placeholder_profile').html(`<p>Failed to load profile data.</p>`);
        }
    });
});
