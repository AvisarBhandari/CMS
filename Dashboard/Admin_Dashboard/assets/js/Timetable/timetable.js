$(document).ready(function () {
  console.log("Document is ready");
  // Load courses
  $.ajax({
    url: "../php/timetable/fetch_courses.php",
    method: "GET",
    dataType: "json",
    success: function (data) {
      data.forEach((course) => {
        $("#course_fetch").append(
          `<option value="${course.course_code}">${course.course_name}</option>`
        );
      });
    },
    error: function () {
      alert("Failed to load courses. Please try again later.");
    },
  });

  // Fetch subjects and initialize the timetable form
  $("#fetchSubjects").click(function () {
    const course = $("#course_fetch").val();
    const semester = $("#semester_fetch").val();
    const day = $("#day").val();
    console.log(day);

    if (!course || !semester || !day) {
      alert("Please select all fields.");
      return;
    }

    // Fetch subjects
    $.ajax({
      url: "../php/timetable/fetch_subjects.php",
      method: "POST",
      dataType: "json",
      data: { course, semester },
      success: function (subjects) {
        $("#subjectsForm").show();
        $("#subjectsContainer").html("");

        subjects.forEach((subject) => {
          $("#subjectsContainer").append(`
                <div class="row mb-2 timetable-entry" data-subject-id="${subject.subject_id}">
                    <div class="col-md-3">
                        <input type="text" class="form-control" value="${subject.subject_name}" readonly>
                        <input type="hidden" name="timetable[${subject.subject_id}][subject_id]" value="${subject.subject_id}">
                    </div>
                    <div class="col-md-2">
                        <input type="time" name="timetable[${subject.subject_id}][start_time]" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <input type="time" name="timetable[${subject.subject_id}][end_time]" class="form-control" required>
                    </div>
                    <div class="col-md-3">
                        <select name="timetable[${subject.subject_id}][faculty_id]" class="form-select" required>
                            <option value="">Loading...</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-warning btn-sm edit-timetable" data-subject-id="${subject.subject_id}">Edit</button>
                    </div>
                </div>
            `);
        });

        // Fetch and populate faculty data for the selected course
        fetchFaculty(course);
      },
      error: function () {
        alert("Failed to load subjects. Please try again later.");
      },
    });
  });

  // Fetch faculty for the selected course
  function fetchFaculty(course) {
    $.ajax({
      url: "../php/timetable/fetch_faculty.php",
      method: "POST",
      dataType: "json",
      data: { course },
      success: function (response) {
        if (response.status === "success" && Array.isArray(response.data)) {
          const facultyOptions = response.data
            .map(
              (member) =>
                `<option value="${member.faculty_id}">${member.faculty_name}</option>`
            )
            .join("");
          $('select[name$="[faculty_id]"]').each(function () {
            $(this).html(
              `<option value="">Select Faculty</option>` + facultyOptions
            );
          });
        } else {
          alert(response.message || "Failed to load faculty data.");
        }
      },
      error: function () {
        alert("Failed to load faculty data. Please try again later.");
      },
    });
  }

  // Save timetable entry
  $("#saveTimetable").click(function () {
    const timetableData = [];
    const course = $("#course_fetch").val();
    const semester = $("#semester_fetch").val();
    const day = $("#day").val();

    // Debugging: Log the selected day
    console.log(day);

    // Collect form data dynamically
    $("#subjectsForm")
      .find(".timetable-entry")
      .each(function () {
        const subject_id = $(this).find('input[name*="[subject_id]"]').val();
        const start_time = $(this).find('input[name*="[start_time]"]').val();
        const end_time = $(this).find('input[name*="[end_time]"]').val();
        const faculty_id = $(this).find('select[name*="[faculty_id]"]').val();

        // Get the action type dynamically (default is 'insert')
        const action = $(this).data("action") || "insert";

        // Only push valid entries
        if (subject_id && start_time && end_time && faculty_id) {
          timetableData.push({
            course_code: course,
            semester: semester,
            day: day,
            subject_id: subject_id,
            start_time: start_time,
            end_time: end_time,
            faculty_id: faculty_id,
            action: action, // Include action flag
          });
        }
      });

    // Debugging: Log the data to be sent
    console.log("Timetable Data:", timetableData);

    // Ensure timetable data is not empty
    if (timetableData.length === 0) {
      alert("Please fill out all fields for at least one subject.");
      return;
    }

    // Send data to backend to save or update the timetable
    $.ajax({
      url: "../php/timetable/save_update_timetable.php", // PHP script to handle saving/updating
      method: "POST",
      dataType: "json",
      data: { timetable: timetableData },
      success: function (data) {
        console.log("Response:", data); // Log the response
        if (data.success) {
          alert("Timetable saved/updated successfully!");
          $("#subjectsForm").hide();
          $("#timetableDisplay").show();
          generateTimetable(); // Refresh the timetable display
        } else {
          alert("Failed to save/update timetable. Error: " + data.message);
        }
      },
      error: function () {
        alert("An error occurred while saving the timetable.");
      },
    });
  });

  // Edit timetable entry
  $(document).on("click", ".edit-timetable", function () {
    const subjectId = $(this).data("subject-id");
    const timetableRow = $(this).closest(".row");
    const day = $("#day").val(); // Get the selected day from the form

    // Check if day is selected
    if (!day) {
      alert("Please select a day to edit the timetable.");
      return;
    }

    // Fetch existing timetable entry for this subject ID and selected day (from the backend)
    $.ajax({
      url: "../php/timetable/fetch_edit_timetable.php",
      method: "POST",
      dataType: "json",
      data: { subject_id: subjectId, day: day },
      success: function (data) {
        console.log(data); // Log the response data
        if (data && data.start_time) {
          timetableRow.find('input[name*="[start_time]"]').val(data.start_time);
          timetableRow.find('input[name*="[end_time]"]').val(data.end_time);
          timetableRow
            .find('select[name*="[faculty_id]"]')
            .val(data.faculty_id);

          // Set the action to 'update' for this row
          timetableRow.data("action", "update");
        } else {
          alert("No data found for this timetable entry.");
        }
      },
      error: function () {
        alert("Failed to load timetable entry.");
      },
    });
  });

  // Generate timetable based on selected course, semester, and day
  $("#generateTimetable").click(function () {
    const course = $("#course_fetch").val();
    const semester = $("#semester_fetch").val();
    const day = $("#day").val();

    if (!course || !semester || !day) {
      alert("Please select all fields.");
      return;
    }

    $.ajax({
      url: "../php/timetable/fetch_time_table.php",
      method: "POST",
      dataType: "json",
      data: { course, semester, day },
      success: function (data) {
        if (data.message) {
          alert(data.message);
          $("#timetableDisplay").hide();
          return;
        }

        // If timetable data exists, generate the timetable table
        $("#timetableDisplay").show();
        const timetableBody = $("#timetableBody");
        timetableBody.empty(); // Clear the previous table content

        data.forEach((row) => {
          const to12HourFormat = (time) => {
            const [hours, minutes] = time.split(":").map(Number);
            const period = hours >= 12 ? "PM" : "AM";
            const hour = hours % 12 || 12; // Convert 0 to 12 for 12-hour format
            return `${hour}:${minutes.toString().padStart(2, "0")} ${period}`;
          };

          timetableBody.append(`
                        <tr>
                            <td>${row.subject_name}</td>
                            <td>${to12HourFormat(row.start_time)}</td>
                            <td>${to12HourFormat(row.end_time)}</td>
                            <td>${row.faculty_name}</td>
                        </tr>
                    `);
        });
      },
    });
  });
});

document
  .getElementById("cancelSelection")
  .addEventListener("click", function () {
    document.getElementById("timetableForm").reset();
    document.getElementById("subjectsForm").style.display = "none";
    document.getElementById("timetableDisplay").style.display = "none";
  });

document
  .getElementById("cancelSubjects")
  .addEventListener("click", function () {
    document.getElementById("subjectsForm").style.display = "none";
    document.getElementById("timetableForm").style.display = "block";
  });

document
  .getElementById("cancelTimetable")
  .addEventListener("click", function () {
    document.getElementById("timetableDisplay").style.display = "none";
    document.getElementById("timetableForm").style.display = "block";
  });
