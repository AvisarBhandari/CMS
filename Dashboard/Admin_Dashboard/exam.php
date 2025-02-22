<?php
// Start the session to store the image
session_start();
include '../php/db_connect.php'; // Database connection


$id = $_SESSION['id']; // or $_POST['id']
$role = $_SESSION['role']; // or $_POST['role']

// SQL query to get the image based on id and role
$sql = "SELECT image FROM images WHERE id = '$id' AND role = '$role'";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if a record was found
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the image data
    $row = mysqli_fetch_assoc($result);
    $imageData = $row['image'];

    // Convert the image data to base64 encoding
    $img = 'data:image/jpeg;base64,' . base64_encode($imageData);

    // Return the base64 image as a JSON response

} 

else{
    $img = 'assets/img/avatars/avatar.png';
    exit();}
// Close the database connection
?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Academy Keeper</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Titillium+Web:400,600,700">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/aos.min.css">
    <link rel="stylesheet" href="assets/css/Button-Change-Text-on-Hover.css">
    <link rel="stylesheet" href="assets/css/Cute-Select.css">
    <link rel="stylesheet" href="assets/css/Filter.css">
    <link rel="stylesheet" href="assets/css/Multiple-Input-Select-Pills.css">
    <link rel="stylesheet" href="assets/css/MUSA_button-label-button-label.css">
    <link rel="stylesheet" href="assets/css/MUSA_button-label.css">
    <link rel="stylesheet" href="assets/css/Navbar-With-Button-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="assets/css/timetable.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="assets/js/sweetalert.js"></script>



</head>
<style>
 
    .body-container-exam {
        font-family: 'Sans-serif', Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
       
    }

    #cancel_btn_exam {
        background-color: #e74a3b;
    }

   
    
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Fixed in place */
        z-index: 9999;
        /* On top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Scroll if needed */
        background-color: rgba(0, 0, 0, 0.5);
        /* Semi-transparent black background */
    }

    /* Modal content */
    .modal-content {
        background-color: white;
        margin: 15% auto;
        /* Center the modal */
        padding: 20px;
        border-radius: 8px;
        /* Rounded corners */
        width: 80%;
        /* Modal width */
        max-width: 600px;
        /* Maximum width */
    }

    /* Close button */
    .close {
        color: #aaa;
        font-size: 28px;
        font-weight: bold;
        position: absolute;
        top: 10px;
        right: 25px;
        transition: color 0.3s ease;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Modal title */
    .modal-title {
        text-align: center;
        background-color: #4d73e0;
        /* Background color */
        color: white;
        padding: 15px;
        margin: 0;
        font-size: 24px;
        border-radius: 8px 8px 0 0;
        /* Rounded top corners */
    }

    /* Form container */
    .form-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-top: 20px;
    }

    /* Label styles */
    .label {
        font-size: 14px;
        font-weight: bold;
    }

    /* Input field styles */
    .input-field {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 14px;
        width: 100%;
        box-sizing: border-box;
        height: 61%;
    }

    .input-field:focus {
        border-color: #4d73e0;
        outline: none;
    }

    
    .btn {
        padding: 12px 20px;
        background-color: #4d73e0;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #3a5bb0;
    }


.time-container {
    display: flex;
    gap: 10px;  
    align-items: center;
}
    
    .subjects-table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    .subjects-table th,
    .subjects-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .subjects-table th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .modal-content {
            width: 90%;
           
        }

        .btn {
            width: 10%;
          
        }
    }
</style>

<body id="page-top">
    <div id="wrapper">
        <!-- Modal for Adding Exam -->
