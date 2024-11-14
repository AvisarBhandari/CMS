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
    <link rel="stylesheet" href="assets/fonts/typicons.min.css">
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
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark" data-aos="fade-right" data-aos-duration="1200">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#" style="padding-bottom: 0px;padding-top: 0px;">
                    <div class="sidebar-brand-icon rotate-n-15" style="transform: rotate(3deg);"><img src="assets/img/untitled-1.png" width="103" height="110" style="margin-right: -32px;margin-top: -12px;margin-left: -37px;margin-bottom: -6px;"></div>
                    <div class="sidebar-brand-text mx-3"><span style="padding-top: 0px;padding-bottom: 0px;">Academy<br>Keeper</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="index.html"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.html"><i class="fas fa-user" style="font-size: 13px;"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="Courses%20Management.html"><i class="fas fa-book" style="font-size: 13px;"></i><span>Course Management&nbsp;</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="faculty.html"><i class="fas fa-table"></i><span>Faculty Management&nbsp;</span></a><a class="nav-link" href="student.html"><i class="far fa-user" style="font-size: 14px;"></i><span>Student Management&nbsp;</span></a></li>
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
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a class="dropdown-item" href="#"><i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container py-4 py-xl-5">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4" data-aos="fade" data-aos-duration="1150" data-aos-delay="500">
                        <h3 class="text-dark mb-0">Course Management&nbsp;</h3>
                    </div>
                    <div class="row gy-4 row-cols-2 row-cols-md-4 " style="display:flex; gap: 100px;">
                        <div class="col" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="550">
                            <div class="text-center d-flex flex-column justify-content-center align-items-center py-3">
                                <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg">
                                  
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-book">
                                        <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"></path>
                                    </svg>
                                </div>
                                <div class="px-3">
                                    <h2 class="fw-bold mb-0" id="total-courses"></h2>
                                    <p class="mb-0">Total Course&nbsp;</p>
                                </div>
                            </div>
                        </div>
                        <div class="col" data-aos="fade-up-right" data-aos-duration="1200" data-aos-delay="650">
                            <div class="text-center d-flex flex-column justify-content-center align-items-center py-3">
                                <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg">
                                   
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-fire">
                                        <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16m0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15"></path>
                                    </svg>
                                </div>
                                <div class="px-3">
                                    <h2 class="fw-bold mb-0" id="active-courses"></h2>
                                    <p class="mb-0">Active Course&nbsp;</p>
                                </div>
                            </div>
                        </div>
                        <div class="col" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="850">
                            <div class="text-center d-flex flex-column justify-content-center align-items-center py-3">
                                <div class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg">
                                  
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-graph-down">
                                        <path fill-rule="evenodd" d="M0 0h1v15h15v1H0zm14.817 11.887a.5.5 0 0 0 .07-.704l-4.5-5.5a.5.5 0 0 0-.74-.037L7.06 8.233 3.404 3.206a.5.5 0 0 0-.808.588l4 5.5a.5.5 0 0 0 .758.06l2.609-2.61 4.15 5.073a.5.5 0 0 0 .704.07Z"></path>
                                    </svg>
                                </div>
                                <div class="px-3">
                                    <h2 class="fw-bold mb-0" id="inactive-courses"></h2>
                                    <p class="mb-0">Inactive Course&nbsp;</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow" data-aos="flip-up" data-aos-duration="1200" data-aos-delay="500" style="box-shadow: 0px 0px 20px;">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Course List</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-nowrap" style="padding-left: 33px;padding-top: 0px;">
                                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                <div class="dropdown"><button class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1" aria-expanded="false" data-bs-toggle="dropdown" data-bs-auto-close="outside" type="button" id="courseDropdownButton"><svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor" style="width: 24px;height: 24px;font-size: 22px;">
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                                        </svg>&nbsp;Add Course&nbsp;</button>
                                    <div class="dropdown-menu"
                                        style="width: 1076px;box-shadow: 0px 0px 20px 1px;">
                                        <h3 class="text-bg-primary"
                                            id="dropdownbtn" style="margin-top: -8px;height: 58.6px;padding-top: 12px;padding-left: 50%;">
                                            Add course
                                        </h3>
                                        <form action="" method="post" id="courseForm" style="padding-bottom: 0px;">
                                            <div style="margin-top: 30px;margin-right: -1px;">
                                                <div class="container" style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                    <div class="row">
                                                        <div class="col-md-3 col-xxl-1" style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;">
                                                            <strong>Course Code</strong>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input class="form-control" type="text" name="course_code" id="course_code" placeholder="Enter Course Code" required="">
                                                        </div>
                                                        <div class="col-md-3 col-xxl-1" style="margin-left: 210px;padding-top: 7px;">
                                                            <strong>Course Name</strong>
                                                        </div>
                                                        <div class="col-md-3" style="margin-left: 31px;">
                                                            <input class="form-control" type="text" name="course_name" id="course_name" placeholder="Enter Course Name" required="" minlength="2" maxlength="50">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container" style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                    <div class="row">
                                                        <div class="col-md-3 col-xxl-1" style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;">
                                                            <strong>Department</strong>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select class="form-control" name="department" id="department_dropdown" required>
                                                                <option value="">Select Department</option>
                                                                <!-- Options populated through  AJAX -->
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 col-xxl-1" style="margin-left: 210px;padding-top: 7px;">
                                                            <strong>Credits</strong>
                                                        </div>
                                                        <div class="col-md-3" style="margin-left: 31px;">
                                                            <input class="form-control" type="number" name="credits" id="credits" required="" max="8" min="1" step="0.01" placeholder="Enter the Credit Hour">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container" style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                    <div class="row">
                                                        <div class="col-md-3 col-xxl-1" style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;">
                                                            <strong>Semester&nbsp;</strong>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input class="form-control" type="number" name="semester" id="sem" placeholder="Enter the semester" min="1">
                                                        </div>
                                                        <div class="col-md-3 col-xxl-1" style="margin-left: 210px;padding-top: 7px;">
                                                            <strong>Status&nbsp;</strong>
                                                        </div>
                                                        <div class="col-md-3" style="margin-left: 31px;padding-left: 50px;padding-top: 2px;padding-bottom: 0px;margin-top: -3px;">
                                                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                                <input type="radio" id="active_status" class="btn-check" name="course_status" autocomplete="off" value="active">
                                                                <label class="form-label btn btn-outline-primary" for="active_status">Active</label>

                                                                <input type="radio" id="inactive_status" class="btn-check" name="course_status" autocomplete="off" value="inactive">
                                                                <label class="form-label btn btn-outline-primary" for="inactive_status">Inactive</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" id="edit_mode" name="edit_mode" value="add">
                                            <input type="hidden" id="course_id_hidden" name="course_id_hidden">
                                            <input class="btn btn-primary" type="submit" style="margin-left: 807px;" name="add_course" value="Add Course">
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end dataTables_filter" id="dataTable_filter" style="margin-left: 2px;"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                            </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable-1" role="grid" aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Course Code</th>
                                        <th>Course Name</th>
                                        <th>Department</th>
                                        <th>Credits Hour</th>
                                        <th>Semester</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="course_table_body">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td><strong>Course Code</strong></td>
                                        <td><strong>Course Name</strong></td>
                                        <td><strong>Department</strong></td>
                                        <td><strong>Credits Hour</strong></td>
                                        <td><strong>Semester</strong></td>
                                        <td><strong>Status</strong></td>
                                        <td><strong><strong>Actions</strong></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6 align-self-center">
                                <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
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
    <script src="assets/js/Department/department_option.js"></script>
    <script src="assets/js/Course/course_crud.js"></script>
    <script src="assets/js/Course/course_validation.js"></script>
    <script src="assets/js/Course/course_stats.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>