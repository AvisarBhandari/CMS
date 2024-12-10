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
    <link rel="stylesheet" href="assets/fonts/line-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/material-icons.min.css">
    <link rel="stylesheet" href="assets/css/aos.min.css">
    <link rel="stylesheet" href="assets/css/Button-Change-Text-on-Hover.css">
    <link rel="stylesheet" href="assets/css/Cute-Select.css">
    <link rel="stylesheet" href="assets/css/Filter.css">
    <link rel="stylesheet" href="assets/css/Multiple-Input-Select-Pills.css">
    <link rel="stylesheet" href="assets/css/MUSA_button-label-button-label.css">
    <link rel="stylesheet" href="assets/css/MUSA_button-label.css">
    <link rel="stylesheet" href="assets/css/Navbar-With-Button-icons.css">
    <link rel="stylesheet" href="assets/css/salary_button.css">
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
                    <li class="nav-item"><a class="nav-link" href="index.php"><i
                                class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user"
                                style="font-size: 13px;"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="Courses%20Management.php"><i class="fas fa-book"
                                style="font-size: 13px;"></i><span>Course Management&nbsp;</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="faculty.php"><i
                                class="fas fa-table"></i><span>Faculty Management&nbsp;</span></a><a class="nav-link"
                            href="student.html"><i class="far fa-user"
                                style="font-size: 14px;"></i><span>StudentManagement&nbsp;</span></a><a
                            class="nav-link active" href="financial.html"><svg xmlns="http://www.w3.org/2000/svg"
                                width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icon-tabler-moneybag" style="font-size: 14px;">
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
                                            class="d-none d-lg-inline me-2 text-gray-600 small">Valerie Luna</span><img
                                            class="border rounded-circle img-profile"
                                            src="assets/img/untitled-1.png"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a
                                            class="dropdown-item" href="#"><i
                                                class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a
                                            class="dropdown-item" href="#"><i
                                                class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings</a><a
                                            class="dropdown-item" href="#"><i
                                                class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity
                                            log</a>
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i
                                                class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4" data-aos="fade"
                        data-aos-duration="1200" data-aos-delay="500" style="padding-right: 5px;">
                        <h3 class="text-dark mb-0">Financial Management&nbsp;</h3><a
                            class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i
                                class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                    </div>
                    <div class="row" data-aos="fade" data-aos-duration="1200" data-aos-delay="500">
                        <div class="col">
                            <div class="text-center d-flex flex-column justify-content-center align-items-center py-3"
                                data-aos="fade-right" data-aos-duration="1000" data-aos-delay="500"
                                data-aos-once="true">
                                <div
                                    class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg">
                                    <i class="la la-money"></i>
                                </div>
                                <div class="px-3">
                                    <h2 class="fw-bold mb-0">123+</h2>
                                    <p class="mb-0">Fee Paid</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center d-flex flex-column justify-content-center align-items-center py-3"
                                data-aos="fade-down" data-aos-duration="950" data-aos-delay="1000">
                                <div
                                    class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24"
                                        height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor">
                                        <g>
                                            <rect fill="none" height="24" width="24"></rect>
                                            <path
                                                d="M17,12c-2.76,0-5,2.24-5,5s2.24,5,5,5c2.76,0,5-2.24,5-5S19.76,12,17,12z M18.65,19.35l-2.15-2.15V14h1v2.79l1.85,1.85 L18.65,19.35z M18,3h-3.18C14.4,1.84,13.3,1,12,1S9.6,1.84,9.18,3H6C4.9,3,4,3.9,4,5v15c0,1.1,0.9,2,2,2h6.11 c-0.59-0.57-1.07-1.25-1.42-2H6V5h2v3h8V5h2v5.08c0.71,0.1,1.38,0.31,2,0.6V5C20,3.9,19.1,3,18,3z M12,5c-0.55,0-1-0.45-1-1 c0-0.55,0.45-1,1-1c0.55,0,1,0.45,1,1C13,4.55,12.55,5,12,5z">
                                            </path>
                                        </g>
                                    </svg>
                                </div>
                                <div class="px-3">
                                    <h2 class="fw-bold mb-0">45+</h2>
                                    <p class="mb-0">Fee&nbsp;Pending</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center d-flex flex-column justify-content-center align-items-center py-3"
                                data-aos="fade-up" data-aos-duration="950" data-aos-delay="1500">
                                <div
                                    class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg">
                                    <i class="material-icons" style="font-size: 36px;">attach_money</i>
                                </div>
                                <div class="px-3">
                                    <h2 class="fw-bold mb-0">67+</h2>
                                    <p class="mb-0">Salary Paid&nbsp;</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="text-center d-flex flex-column justify-content-center align-items-center py-3"
                                data-aos="fade-left" data-aos-duration="950" data-aos-delay="2000">
                                <div
                                    class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                        viewBox="0 0 16 16" class="bi bi-hourglass-top">
                                        <path
                                            d="M2 14.5a.5.5 0 0 0 .5.5h11a.5.5 0 1 0 0-1h-1v-1a4.5 4.5 0 0 0-2.557-4.06c-.29-.139-.443-.377-.443-.59v-.7c0-.213.154-.451.443-.59A4.5 4.5 0 0 0 12.5 3V2h1a.5.5 0 0 0 0-1h-11a.5.5 0 0 0 0 1h1v1a4.5 4.5 0 0 0 2.557 4.06c.29.139.443.377.443.59v.7c0 .213-.154.451-.443.59A4.5 4.5 0 0 0 3.5 13v1h-1a.5.5 0 0 0-.5.5m2.5-.5v-1a3.5 3.5 0 0 1 1.989-3.158c.533-.256 1.011-.79 1.011-1.491v-.702s.18.101.5.101.5-.1.5-.1v.7c0 .701.478 1.236 1.011 1.492A3.5 3.5 0 0 1 11.5 13v1z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="px-3">
                                    <h2 class="fw-bold mb-0">89</h2>
                                    <p class="mb-0">Salary&nbsp;Pending</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-duration="700" data-aos-delay="700"
                        data-aos-once="true">
                        <div class="col-lg-7 col-xl-8 col-xxl-12" data-aos="fade-right" data-aos-duration="1200">
                            <div class="card shadow mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center"
                                    style="height: 57.4px;">
                                    <h6 class="text-primary fw-bold m-0">Earnings Overview</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area"><canvas
                                            data-bss-chart="{&quot;type&quot;:&quot;line&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Jan&quot;,&quot;Feb&quot;,&quot;Mar&quot;,&quot;Apr&quot;,&quot;May&quot;,&quot;Jun&quot;,&quot;Jul&quot;,&quot;Aug&quot;,&quot;Sep&quot;,&quot;Oct&quot;,&quot;Nov&quot;,&quot;Dec&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Earnings&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;0&quot;,&quot;10000&quot;,&quot;5000&quot;,&quot;15000&quot;,&quot;10000&quot;,&quot;20000&quot;,&quot;15000&quot;,&quot;25000&quot;,&quot;20000&quot;,&quot;25000&quot;,&quot;15000&quot;,&quot;10000&quot;],&quot;backgroundColor&quot;:&quot;rgba(78, 115, 223, 0.05)&quot;,&quot;borderColor&quot;:&quot;rgba(78, 115, 223, 1)&quot;},{&quot;label&quot;:&quot;Expenditures&quot;,&quot;fill&quot;:true,&quot;data&quot;:[&quot;0&quot;,&quot;1000&quot;,&quot;500&quot;,&quot;5000&quot;,&quot;20000&quot;,&quot;23000&quot;,&quot;10000&quot;,&quot;2497&quot;,&quot;10000&quot;,&quot;20000&quot;,&quot;1500&quot;,&quot;4000&quot;],&quot;backgroundColor&quot;:&quot;rgba(229,5,58,0.04)&quot;,&quot;borderColor&quot;:&quot;rgba(229,5,58,0.49)&quot;}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;],&quot;drawOnChartArea&quot;:false},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;fontStyle&quot;:&quot;normal&quot;,&quot;padding&quot;:20}}],&quot;yAxes&quot;:[{&quot;gridLines&quot;:{&quot;color&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;zeroLineColor&quot;:&quot;rgb(234, 236, 244)&quot;,&quot;drawBorder&quot;:false,&quot;drawTicks&quot;:false,&quot;borderDash&quot;:[&quot;2&quot;],&quot;zeroLineBorderDash&quot;:[&quot;2&quot;]},&quot;ticks&quot;:{&quot;fontColor&quot;:&quot;#858796&quot;,&quot;fontStyle&quot;:&quot;normal&quot;,&quot;padding&quot;:20}}]}}}"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card"></div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xxl-6" data-aos="flip-up" data-aos-duration="1000" data-aos-delay="500"
                            data-aos-once="true">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Students list</p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 text-nowrap">
                                            <div id="dataTable_length" class="dataTables_length"
                                                aria-controls="dataTable">
                                                <div class="dropdown"><button
                                                        class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1"
                                                        aria-expanded="false" data-bs-toggle="dropdown"
                                                        data-bs-auto-close="outside" type="button"><svg
                                                            xmlns="http://www.w3.org/2000/svg" height="1em"
                                                            viewBox="0 0 24 24" width="1em" fill="currentColor"
                                                            style="width: 24px;height: 24px;font-size: 22px;">
                                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                                                        </svg>Student Transaction</button>
                                                    <div class="dropdown-menu"
                                                        style="width: 1076px;box-shadow: 0px 0px 20px 1px;">
                                                        <h3 class="text-light text-bg-primary"
                                                            style="padding-left: 43%;padding-top: 4px;margin-top: -8px;margin-bottom: 14px;height: 41.6px;">
                                                            Student Transaction</h3>
                                                        <form style="padding-bottom: 0px;">
                                                            <div style="margin-top: 30px;margin-right: -1px;">
                                                                <div class="container"
                                                                    style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                                    <div class="row">
                                                                        <div class="col-md-3 col-xxl-1"
                                                                            style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;">
                                                                            <strong>Student ID</strong>
                                                                        </div>
                                                                        <div class="col-md-3"><input
                                                                                class="form-control" type="text"
                                                                                name="student_code"
                                                                                placeholder="Enter Student ID"
                                                                                required="" min="8" max="8"
                                                                                pattern="^STU\d{4}-\d{4}$"
                                                                                maxlength="13" minlength="1"
                                                                                autofocus=""></div>
                                                                        <div class="col-md-3 col-xxl-1"
                                                                            style="margin-left: 210px;padding-top: 7px;">
                                                                            <strong>StudentName</strong>
                                                                        </div>
                                                                        <div class="col-md-3"
                                                                            style="margin-left: 31px;"><input
                                                                                class="form-control" type="text"
                                                                                name="student_name"
                                                                                placeholder="Enter StudentName"
                                                                                required="" minlength="2" maxlength="25"
                                                                                autofocus=""></div>
                                                                    </div>
                                                                </div>
                                                                <div class="container"
                                                                    style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                                    <div class="row">
                                                                        <div class="col-md-3 col-xxl-1"
                                                                            style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;">
                                                                            <strong>Department&nbsp;</strong>
                                                                        </div>
                                                                        <div class="col-md-3"><select
                                                                                class="border rounded form-select"
                                                                                name="dep" required="" autofocus="">
                                                                                <optgroup label="Department ">
                                                                                    <option value="" selected="">
                                                                                        Department </option>
                                                                                    <option value="bca">BCA</option>
                                                                                    <option value="bbs">BBS</option>
                                                                                </optgroup>
                                                                            </select></div>
                                                                        <div class="col-md-3 col-xxl-1"
                                                                            style="margin-left: 210px;padding-top: 7px;">
                                                                            <strong>Fee Amount</strong>
                                                                        </div>
                                                                        <div class="col-md-3"
                                                                            style="margin-left: 31px;"><input
                                                                                class="form-control" type="number"
                                                                                name="fee" required=""
                                                                                placeholder="Enter Amount"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form><input class="btn btn-primary" type="submit"
                                                            style="margin-left: 807px;" name="Add Course "
                                                            value="Add Faculty ">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-md-end dataTables_filter" id="dataTable_filter"><label
                                                    class="form-label"><input type="search"
                                                        class="form-control form-control-sm" aria-controls="dataTable"
                                                        placeholder="Search"></label></div>
                                        </div>
                                    </div>
                                    <div class="table-responsive table mt-2" id="dataTable-1" role="grid"
                                        aria-describedby="dataTable_info">
                                        <table class="table my-0" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>ID</th>
                                                    <th>Department&nbsp;</th>
                                                    <th>Address&nbsp;</th>
                                                    <th>Due Fees</th>
                                                    <th class="me-0"><strong>Actions</strong></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Airi Satou</td>
                                                    <td>12313131</td>
                                                    <td>Accountant</td>
                                                    <td>Parsa</td>
                                                    <td class="text-danger">RS. 162,700</td>
                                                    <td><a id="edit" class="faculty_action" href="#"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="1em"
                                                                height="1em" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icon-tabler-edit text-warning pt-xxl-0 mt-xxl-0"
                                                                style="font-size: 27px;padding-top: 0px;margin-top: -13px;">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path
                                                                    d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                                </path>
                                                                <path
                                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                                </path>
                                                                <path d="M16 5l3 3"></path>
                                                            </svg></a><a id="delete" class="faculty_action"
                                                            href="#"><svg xmlns="http://www.w3.org/2000/svg"
                                                                height="1em" viewBox="0 0 24 24" width="1em"
                                                                fill="currentColor"
                                                                class="text-danger pt-xxl-0 mt-xxl-0 ms-0"
                                                                style="font-size: 29px;margin-left: 11px;margin-top: -8px;">
                                                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                                <path
                                                                    d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z">
                                                                </path>
                                                            </svg></a></td>
                                                </tr>
                                                <tr>
                                                    <td>Angelica Ramos</td>
                                                    <td>12312312</td>
                                                    <td>ABC</td>
                                                    <td class="text-success-emphasis">parsa</td>
                                                    <td class="text-danger">RS.1,20,000</td>
                                                    <td><a id="edit-1" class="faculty_action" href="#"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="1em"
                                                                height="1em" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icon-tabler-edit text-warning pt-xxl-0 mt-xxl-0"
                                                                style="font-size: 27px;padding-top: 0px;margin-top: -13px;">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path
                                                                    d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                                </path>
                                                                <path
                                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                                </path>
                                                                <path d="M16 5l3 3"></path>
                                                            </svg></a><a id="delete-1" class="faculty_action"
                                                            href="#"><svg xmlns="http://www.w3.org/2000/svg"
                                                                height="1em" viewBox="0 0 24 24" width="1em"
                                                                fill="currentColor"
                                                                class="text-danger pt-xxl-0 mt-xxl-0 ms-0"
                                                                style="font-size: 29px;margin-left: 11px;margin-top: -8px;">
                                                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                                <path
                                                                    d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z">
                                                                </path>
                                                            </svg></a></td>
                                                </tr>
                                                <tr>
                                                    <td>Ashton Cox</td>
                                                    <td>1231231</td>
                                                    <td>Assistant Professor</td>
                                                    <td>Parsa</td>
                                                    <td class="text-danger">RS. 86,000</td>
                                                    <td><a id="edit-2" class="faculty_action" href="#"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="1em"
                                                                height="1em" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icon-tabler-edit text-warning pt-xxl-0 mt-xxl-0"
                                                                style="font-size: 27px;padding-top: 0px;margin-top: -13px;">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path
                                                                    d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                                </path>
                                                                <path
                                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                                </path>
                                                                <path d="M16 5l3 3"></path>
                                                            </svg></a><a id="delete-2" class="faculty_action"
                                                            href="#"><svg xmlns="http://www.w3.org/2000/svg"
                                                                height="1em" viewBox="0 0 24 24" width="1em"
                                                                fill="currentColor"
                                                                class="text-danger pt-xxl-0 mt-xxl-0 ms-0"
                                                                style="font-size: 29px;margin-left: 11px;margin-top: -8px;">
                                                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                                <path
                                                                    d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z">
                                                                </path>
                                                            </svg></a></td>
                                                </tr>
                                                <tr>
                                                    <td>Bradley Greer</td>
                                                    <td>12312313</td>
                                                    <td>Software Engineer</td>
                                                    <td>awd</td>
                                                    <td class="text-danger">RS. 132,000</td>
                                                    <td><a id="edit-3" class="faculty_action" href="#"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="1em"
                                                                height="1em" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icon-tabler-edit text-warning pt-xxl-0 mt-xxl-0"
                                                                style="font-size: 27px;padding-top: 0px;margin-top: -13px;">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path
                                                                    d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                                </path>
                                                                <path
                                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                                </path>
                                                                <path d="M16 5l3 3"></path>
                                                            </svg></a><a id="delete-3" class="faculty_action"
                                                            href="#"><svg xmlns="http://www.w3.org/2000/svg"
                                                                height="1em" viewBox="0 0 24 24" width="1em"
                                                                fill="currentColor"
                                                                class="text-danger pt-xxl-0 mt-xxl-0 ms-0"
                                                                style="font-size: 29px;margin-left: 11px;margin-top: -8px;">
                                                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                                <path
                                                                    d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z">
                                                                </path>
                                                            </svg></a></td>
                                                </tr>
                                                <tr>
                                                    <td>Brenden Wagner</td>
                                                    <td>13123131</td>
                                                    <td>Software Engineer</td>
                                                    <td>ABC</td>
                                                    <td class="text-danger">RS. 206,850</td>
                                                    <td><a id="edit-4" class="faculty_action" href="#"><svg
                                                                xmlns="http://www.w3.org/2000/svg" width="1em"
                                                                height="1em" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="icon icon-tabler icon-tabler-edit text-warning pt-xxl-0 mt-xxl-0"
                                                                style="font-size: 27px;padding-top: 0px;margin-top: -13px;">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <path
                                                                    d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1">
                                                                </path>
                                                                <path
                                                                    d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                                                </path>
                                                                <path d="M16 5l3 3"></path>
                                                            </svg></a><a id="delete-4" class="faculty_action"
                                                            href="#"><svg xmlns="http://www.w3.org/2000/svg"
                                                                height="1em" viewBox="0 0 24 24" width="1em"
                                                                fill="currentColor"
                                                                class="text-danger pt-xxl-0 mt-xxl-0 ms-0"
                                                                style="font-size: 29px;margin-left: 11px;margin-top: -8px;">
                                                                <path d="M0 0h24v24H0V0z" fill="none"></path>
                                                                <path
                                                                    d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-3.5l-1-1zM18 7H6v12c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7z">
                                                                </path>
                                                            </svg></a></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><strong>Name</strong></td>
                                                    <td><strong>ID</strong></td>
                                                    <td><strong>Department&nbsp;</strong></td>
                                                    <td><strong>Address&nbsp;</strong></td>
                                                    <td><strong>Due Fees</strong></td>
                                                    <td><strong><strong>Actions</strong></strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow" data-aos="flip-down" data-aos-duration="700" data-aos-delay="800"
                                data-aos-once="true">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Faculty Info</p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 text-nowrap">
                                            <div id="dataTable_length-1" class="dataTables_length"
                                                aria-controls="dataTable">
                                                <div class="dropdown"><button id="generateSalaryList"
                                                        class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1"
                                                        aria-expanded="false" data-bs-toggle="dropdown"
                                                        data-bs-auto-close="outside" type="button"><svg
                                                            xmlns="http://www.w3.org/2000/svg" height="1em"
                                                            viewBox="0 0 24 24" width="1em" fill="currentColor"
                                                            style="width: 24px;height: 24px;font-size: 22px;">
                                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                                                        </svg>Generate Salary List</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-md-end dataTables_filter" id="dataTable_filter-1"><label
                                                    class="form-label"><input type="search"
                                                        class="form-control form-control-sm" aria-controls="dataTable"
                                                        placeholder="Search"></label></div>
                                        </div>
                                    </div>
                                    <div class="table-responsive table mt-2" id="dataTable-2" role="grid"
                                        aria-describedby="dataTable_info">
                                        <table class="table my-0" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Department</th>
                                                    <th>Faculty ID</th>
                                                    <th>Name</th>
                                                    <th>Salary Amount</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="faculty_salary_body">
                                                <!-- Rows will be dynamically populated here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                  



                    <div class="row">
                        <div class="col-lg-7 col-xl-8 col-xxl-12" data-aos="fade-right" data-aos-duration="1200">
                            <div class="card shadow mb-4"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card"></div>
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
    <script src="assets/js/Faculty/salary.js"></script>
</body>

</html>