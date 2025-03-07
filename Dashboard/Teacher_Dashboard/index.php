<?php session_start();?>
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
                    <li class="nav-item"><a class="nav-link" href="Courses%20Management.php"><i class="fas fa-book"
                                style="font-size: 13px;"></i><span>Course Management&nbsp;</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="student.php"><i class="far fa-user"
                                style="font-size: 14px;"></i><span><strong>Student
                                    Management&nbsp;</strong>&nbsp;</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="exam.php"><i
                                class="fas fa-table"></i><span>Examination</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="time_table.php"><i class="fas fa-calendar-alt"
                                style="font-size: 13px;"></i><span>Time Table&nbsp;</span></a></li>
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
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                        aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                                            class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $_SESSION['name'];?></span><img
                                            class="border rounded-circle img-profile"
                                            src="assets/img/untitled-1.png"></a>
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
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4" style="padding-right: 5px;">
                        <h3 class="text-dark mb-0" data-aos="fade-right" data-aos-duration="600" data-aos-delay="500"
                            data-aos-once="true">Faculty Dashboard</h3>
                    </div>
                    <div class="row mt-0">

                        <div class="container mt-5" id="course-info-container"
                            style="display: flex; flex-wrap: wrap; justify-content: flex-start;">

                            <div class="col-md-6 col-xl-3 col-xxl-3 mb-4 ms-5" data-aos="fade-left"
                                data-aos-duration="650" data-aos-delay="500" data-aos-once="true">
                                <div class="card shadow border-left-info py-2">
                                    <div class="card-body">
                                        <div class="row g-0 align-items-center">
                                            <div class="col me-2">
                                                <div class="text-uppercase text-info fw-bold text-xs mb-1">
                                                    <span>Salary</span>
                                                </div>
                                                <div class="row g-0 align-items-center">
                                                    <div class="col-auto">
                                                        <div class="text-dark fw-bold h5 mb-0 me-3"><span
                                                                id="salary_amount">₹0.00</span></div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div id="payment_status" class="fw-bold text-red">Not Paid</div>
                                                    </div>
                                                </div>
                                                <div class="row g-0 align-items-center mt-2">
                                                    <div class="col-auto">
                                                        <div class="progress progress-sm">
                                                            <div class="progress-bar bg-info" id="salary_progress_bar"
                                                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                                                style="width: 0%;">
                                                                <span class="visually-hidden">0%</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-xl-4" data-aos="fade-right" data-aos-duration="550"
                            data-aos-delay="200" data-aos-once="true">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center"
                                    style="height: 57.4px;">
                                    <h6 class="text-primary fw-bold m-0">This Month Attendance</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area"><canvas id="attendanceChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col" data-aos="fade-left" data-aos-duration="550" data-aos-delay="400"
                            data-aos-once="true">
                            <div class="col-lg-6 mb-4" data-aos="fade-left" data-aos-duration="650" data-aos-delay="550"
                                data-aos-once="true">
                                <div class="card shadow mb-4" data-aos="fade-right" data-aos-duration="1200"></div>
                                <div class="card shadow mb-4 upcoming-events-card" data-aos="fade-right"
                                    data-aos-duration="1200" style="box-shadow: 0px 0px 20px;">
                                    <div class="card-header py-3">
                                        <h6 class="text-primary fw-bold m-0">Upcoming Events</h6>
                                    </div>
                                    <ul class="list-group list-group-flush" id="events-list">
                                        <!-- Events will be dynamically loaded here -->
                                    </ul>
                                </div>
                            </div>



                            <div class="col-lg-6 mb-4" data-aos="fade-left" data-aos-duration="650" data-aos-delay="550"
                                data-aos-once="true">
                                <div class="card shadow mb-4" data-aos="fade-right" data-aos-duration="1200"></div>
                                <div class="card shadow mb-4" data-aos="fade-right" data-aos-duration="1200"
                                    style="box-shadow: 0px 0px 20px;">
                                    <div class="card-header py-3">
                                        <h6 class="text-primary fw-bold m-0">Upcoming Holidays</h6>
                                    </div>
                                    <ul class="list-group list-group-flush" id="holiday-list">
                                        <!-- Holidays will be dynamically loaded here -->
                                    </ul>
                                </div>
                            </div>
                        </div>
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
    <script src="assets/js/Events/fetch_events.js"></script>
    <script src="assets/js/Events/fetch_holidays.js"></script>
    <script src="assets/js/Profile/attendance_data.js"></script>
    <script src="assets/js/Student_data/student_data_display.js"></script>
    <script src="assets/js/Profile/salary_data.js"></script>
</body>

</html>