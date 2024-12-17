<?php
session_start();
include '../php/db_connect.php';
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
                            href="student.php"><i class="far fa-user"
                                style="font-size: 14px;"></i><span>StudentManagement&nbsp;</span></a>
                        <a class="nav-link active" href="financial.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icon-tabler-moneybag"
                                style="font-size: 14px;">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M9.5 3h5a1.5 1.5 0 0 1 1.5 1.5a3.5 3.5 0 0 1 -3.5 3.5h-1a3.5 3.5 0 0 1 -3.5 -3.5a1.5 1.5 0 0 1 1.5 -1.5z">
                                </path>
                                <path d="M4 17v-1a8 8 0 1 1 16 0v1a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z"></path>
                            </svg><span style="padding-left: 2px;">Financial&nbsp; Management&nbsp;</span></a>
                            <li class="nav-item"><a class="nav-link " href="exam.php"><i class="fas fa-table"></i><span>Exam Management&nbsp;</span></a></li>

                    </li>
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
                                            class="d-none d-lg-inline me-2 text-gray-600 small">
                                        <?php
                                        echo $_SESSION['name'];
                                        ?>
                                        </span><img
                                            class="border rounded-circle img-profile"
                                            src="<?php
    $result = $conn->query("SELECT image FROM images ORDER BY id DESC LIMIT 1");

    if (!empty($result) && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $imageData = $row['image'];
      $img= 'data:image/jpeg;base64,' . base64_encode($imageData) . '';
      echo $img;
    } else {
      echo 'No image uploaded yet.';
    }

    $conn->close();
    ?>"></a>
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
                                    <h2 class="fw-bold mb-0 fee-paid-count">0</h2> <!-- Dynamically updated here -->
                                    <p class="mb-0">Fee Paid(This period)</p>
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
                                    <h2 class="fw-bold mb-0 fee-pending-count">0</h2> <!-- Dynamically updated here -->
                                    <p class="mb-0">Fee&nbsp;Pending(This period)</p>
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
                                    <h2 class="fw-bold mb-0 salary-paid-count">0</h2> <!-- Dynamically updated here -->
                                    <p class="mb-0">Salary Paid(This month)&nbsp;</p>
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
                                    <h2 class="fw-bold mb-0 salary-pending-count">0</h2>
                                    <!-- Dynamically updated here -->
                                    <p class="mb-0">Salary&nbsp;Pending(This month)</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    
                    <div class="row" data-aos="fade-up" data-aos-duration="700" data-aos-delay="700"
                        data-aos-once="true">
                        <!-- Fee Payment Overview -->
                        <div class="col-lg-6 col-xl-6 col-xxl-6 mx-auto" data-aos="fade-right" data-aos-duration="1200">
                            <div class="card shadow-lg mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center bg-light"
                                    style="height: 57.4px;">
                                    <h6 class="text-dark fw-bold m-0">Students Fee Payment Overview (This Period)</h6>
                                </div>
                                <div class="card-body p-3 d-flex justify-content-center align-items-center">
                                    <div class="chart-area"
                                        style="position: relative; width: 100%; height: 300px; display: flex; justify-content: center; align-items: center;">
                                        <canvas id="feechartt" style="max-width: 80%; max-height: 80%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Salary Payment Overview -->
                        <div class="col-lg-6 col-xl-6 col-xxl-6 mx-auto" data-aos="fade-left" data-aos-duration="1200">
                            <div class="card shadow-lg mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center bg-light"
                                    style="height: 57.4px;">
                                    <h6 class="text-dark fw-bold m-0">Staff Salary Payment Overview (This Month)</h6>
                                </div>
                                <div class="card-body p-3 d-flex justify-content-center align-items-center">
                                    <div class="chart-area"
                                        style="position: relative; width: 100%; height: 300px; display: flex; justify-content: center; align-items: center;">
                                        <canvas id="salaryChart" style="max-width: 80%; max-height: 80%;"></canvas>
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
                        <div class="col">
                            <div class="card shadow" data-aos="flip-down" data-aos-duration="700" data-aos-delay="800"
                                data-aos-once="true">
                                <div class="card-header py-3">
                                    <p class="text-primary m-0 fw-bold">Student Fee info</p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 text-nowrap">
                                            <div id="dataTable_length-1" class="dataTables_length"
                                                aria-controls="dataTable">
                                                <div class="dropdown"><button id="generateFeeBtn"
                                                        class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1"
                                                        aria-expanded="false" data-bs-toggle="dropdown"
                                                        data-bs-auto-close="outside" type="button"><svg
                                                            xmlns="http://www.w3.org/2000/svg" height="1em"
                                                            viewBox="0 0 24 24" width="1em" fill="currentColor"
                                                            style="width: 24px;height: 24px;font-size: 22px;">
                                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                                                        </svg>Generate Fee List</button>
                                                        <button id="toggleFeeDataBtn"
                                                        class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1"
                                                        type="button">
                                                        Show Data
                                                    </button>
                                                        
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
                                    <div class="table-responsive table mt-2" id="feeTableContainer" role="grid"
                                        aria-describedby="dataTable_info">
                                        <table class="table my-0" id="feeTable">
                                            <thead>
                                                <tr>
                                                    <th>Roll Number</th>
                                                    <th>Student Name</th>
                                                    <th>Installment No</th>
                                                    <th>Due Date</th>
                                                    <th>Amount</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="feeTableBody">
                                                <!-- Fee records will be dynamically loaded here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog"
                        aria-labelledby="paymentModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="paymentModalLabel">Pay Fee</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="paymentForm">
                                        <!-- Form fields to capture payment details -->
                                        <div class="form-group">
                                            <label for="studentRoll">Student Roll Number</label>
                                            <input type="text" class="form-control" id="studentRoll" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="installmentNo">Installment Number</label>
                                            <input type="text" class="form-control" id="installmentNo" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="text" class="form-control" id="amount" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="scholarship">Select Scholarship</label>
                                            <select class="form-control" id="scholarship">
                                                <!-- Options will be dynamically populated here -->
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="finalAmount">Final Amount</label>
                                            <input type="text" class="form-control" id="finalAmount" readonly>
                                        </div>
                                        <button type="submit" class="btn btn-success">Submit Payment</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="row">
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
                                                        <button id="hideSalaryList"
                                                        class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1"
                                                        type="button">
                                                        Hide Data
                                                    </button>
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
                </div>


                        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © Academy Keeper 2024</span></div>
            </div>
        </footer>
            </div>
        </div>

    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/js/aos.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
    <script src="assets/js/Faculty/salary.js"></script>
    <script src="assets/js/Student/fee_list.js"></script>
    <script src="assets/js/Student/fee_payment.js"></script>
    <script src="assets/js/Finance/fee_salary_data.js"></script>
    <script src="assets/js/Finance/get_fee_amount.js"></script>
    <script src="assets/js/Finance/salary_chart.js"></script>
    <script src="assets/js/Finance/hide_button.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>