<div id="examModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 class="modal-title">Add New Exam</h2>
        <form id="examForm" class="form-container" onsubmit="submitForm(event)">
            <!-- Universal Exam Details -->
            <label class="label" for="examName">Exam Name:</label>
            <input type="text" class="input-field" id="examName" name="examName" placeholder="Enter exam name" required><br>

            <label class="label" for="roomNo">Room Number:</label>
            <input type="text" class="input-field" id="roomNo" name="roomNo" placeholder="Enter room number" required><br>

            <!-- Exam Start and End Time in the same row -->
            <label class="label" for="examTimes">Exam Times:</label>
            <div class="time-container">
                <label for="examStartTime">Start Time:</label>
                <input type="time" class="input-field" id="examStartTime" name="examStartTime" required>

                <label for="examEndTime">End Time:</label>
                <input type="time" class="input-field" id="examEndTime" name="examEndTime" required>
            </div><br>

   <!-- Department Select -->
    <label for="department">Select Department:</label>
    <select id="department" onchange="getCourses()">
        <option value="">Select Department</option>
        <!-- Department options will be populated dynamically from the database -->
    </select>

    <!-- Display selected department -->

    <!-- Course Select -->
    <div id="courseContainer" style="display:none;">
        <label for="course">Select Course:</label>
        <select id="course" onchange="getSemesters()">
            <option value="">Select Course</option>
        </select>
    </div>


            <!-- Semester Selection -->
            <div id="semesterContainer" style="display:none;">
                <label class="label" for="semester" id="sem/year">Semester:</label>
                <select class="input-field"  style="margin-top: 15px;" id="semester" name="semester" onchange="getSubjects()" required>
                    <option value="" id="">Select Semester</option>
                </select><br>
            </div>

            <!-- Table for Subjects and Exam Dates -->
            <div id="subjectsTableContainer" style="display:none;">
    <table id="subjectsTable" class="subjects-table">
        <thead>
            <tr>
                <th>Subject</th>
                <th>Exam Date</th>
            </tr>
        </thead>
        <tbody>
            <!-- Rows for subjects will be dynamically added here -->
        </tbody>
    </table>
</div>

            <button type="submit" class="btn">Submit</button>
            <button type="button" id="cancel_btn_exam" class="btn" onclick="closeModal()">Cancel</button>
        </form>
    </div>
</div>


<script>

        
      // Open Modal
        function openModal() {
            document.getElementById('examModal').style.display = 'block';
        }

        // Close Modal
        function closeModal() {
            document.getElementById('examModal').style.display = 'none';
        }


            window.onload = function() {
            fetchDepartments();
        };

        // Function to fetch departments from the server
        function fetchDepartments() {
            var departmentSelect = document.getElementById('department');

            // Fetch departments from the server (getDepartments.php)
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '../php/exam/getDepartments.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var departments = JSON.parse(xhr.responseText);
                    departments.forEach(function(department) {
                        var option = document.createElement('option');
                        option.value = department.name;
                        option.textContent = department.name;
                        departmentSelect.appendChild(option);
                    });
                }
            };
            xhr.send();
        }

        // Populate Subjects based on Department Selection
// Populate Courses based on Department
function getCourses() {
    var department = document.getElementById('department').value;
    var courseSelect = document.getElementById('course');
    var courseContainer = document.getElementById('courseContainer');
    var departmentNameContainer = document.getElementById('departmentName');
    
    // Clear existing courses
    courseSelect.innerHTML = '<option value="">Select Course</option>';
    
    if (department) {
        // Show course container if department is selected
        courseContainer.style.display = 'block';

        // Send an AJAX request to the server to fetch courses for the selected department
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../php/exam/getCourses.php?department=' + encodeURIComponent(department), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var courses = JSON.parse(xhr.responseText);
                if (courses.length > 0) {
                    courses.forEach(function(course) {
                        var option = document.createElement('option');
                        option.value = course.course_code;
                        option.textContent = course.course_name ;
                        option.setAttribute('data-course-type', course.course_type);  // Store course type in the option
                        courseSelect.appendChild(option);
                    });
                } else {
                    var option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'No courses available';
                    courseSelect.appendChild(option);
                }
            }
        };
        xhr.send();
    } else {
        courseContainer.style.display = 'none'; // Hide if no department selected
        departmentNameContainer.textContent = ''; // Clear the department name text
    }
}



