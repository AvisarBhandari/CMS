$(document).ready(function () {
  $.ajax({
    url: "../php/Subjects/fetch_courses_data_display.php",
    method: "GET",
    dataType: "json",
    success: function (response) {
      if (response.status === "success") {
        let courseOptions = "<option value=''>Select Course</option>";
        $.each(response.data, function (index, course) {
          courseOptions += `<option value="${course.course_code}">${course.course_name}</option>`;
        });
        $("#courseSelect").html(courseOptions);
      }
    },
    error: function () {
      alert("Error fetching courses.");
    },
  });
});

function fetchSubjects() {
  const courseCode = $("#courseSelect").val();
  if (!courseCode) return;

  $.ajax({
    url: "../php/Subjects/fetch_subject.php",
    method: "GET",
    data: { course_code: courseCode },
    dataType: "json",
    success: function (response) {
      if (response.status === "success") {
        let subjectsHtml = "";
        $.each(response.data, function (index, subject) {
          let syllabusStatus =
            subject.syllabus_status === "Completed"
              ? "Completed"
              : "Not Completed";
          subjectsHtml += ` 
                        <tr>
                            <td>${subject.subject_code}</td>
                            <td>${subject.subject_name}</td>
                            <td>${subject.credits}</td>
                            <td>${subject.semester}</td>
                            <td>${syllabusStatus}</td>
                             <td>
            <a href="#" onclick="editSubject('${subject.subject_id}')">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-edit text-warning" style="font-size: 27px;">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                    <path d="M16 5l3 3"></path>
                </svg>
            </a>
            <a href="#" onclick="deleteSubject('${subject.subject_id}')">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor" class="text-danger" style="font-size: 29px;">
                    <path d="M0 0h24v24H0V0z" fill="none"></path>
                    <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"></path>
                </svg>
            </a>
        </td>
                        </tr>`;
        });
        $("#subjectTableBody").html(subjectsHtml);
      } else {
        $("#subjectTableBody").html(
          "<tr><td colspan='6'>No subjects found.</td></tr>"
        );
      }
    },
    error: function () {
      alert("Error fetching subjects.");
    },
  });
}

// Add/Edit Subject
$("#subjectForm").on("submit", function (e) {
  e.preventDefault();

  const formData = {
    subject_code: $("#subjectCode").val(),
    subject_name: $("#subjectName").val(),
    credits: $("#subjectCredits").val(),
    semester: $("#subjectSemester").val(),
    syllabus_status: $("#syllabusStatus").val(),
    course_code: $("#courseSelect").val(),
    edit_mode: $("#editMode").val(),
    subject_id: $("#subjectId").val(),
  };

  const url =
    formData.edit_mode === "edit"
      ? "../php/Subjects/update_subject.php"
      : "../php/Subjects/insert_subject.php";

  $.ajax({
    url: url,
    method: "POST",
    data: formData,
    dataType: "json",
    success: function (response) {
      if (response.status === "success") {
        alert(response.message);
        fetchSubjects();
        $("#subjectForm")[0].reset();
        $("#editMode").val("add");
        $("#subjectFormCollapse").collapse("hide");
      } else {
        alert(response.message);
      }
    },
    error: function () {
      alert("Error saving subject.");
    },
  });
});

// Edit Subject
function editSubject(subjectId) {
  $.ajax({
    url: "../php/Subjects/get_subject_data.php",
    method: "GET",
    data: { subject_id: subjectId },
    dataType: "json",
    success: function (response) {
      if (response.status === "success") {
        // Populate the form fields with the subject data
        $("#subjectCode").val(response.data.subject_code);
        $("#subjectName").val(response.data.subject_name);
        $("#subjectCredits").val(response.data.credits);
        $("#subjectSemester").val(response.data.semester);
        $("#syllabusStatus").val(response.data.syllabus_status);
        $("#editMode").val("edit");
        $("#subjectId").val(response.data.subject_id);

        $("#subjectFormCollapse").collapse("show");
        $("html, body").animate(
          {
            scrollTop: $("#subjectFormCollapse").offset().top,
          },
          0
        );
      } else {
        alert("Error fetching subject data.");
      }
    },
    error: function () {
      alert("Error fetching subject data.");
    },
  });
}

// Delete Subject
function deleteSubject(subjectId) {
  if (confirm("Are you sure you want to delete this subject?")) {
    $.ajax({
      url: "../php/Subjects/delete_subject.php",
      method: "POST",
      data: { subject_id: subjectId },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          alert(response.message);
          fetchSubjects();
        } else {
          alert(response.message);
        }
      },
      error: function () {
        alert("Error deleting subject.");
      },
    });
  }
}
