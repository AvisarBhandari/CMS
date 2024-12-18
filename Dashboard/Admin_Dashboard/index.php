    <?php
    include '../php/db_connect.php';
    session_start();
    echo $_SESSION['name'];
    echo $_SESSION['id'];
        
    ?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Academy Keeper</title>
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


</head>

<body id="page-top">
<<<<<<< HEAD
    <?php
    include '../php/db_connect.php';
    session_start();
    // Query to get total number of students
    $student_query = "SELECT COUNT(*) AS total_students FROM studentS_info";
    $result_student = $conn->query($student_query);
    $total_students = $result_student->num_rows > 0 ? $result_student->fetch_assoc()['total_students'] : 0;

    // Query to get total number of faculty members
    $faculty_query = "SELECT COUNT(*) AS total_faculty FROM faculty";
    $result_faculty = $conn->query($faculty_query);
    $total_faculty = $result_faculty->num_rows > 0 ? $result_faculty->fetch_assoc()['total_faculty'] : 0;

    // Store data in session variables
    $_SESSION['total_students'] = $total_students;
    $_SESSION['total_faculty'] = $total_faculty;

    $sql = "SELECT COUNT(*) AS TotalAttendance 
FROM student_attendance 
WHERE status = 'Present'";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful and retrieve the result
    if ($result->num_rows > 0) {
        // Fetch the result as an associative array
        $row = $result->fetch_assoc();

        // Store the total attendance count in the variable
        $totalAttendance = $row['TotalAttendance'];
        $_SESSION['totalAttendance'] = $totalAttendance;
    } else {
        $totalAttendance = 0; // Assign a default value in case there are no records
        $_SESSION['totalAttendance'] = $totalAttendance;
    }

    // If we have total students and total attendance, calculate attendance percentage
    if ($total_students > 0) {
        // Calculate attendance percentage
        $attendancePercentage = floor(($totalAttendance / $total_students) * 100);
        $_SESSION['attendancePercentage'] = round($attendancePercentage, 2);  // Round to 2 decimal places
    
    } else {
        $_SESSION['attendancePercentage'] = 0;  // Default to 0% if no students
    }

    // Now calculate the total present students based on the attendance percentage
    if ($total_students > 0 && isset($_SESSION['attendancePercentage'])) {
        // Calculate the total present students
        $totalPresent = ($totalAttendance / 100) * $total_students;  // This formula works as you're calculating presence from the attendance records
        $_SESSION['totalPresent'] = round($totalPresent);  // Round to the nearest integer
    
        // Output total present students
    } else {
        $_SESSION['totalPresent'] = 0;  // Default to 0 if there are no students or percentage
    }



    $sql = "SELECT COUNT(*) AS departmentCount FROM courses";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful and retrieve the result
    if ($result->num_rows > 0) {
        // Fetch the result as an associative array
        $row = $result->fetch_assoc();

        $_SESSION['totalCourse'] = $row['departmentCount'];
    }
    $totalCourse = isset($_SESSION['totalCourse']) ? $_SESSION['totalCourse'] : 0;

    $id = $_SESSION['id'];

    $sql = "SELECT name FROM admin WHERE id = '$id'"; // Be cautious, this is vulnerable to SQL injection if $id is not sanitized
    
    // Run the query
    $result = $conn->query($sql);

    // Check if the query returned any result
    if ($result->num_rows > 0) {
        // Fetch the result (name)
        $row = $result->fetch_assoc();
        $_SESSION['name'] = $row['name']; // Output the name
        $_SESSION['role'] = 'admin';
    } else {
        echo "No user found with this ID."; // No matching id found
    }


    ?>
