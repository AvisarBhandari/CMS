function conform_password() {
swal({
    title: "Enter your password",
    content: {
        element: "input",
        attributes: {
            placeholder: "Type your password",
            type: "password",
        },
    },
    buttons: {
        cancel: "Cancel",
        confirm: "Submit"
    }
}).then((password) => {
    if (password) {
        console.log(password);
        // Get the other data (username, phone_no, and address)
        var username = document.getElementById("username").value;
        var phone_no = document.getElementById("phone_no").value;
        var address = document.getElementById("address").value;

        // Create a new XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/profile/verify_password.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (xhr.status == 200) {
                var response = xhr.responseText;
                if (response == "success") {
                    // Handle the success response here (stay on the page)
                    swal("Success", "Password verified, proceed with updating your profile.", "success");

                    // Send additional data to another endpoint or use it as needed
                    var data = {
                        username: username,
                        phone_no: phone_no,
                        address: address
                    };

                    // You can send additional data to another endpoint or use it locally here
                    // Example: Send to a profile update endpoint
                    var xhrUpdate = new XMLHttpRequest();
                    xhrUpdate.open("POST", "../php/profile/update.php", true);
                    xhrUpdate.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhrUpdate.onload = function() {
    if (xhrUpdate.status == 200) {
        var updateResponse = JSON.parse(xhrUpdate.responseText); // Parse the response
        if (updateResponse.status === "success") {
            swal("Profile Updated", "Your profile has been successfully updated!", "success");
        } else {
            swal("Error", "There was an issue updating your profile.", "error");
        }
    }
};


                    // Send the username, phone number, and address to update profile
                    xhrUpdate.send("username=" + encodeURIComponent(username) +
                                   "&phone_no=" + encodeURIComponent(phone_no) +
                                   "&address=" + encodeURIComponent(address));
                } else {
                    console.log(response);
                    swal("Error", "Incorrect password!", "error");
                }
            }
        };

        // Send the password (with additional data sent in the next step if needed)
        xhr.send("password=" + encodeURIComponent(password));
    }
});
}