// Populate Semesters based on Course Selection
function getSemesters() {
    var courseSelect = document.getElementById('course');
    var courseCode = courseSelect.value;  // Get the selected course code
    var semesterSelect = document.getElementById('semester');
    
    // Extract the numeric part from the semester/year value (e.g., "Semester 1" -> 1 or "Year 1" -> 1)
    var semesterText = semesterSelect.value;
    var semester = null;

    if (semesterText) {
        // Use regular expressions to extract the number part after "Semester" or "Year"
        var match = semesterText.match(/(?:Semester|Year)\s*(\d+)/);
        if (match) {
            semester = parseInt(match[1], 10); // Get the number after "Semester" or "Year"
        }
    }

    var subjectsTable = document.getElementById('subjectsTable').getElementsByTagName('tbody')[0];
    
    // Clear existing subjects
    subjectsTable.innerHTML = '';

    // Check if both course and semester are selected
    if (courseCode && !isNaN(semester)) {
    var courseSelect = document.getElementById('course');
    var courseCode = courseSelect.value; // Get the selected course code
    var semesterSelect = document.getElementById('semester');
    var semesterContainer = document.getElementById('semesterContainer');

    // Clear existing semesters
    semesterSelect.innerHTML = '<option value="">Select Semester</option>';

    if (courseCode) {
        // Show semester container if course is selected
        semesterContainer.style.display = 'block';

        // Get the selected course option element
        var selectedOption = courseSelect.options[courseSelect.selectedIndex];
        
        // Ensure the course option has a data-course-type attribute
        var courseType = selectedOption.getAttribute('data-course-type');
        
        var semesters = [];

        if (courseType === 'Semester Based') {
            // For Semester Based courses, create 8 semesters
            for (var i = 1; i <= 8; i++) {
                semesters.push('Semester ' + i);
            }
        } else if (courseType === 'Yearly Based') {
            // For Yearly Based courses, create 4 semesters (Year 1 and Year 2)
            semesters = ['Year 1', 'Year 2'];
        }

        // Populate semester select dropdown
        semesters.forEach(function(semester) {
            var option = document.createElement('option');
            option.value = semester;
            option.textContent = semester;
            semesterSelect.appendChild(option);
        });
    } else {
        semesterContainer.style.display = 'none'; // Hide if no course selected
    }
}
}







function getSubjects() {
    var courseSelect = document.getElementById('course');
    var courseCode = courseSelect.value;  // Get the selected course code
    var semesterSelect = document.getElementById('semester');
    var semesterText = semesterSelect.value;  // Get the selected semester (e.g., "Semester 4")

    var subjectsTable = document.getElementById('subjectsTable').getElementsByTagName('tbody')[0];

    // Clear existing subjects
    subjectsTable.innerHTML = '';

    // Check if both course and semester are selected
    if (courseCode && semesterText) {
        // Make an AJAX request to fetch subjects
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../php/exam/getSubjects.php?course_code=' + encodeURIComponent(courseCode) + '&semester=' + encodeURIComponent(semesterText), true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                var subjects = JSON.parse(xhr.responseText);
                
                // Show the table container
                document.getElementById('subjectsTableContainer').style.display = 'block';

                if (subjects.length > 0) {
                    // Populate subjects in the table
                    subjects.forEach(function(subject) {
                        var row = subjectsTable.insertRow();

                        // Insert cells for subject name and exam date input
                        var cell1 = row.insertCell(0);  // Subject name
                        var cell2 = row.insertCell(1);  // Exam Date input

                        // Set the text content for the subject name
                        cell1.textContent = subject.subject_name;

                        // Create the input field for the exam date
                        var dateInput = document.createElement('input');
                        dateInput.type = 'date';
                        dateInput.className = 'exam-date';  // Optional: Add a class for styling or JS targeting
                        dateInput.name = 'exam_date_' + subject.subject_code;  // Optional: Name based on subject code for easy access

                        // Append the date input to the second cell
                        cell2.appendChild(dateInput);
                    });
                } else {
                    // If no subjects are found, show a message
                    var row = subjectsTable.insertRow();
                    var cell = row.insertCell(0);
                    cell.colSpan = 2;  // Merge both columns
                    cell.textContent = 'No subjects found for this course and semester.';
                }
            }
        };
        xhr.send();
    } else {
        // If no course or semester is selected, hide the subject table
        subjectsTable.innerHTML = '';
        document.getElementById('subjectsTableContainer').style.display = 'none';
    }
}





