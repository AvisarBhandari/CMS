$(document).ready(function () {
  $("#facultyForm").on("submit", function (e) {
    e.preventDefault();
    var formData = {
      department: $("#department").val(),
      faculty_id: $("#faculty_id").val(),
      faculty_name: $("#faculty_name").val(),
      position: $("#position").val(),
      address: $("#address").val(),
      dob: $("#dob").val(),
      start_date: $("#start_date").val(),
      salary: $("#salary").val(),
      phone_number: $("#phone_number").val(),
      status: $("#status").val(),
      edit_mode: $("#edit_mode").val(),
      faculty_id_hidden: $("#faculty_id_hidden").val(),
    };
    console.log("DOB: " + $("#dob").val());

    console.log("Form data to be sent:", formData);

    var url =
      $("#edit_mode").val() === "edit"
        ? "../php/update_faculty.php"
        : "../php/insert_faculty_member.php";

    console.log("Request URL:", url);

    $.ajax({
      type: "POST",
      url: url,
      data: formData,
      dataType: "json",
      success: function (response) {
        console.log("Response received:", response);

        try {
          if (typeof response === "string") {
            response = JSON.parse(response);
          }

          if (response.status === "success") {
            var message =
              $("#edit_mode").val() === "edit"
                ? "Faculty updated successfully!"
                : "Faculty added successfully!";
            alert(message);
            window.location.reload();
            $("#facultyForm")[0].reset();
            $("#submit_button").val("Add Faculty");
            $("#faculty_id_hidden").val("");
            $("#edit_mode").val("add");
            $("#facultyForm").show();
            fetchFaculty();
          } else {
            alert("Error: " + response.message);
          }
        } catch (error) {
          console.error("Error parsing response:", error);
          alert("An error occurred while processing the response.");
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error Status:", status);
        console.error("AJAX Error:", error);
        console.error("Response Text:", xhr.responseText);
        alert("An error occurred while submitting the form.");
      },
    });
  });
});

// Function to fetch and display faculty data in the table
function fetchFaculty(searchQuery = "") {
  console.log("Fetching faculty data with searchQuery:", searchQuery);

  $.ajax({
    url: "../php/fetch_faculty_data_display.php",
    method: "GET",
    data: { searchQuery: searchQuery },
    dataType: "json",
    success: function (response) {
      // Log the type of the response data
      console.log("Type of response:", typeof response);

      if (response.data) {
        // console.log("Type of response.data:", typeof response.data);
        // console.log("Contents of response.data:", response.data);
      }

      if (response.status === "success") {
        let dataHtml = "";
        $.each(response.data, function (index, faculty) {
          // console.log("Faculty data at index " + index + ":", faculty);

          // Construct the HTML for each row of faculty data
          dataHtml += `
                            <tr>
                                <td>${faculty.department || "N/A"}</td>
                                <td>${faculty.faculty_id || "N/A"}</td>
                                <td>${faculty.faculty_name || "N/A"}</td>
                                <td>${faculty.position || "N/A"}</td>
                                <td>${faculty.address || "N/A"}</td>
                                <td>${faculty.dob || "N/A"}</td>
                                <td>${faculty.start_date || "N/A"}</td>
                                <td>${faculty.salary || "N/A"}</td>
                                <td>${faculty.phone_number || "N/A"}</td>
                                <td>${faculty.status || "N/A"}</td>
                                <td>
                                    <a href="#" onclick="editFaculty('${
                                      faculty.faculty_id
                                    }')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-edit text-warning" style="font-size: 27px;">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                    </a>
                                    <a href="#" onclick="deleteFaculty('${
                                      faculty.faculty_id
                                    }')">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor" class="text-danger" style="font-size: 29px;">
                                            <path d="M0 0h24v24H0V0z" fill="none"></path>
                                            <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        `;
        });

        $("#faculty_table_body").html(dataHtml); // Insert the rows into the table body
      } else {
        $("#faculty_table_body").html(
          '<tr><td colspan="11" class="text-center">No faculty found.</td></tr>'
        );
        alert(
          response.message || "An error occurred while fetching faculty data."
        );
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching data:", status, error);
      alert("An error occurred while fetching faculty data.");
    },
  });
}

fetchFaculty();

window.deleteFaculty = function (facultyId) {
  console.log("Deleting faculty with ID:", facultyId);

  if (confirm("Are you sure you want to delete this faculty member?")) {
    $.ajax({
      url: "../php/delete_faculty_member.php",
      method: "POST",
      data: { faculty_id: facultyId },
      dataType: "json",
      success: function (response) {
        console.log("Delete response:", response);
        if (response.status === "success") {
          alert(response.message);
          fetchFaculty();
        } else {
          alert(response.message);
        }
      },
      error: function (xhr, status, error) {
        console.log("AJAX Error:", status, error);
        alert("An error occurred while trying to delete the data.");
      },
    });
  }
};

window.editFaculty = function (facultyId) {
  console.log("Editing faculty with ID:", facultyId);
  if (event) {
    event.preventDefault();
  }

  $.ajax({
    url: "../php/get_faculty_data.php",
    method: "GET",
    data: { faculty_id: facultyId },
    dataType: "json",
    success: function (response) {
      console.log("Fetched faculty data:", response);

      if (response.status === "success") {
        $("#department").val(response.data.department);
        $("#faculty_id").val(response.data.faculty_id);
        $("#faculty_name").val(response.data.faculty_name);
        $("#position").val(response.data.position);
        $("#address").val(response.data.address);
        $("#dob").val(response.data.dob);
        $("#start_date").val(response.data.start_date);
        $("#salary").val(response.data.salary);
        $("#phone_number").val(response.data.phone_number);
        $("#status").val(response.data.status);

        console.log("Faculty data populated for editing");

        $("#faculty_id_hidden").val(response.data.faculty_id);
        $("#submit_button").val("Update Faculty");
        $("#edit_mode").val("edit");

        $("#editModal").modal("show");

        $("#dropdownbtn").text("Update Faculty");

        $("#facultyForm").css({
          position: "relative",
          width: "auto",
          left: "40px",
          transition: "left 0.3s ease",
        });

        $("#dropdownbtn").parent().addClass("show");
        $("#facultyForm").show();
      } else {
        alert("Error fetching faculty data for editing.");
      }
    },
    error: function (xhr, status, error) {
      console.log("Error fetching faculty data:", error);
      alert("An error occurred while fetching data for editing.");
    },
  });
};
