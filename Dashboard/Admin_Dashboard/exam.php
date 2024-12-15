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
</head>
<style>
    /* General body styles */
    .body-container-exam {
        font-family: 'Sans-serif', Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        /* Light background color */
    }

    #cancel_btn_exam {
        background-color: #e74a3b;
    }

    /* Modal container styles */
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
    }

    .input-field:focus {
        border-color: #4d73e0;
        outline: none;
    }

    /* Button styling */
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

    /* Table styles for subjects */
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
            /* Make the modal take up 90% of the screen on smaller devices */
        }

        .btn {
            width: 10%;
            /* Button takes up full width on smaller screens */
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
                    <input type="text" class="input-field" id="examName" name="examName" placeholder="Enter exam name"
                        required><br>

                    <label class="label" for="roomNo">Room Number:</label>
                    <input type="text" class="input-field" id="roomNo" name="roomNo" placeholder="Enter room number"
                        required><br>

                    <label class="label" for="examTime">Exam Time:</label>
                    <input type="time" class="input-field" id="examTime" name="examTime" required><br>

                    <!-- Department Selection -->
                    <label class="label" for="department">Department:</label>
                    <select class="input-field" id="department" name="department" onchange="populateSubjects()"
                        required>
                        <option value="">Select Department</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Mathematics">Mathematics</option>
                        <option value="Physics">Physics</option>
                    </select><br>

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
                    <li class="nav-item"><a class="nav-link active" href="exam.php"><i
                                class="fas fa-table"></i><span>Exam Management&nbsp;</span></a></li>
                    <li class="nav-item"></li>
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
                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text"
                                    placeholder="Search for ..." style="height: 38.6px;">'
                                <button class="btn btn-primary py-0" type="button"
                                    style="width: 42.6px;height: 37.6px;"><i class="fas fa-search"></i></button>
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
                                            class="d-none d-lg-inline me-2 text-gray-600 small">xyz</span><img
                                            class="border rounded-circle img-profile"
                                            src="assets/img/untitled-1.png"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a
                                            class="dropdown-item" href="#"><i
                                                class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i
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
                                    <label for="course" class="form-label">Course</label>
                                    <select id="course" class="form-select" name="course" required>
                                        <option value="">Select Course</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="semester" class="form-label">Semester</label>
                                    <select id="semester" class="form-select" name="semester" required>
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
                        data-aos-once="true">Exam Management&nbsp;</h3><a
                        class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" data-aos="fade-left"
                        data-aos-duration="800" data-aos-delay="500" data-aos-once="true" href="#"><i
                            class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
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
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Name</th>
                                            <th>Room No.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>2081/11/28</td>
                                            <td>7-30 AM</td>
                                            <td>First Term</td>
                                            <td>30</td>
                                        </tr>
                                        <tr>
                                            <td>2081/10/09</td>
                                            <td>7-30 AM</td>
                                            <td>Second Term</td>
                                            <td>10</td>
                                        </tr>
                                        <tr>
                                            <td>2081/01/12</td>
                                            <td>7-30 AM</td>
                                            <td>Third Term</td>
                                            <td>3</td>
                                        </tr>
                                        <tr></tr>
                                        <tr></tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>Date</strong></td>
                                            <td><strong>Time</strong></td>
                                            <td><strong>Name</strong></td>
                                            <td><strong>Room No.</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
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
    <script>
        // Open Modal
        function openModal() {
            document.getElementById('examModal').style.display = 'block';
        }

        // Close Modal
        function closeModal() {
            document.getElementById('examModal').style.display = 'none';
        }

        // Populate Subjects based on Department Selection
        function populateSubjects() {
            var department = document.getElementById('department').value;
            var subjectsTableContainer = document.getElementById('subjectsTableContainer');
            var subjectsTableBody = document.getElementById('subjectsTable').getElementsByTagName('tbody')[0];

            // Clear the current rows in the table
            subjectsTableBody.innerHTML = '';

            // Show table if department is selected
            if (department) {
                subjectsTableContainer.style.display = 'block';

                // Define subjects for each department
                var subjects = [];
                if (department === 'Computer Science') {
                    subjects = ['Data Structures', 'Algorithms', 'Operating Systems', 'Database Systems'];
                } else if (department === 'Mathematics') {
                    subjects = ['Calculus', 'Linear Algebra', 'Probability', 'Statistics'];
                } else if (department === 'Physics') {
                    subjects = ['Mechanics', 'Electromagnetism', 'Thermodynamics', 'Quantum Physics'];
                }

                // Add each subject and an input field for the exam date
                subjects.forEach(function (subject) {
                    var row = subjectsTableBody.insertRow();

                    var cell1 = row.insertCell(0);
                    cell1.textContent = subject;

                    var cell2 = row.insertCell(1);
                    var inputDate = document.createElement('input');
                    inputDate.type = 'date';  // Only date, time will be universal
                    inputDate.name = 'examDate_' + subject;  // Unique name for each subject
                    inputDate.required = true;
                    cell2.appendChild(inputDate);
                });
            } else {
                subjectsTableContainer.style.display = 'none'; // Hide table if no department selected
            }
        }

        // Form Submission
        function submitForm(event) {
            event.preventDefault();

            // Collect universal exam details
            var department = document.getElementById('department').value;
            var examName = document.getElementById('examName').value;
            var roomNo = document.getElementById('roomNo').value;
            var examTime = document.getElementById('examTime').value;

            // Collect subject data
            var subjects = document.getElementById('subjectsTable').getElementsByTagName('tbody')[0].rows;
            var formData = [];

            // Loop through each subject row and get the exam date (apply universal time)
            for (var i = 0; i < subjects.length; i++) {
                var subject = subjects[i].cells[0].textContent;
                var examDate = subjects[i].cells[1].getElementsByTagName('input')[0].value;

                if (examDate) {
                    // Combine the date with the universal time and create the exam details
                    var fullExamDateTime = examDate + 'T' + examTime;

                    formData.push({
                        department: department,
                        subject: subject,
                        examName: examName,
                        roomNo: roomNo,
                        examDateTime: fullExamDateTime
                    });
                } else {
                    alert('Please provide an exam date for all subjects.');
                    return;
                }
            }

            // For now, log the form data (In practice, send this to the server)
            console.log('Exam Data:', formData);

            // Close the modal after submitting
            closeModal();
        }
    </script>

    <script src="assets/js/Timetable/timetable.js"></script>
</body>

</html>