function submitForm(event) {
    event.preventDefault();

    // Collect universal exam details
    var department = document.getElementById('department').value;
    var examName = document.getElementById('examName').value;
    var roomNo = document.getElementById('roomNo').value;
    var examStartTime = document.getElementById('examStartTime').value;
    var examEndTime = document.getElementById('examEndTime').value;
    var courseSelect = document.getElementById('course');
    var courseName = courseSelect.options[courseSelect.selectedIndex].text;
    var semesterSelect = document.getElementById('semester');
    var semester = semesterSelect.value;

    // Collect subject data
    var subjects = document.getElementById('subjectsTable').getElementsByTagName('tbody')[0].rows;
    var formData = [];
    var examDates = {}; // Object to keep track of dates and avoid duplicates

    // Convert time to Date object for comparison
    function convertTimeToDate(examDate, time) {
        var date = new Date(examDate);
        var [hours, minutes] = time.split(":");
        date.setHours(hours, minutes, 0, 0);
        return date;
    }

    // Loop through each subject row and get the exam date
    for (var i = 0; i < subjects.length; i++) {
        var subject = subjects[i].cells[0].textContent;
        var examDate = subjects[i].cells[1].getElementsByTagName('input')[0].value;

        if (examDate) {
            // Combine date and time into a Date object
            var fullExamDateTime = convertTimeToDate(examDate, examStartTime);

            // Check for duplicate exam date
            if (examDates[examDate]) {
                // SweetAlert: show warning if exam date already exists
                swal({
                    icon: 'warning',
                    title: 'Duplicate Exam Date',
                    text: 'You cannot schedule multiple exams on the same date.'
                });
                return;
            }

            // Add date to the dates object to track duplicates
            examDates[examDate] = true;

            // Calculate the duration in minutes (example: difference between start and end time)
            var startTime = convertTimeToDate(examDate, examStartTime);
            var endTime = convertTimeToDate(examDate, examEndTime);
            var duration = (endTime - startTime) / 60000; // Convert milliseconds to minutes

            // Check for exam duration and gaps
            if (examStartTime && examEndTime) {
                if (endTime <= startTime) {
                    swal({
                        icon: 'error',
                        title: 'Invalid Time',
                        text: 'End time cannot be before start time.'
                    });
                    return;
                }

                // Check time gap between current and the next exam
                var minGap = 30; // Minimum gap in minutes (example: 30 minutes gap between exams)
                var prevExamDateTime = formData.length > 0 ? formData[formData.length - 1].examDateTime : null;
                if (prevExamDateTime) {
                    var prevEndTime = new Date(prevExamDateTime);
                    prevEndTime.setMinutes(prevEndTime.getMinutes() + 30); // Set gap of 30 minutes
                    if (startTime < prevEndTime) {
                        swal({
                            icon: 'warning',
                            title: 'Too Close',
                            text: 'There should be at least 30 minutes gap between exams.'
                        });
                        return;
                    }
                }
            }

            // Add all the collected data into formData array
            formData.push({
                department: department,
                courseName: courseName,
                subject: subject,
                examName: examName,
                roomNo: roomNo,
                examDate: examDate,  // Exam date (the start date of the exam)
                examTime: examStartTime, // Exam start time
                duration: duration, // Exam duration in minutes
                location: roomNo, // Room number as location
                department_name: department, // Department name
                semester: semester, // Semester (extracted from the dropdown)
                subject_name: subject // Subject name
            });
        } else {
            // Alert if any exam date is missing
            swal({
                icon: 'error',
                title: 'Missing Exam Date',
                text: 'Please provide an exam date for all subjects.'
            });
            return;
        }
    }

    // At this point, data is validated and ready for submission
    console.log('Exam Data:', formData);

    // Submit data to server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../php/exam/saveExamRoutine.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function () {
        console.log("Server Response: ", xhr.responseText);
        var response = JSON.parse(xhr.responseText);
        if (xhr.status === 200) {
            if (response.status === 'success') {
                swal({
                    icon: 'success',
                    title: 'Exam Routine Saved',
                    text: 'The exam routine has been successfully saved.'
                });
                // Optionally close the modal or reset form
                closeModal();  // Uncomment if you have a modal to close
            } else {
                swal({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'An error occurred while saving the exam routine. Please try again.'
                });
            }
        }
    };
    xhr.send(JSON.stringify(formData)); // Send the exam data as JSON
}

