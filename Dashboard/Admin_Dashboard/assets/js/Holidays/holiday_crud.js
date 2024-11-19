$(document).ready(function () {
    $("#holidayForm").on("submit", function (e) {
      e.preventDefault();
  
      var formData = {
        holiday_id: $("#holiday_id").val(),
        holiday_date: $("#holiday_date").val(),
        reason: $("#reason").val(),
        edit_mode: $("#edit_mode").val(),
      };
  
      var url =
        formData.edit_mode === "edit"
          ? "../php/Holidays/update_holiday.php"
          : "../php/Holidays/insert_holiday.php";
  
      $.ajax({
        type: "POST",
        url: url,
        data: formData,
        dataType: "json",
        success: function (response) {
          if (response.status === "success") {
            alert(response.message);
            window.location.reload();
            $("#holidayForm")[0].reset();
            $("#submit_button").val("Add Holiday");
            $("#edit_mode").val("add");
            $("#holiday_id").val("");
          } else {
            alert("Error: " + response.message);
          }
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error Status:", status);
          console.error("AJAX Error:", error);
          alert("An error occurred while submitting the holiday form.");
        },
      });
    });
  });

  document.addEventListener("DOMContentLoaded", function () {
    fetchHolidays();
  });
  
  function fetchHolidays() {
    fetch("../php/Holidays/fetch_holiday.php")
      .then((response) => response.json())
      .then((data) => {
        const holidayList = document.querySelector("#holidayList"); 
        holidayList.innerHTML = ""; 
        data.forEach((holiday) => {
          const holidayHTML = `
            <li class="list-group-item">
              <div class="row g-0 align-items-center">
                <div class="col-xxl-9 me-2">
                  <h6 class="text-info mb-0">${new Date(
                    holiday.holiday_date
                  ).toLocaleDateString("en-US", {
                    month: "short",
                    day: "numeric",
                  })}</h6>
                  <small>${holiday.reason}</small>
                </div>
                <div class="col">
                  <a class="holiday_action" href="#" onclick="editHoliday(${holiday.holiday_id})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-edit text-warning" style="font-size: 27px;">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                      <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                      <path d="M16 5l3 3"></path>
                    </svg>
                  </a>
                  <a class="holiday_action" href="#" onclick="deleteHoliday(${holiday.holiday_id})">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor" class="text-danger" style="font-size: 29px;">
                      <path d="M0 0h24v24H0V0z" fill="none"></path>
                      <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"></path>
                    </svg>
                  </a>
                </div>
              </div>
            </li>
          `;
          holidayList.innerHTML += holidayHTML;
        });
      })
      .catch((error) => console.error("Error fetching holidays:", error));
  }

  window.editHoliday = function (holidayId) {
    console.log("Editing holiday with ID:", holidayId);

    $.ajax({
        url: "../php/Holidays/get_holiday_data.php", 
        method: "GET",
        data: { holiday_id: holidayId },
        dataType: "json",
        success: function (response) {
            if (response.status === 'success') {
                $('#holiday_id').val(response.data.holiday_id);
                $('#holiday_date').val(response.data.holiday_date);
                $('#reason').val(response.data.reason); 
                
                
                $('#edit_mode').val('edit');
                $('#submit_button_holiday').val('Update Holiday');
                $('#form_heading_holiday').text('Edit Holiday');

               
                $('#holidayForm').show();

              
                $("#HolidayDropdownButton").dropdown('toggle');
                $('#HolidayDropdownButton').next('.dropdown-menu').addClass('show');
            } else {
                alert("Error: " + response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error fetching holiday data:", error);
            alert("An error occurred while fetching holiday data for editing.");
        }
    });
};

window.deleteHoliday = function (holidayId) {
    console.log("Deleting holiday with ID:", holidayId);
  
    if (confirm("Are you sure you want to delete this holiday?")) {
      $.ajax({
        url: "../php/Holidays/delete_holiday.php",  
        method: "POST",
        data: { holiday_id: holidayId },
        dataType: "json",
        success: function (response) {
          console.log("Delete response:", response);
          if (response.status === "success") {
            alert(response.message);
            fetchHolidays();  
          } else {
            alert(response.message);
          }
        },
        error: function (xhr, status, error) {
          console.log("AJAX Error:", status, error);
          alert("An error occurred while trying to delete the holiday.");
        },
      });
    }
  };
  

  