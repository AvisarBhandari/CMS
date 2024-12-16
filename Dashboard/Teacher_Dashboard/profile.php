<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Academy Keeper</title>
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
                    <li class="nav-item"><a class="nav-link active" href="profile.php"><i class="fas fa-user"
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
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4 me-0 pe-5"
                        style="padding-left: 24px; position: relative;">
                        <h3 class="text-dark mb-0" data-aos="flip-left" data-aos-duration="800" data-aos-delay="500"
                            data-aos-once="true">Profile</h3>
                    </div>

                    <div class="container mt-5" id="profile-container" data-aos="flip-left" data-aos-duration="800"
                        data-aos-delay="500" data-aos-once="true">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h4>Faculty Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <p><strong>Faculty ID:</strong> <span id="faculty_id"></span></p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <p><strong>Faculty Name:</strong> <span id="faculty_name"></span></p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <p><strong>Position:</strong> <span id="position"></span></p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <p><strong>Phone Number:</strong> <span id="phone_number"></span></p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <p><strong>Department:</strong> <span id="department"></span></p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <p><strong>Date of Birth:</strong> <span id="dob"></span></p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <p><strong>Start Date:</strong> <span id="start_date"></span></p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <p><strong>Salary:</strong> <span id="salary"></span></p>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <p><strong>Address:</strong> <span id="address"></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <footer class="bg-white sticky-footer">
                        <div class="container my-auto">
                            <div class="text-center my-auto copyright">
                                <span>Copyright © Academy Keeper 2024</span>
                            </div>
                        </div>
                    </footer>
                </div>

                <a class="border rounded d-inline scroll-to-top" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

                <script src="assets/js/jquery.min.js"></script>
                <script src="assets/bootstrap/js/bootstrap.min.js"></script>
                <script src="assets/js/aos.min.js"></script>
                <script src="assets/js/bs-init.js"></script>
                <script src="assets/js/theme.js"></script>
                <script src="assets/js/Profile/profile_data.js"></script>
</body>

</html>