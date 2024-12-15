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
    <link rel="stylesheet" href="assets/css/fee_table.css">

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
                <ul class="navbar-nav text-light" id="accordionSidebar-1">
                    <li class="nav-item"><a class="nav-link active" href="index.php"><i
                                class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user"
                                style="font-size: 13px;"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="time_table.php"><i class="fas fa-calendar-alt"
                                style="font-size: 13px;"></i><span>Time Table&nbsp;</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="exam.php"><i
                                class="fas fa-table"></i><span>Examination</span></a><a class="nav-link"
                            href="Courses%20Management.php"><svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-book">
                                <path
                                    d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783">
                                </path>
                            </svg><span class="ps-1">Courses Management&nbsp;</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0"
                        id="sidebarToggle-1" type="button"></button></div>
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
                                            class="d-none d-lg-inline me-2 text-gray-600 small">Your name</span><img
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
                    <div class="d-sm-flex justify-content-between align-items-center mb-4" style="padding-right: 5px;">
                        <h3 class="text-dark mb-0" data-aos="fade-right" data-aos-duration="850" data-aos-delay="500"
                            data-aos-once="true">Student Dashboard</h3>
                    </div>
                    <div class="row">

                        <div class="container-fluid">
                            <div class="d-flex justify-content-between align-items-center mb-4"
                                style="padding-right: 5px;">
                               
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <button id="toggleTableBtn">Show Fee Installments</button>

                                    <div id="feeInstallmentTable" style="display: none;">
                                        <table id="styledTable">
                                            <thead>
                                                <tr>
                                                    <th>Installment No</th>
                                                    <th>Due Date</th>
                                                    <th>Status</th>
                                                    <th>Amount</th>
                                                    <th>Discount</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment Date</th>
                                                </tr>
                                            </thead>
                                            <tbody id="installmentDetails"></tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3 mb-4" data-aos="fade-down" data-aos-duration="850"
                            data-aos-delay="500" data-aos-once="true">
                            <div class="card shadow border-left-success py-2">
                                <div class="card-body">
                                    <div class="row g-0 align-items-center">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1">
                                                <span>Paid Amount</span>
                                            </div>
                                            <div class="text-dark fw-bold h5 mb-0" id="paidAmount"><span>RS. 0</span>
                                            </div>
                                        </div>
                                        <div class="col-auto"><svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                viewBox="0 0 24 24" width="1em" fill="currentColor"
                                                class="fa-2x text-gray-300">
                                                <path d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3 mb-4" data-aos="fade-down" data-aos-duration="850"
                            data-aos-delay="500" data-aos-once="true">
                            <div class="card shadow border-left-success py-2">
                                <div class="card-body">
                                    <div class="row g-0 align-items-center">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1">
                                                <span>Discount Amount</span>
                                            </div>
                                            <div class="text-dark fw-bold h5 mb-0" id="discountAmount"><span>RS.
                                                    0</span></div>
                                        </div>
                                        <div class="col-auto"><svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                viewBox="0 0 24 24" width="1em" fill="currentColor"
                                                class="fa-2x text-gray-300">
                                                <path d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-3 mb-4" data-aos="fade-down" data-aos-duration="850"
                            data-aos-delay="500" data-aos-once="true">
                            <div class="card shadow border-left-success py-2">
                                <div class="card-body">
                                    <div class="row g-0 align-items-center">
                                        <div class="col me-2">
                                            <div class="text-uppercase text-success fw-bold text-xs mb-1">
                                                <span>Remaining Amount</span>
                                            </div>
                                            <div class="text-dark fw-bold h5 mb-0" id="remainingAmount"><span>RS.
                                                    0</span></div>
                                        </div>
                                        <div class="col-auto"><svg xmlns="http://www.w3.org/2000/svg" height="1em"
                                                viewBox="0 0 24 24" width="1em" fill="currentColor"
                                                class="fa-2x text-gray-300">
                                                <path d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>










                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-xl-4" data-aos="fade-right" data-aos-duration="800"
                            data-aos-delay="500" data-aos-once="true">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center"
                                    style="height: 57.4px;">
                                    <h6 class="text-primary fw-bold m-0">Attendance(This Month)</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area" style="position: relative; height: 250px;">
                                        <canvas id="attendanceDonutChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="col-lg-6 mb-4" data-aos="fade-left" data-aos-duration="650" data-aos-delay="550"
                            data-aos-once="true">
                            <div class="card shadow mb-4" data-aos="fade-right" data-aos-duration="1200"></div>
                            <div class="card shadow mb-4" data-aos="fade-right" data-aos-duration="1200"
                                style="box-shadow: 0px 0px 20px;">
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
    <script src="assets/js/Attendance/attendance_data.js"></script>
    <script src="assets/js/Fee/fee_data.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/js/Fee/fee_details.js"></script>

</body>

</html>