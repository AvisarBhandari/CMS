<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Academy Keeper</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
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
    <?php
    include '../php/db_connect.php';
    session_start();
// Query to get total number of students
$student_query = "SELECT COUNT(*) AS total_students FROM student";
$result_student = $conn->query($student_query);
$total_students = $result_student->num_rows > 0 ? $result_student->fetch_assoc()['total_students'] : 0;

// Query to get total number of faculty members
$faculty_query = "SELECT COUNT(*) AS total_faculty FROM faculty";
$result_faculty = $conn->query($faculty_query);
$total_faculty = $result_faculty->num_rows > 0 ? $result_faculty->fetch_assoc()['total_faculty'] : 0;

// Store data in session variables
$_SESSION['total_students'] = $total_students;
$_SESSION['total_faculty'] = $total_faculty;

$sql = "SELECT COUNT(*) AS TotalAttendance FROM attendance";

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
    $attendancePercentage = ($totalAttendance / $total_students) * 100;
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



$sql = "SELECT COUNT(*) AS departmentCount FROM department";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful and retrieve the result
if ($result->num_rows > 0) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();
    
    $_SESSION['totalCourse'] = $row['departmentCount'];
    
} 
$totalCourse = isset($_SESSION['totalCourse']) ? $_SESSION['totalCourse'] : 0;

    ?>


    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark" data-aos="fade-right" data-aos-duration="1200">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#" style="padding-bottom: 0px;padding-top: 0px;">
                    <div class="sidebar-brand-icon rotate-n-15" style="transform: rotate(3deg);"><img src="assets/img/untitled-1.png" width="103" height="110" style="margin-right: -32px;margin-top: -12px;margin-left: -37px;margin-bottom: -6px;"></div>
                    <div class="sidebar-brand-text mx-3"><span style="padding-top: 0px;padding-bottom: 0px;">Academy<br>Keeper</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link active" href="index.html"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.html"><i class="fas fa-user" style="font-size: 13px;"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="Courses%20Management.html"><i class="fas fa-book" style="font-size: 13px;"></i><span>Course Management&nbsp;</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="faculty.html"><i class="fas fa-table"></i><span>Faculty Management&nbsp;</span></a><a class="nav-link" href="student.html"><i class="far fa-user" style="font-size: 14px;"></i><span>StudentManagement&nbsp;</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-expand bg-white shadow mb-4 topbar">
                    <div class="container-fluid">
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search" data-aos="slide-down" data-aos-duration="1200" data-aos-delay="400">
                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ..." style="height: 38.6px;"><button class="btn btn-primary py-0" type="button" style="width: 42.6px;height: 37.6px;"><i class="fas fa-search"></i></button></div>
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light border-0 form-control small" type="text" placeholder="Search for ..."><button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button></div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">alerts center</h6><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 12, 2019</span>
                                                <p>A new monthly report is ready to download!</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 7, 2019</span>
                                                <p>$290.29 has been deposited into your account!</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="me-3">
                                                <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                                            </div>
                                            <div><span class="small text-gray-500">December 2, 2019</span>
                                                <p>Spending Alert: We've noticed unusually high spending for your account.</p>
                                            </div>
                                        </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="badge bg-danger badge-counter">7</span><i class="fas fa-envelope fa-fw"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end dropdown-list animated--grow-in">
                                        <h6 class="dropdown-header">alerts center</h6><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar4.jpeg">
                                                <div class="bg-success status-indicator"></div>
                                            </div>
                                            <div class="fw-bold">
                                                <div class="text-truncate"><span>Hi there! I am wondering if you can help me with a problem I've been having.</span></div>
                                                <p class="small text-gray-500 mb-0">Emily Fowler - 58m</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar2.jpeg">
                                                <div class="status-indicator"></div>
                                            </div>
                                            <div class="fw-bold">
                                                <div class="text-truncate"><span>I have the photos that you ordered last month!</span></div>
                                                <p class="small text-gray-500 mb-0">Jae Chun - 1d</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar3.jpeg">
                                                <div class="bg-warning status-indicator"></div>
                                            </div>
                                            <div class="fw-bold">
                                                <div class="text-truncate"><span>Last month's report looks great, I am very happy with the progress so far, keep up the good work!</span></div>
                                                <p class="small text-gray-500 mb-0">Morgan Alvarez - 2d</p>
                                            </div>
                                        </a><a class="dropdown-item d-flex align-items-center" href="#">
                                            <div class="dropdown-list-image me-3"><img class="rounded-circle" src="assets/img/avatars/avatar5.jpeg">
                                                <div class="bg-success status-indicator"></div>
                                            </div>
                                            <div class="fw-bold">
                                                <div class="text-truncate"><span>Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</span></div>
                                                <p class="small text-gray-500 mb-0">Chicken the Dog · 2w</p>
                                            </div>
                                        </a><a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                                    </div>
                                </div>
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">Valerie Luna</span><img class="border rounded-circle img-profile" src="assets/img/avatars/avatar.png"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="profile.html"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4" data-aos="fade" data-aos-duration="1200" data-aos-delay="500" style="padding-right: 5px;">
                        <h3 class="text-dark mb-0">Admin Dashboard</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                    </div>
                    <div class="row" data-aos="fade" data-aos-duration="1200" data-aos-delay="500">
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-primary py-2" style="box-shadow: 0px 0px;">
                                <div class="card-body">
                                    <div class="row g-0 align-items-center">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Total Student</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>
                                                    <?php
                                                    echo $total_students;
                                                    ?>
                                                </span></div>
                                        </div>
                                        <div class="col-auto"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person fa-2x text-gray-300">
                                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"></path>
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
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Total Faculty</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>
                                                    <?php
                                                    echo $total_faculty;
                                                    ?>
                                                </span></div>
                                        </div>
                                        <div class="col-auto"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" class="fa-2x text-gray-300">
                                                
                                                <path d="M112 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm40 304V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V256.9L59.4 304.5c-9.1 15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l58.3-97c17.4-28.9 48.6-46.6 82.3-46.6h29.7c33.7 0 64.9 17.7 82.3 46.6l58.3 97c9.1 15.1 4.2 34.8-10.9 43.9s-34.8 4.2-43.9-10.9L232 256.9V480c0 17.7-14.3 32-32 32s-32-14.3-32-32V352H152z"></path>
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
                                            <div class="text-uppercase text-info fw-bold text-xs mb-1"><span>Attendance Rate</span></div>
                                            <div class="row g-0 align-items-center">
                                                <div class="col-auto">
                                                    <div class="text-dark fw-bold h5 mb-0 me-3"><span>
                                                            <?php
                                                            echo $attendancePercentage . "%";
                                                            ?>
                                                        </span></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm">
                                                        <div class="progress-bar bg-info" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"
                                                            style="width: 
                                                        <?php
                                                        echo $attendancePercentage . "%";
                                                        ?>
                                                        ;"><span class="visually-hidden">50%</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-clipboard-list fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow border-left-warning py-2">
                                <div class="card-body">
                                    <div class="row g-0 align-items-center">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-warning fw-bold text-xs mb-1"><span>Total Courses</span></div>
                                            <div class="text-dark fw-bold h5 mb-0"><span>
                                                    <?php
                                                    echo $totalCourse;
                                                    ?>
                                                </span></div>
                                        </div>
                                        <div class="col-auto"><i class="fas fa-book fa-2x text-gray-300"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" data-aos="fade">
                        <div class="col-lg-7 col-xl-8" data-aos="fade-right" data-aos-duration="1200">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center" style="height: 57.4px;">
                                    <h6 class="text-primary fw-bold m-0">Earnings Overview</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container" style="position: relative; height: 300px ;">
                                        <canvas id="earningsChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-xl-4" data-aos="fade-left" data-aos-duration="1200">
                            <div class="card shadow-lg mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center bg-light" style="height: 57.4px;">
                                    <h6 class="text-dark fw-bold m-0">Students Fee Payment Overview</h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="chart-area">
                                        <canvas id="feechart" style="margin-left: 100px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow mb-4" data-aos="fade-right" data-aos-duration="1200">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Progress Summary</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small fw-bold">Enrollment Progress<span class="float-end">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"><span class="visually-hidden">20%</span></div>
                                    </div>
                                    <h4 class="small fw-bold">Course Completion<span class="float-end">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="visually-hidden">40%</span></div>
                                    </div>
                                    <h4 class="small fw-bold">Faculty Performance<span class="float-end">60%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-primary" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="visually-hidden">60%</span></div>
                                    </div>
                                    <h4 class="small fw-bold">Payout Details<span class="float-end">80%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-info" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="visually-hidden">80%</span></div>
                                    </div>
                                    <h4 class="small fw-bold">Syllabus Updates<span class="float-end">Complete!</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-success" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="visually-hidden">100%</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card shadow mb-4" data-aos="fade-right" data-aos-duration="1200" style="box-shadow: 0px 0px 20px;">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Upcoming Events</h6>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-xxl-9 me-2">
                                                <h6 class="text-info mb-0">Nov 10</h6><small>College Open Day</small>
                                            </div>
                                            <div class="col"><a id="edit" class="event_action" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-edit text-warning pt-xxl-0 mt-xxl-0" style="font-size: 27px;padding-top: 0px;margin-top: -13px;">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                        <path d="M16 5l3 3"></path>
                                                    </svg></a><a id="delete" class="event_action" href="#"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor" class="text-danger pt-xxl-0 mt-xxl-0" style="font-size: 29px;margin-left: 11px;margin-top: -8px;">
                                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                        <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"></path>
                                                    </svg></a></div>
                                        </div><span class="text-xs">10:30 AM</span>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-xxl-9 me-2">
                                                <h6 class="text-info mb-0">Nov 15&nbsp;</h6><small>First-term Exams Start</small>
                                            </div>
                                            <div class="col"><a id="edit-1" class="event_action" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-edit text-warning pt-xxl-0 mt-xxl-0" style="font-size: 27px;padding-top: 0px;margin-top: -13px;">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                        <path d="M16 5l3 3"></path>
                                                    </svg></a><a id="delete-1" class="event_action" href="#"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor" class="text-danger pt-xxl-0 mt-xxl-0" style="font-size: 29px;margin-left: 11px;margin-top: -8px;">
                                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                        <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"></path>
                                                    </svg></a></div>
                                        </div><span class="text-xs">11:30 AM</span>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-xxl-9 me-2">
                                                <h6 class="text-info mb-0">Nov 20</h6><small>Faculty Meeting</small>
                                            </div>
                                            <div class="col"><a id="edit" class="event_action" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-edit text-warning pt-xxl-0 mt-xxl-0" style="font-size: 27px;padding-top: 0px;margin-top: -13px;">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                        <path d="M16 5l3 3"></path>
                                                    </svg></a><a id="delete" class="event_action" href="#"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor" class="text-danger pt-xxl-0 mt-xxl-0" style="font-size: 29px;margin-left: 11px;margin-top: -8px;">
                                                        <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                        <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z"></path>
                                                    </svg></a></div>
                                        </div><span class="text-xs">11:30 AM</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow mb-4"></div>
                            <div class="card shadow mb-4" data-aos="fade-left" data-aos-duration="1200" style="padding-bottom: 0px;height: 267.7px;width: 417.8px;margin-left: 74px;box-shadow: 0px 0px 20px;">
                                <div class="card-header py-3">
                                    <h6 class="text-primary fw-bold m-0">Quick Actions</h6>
                                </div>
                                <div class="card-body pb-xxl-0 mb-xxl-5">
                                    <div class="dropdown" style="margin-left: 112px;"><button class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1" aria-expanded="false" data-bs-toggle="dropdown" data-bs-auto-close="outside" type="button"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor" style="width: 24px;height: 24px;font-size: 22px;">
                                                <path d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                                            </svg>&nbsp;Add Course&nbsp;</button>
                                        <div class="dropdown-menu" style="width: 1076px;box-shadow: 0px 0px 20px 1px;">
                                            <form style="padding-bottom: 0px;">
                                                <h3 class="text-bg-primary" style="margin-top: -8px;height: 58.6px;padding-top: 12px;padding-left: 50%;"><strong><span style="color: rgba(var(--bs-primary-rgb), var(--bs-text-opacity));">Add Course&nbsp;</span></strong></h3>
                                                <div style="margin-top: 30px;margin-right: -1px;">
                                                    <div class="container" style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                        <div class="row">
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;"><strong>Course Code</strong></div>
                                                            <div class="col-md-3"><input class="form-control" type="number" name="course_code" placeholder="Enter Course Code" required=""></div>
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 210px;padding-top: 7px;"><strong>Course Name</strong></div>
                                                            <div class="col-md-3" style="margin-left: 31px;"><input class="form-control" type="text" name="course_name" placeholder="Enter Course Name" required="" minlength="2" maxlength="25"></div>
                                                        </div>
                                                    </div>
                                                    <div class="container" style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                        <div class="row">
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;"><strong>Department</strong></div>
                                                            <div class="col-md-3"><input class="form-control" type="text" required="" name="department" autofocus="" autocomplete="off" placeholder="Enter Department Name" minlength="2" maxlength="25"></div>
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 210px;padding-top: 7px;"><strong>Credits</strong></div>
                                                            <div class="col-md-3" style="margin-left: 31px;"><input class="form-control" type="number" name="credits" required="" placeholder="Enter the Credit score " max="100" min="1"></div>
                                                        </div>
                                                    </div>
                                                    <div class="container" style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                        <div class="row">
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;"><strong>Semester&nbsp;</strong></div>
                                                            <div class="col-md-3"><input class="form-control" type="number" name="sem" placeholder="Enter the semester " min="1"></div>
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 210px;padding-top: 7px;"><strong>Status&nbsp;</strong></div>
                                                            <div class="col-md-3" style="margin-left: 31px;padding-left: 50px;padding-top: 2px;padding-bottom: 0px;margin-top: -3px;">
                                                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group"><input type="radio" id="btnradio1-1" class="btn-check" name="btnradio" autocomplete="off" checked="" value="active"><label class="form-label btn btn-outline-primary" for="btnradio1">Active</label><input type="radio" id="btnradio2-1" class="btn-check" name="btnradio" autocomplete="off" value="in_active"><label class="form-label btn btn-outline-primary" for="btnradio2-1">IN Active</label></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><input class="btn btn-primary" type="submit" style="margin-left: 807px;" name="Add Course " value="Add Course ">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="dropdown" style="margin-left: 112px;"><button class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1" aria-expanded="false" data-bs-toggle="dropdown" type="button"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor" style="width: 24px;height: 24px;font-size: 22px;">
                                                <path d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                                            </svg>&nbsp;Add Faculty</button>
                                        <div class="dropdown-menu" style="width: 1076px;box-shadow: 0px 0px 20px 1px;">
                                            <h3 class="text-light text-bg-primary" style="padding-left: 43%;padding-top: 4px;margin-top: -8px;margin-bottom: 14px;height: 41.6px;">Add Faculty</h3>
                                            <form style="padding-bottom: 0px;">
                                                <div style="margin-top: 30px;margin-right: -1px;">
                                                    <div class="container" style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                        <div class="row">
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;"><strong>Faculty ID</strong></div>
                                                            <div class="col-md-3"><input class="form-control" type="text" name="teacher_code" placeholder="Enter Faculty ID" required="" min="8" max="8" pattern="^TEA-\d{4}-\d{4}$" maxlength="13" minlength="1" autofocus=""></div>
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 210px;padding-top: 7px;"><strong>Faculty Name</strong></div>
                                                            <div class="col-md-3" style="margin-left: 31px;"><input class="form-control" type="text" name="teacher_name" placeholder="Enter Faculty Name" required="" minlength="2" maxlength="25" autofocus=""></div>
                                                        </div>
                                                    </div>
                                                    <div class="container" style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                        <div class="row">
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;"><strong>Position</strong></div>
                                                            <div class="col-md-3"><input class="form-control" type="text" required="" name="position" autofocus="" autocomplete="off" placeholder="Enter Position Name" minlength="2" maxlength="25"></div>
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 210px;padding-top: 7px;"><strong>Address&nbsp;</strong></div>
                                                            <div class="col-md-3" style="margin-left: 31px;"><input class="form-control" type="number" name="address " required="" placeholder="Enter Address" min="1" max="25"></div>
                                                        </div>
                                                    </div>
                                                    <div class="container" style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                        <div class="row mb-xxl-3">
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;"><strong>D.O.B</strong></div>
                                                            <div class="col-md-3"><input class="form-control" type="date" name="dob" required=""></div>
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 210px;padding-top: 7px;"><strong>Start date&nbsp;</strong></div>
                                                            <div class="col-md-3 ps-xxl-1" style="margin-left: 31px;padding-left: 50px;padding-top: 2px;padding-bottom: 0px;margin-top: -3px;"><input class="form-control" type="date" style="width: 247.85px;" required=""></div>
                                                        </div>
                                                    </div>
                                                    <div class="container" style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                        <div class="row mb-xxl-3">
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;"><strong>Salary&nbsp;</strong></div>
                                                            <div class="col-md-3"><input class="form-control" type="number" name="salary" min="3" max="8" placeholder="Enter the Salary" required=""></div>
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 210px;padding-top: 7px;"><strong>Phone number&nbsp;</strong></div>
                                                            <div class="col-md-3 ps-xxl-1" style="margin-left: 31px;padding-left: 50px;padding-top: 2px;padding-bottom: 0px;margin-top: -3px;"><input class="form-control" type="tel" name="Phone_no" placeholder="Enter the Phone Number " required="" pattern="(98|97)\d{8}$" maxlength="13" minlength="10"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form><input class="btn btn-primary" type="submit" style="margin-left: 807px;" name="Add Course " value="Add Faculty ">
                                        </div>
                                    </div>
                                    <div class="dropdown" style="margin-left: 112px;"><button class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1" aria-expanded="false" data-bs-toggle="dropdown" type="button"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor" style="width: 24px;height: 24px;font-size: 22px;">
                                                <path d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                                            </svg>&nbsp;Manage Events&nbsp;</button>
                                        <div class="dropdown-menu" style="width: 1076px;box-shadow: 0px 0px 20px 1px;">
                                            <form style="padding-bottom: 0px;">
                                                <h3 class="text-bg-primary" style="margin-top: -8px;height: 46.6px;padding-top: 6px;padding-left: 50%;"><strong><span style="color: rgba(var(--bs-primary-rgb), var(--bs-text-opacity));">Add Event</span></strong></h3>
                                                <div style="margin-top: 30px;margin-right: -1px;width: 1130.4px;"></div>
                                            </form>
                                            <div class="container" style="padding-bottom: 0px;margin-bottom: 24px;">
                                                <div class="row">
                                                    <div class="col-md-6 col-xxl-4"><strong>Date of Event</strong></div>
                                                    <div class="col-md-6"><input class="form-control-lg" type="date" name="event_date" value="event" required=""></div>
                                                </div>
                                            </div>
                                            <div class="container" style="padding-bottom: 0px;margin-bottom: 24px;">
                                                <div class="row">
                                                    <div class="col-md-6 col-xxl-4" style="padding-top: 22px;"><strong>Event Name</strong></div>
                                                    <div class="col-md-6"><textarea style="width: 638.4px;height: 71.4px;" required=""></textarea></div>
                                                </div>
                                            </div><input class="btn btn-primary" type="submit" style="margin-left: 807px;" name="Add Course " value="Add Faculty ">
                                        </div>
                                    </div>
                                    <div class="dropdown" style="margin-left: 112px;"><button class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1" aria-expanded="false" data-bs-toggle="dropdown" data-bs-auto-close="outside" type="button"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor" style="width: 24px;height: 24px;font-size: 22px;">
                                                <path d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                                            </svg>&nbsp;Add Student</button>
                                        <div class="dropdown-menu" style="width: 1076px;box-shadow: 0px 0px 20px 1px;">
                                            <h3 class="text-light text-bg-primary" style="padding-left: 43%;padding-top: 4px;margin-top: -8px;margin-bottom: 14px;height: 41.6px;">Add Faculty</h3>
                                            <form style="padding-bottom: 0px;">
                                                <div style="margin-top: 30px;margin-right: -1px;">
                                                    <div class="container" style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                        <div class="row">
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;"><strong>Student ID</strong></div>
                                                            <div class="col-md-3"><input class="form-control" type="text" name="student_code" placeholder="Enter Student ID" required="" min="8" max="8" pattern="^STU\d{4}-\d{4}$" maxlength="13" minlength="1" autofocus=""></div>
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 210px;padding-top: 7px;"><strong>StudentName</strong></div>
                                                            <div class="col-md-3" style="margin-left: 31px;"><input class="form-control" type="text" name="student_name" placeholder="Enter StudentName" required="" minlength="2" maxlength="25" autofocus=""></div>
                                                        </div>
                                                    </div>
                                                    <div class="container" style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                        <div class="row">
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;"><strong>Department&nbsp;</strong></div>
                                                            <div class="col-md-3"><select class="border rounded form-select" name="dep" required="" autofocus="">
                                                                    <optgroup label="Department ">
                                                                        <option value="" selected="">Department </option>
                                                                        <option value="bca">BCA</option>
                                                                        <option value="bbs">BBS</option>
                                                                    </optgroup>
                                                                </select></div>
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 210px;padding-top: 7px;"><strong>Address&nbsp;</strong></div>
                                                            <div class="col-md-3" style="margin-left: 31px;"><input class="form-control" type="number" name="student_address " required="" placeholder="Enter Address"></div>
                                                        </div>
                                                    </div>
                                                    <div class="container" style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                        <div class="row mb-xxl-3">
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;"><strong>D.O.B</strong></div>
                                                            <div class="col-md-3"><input class="form-control" type="date" name="student_dob" required=""></div>
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 210px;padding-top: 7px;"><strong>Admission Date</strong></div>
                                                            <div class="col-md-3 ps-xxl-1" style="margin-left: 31px;padding-left: 50px;padding-top: 2px;padding-bottom: 0px;margin-top: -3px;"><input class="form-control" type="date" style="width: 247.85px;" required="" name="student_start"></div>
                                                        </div>
                                                    </div>
                                                    <div class="container" style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                        <div class="row mb-xxl-3">
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;"><strong>Monthly Fees&nbsp;</strong></div>
                                                            <div class="col-md-3"><input class="form-control" type="number" name="monthly_fees" placeholder="Enter the Fees" required=""></div>
                                                            <div class="col-md-3 col-xxl-1" style="margin-left: 210px;padding-top: 7px;"><strong>Phone number&nbsp;</strong></div>
                                                            <div class="col-md-3 ps-xxl-1" style="margin-left: 31px;padding-left: 50px;padding-top: 2px;padding-bottom: 0px;margin-top: -3px;"><input class="form-control" type="tel" name="Phone_no" placeholder="Enter the Phone Number " required="" pattern="(98|97)\d{8}$" maxlength="13" minlength="10"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form><input class="btn btn-primary" type="submit" style="margin-left: 807px;" name="Add Course " value="Add Faculty ">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body pb-xxl-0 mb-xxl-5"></div>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



</body>

</html>