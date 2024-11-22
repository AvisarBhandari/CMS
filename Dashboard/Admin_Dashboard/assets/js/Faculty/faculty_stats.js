function fetchFacultyStats() {
    $.ajax({
      url: "..//php/faculty_stats.php",
      type: "GET",
      dataType: "json",
      success: function (data) {
        $("#totalFaculty").text(data.total_faculty);
        $("#activeFaculty").text(data.active_percentage + "%");
        $("#absenteeismRate").text(data.absenteeism_rate + "%");
        $("#presentFaculty").text(data.present_percentage + "%");
      },
      error: function () {
        console.error("Error fetching faculty stats.");
      },
    });
  }
  
  $(document).ready(function () {
    fetchFacultyStats();
  });
  