</script>



        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark"
            data-aos="fade-right" data-aos-duration="1200">
            <div class="container-fluid d-flex flex-column p-0"><a
                    class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#"
                    style="padding-bottom: 0px;padding-top: 0px;">
                    <div class="sidebar-brand-icon rotate-n-15" style="transform: rotate(3deg);"><img
                            src="assets/img/untitled-1.png" width="103" height="110"
                            style="margin-right: -32px;margin-top: -12px;margin-left: -37px;margin-bottom: -6px;"></div>
                    <div class="sidebar-brand-text mx-3"><span
                            style="padding-top: 0px;padding-bottom: 0px;">Academy<br>Keeper</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i
                                class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user"
                                style="font-size: 13px;"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="Courses Management.php"><i class="fas fa-book"
                                style="font-size: 13px;"></i><span>Course Management&nbsp;</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="faculty.php"><i
                                class="fas fa-table"></i><span>Faculty Management&nbsp;</span></a><a class="nav-link"
                            href="student.php"><i class="far fa-user"
                                style="font-size: 14px;"></i><span>StudentManagement&nbsp;</span></a></li>
                                <li class="nav-item"><a class="nav-link" href="financial.php"><svg
                                xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icon-tabler-moneybag"
                                style="font-size: 14px;">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M9.5 3h5a1.5 1.5 0 0 1 1.5 1.5a3.5 3.5 0 0 1 -3.5 3.5h-1a3.5 3.5 0 0 1 -3.5 -3.5a1.5 1.5 0 0 1 1.5 -1.5z">
                                </path>
                                <path d="M4 17v-1a8 8 0 1 1 16 0v1a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z"></path>
                            </svg>&nbsp;
                            <span>Financial Management&nbsp;</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="exam.php"><i
                                class="fas fa-table"></i><span>Exam Management&nbsp;</span></a></li>
                    
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar">
                    <div class="container-fluid">
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search"
                            data-aos="slide-down" data-aos-duration="1200" data-aos-delay="400">
                            <div class="input-group">
                            </div>
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link"
                                    aria-expanded="false" data-bs-toggle="dropdown" href="#"><i
                                        class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light border-0 form-control small"
                                                type="text" placeholder="Search for ..."><button class="btn btn-primary"
                                                type="button"><i class="fas fa-search"></i></button></div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1"></li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end"
                                    aria-labelledby="alertsDropdown"></div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                        aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                                            class="d-none d-lg-inline me-2 text-gray-600 small">
                                        <?php echo $_SESSION['name']; ?>
                                        </span><img
                                            class="border rounded-circle img-profile"
                                            src="
                                            <?php
                                            echo $img;
                                            ?>
                                            "></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a
                                            class="dropdown-item" href="profile.php"><i
                                                class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="../../front/logout.php"><i
                                                class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="container mt-5">
                    <h2 class="text-center">Timetable Management</h2>

                    <!-- Selection Form -->
                    <div class="form-section">
                        <form id="timetableForm" class="mb-4">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="course_fetch" class="form-label">Course</label>
                                    <select id="course_fetch" class="form-select" name="course" required>
                                        <option value="">Select Course</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="semester_fetch" class="form-label">Semester</label>
                                    <select id="semester_fetch" class="form-select" name="semester" required>
                                        <option value="">Select Semester</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="day" class="form-label">Day</label>
                                    <select id="day" class="form-select" name="day" required>
                                        <option value="">Select Day</option>
                                        <option value="Sunday">Sunday</option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                    </select>
                                </div>
                            </div>
                            <button type="button" id="fetchSubjects" class="btn btn-primary btn-custom">Add
                                Timetable</button>
                            <button type="button" id="generateTimetable" class="btn btn-success btn-custom">Generate
                                Timetable</button>
                                <button type="button" id="cancelSelection" class="btn btn-secondary btn-custom">Cancel</button>
                        </form>
                    </div>

                    <!-- Subjects Form -->
                    <div class="form-section" id="subjectsForm" style="display: none;">
                        <h4>Add/Edit Timetable</h4>
                        <div id="subjectsContainer"></div>
                        <button type="button" id="saveTimetable" class="btn btn-success mt-3">Save Timetable</button>
                        <button type="button" id="cancelSubjects" class="btn btn-secondary btn-custom mt-3">Cancel</button>
                    </div>

                    <!-- Timetable Display -->
                    <div class="form-section" id="timetableDisplay" style="display: none;">
                        <h4>Generated Timetable</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Faculty</th>
                                </tr>
                            </thead>
                            <tbody id="timetableBody"></tbody>
                        </table>
                    </div>
                </div>

                <div class="d-sm-flex justify-content-between align-items-center mb-4 pe-5" style="padding-left: 24px;">
                    <h3 class="text-dark mb-0" data-aos="fade-right" data-aos-duration="800" data-aos-delay="500"
                        data-aos-once="true">Exam Management&nbsp;
                </div>
                <div class="container-fluid">
                    <div class="card shadow" data-aos="flip-up" data-aos-duration="700" data-aos-delay="400"
                        data-aos-once="true">
                        <div class="card-header py-3 pb-0">
                            <p class="text-primary m-0 fw-bold pb-0 mb-3">Examination&nbsp;</p>
                            <button class="add-exam-btn btn" onclick="openModal()">
                                <i class="fas "></i> Add Exam
                            </button>



                        </div>

                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                aria-describedby="dataTable_info">
                                <?php
                                $sql = "SELECT exam_code, exam_date,exam_name, exam_time, department_name, course_name, semester,subject_name, location 
        FROM exam_routine
        ORDER BY exam_code, exam_date, exam_time";

