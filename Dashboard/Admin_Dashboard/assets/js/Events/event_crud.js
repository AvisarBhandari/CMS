$(document).ready(function () {
  $("#eventForm").on("submit", function (e) {
    e.preventDefault();

    var formData = {
      event_id: $("#event_id").val(),
      event_name: $("#event_name").val(),
      event_date: $("#event_date").val(),
      event_time: $("#event_time").val(),
      edit_mode: $("#edit_mode").val(),
    };

    var url =
      formData.edit_mode === "edit"
        ? "../php/Events/update_event.php"
        : "../php/Events/insert_event.php";

    $.ajax({
      type: "POST",
      url: url,
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          alert(response.message);
          window.location.reload();
          $("#eventForm")[0].reset();
          $("#submit_button").val("Add Event");
          $("#edit_mode").val("add");
          $("#event_id").val("");
        } else {
          alert("Error: " + response.message);
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error Status:", status);
        console.error("AJAX Error:", error);
        alert("An error occurred while submitting the event form.");
      },
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  fetchEvents();
});

function fetchEvents() {
  fetch("../php/Events/fetch_events.php")
    .then((response) => response.json())
    .then((data) => {
      const listGroup = document.querySelector(".list-group");
      listGroup.innerHTML = "";
      data.forEach((event) => {
        const eventHTML = `
                    <li class="list-group-item">
                        <div class="row g-0 align-items-center">
                            <div class="col-xxl-9 me-2">
                                <h6 class="text-info mb-0">${new Date(
                                  event.event_date
                                ).toLocaleDateString("en-US", {
                                  month: "short",
                                  day: "numeric",
                                })}</h6>
                                <small>${event.event_name}</small>
                            </div>
                            <div class="col">
                                <a class="event_action" href="#" onclick="editEvent(${
                                  event.event_id
                                })">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-edit text-warning" style="font-size: 27px;">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                        <path d="M16 5l3 3"></path>
                                    </svg>
                                </a>
                                <a class="event_action" href="#" onclick="deleteEvent(${
                                  event.event_id
                                })">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor" class="text-danger" style="font-size: 29px;">
                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                        <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <span class="text-xs">${event.event_time}</span>
                    </li>
                `;
        listGroup.innerHTML += eventHTML;
      });
    })
    .catch((error) => console.error("Error fetching events:", error));
}



window.editEvent = function (eventId) {
    console.log("Editing event with ID:", eventId);

    $.ajax({
        url: "../php/Events/get_event_data.php",
        method: "GET",
        data: { event_id: eventId },
        dataType: "json",
        success: function (response) {
            if (response.status === 'success') {
                // Fill the form with the fetched event data
                $('#event_id').val(response.data.event_id);
                $('#event_name').val(response.data.event_name);
                $('#event_date').val(response.data.event_date);
                $('#event_time').val(response.data.event_time);
                $('#edit_mode').val('edit');
                $('#submit_button').val('Update Event');
                $('#form_heading').text('Edit Event');

               
                $('#eventForm').show();

                
                $("#EventdropdDownButton").dropdown('toggle'); 
                $('#EventDropdownButton').next('.dropdown-menu').addClass('show');
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error fetching event data:", error);
            alert("An error occurred while fetching event data for editing.");
        }
    });
};

window.deleteEvent = function (eventId) {
  console.log("Deleting event with ID:", eventId);

  if (confirm("Are you sure you want to delete this event?")) {
    $.ajax({
      url: "../php/Events/delete_events.php",
      method: "POST",
      data: { event_id: eventId },
      dataType: "json",
      success: function (response) {
        console.log("Delete response:", response);
        if (response.status === "success") {
          alert(response.message);
          fetchEvents();
        } else {
          alert(response.message);
        }
      },
      error: function (xhr, status, error) {
        console.log("AJAX Error:", status, error);
        alert("An error occurred while trying to delete the event.");
      },
    });
  }
};
