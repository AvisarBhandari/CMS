$(document).ready(function () {
  // Fetch faculty attendance data
  function fetchFacultyAttendance(date) {
    $.ajax({
      url: "../php/Faculty/faculty_status_data.php",
      method: "POST",
      data: { date: date },
      dataType: "json",
      success: function (response) {
        if (response.success) {
          updateAttendanceTable(response.facultyData);
        } else {
          alert(response.message);
        }
      },
      error: function () {
        alert("An error occurred while fetching data.");
      },
    });
  }

  // Update the attendance table with faculty data
  function updateAttendanceTable(facultyData) {
    const attendanceTable = $("#attendanceTable");
    attendanceTable.empty(); // Clear the table before appending new data

    facultyData.forEach(function (faculty) {
      const row = `
                <tr data-faculty="${faculty.faculty_id}">
                    <td>${faculty.faculty_id}</td>
                    <td>${faculty.faculty_name}</td>
                    <td>
                        <select class="form-control attendance-status" data-faculty="${
                          faculty.faculty_id
                        }">
                            <option value="Present" ${
                              faculty.status === "Present" ? "selected" : ""
                            }>Present</option>
                            <option value="Absent" ${
                              faculty.status === "Absent" ? "selected" : ""
                            }>Absent</option>
                        </select>
                    </td>
                </tr>
            `;
      attendanceTable.append(row); // Append the new row to the table
    });
  }

  // Submit attendance data
  function submitAttendance() {
    const attendanceDate = $("#attendance_date").val();
    const attendanceData = {};

    // Collect attendance status for each faculty
    $(".attendance-status").each(function () {
      const facultyId = $(this).data("faculty");
      const status = $(this).val();
      attendanceData[facultyId] = status;
    });

    const postData = {
      attendance_date: attendanceDate,
      attendance: JSON.stringify(attendanceData),
    };

    // Send the data via AJAX
    $.ajax({
      url: "../php/Faculty/mark_attandance.php",
      method: "POST",
      data: postData,
      dataType: "json",
      success: function (response) {
        if (response.status === "error") {
          alert(response.message);
        } else {
          alert(response.message);
          $("#attendanceForm")[0].reset();
          fetchFacultyAttendance(attendanceDate);
        }
      },
      error: function () {
        alert("An error occurred while submitting the attendance.");
      },
    });
  }

  function updateAttendance() {
    const attendanceDate = $("#attendance_date").val();
    const updatedData = {};

    $(".attendance-status").each(function () {
      const facultyId = $(this).data("faculty");
      const status = $(this).val();
      updatedData[facultyId] = status;
    });

    const postData = {
      attendance_date: attendanceDate,
      attendance: JSON.stringify(updatedData),
    };

    $.ajax({
      url: "../php/Faculty/update_attendance.php",
      method: "POST",
      data: postData,
      dataType: "json",
      success: function (response) {
        if (response.status === "error") {
          alert(response.message);
        } else {
          alert(response.message);
          $("#editAttendanceForm")[0].reset();
          fetchFacultyAttendance(attendanceDate);
        }
      },
      error: function () {
        alert("An error occurred while updating the attendance.");
      },
    });
  }

  fetchFacultyAttendance($("#attendance_date").val());

  $("#addAttendance").on("click", function () {
    submitAttendance();
  });

  $("#updateAttendance").on("click", function () {
    updateAttendance();
  });

  $("#attendance_date").on("change", function () {
    fetchFacultyAttendance($(this).val());
  });

  $(document).ready(function () {
   
    $("#editAttendance")
      .off("click")
      .on("click", function () {
        const attendanceDate = $("#attendance_date").val();

       
        if (!attendanceDate) {
          alert("Please select a date first.");
          return;
        }

       
        setTimeout(function () {
          $.ajax({
            url: "../php/Faculty/get_attendance.php",
            method: "POST",
            data: { attendance_date: attendanceDate },
            dataType: "json",
            success: function (response) {
              if (response.status === "success") {
                updateAttendanceTable(response.data);
                $("#updateAttendance").show();
                $("#addAttendance").hide();
              } else {
                alert(response.message);
              }
            },
            error: function () {
              alert("Failed to fetch attendance data. Please try again.");
            },
          });
        }, 500); 
      });
  });
});
