$(document).ready(function () {
  $("#recordForm").on("submit", function (e) {
      e.preventDefault();
      
      var formData = {
          year: $("#year").val(),
          month: $("#month").val(),
          earnings: $("#earnings").val(),
          expenditures: $("#expenditures").val(),
          edit_mode: $("#edit_mode").val(),
          record_id_hidden: $("#record_id_hidden").val(),
      };
      
      console.log("Form data to be sent:", formData);

      var url = $("#edit_mode").val() === "edit" 
          ? "../php/Finance/update_finance_record.php"
          : "../php/Finance/insert_data.php";
      
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
                      var message = $("#edit_mode").val() === "edit" 
                          ? "Record updated successfully!" 
                          : "Record added successfully!";
                      
                      alert(message);
                      window.location.reload();
                      $("#recordForm")[0].reset();
                      $("#edit_mode").val("add");
                      $("#record_id_hidden").val(""); 
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

function fetchFinanceRecords() {
  console.log('Fetching finance data...');
  
  $.ajax({
      url: "../php/Finance/fetch_finance_data.php",  
      method: "GET",
      dataType: "json",
      success: function (response) {
          if (response.status === "success") {
              let dataHtml = "";
              
              $.each(response.data, function (index, record) {
                  dataHtml += `
                      <tr>
                          <td>${record.month}</td>
                          <td>${record.income}</td>
                          <td>${record.expenditure}</td>
                          <td>${record.net_balance || "Not Available"}</td>
                          <td>
                              <a href="#" onclick="editFinaceRecords('${record.id}')">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-edit text-warning" style="font-size: 27px;">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                      <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                      <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                      <path d="M16 5l3 3"></path>
                                  </svg>
                              </a>
                              <a href="#" onclick="deleteFinanceRecord('${record.id}')">
                                  <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor" class="text-danger" style="font-size: 29px;">
                                      <path d="M0 0h24v24H0V0z" fill="none"></path>
                                      <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"></path>
                                  </svg>
                              </a>
                          </td>
                      </tr>
                  `;
              });

              $("#finance_table_body").html(dataHtml);  
          } else {
              alert(response.message || "An error occurred while fetching finance data.");
          }
      },
      error: function (xhr, status, error) {
          console.log("Error fetching data:", status, error);
          alert("An error occurred while fetching finance data.");
      }
  });
}
fetchFinanceRecords();

window.deleteFinanceRecord = function (recordId) {
  console.log("Deleting finance record with ID:", recordId);
  
  if (confirm("Are you sure you want to delete this finance record?")) {
      $.ajax({
          url: "../php/finance/delete_finance_record.php",  
          method: "POST",
          data: { id: recordId },  
          dataType: "json",
          success: function (response) {
              console.log("Delete response:", response);
              if (response.status === 'success') {
                  alert(response.message);  
                  fetchFinanceRecords();  
              } else {
                  alert(response.message); 
              }
          },
          error: function (xhr, status, error) {
              console.log("AJAX Error:", status, error);
              alert("An error occurred while trying to delete the finance record.");
          }
      });
  }
};
window.editFinaceRecords = function (recordId) {
  console.log("Editing finance record with ID:", recordId);

  $.ajax({
      url: "../php/finance/get_finance_data.php",  
      method: "GET",
      data: { id: recordId },  
      dataType: "json",
      success: function (response) {
          if (response.status === 'success') {
              
              $('#month').val(response.data.month);
              $('#earnings').val(response.data.income);
              $('#expenditures').val(response.data.expenditure);

            
              $('#record_id_hidden').val(response.data.id);
              $('#edit_mode').val('edit');

             
              $('#submitButtonFinance').val('Update Record');  
              
              $('#recordDropdownButton').dropdown('toggle');  

             
              $('#recordDropdownButton').next('.dropdown-menu').addClass('show');

              

              
              $('#recordForm').show();
          } else {
              alert("Error fetching finance record data for editing.");
          }
      },
      error: function (xhr, status, error) {
          console.log("Error fetching finance record data:", error);
          alert("An error occurred while fetching data for editing.");
      }
  });
};
