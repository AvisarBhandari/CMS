<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Academy Keeper</title>
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
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark" data-aos="fade-right" data-aos-duration="1200" data-aos-once="true">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#" style="padding-bottom: 0px;padding-top: 0px;">
                    <div class="sidebar-brand-icon rotate-n-15" style="transform: rotate(3deg);"><img src="assets/img/untitled-1.png" width="103" height="110" style="margin-right: -32px;margin-top: -12px;margin-left: -37px;margin-bottom: -6px;"></div>
                    <div class="sidebar-brand-text mx-3"><span style="padding-top: 0px;padding-bottom: 0px;">Academy<br>Keeper</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user" style="font-size: 13px;"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="Courses%20Management.php"><i class="fas fa-book" style="font-size: 13px;"></i><span>Course Management&nbsp;</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="student.php"><i class="far fa-user" style="font-size: 14px;"></i><span><strong>Student Management&nbsp;</strong>&nbsp;</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="exam.php"><i class="fas fa-table"></i><span>Examination</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="time_table.php"><i class="fas fa-calendar-alt" style="font-size: 13px;"></i><span>Time Table&nbsp;</span></a></li>
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
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><span class="d-none d-lg-inline me-2 text-gray-600 small">xyz</span><img class="border rounded-circle img-profile" src="assets/img/untitled-1.png"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="d-sm-flex justify-content-between align-items-center mb-4 me-0 pe-5" style="padding-left: 24px;position: relative;" zin="">
                    <h3 class="text-dark mb-0" data-aos="fade-right" data-aos-duration="800" data-aos-delay="500" data-aos-once="true">Student</h3><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" data-aos="fade-left" data-aos-duration="550" data-aos-delay="650" data-aos-once="true" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                </div>
                <div class="container-fluid" data-aos="fade-up" data-aos-duration="2000" data-aos-delay="400" data-aos-once="true">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 fw-bold">Students list</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 text-nowrap">
                                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                                </div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>ID</th>
                                            <th>Assignment&nbsp;</th>
                                            <th>Address&nbsp;</th>
                                            <th>Attendance</th>
                                            <th>Admission Date</th>
                                            <th>Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Airi Satou</td>
                                            <td>12313131</td>
                                            <td><a class="link-primary" href="#" target="_blank" style="font-size: 20px;font-family: Nunito, sans-serif;">SUBMITTED</a></td>
                                            <td>Parsa</td>
                                            <td class="text-success ps-0 mt-0 pb-0 pe-0 me-0 pt-0">&nbsp;<button class="btn btn-danger ms-0 mb-0 mt-0" style="border: none;width: 80px;height: 40px;margin-left: 14px;background-color: #3abaa1;color: rgb(255,255,255);margin-top: 12px;" type="button">Present</button></td>
                                            <td>2008/11/28</td>
                                            <td>A</td>
                                        </tr>
                                        <tr>
                                            <td>Angelica Ramos</td>
                                            <td>12312312</td>
                                            <td><a class="link-primary" href="#" target="_blank" style="font-size: 20px;font-family: Nunito, sans-serif;"><span style="color: RGBA(62, 92, 178, var(--bs-link-opacity, 1));">SUBMITTED</span></a></td>
                                            <td class="text-success-emphasis">parsa</td>
                                            <td class="text-success ps-0 pt-0 pb-0"><button class="btn btn-danger ms-0 mb-0 mt-0" style="border: none;width: 80px;height: 40px;margin-left: 14px;background-color: #3abaa1;color: rgb(255,255,255);margin-top: 12px;" type="button">Present</button></td>
                                            <td>2009/10/09<br></td>
                                            <td>B</td>
                                        </tr>
                                        <tr>
                                            <td>Ashton Cox</td>
                                            <td>1231231</td>
                                            <td><a class="link-primary" href="#" target="_blank" style="font-size: 20px;font-family: Nunito, sans-serif;"><span style="color: RGBA(62, 92, 178, var(--bs-link-opacity, 1));">SUBMITTED</span></a></td>
                                            <td>Parsa</td>
                                            <td class="text-success ps-0 pt-0 pb-0 me-0 pe-0"><button class="btn btn-danger ms-0 mb-0 mt-0" style="border: none;width: 80px;height: 40px;margin-left: 14px;background-color: #3abaa1;color: rgb(255,255,255);margin-top: 12px;" type="button">Present</button></td>
                                            <td>2009/01/12<br></td>
                                            <td>C</td>
                                        </tr>
                                        <tr>
                                            <td>Bradley Greer</td>
                                            <td>12312313</td>
                                            <td style="font-size: 19px;color: var(--bs-danger);">DUE</td>
                                            <td>Bhandara</td>
                                            <td class="text-danger ps-0 pt-0 pb-0 pe-0"><button class="btn btn-danger ms-0 mb-0" style="border: none;width: 80px;height: 40px;background-color: #e86767;" type="button">Absent</button></td>
                                            <td>2012/10/13<br></td>
                                            <td>D</td>
                                        </tr>
                                        <tr>
                                            <td>Brenden Wagner</td>
                                            <td>13123131</td>
                                            <td style="font-size: 19px;color: var(--bs-danger);">DUE</td>
                                            <td>Tandi</td>
                                            <td class="text-danger pe-0 pt-0 ps-0 pb-0"><button class="btn btn-danger ms-0 mb-0" style="border: none;width: 80px;height: 40px;background-color: #e86767;" type="button">Absent</button></td>
                                            <td>2011/06/07<br></td>
                                            <td>E</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><strong>Name</strong></td>
                                            <td><strong>ID</strong></td>
                                            <td><strong>Assignment&nbsp;</strong></td>
                                            <td><strong>Address&nbsp;</strong></td>
                                            <td><strong>Attendance&nbsp;</strong></td>
                                            <td><strong><strong><span style="color: rgb(133, 135, 150);">Admission Date</span></strong></strong></td>
                                            <td><strong>Grade</strong></td>
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
</body>

</html>