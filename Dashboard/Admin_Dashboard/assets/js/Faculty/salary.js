$(document).ready(function () {
  // Generate Salary List
  $("#generateSalaryList").click(function () {
    $.ajax({
      url: "../php/Faculty/generate_salary_list.php",
      method: "GET",
      success: function (response) {
        alert(response); // Show success or error message
        fetchSalaries(); // Refresh the list
      },
    });
  });

  // Fetch Salary List
  function fetchSalaries() {
    $.ajax({
      url: "../php/Faculty/fetch_salaries.php",
      method: "GET",
      dataType: "json",
      success: function (data) {
        let rows = "";

        data.forEach(function (item) {
          rows += `
                        <tr>
                            <td>${item.department}</td>
                            <td>${item.faculty_id}</td>
                            <td>${item.faculty_name}</td>
                            <td>${item.salary_amount}</td>
                            <td>${item.status}</td>
                            <td>
                           <button class="btn btn-sm btn-${
                             item.status === "paid" ? "danger" : "primary"
                           } updateStatus" 
                           data-id="${item.id}" 
                           data-status="${item.status === "paid" ? "unpaid" : "paid"}">
                           Mark as ${item.status === "paid" ? "Unpaid" : "Paid"}
                           </button>  
                            </td>
                        </tr>
                    `;
        });

        // Populate the tbody
        $("#faculty_salary_body").html(rows);
      },
      error: function (xhr, status, error) {
        console.error("Error fetching salary data:", error);
      },
    });
  }

  // Update Payment Status
  $(document).on("click", ".updateStatus", function () {
    const id = $(this).data("id");
    const newStatus = $(this).data("status");

    $.ajax({
      url: "../php/Faculty/update_salary_status.php",
      method: "POST",
      data: { id: id, status: newStatus },
      success: function (response) {
        alert(response); // Show success message
        fetchSalaries(); // Refresh the list
      },
    });
  });

  // Fetch initial list
  fetchSalaries();
});