=======
>>>>>>> 5df88bb8b31213ed2511d33c5fc2db810b4a9098


    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark"
            data-aos="fade-right" data-aos-duration="1200" data-aos-once="true">
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
                    <li class="nav-item"><a class="nav-link active" href="index.php"><i
                                class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user"
                                style="font-size: 13px;"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="Courses Management.php"><i class="fas fa-book"
                                style="font-size: 13px;"></i><span>Course Management&nbsp;</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="faculty.php"><i
                                class="fas fa-table"></i><span>Faculty Management&nbsp;</span></a><a class="nav-link"
                            href="student.php"><i class="far fa-user"
                                style="font-size: 14px;"></i><span>StudentManagement&nbsp;</span></a></li>
                    <li class="nav-item"><a class="nav-link " href="exam.php"><i class="fas fa-table"></i><span>Exam
                                Management&nbsp;</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="financial.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icon-tabler-moneybag"
                                style="font-size: 14px;">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M9.5 3h5a1.5 1.5 0 0 1 1.5 1.5a3.5 3.5 0 0 1 -3.5 3.5h-1a3.5 3.5 0 0 1 -3.5 -3.5a1.5 1.5 0 0 1 1.5 -1.5z">
                                </path>
                                <path d="M4 17v-1a8 8 0 1 1 16 0v1a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z"></path>
                            </svg><span style="padding-left: 2px;">Financial&nbsp; Management&nbsp;</span></a></li>

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
                            data-aos="slide-down" data-aos-duration="1200" data-aos-delay="400" data-aos-once="true">
                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text"
                                    placeholder="Search for ..." style="height: 38.6px;"><button
                                    class="btn btn-primary py-0" type="button" style="width: 42.6px;height: 37.6px;"><i
                                        class="fas fa-search"></i></button></div>
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


                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                        aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                                            class="d-none d-lg-inline me-2 text-gray-600 small">
                                            <?php
                                            echo $_SESSION['name'];
                                            ?>
                                        </span>
                                        <img class="border rounded-circle img-profile" src="<?php
                                        $result = $conn->query("SELECT image FROM images ORDER BY id DESC LIMIT 1");

                                        if (!empty($result) && $result->num_rows > 0) {
                                            $row = $result->fetch_assoc();
                                            $imageData = $row['image'];
                                            echo 'data:image/jpeg;base64,' . base64_encode($imageData) . '';
                                        } else {
                                            echo 'No image uploaded yet.';
                                        }

                                        $conn->close();
                                        ?>"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                        <a class="dropdown-item" href="profile.php">
                                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                                        <div class="dropdown-divider">

                                        </div>
                                        <a class="dropdown-item" href="#">
                                            <i
                                                class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4" data-aos="fade"
                        data-aos-once="true" data-aos-duration="1200" data-aos-delay="500" style="padding-right: 5px;">
                        <h3 class="text-dark mb-0">Admin Dashboard</h3><a
                            class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i
                                class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                    </div>
                    <div class="row" data-aos="fade" data-aos-duration="1200" data-aos-delay="500" data-aos-once="true">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-primary py-2" style="box-shadow: 0px 0px;">
                                <div class="card-body">
                                    <div class="row g-0 align-items-center">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total
                                                    Student</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span id="total_students">
                                                    
                                                </span></div>
                                        </div>
                                        <div class="col-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                height="1em" fill="currentColor" viewBox="0 0 16 16"
                                                class="bi bi-person fa-2x text-gray-300">
                                                <path
                                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z">
                                                </path>
                                            </svg></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-success py-2">
                                <div class="card-body">
                                    <div class="row g-0 align-items-center">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total
                                                    Faculty</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span id="total_faculty">
                                                    
                                                </span></div>
                                        </div>
                                        <div class="col-auto"><svg xmlns="http://www.w3.org/2000/svg"
                                                viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor"
                                                class="fa-2x text-gray-300">

                                                <path
                                                    d="M112 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm40 304V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V256.9L59.4 304.5c-9.1 15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l58.3-97c17.4-28.9 48.6-46.6 82.3-46.6h29.7c33.7 0 64.9 17.7 82.3 46.6l58.3 97c9.1 15.1 4.2 34.8-10.9 43.9s-34.8 4.2-43.9-10.9L232 256.9V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V352H152z">
                                                </path>
                                            </svg></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-info py-2">
                                <div class="card-body">
                                    <div class="row g-0 align-items-center">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Attendance
                                                    Rate</span></div>
                                            <div class="row g-0 align-items-center">
                                                <div class="col-auto">
                                                    <div class="text-dark fw-bold h5 mb-0 me-3"><span id="attendance_rate">
                                                            
                                                        </span></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-info" aria-valuenow="50"
                                                            aria-valuemin="0" aria-valuemax="100" style="width: 
                                                        10%">




                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-warning py-2">
                                <div class="card-body">
                                    <div class="row g-0 align-items-center">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Total
                                                    Courses</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span id="total_courses">

                                                </span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-book fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" data-aos="fade" data-aos-once="true">
                        <div class="col-lg-7 col-xl-8 col-xxl-12 mx-auto" data-aos="fade-right" data-aos-once="true"
                            data-aos-duration="1200" data-aos-once="true">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center"
                                    style="height: 57.4px;">
                                    <h6 class="text-primary fw-bold m-0">Earnings Overview</h6>
                                </div>
                                <div class="card-body p-3 d-flex justify-content-center align-items-center">
                                    <!-- Chart Container, centered horizontally and vertically -->
                                    <div class="chart-container"
                                        style="position: relative; width: 100%; height: 300px; display: flex; justify-content: center; align-items: center;">
                                        <canvas id="earningsChart" style="max-width: 100%; max-height: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow mb-4" data-aos="fade-right" data-aos-duration="1200"
                            data-aos-once="true" style="box-shadow: 0px 0px 20px;">
                            <div class="card-header py-3">
                                <h6 class="text-primary fw-bold m-0">Upcoming Events</h6>
                            </div>
                            <ul class="list-group list-group-flush" id="eventList">
                                <!-- Events will be dynamically populated here -->
                            </ul>
                        </div>
                        <div class="card shadow mb-4" data-aos="fade-right" data-aos-duration="1200"
                            data-aos-once="true" style="box-shadow: 0px 0px 20px;">
                            <div class="card-header py-3">
                                <h6 class="text-primary fw-bold m-0">Upcoming Holidays</h6>
                            </div>
                            <ul id="holidayList" class="list-group list-group-flush">
                                <!-- Holidays will be dynamically populated here -->
                            </ul>
                        </div>

                    </div>
                    <div class="col">
                        <div class="card shadow mb-4"></div>
                        <div class="card shadow mb-4" data-aos="fade-left" data-aos-duration="1200" data-aos-once="true"
                            style="padding-bottom: 0px;height: 267.7px;width: 417.8px;margin-left: 74px;box-shadow: 0px 0px 20px; z-index:2;">
                            <div class="card-header py-3">
                                <h6 class="text-primary fw-bold m-0">Quick Actions</h6>
                            </div>
                            <div class="card-body pb-xxl-0 mb-xxl-5">
                                <div class="dropdown" style="margin-left: 112px;">
                                    <button class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1"
                                        aria-expanded="false" data-bs-toggle="dropdown" type="button"
                                        id="EventdropdDownButton">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24"
                                            width="1em" fill="currentColor"
                                            style="width: 24px;height: 24px;font-size: 22px; z-index: 1;">
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                                        </svg>&nbsp;Add Events&nbsp;
                                    </button>
                                    <div class="dropdown-menu" style="width: 1076px; box-shadow: 0px 0px 20px 1px;">
                                        <form style="padding-bottom: 0;" id="eventForm">
                                            <h3 class="text-bg-primary"
                                                style="margin-top: -8px; height: 46.6px; padding-top: 6px; text-align: center;"
                                                id="form_heading">
                                                <strong>Add Event</strong>
                                            </h3>
                                            <div class="container" style="padding-bottom: 0; margin-bottom: 24px;">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6 col-xxl-4"><strong>Event Date</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input class="form-control-lg" type="date" id="event_date"
                                                            name="event_date" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container" style="padding-bottom: 0; margin-bottom: 24px;">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6 col-xxl-4"><strong>Event Name</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" id="event_name" name="event_name"
                                                            class="form-control-lg" style="width: 100%; height: 71.4px;"
                                                            required></>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container" style="padding-bottom: 0; margin-bottom: 24px;">
                                                <div class="row align-items-center">
                                                    <div class="col-md-6 col-xxl-4"><strong>Event Time</strong>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input class="form-control-lg" type="time" id="event_time"
                                                            name="event_time" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-end" style="margin-right: 15px;">
                                                <input class="btn btn-primary" type="submit" id="submit_button"
                                                    value="Add Event">
                                            </div>
                                            <input type="hidden" id="event_id" name="event_id" value="">
                                            <input type="hidden" id="edit_mode" name="edit_mode" value="add">
                                        </form>
                                    </div>
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                        <div class="dropdown">
                                            <button id="HolidayDropdownButton"
                                                class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1"
                                                aria-expanded="false" data-bs-toggle="dropdown"
                                                data-bs-auto-close="outside" style="position: relative; top:5px;"
                                                type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24"
                                                    width="1em" fill="currentColor"
                                                    style="width: 24px;height: 24px;font-size: 22px;">
                                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                                                </svg>&nbsp;Add Holiday
                                            </button>
                                            <div class="dropdown-menu"
                                                style="width: 1076px; box-shadow: 0px 0px 20px 1px; position: relative; left: 100px">
                                                <h3 class="text-light text-bg-primary"
                                                    style="padding-left: 43%; padding-top: 4px; margin-top: -8px; margin-bottom: 14px; height: 41.6px;"
                                                    id="form_heading_holiday">Add Holiday</h3>
                                                <form style="padding-bottom: 0px;" id="holidayForm" method="POST">
                                                    <div style="margin-top: 30px; margin-right: -1px;">
                                                        <div class="container"
                                                            style="padding-top: 0px; padding-bottom: 0px; margin-bottom: 15px; margin-top: 8px;">
                                                            <div class="row">
                                                                <div class="col-md-3 col-xxl-1"
                                                                    style="margin-left: 40px; margin-top: 0px; padding-top: 8px; margin-right: 24px;">
                                                                    <strong>Holiday Date</strong>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input class="form-control" type="date"
                                                                        name="holiday_date" id="holiday_date"
                                                                        placeholder="Enter Holiday Date" required>
                                                                </div>
                                                                <div class="col-md-3 col-xxl-1"
                                                                    style="margin-left: 210px; padding-top: 7px;">
                                                                    <strong>Reason</strong>
                                                                </div>
                                                                <div class="col-md-3" style="margin-left: 31px;">
                                                                    <input class="form-control" type="text"
                                                                        name="reason" id="reason"
                                                                        style="width: 100%; height: 71.4px;"
                                                                        placeholder="Enter Holiday Reason" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="edit_mode" value="add">
                                                        <input type="hidden" id="holiday_id">

                                                        <input class="btn btn-primary" type="submit"
                                                            style="margin-left: 807px;" value="Add Holiday"
                                                            id="submit_button_holiday">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-nowrap"
                                        style="padding-left: 33px; padding-top: 0px;position:relative; top: 5px; left:-32px; ">
                                        <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                        </div>
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1"
                                                aria-expanded="false" data-bs-toggle="dropdown"
                                                data-bs-auto-close="outside" type="button" id="recordDropdownButton">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24"
                                                    width="1em" fill="currentColor"
                                                    style="width: 24px; height: 24px; font-size: 22px;">
                                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                                                </svg>&nbsp;Add Finance&nbsp;
                                            </button>
                                            <div class="dropdown-menu"
                                                style="width: 1076px; box-shadow: 0px 0px 20px 1px;">
                                                <h3 class="text-bg-primary" id="financedropdownbtn"
                                                    style="margin-top: -8px; height: 58.6px; padding-top: 12px; padding-left: 50%;">
                                                    Add Finance
                                                </h3>
                                                <form action="" method="post" id="recordForm"
                                                    style="padding-bottom: 0px;">
                                                    <div style="margin-top: 30px; margin-right: -1px;">
                                                        <div class="container"
                                                            style="padding-top: 0px; padding-bottom: 0px; margin-bottom: 15px; margin-top: 8px;">
                                                            <div class="row">
                                                                <div class="col-md-3 col-xxl-1"
                                                                    style="margin-left: 40px; margin-top: 0px; padding-top: 8px; margin-right: 24px;">
                                                                    <strong>Month</strong>
                                                                </div>
                                                                <div class="col-md-3" style="margin-left: 31px;">
                                                                    <select class="form-control" name="month" id="month"
                                                                        required>
                                                                        <option value="">Select Month</option>
                                                                        <option value="January">January</option>
                                                                        <option value="February">February</option>
                                                                        <option value="March">March</option>
                                                                        <option value="April">April</option>
                                                                        <option value="May">May</option>
                                                                        <option value="June">June</option>
                                                                        <option value="July">July</option>
                                                                        <option value="August">August</option>
                                                                        <option value="September">September</option>
                                                                        <option value="October">October</option>
                                                                        <option value="November">November</option>
                                                                        <option value="December">December</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3 col-xxl-1"
                                                                    style="margin-left: 40px; margin-top: 0px; padding-top: 8px; margin-right: 24px;">
                                                                    <strong>Earnings</strong>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input class="form-control" type="number"
                                                                        name="earnings" id="earnings"
                                                                        placeholder="Enter Earnings" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="container"
                                                            style="padding-top: 0px; padding-bottom: 0px; margin-bottom: 15px; margin-top: 8px;">
                                                            <div class="row">
                                                                <div class="col-md-3 col-xxl-1"
                                                                    style="margin-left: 40px; margin-top: 0px; padding-top: 8px; margin-right: 24px;">
                                                                    <strong>Expenditures</strong>
                                                                </div>
                                                                <div class="col-md-3" style="margin-left: 31px;"
                                                                    style="margin-left: 31px;">
                                                                    <input class="form-control" type="number"
                                                                        name="expenditures" id="expenditures"
                                                                        placeholder="Enter Expenditures" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="edit_mode" name="edit_mode" value="add">
                                                    <input type="hidden" id="record_id_hidden" name="record_id_hidden">
                                                    <input class="btn btn-primary" type="submit"
                                                        style="margin-left: 807px;" name="add_record" value="Add Record"
                                                        id="submitButtonFinance">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pb-xxl-0 mb-xxl-5"></div>
                            </div>

                        </div>
                        <div class="card shadow" style="box-shadow: 0px 0px 20px;">
                            <div class="card-header py-3">
                                <p class="text-primary m-0 fw-bold">Income-Expenditure past 12 month</p>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable-1" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Earnings</th>
                                            <th>Expenditures</th>
                                            <th>Net Balance</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="finance_table_body">
                                        <!-- Dynamic rows will be added here -->
                                    </tbody>
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
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/earning_data.js"></script>
    <script src="assets/js/fee_data.js"></script>
    <script src="assets/js/Events/event_crud.js"></script>
    <script src="assets/js/Holidays/holiday_crud.js"></script>
    <script src="assets/js/Holidays/validate_holiday.js"></script>
    <script src="assets/js/Events/validate_event.js"></script>
    <script src="assets/js/Finance/finance_crud.js"></script>
    <script src="assets/js/Finance/validate_finance.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script type="text/javascript">
        // Function to fetch data using AJAX
        function fetchAttendanceData() {
            $.ajax({
                url: '../php/count.php',  // PHP file that will handle the request
                type: 'POST',
                success: function(response) {
                    // Parse the JSON response from the PHP file
                    var data = JSON.parse(response);
                    
                    // Store values in JavaScript variables
                    var totalStudents = data.total_students;
                    var totalFaculty = data.total_faculty;
                    var attendancePercentage = data.attendance_percentage;
                    var cource_no = data.cource;

                    // Display the data in the HTML
                    document.getElementById('total_students').innerHTML = totalStudents;
                    document.getElementById('total_faculty').innerHTML = totalFaculty;
                    document.getElementById('attendance_rate').innerHTML = attendancePercentage + "%";
                    document.getElementById('total_courses').innerHTML = cource_no;

                    let progressBar = document.querySelector('.progress-bar.bg-info');

// Update the width of the progress bar
progressBar.style.width = attendancePercentage + '%';

// Optionally, also update the aria-valuenow attribute
progressBar.setAttribute('aria-valuenow', attendancePercentage);
 

                },
                error: function(xhr, status, error) {
                    console.error("Error fetching data: " + error);
                }
            });
        }

        // Fetch data when the page is loaded
        window.onload = function() {
            fetchAttendanceData();
        };
    </script>

</body>

</html>