// Execute the query
$result = $conn->query($sql);

// Check if the query returns any rows
if ($result->num_rows > 0) {
    // Initialize variables to track unique exam codes
    $current_exam_code = "";
    
    // Start HTML output
    
echo '<table class="table my-0" id="dataTable">';
    echo '<thead>
            
          </thead>';
    echo '<tbody>';
    // Loop through the query result
    while ($row = $result->fetch_assoc()) {
        
        // Check if the exam code has changed
        if ($current_exam_code !== $row['exam_code']) {
            if ($current_exam_code !== "") {
                
                echo '</tbody>';
            }
            $current_exam_code = $row['exam_code'];
            echo '<thead><tr>
                <th>Exam Date</th>
                <th>Exam Time</th>
                <th>Exam Name</th>
                <th>Department</th>
                <th>Subject</th>
                <th>Semester/Year</th>
                <th>Room No.</th>
                <th>Actions</th>
            </tr></thead>';
            echo '<tbody>';
        }

        // Display the exam information in table rows
        echo '<tr>';
        echo '<td>' . $row['exam_date'] . '</td>';
        echo '<td>' . $row['exam_time'] . '</td>';
        echo '<td>' . $row['exam_name'] . '</td>';
        echo '<td>' . $row['department_name'] . '</td>';
        echo '<td>' . $row['subject_name'] . '</td>';
        echo '<td>' . $row['semester'] . '</td>';
        echo '<td>' . $row['location'] . '</td>';
        echo '<td> 
                <form method="post" action="../php/exam/deleteaxm.php">
    <input type="hidden" name="exam_code" value=" '.$current_exam_code.'">

    <button type="submit" style="background: none; border: none;">
        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor" class="text-danger" style="font-size: 29px;">
            <path d="M0 0h24v24H0V0z" fill="none"></path>
            <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"></path>
        </svg>
    </button>
</form>

            </td>';
    }

    // Close the final tbody and table
    echo '</tbody></table>
    <br>
    <br>';

} else {
    echo "No exam data found.";
}

// Close the database connection
$conn->close();
                                ?>
                            </div>
                        </div>
                    </div >
                </div>
            </div>




            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Academy Keeper 2024</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/aos.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/exam/exam.js"></script>
    <script src="assets/js/Timetable/timetable.js"></script>
    <script src="assets/js/sweetalert.js"></script>
    <script src=""></script>
    <script>
        function editStudent(examCode) {
    // Open the modal
    openModal();

    // Fetch the exam data based on examCode via AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../php/exam/getExamDetails.php?exam_code=' + encodeURIComponent(examCode), true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);

            // Populate the form fields with the fetched data
            document.getElementById('examName').value = data.exam_name;
            document.getElementById('roomNo').value = data.room_no;
            document.getElementById('examStartTime').value = data.exam_start_time;
            document.getElementById('examEndTime').value = data.exam_end_time;
            document.getElementById('department').value = data.department;
            document.getElementById('course').value = data.course_code;
            document.getElementById('semester').value = data.semester;

            // Call functions to populate dependent fields
            getCourses(); // To populate courses based on department
            getSemesters(); // To populate semesters based on selected course
            getSubjects(); // To populate subjects based on selected course and semester
        }
    };
    xhr.send();
}

// Function to open the modal
function openModal() {
    document.getElementById('examModal').style.display = 'block';
}

// Function to close the modal
function closeModal() {
    document.getElementById('examModal').style.display = 'none';
}

    </script>

<?php
    if(isset($_SESSION['status']) && $_SESSION['massage']) {
    ?>
    <script>
    swal({
  title: "<?php echo $_SESSION['massage']; ?>",
  icon: "<?php echo $_SESSION['status']; ?>",
});
    </script>
    <?php
    unset($_SESSION['status']);
    unset($_SESSION['massage']);
}
?>


</body>

</html>