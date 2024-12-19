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
    <link rel="stylesheet" href="assets/css/subject_table.css">
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
                    <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user"
                                style="font-size: 13px;"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="Courses%20Management.php"><i
                                class="fas fa-book" style="font-size: 13px;"></i><span>Course
                                Management&nbsp;</span></a></li>
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
                            <li class="nav-item dropdown no-arrow mx-1"></li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end"
                                    aria-labelledby="alertsDropdown"></div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
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
                <div class="d-sm-flex justify-content-between align-items-center mb-4 ms-0 ps-5 pe-5" data-aos="fade"
                    data-aos-duration="1150" data-aos-delay="500">
                    <h3 class="text-dark mb-0" data-aos="fade-right" data-aos-duration="650" data-aos-delay="500"
                        data-aos-once="true">Course Management&nbsp;</h3>
                </div>
                <div class="card shadow" data-aos="flip-up" data-aos-duration="1200" data-aos-delay="500"
                    style="box-shadow: 0px 0px 20px;">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Course List <span id="dept_name"></span></p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-nowrap" style="padding-left: 33px;padding-top: 0px;">
                                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                <div class="dropdown"><button
                                        class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1"
                                        aria-expanded="false" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                        type="button"><svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                            viewBox="0 0 24 24" width="1em" fill="currentColor"
                                            style="width: 24px;height: 24px;font-size: 22px;">
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                                        </svg>&nbsp;Add Assignments&nbsp;</button>
                                    <div class="dropdown-menu" style="width: 1076px;box-shadow: 0px 0px 20px 1px;">
                                        <form style="padding-bottom: 0px;">
                                            <h3 class="text-bg-primary"
                                                style="margin-top: -8px;height: 58.6px;padding-top: 12px;padding-left: 50%;">
                                                <strong><span
                                                        style="color: rgba(var(--bs-primary-rgb), var(--bs-text-opacity));">Add&nbsp;</span>Assignments<span
                                                        style="color: rgba(var(--bs-primary-rgb), var(--bs-text-opacity));">&nbsp;</span></strong>
                                            </h3>
                                            <div style="margin-top: 30px;margin-right: -1px;">
                                                <div class="container"
                                                    style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                    <div class="row">
                                                        <div class="col-md-3 col-xxl-1"
                                                            style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;">
                                                            <strong>Course Code</strong>
                                                        </div>
                                                        <div class="col-md-3"><input class="form-control" type="number"
                                                                name="course_code" placeholder="Enter Course Code"
                                                                required=""></div>
                                                        <div class="col-md-3 col-xxl-1"
                                                            style="margin-left: 210px;padding-top: 7px;"><strong>Course
                                                                Name</strong></div>
                                                        <div class="col-md-3" style="margin-left: 31px;"><input
                                                                class="form-control" type="text" name="course_name"
                                                                placeholder="Enter Course Name" required=""
                                                                minlength="2" maxlength="25"></div>
                                                    </div>
                                                </div>
                                                <div class="container"
                                                    style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                    <div class="row">
                                                        <div class="col-md-3 col-xxl-1"
                                                            style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;">
                                                            <strong>Department</strong>
                                                        </div>
                                                        <div class="col-md-3"><input class="form-control" type="text"
                                                                required="" name="department" autofocus=""
                                                                autocomplete="off" placeholder="Enter Department Name"
                                                                minlength="2" maxlength="25"></div>
                                                        <div class="col-md-3 col-xxl-1"
                                                            style="margin-left: 210px;padding-top: 7px;">
                                                            <strong>Credits</strong>
                                                        </div>
                                                        <div class="col-md-3" style="margin-left: 31px;"><input
                                                                class="form-control" type="number" name="credits"
                                                                required="" placeholder="Enter the Credit score "
                                                                max="100" min="1"></div>
                                                    </div>
                                                </div>
                                                <div class="container"
                                                    style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                    <div class="row">
                                                        <div class="col-md-3 col-xxl-1"
                                                            style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;">
                                                            <strong>Semester&nbsp;</strong>
                                                        </div>
                                                        <div class="col-md-3"><input class="form-control" type="number"
                                                                name="sem" placeholder="Enter the semester " min="1">
                                                        </div>
                                                        <div class="col-md-3 col-xxl-1"
                                                            style="margin-left: 210px;padding-top: 7px;">
                                                            <strong>Assignments&nbsp;</strong>
                                                        </div>
                                                        <div class="col-md-3"
                                                            style="margin-left: 31px;padding-left: 50px;padding-top: 2px;padding-bottom: 0px;margin-top: -3px;">
                                                            <input class="form-control" type="file">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><input class="btn btn-primary" type="submit"
                                                style="margin-left: 807px;" name="Add Course " value="Add Course ">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end dataTables_filter" id="dataTable_filter"
                                    style="margin-left: 2px;"><label class="form-label"><input type="search"
                                            class="form-control form-control-sm" aria-controls="dataTable"
                                            placeholder="Search"></label></div>
                            </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable-1" role="grid"
                            aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Course Code</th>
                                        <th>Course Name</th>
                                        <th>Credits</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="course-list">

                                </tbody>
                            </table>
                        </div>

                        <div id="options" style="margin-top: 50px;">
                        <div class="form-group">
                            <label for="courseSelect">Select Course:</label>
                            <select class="form-control" id="courseSelect">
                                <!-- Options will be dynamically loaded -->
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="semesterSelect">Select Semester:</label>
                            <select class="form-control" id="semesterSelect">
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
                        </div>
                        
                        <div class="table-responsive table mt-2" id="dataTable-1" role="grid"
                            aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <p id="subject">Subjects</p>
                                <thead>
                                    <tr>
                                    <tr>
                                        <th>Subject Code</th>
                                        <th>Subject Name</th>
                                        <th>Credits</th>
                                        <th>Syllabus Status</th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody id="subjectsTableBody">

                                </tbody>
                            </table>
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
    <script src="assets/js/Course_data/fetch_courses.js"></script>
    <script src="assets/js/Course_data/fetch_subjects.js"></script>
</body>

</html>