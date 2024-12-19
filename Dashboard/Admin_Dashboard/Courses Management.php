<?php
// Start the session to store the image
session_start();
include '../php/db_connect.php'; // Database connection


$id = $_SESSION['id']; // or $_POST['id']
$role = $_SESSION['role']; // or $_POST['role']
echo $id;
echo $role;
// SQL query to get the image based on id and role
$sql = "SELECT image FROM images WHERE id = '$id' AND role = '$role'";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if a record was found
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the image data
    $row = mysqli_fetch_assoc($result);
    $imageData = $row['image'];

    // Convert the image data to base64 encoding
    $img = 'data:image/jpeg;base64,' . base64_encode($imageData);

    // Return the base64 image as a JSON response

} 

else{
    $img = 'assets/img/avatars/avatar.png';
    exit();}
// Close the database connection
mysqli_close($conn);
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
                    <li class="nav-item"><a class="nav-link " href="profile.php"><i class="fas fa-user"
                                style="font-size: 13px;"></i><span>Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="Courses%20Management.php"><i
                                class="fas fa-book" style="font-size: 13px;"></i><span>Course
                                Management&nbsp;</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="faculty.php"><i
                                class="fas fa-table"></i><span>Faculty Management&nbsp;</span></a>
                    <li class="nav-item"><a class="nav-link" href="student.php"><i class="far fa-user"
                                style="font-size: 14px;"></i><span>Student Management&nbsp;</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="financial.php"><svg
                                xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icon-tabler-moneybag"
                                style="font-size: 14px;">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M9.5 3h5a1.5 1.5 0 0 1 1.5 1.5a3.5 3.5 0 0 1 -3.5 3.5h-1a3.5 3.5 0 0 1 -3.5 -3.5a1.5 1.5 0 0 1 1.5 -1.5z">
                                </path>
                                <path d="M4 17v-1a8 8 0 1 1 16 0v1a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z"></path>
                            </svg>&nbsp;
                            <span>Financial Management&nbsp;</span></a></li>
                                                <li class="nav-item"><a class="nav-link " href="exam.php"><i class="fas fa-table"></i><span>Exam Management&nbsp;</span></a></li>

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
                                            class="d-none d-lg-inline me-2 text-gray-600 small">
                                            <?php
                                            echo $_SESSION['name'];
                                            ?>
                                        </span><img class="border rounded-circle img-profile"
                                            src="<?php
echo $img;
?>
    "></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a
                                            class="dropdown-item" href="#"><i
                                                class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a
                                            class="dropdown-item" href="profi">
                                        <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i
                                                class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container py-4 py-xl-5">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4" data-aos="fade"
                        data-aos-duration="1150" data-aos-delay="500">
                        <h3 class="text-dark mb-0">Course Management&nbsp;</h3>
                    </div>
                    <div class="row gy-4 row-cols-2 row-cols-md-4 " style="display:flex; gap: 100px;">
                        <div class="col" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="550">
                            <div class="text-center d-flex flex-column justify-content-center align-items-center py-3">
                                <div
                                    class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                        viewBox="0 0 16 16" class="bi bi-book">
                                        <path
                                            d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783">
                                        </path>
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
                                <div
                                    class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                        viewBox="0 0 16 16" class="bi bi-fire">
                                        <path
                                            d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16m0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15">
                                        </path>
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
                                <div
                                    class="bs-icon-xl bs-icon-circle bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block mb-2 bs-icon lg">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                        viewBox="0 0 16 16" class="bi bi-graph-down">
                                        <path fill-rule="evenodd"
                                            d="M0 0h1v15h15v1H0zm14.817 11.887a.5.5 0 0 0 .07-.704l-4.5-5.5a.5.5 0 0 0-.74-.037L7.06 8.233 3.404 3.206a.5.5 0 0 0-.808.588l4 5.5a.5.5 0 0 0 .758.06l2.609-2.61 4.15 5.073a.5.5 0 0 0 .704.07Z">
                                        </path>
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
                <div class="card shadow" data-aos="flip-up" data-aos-duration="1200" data-aos-delay="500"
                    style="box-shadow: 0px 0px 20px;">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Course List</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-nowrap" style="padding-left: 33px;padding-top: 0px;">
                                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                                <div class="dropdown"><button
                                        class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1"
                                        aria-expanded="false" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                        type="button" id="courseDropdownButton"><svg xmlns="http://www.w3.org/2000/svg"
                                            height="1em" viewBox="0 0 24 24" width="1em" fill="currentColor"
                                            style="width: 24px;height: 24px;font-size: 22px;">
                                            <path d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                                        </svg>&nbsp;Add Course&nbsp;</button>
                                    <div class="dropdown-menu" style="width: 1076px;box-shadow: 0px 0px 20px 1px;">
                                        <h3 class="text-bg-primary" id="dropdownbtn"
                                            style="margin-top: -8px;height: 58.6px;padding-top: 12px;padding-left: 50%;">
                                            Add course
                                        </h3>
                                        <form action="" method="post" id="courseForm" style="padding-bottom: 0px;">
                                            <div style="margin-top: 30px;margin-right: -1px;">
                                                <div class="container"
                                                    style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                    <div class="row">
                                                        <div class="col-md-3 col-xxl-1"
                                                            style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;">
                                                            <strong>Course Code</strong>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input class="form-control" type="text" name="course_code"
                                                                id="course_code" placeholder="Enter Course Code"
                                                                required="">
                                                        </div>
                                                        <div class="col-md-3 col-xxl-1"
                                                            style="margin-left: 210px;padding-top: 7px;">
                                                            <strong>Course Name</strong>
                                                        </div>
                                                        <div class="col-md-3" style="margin-left: 31px;">
                                                            <input class="form-control" type="text" name="course_name"
                                                                id="course_name" placeholder="Enter Course Name"
                                                                required="" minlength="2" maxlength="50">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container"
                                                    style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                    <div class="row">
                                                        <div class="col-md-3 col-xxl-1"
                                                            style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;">
                                                            <strong>Department</strong>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select class="form-control" name="department"
                                                                id="department" required>
                                                                <option value="">Select Department</option>
                                                                <!-- Options populated through  AJAX -->
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 col-xxl-1"
                                                            style="margin-left: 210px;padding-top: 7px;">
                                                            <strong>Credits</strong>
                                                        </div>
                                                        <div class="col-md-3" style="margin-left: 31px;">
                                                            <input class="form-control" type="number" name="credits"
                                                                id="credits" required=""
                                                                placeholder="Enter the Credit Hour">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container"
                                                    style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                    <div class="row">
                                                        <div class="col-md-3 col-xxl-1"
                                                            style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;">
                                                            <strong>Course Type&nbsp;</strong>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select id="course_type" class="form-select"
                                                                name="course_type">
                                                                <option value="">Select Course type</option>
                                                                <option value="Yearly Based">Yearly Based</option>
                                                                <option value="Semester Based">Semester Based</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3 col-xxl-1"
                                                            style="margin-left: 210px;padding-top: 7px;">
                                                            <strong>Status&nbsp;</strong>
                                                        </div>
                                                        <div class="col-md-3"
                                                            style="margin-left: 31px;padding-left: 50px;padding-top: 2px;padding-bottom: 0px;margin-top: -3px;">
                                                            <div class="btn-group" role="group"
                                                                aria-label="Basic radio toggle button group">
                                                                <input type="radio" id="active_status" class="btn-check"
                                                                    name="course_status" autocomplete="off"
                                                                    value="active">
                                                                <label class="form-label btn btn-outline-primary"
                                                                    for="active_status">Active</label>

                                                                <input type="radio" id="inactive_status"
                                                                    class="btn-check" name="course_status"
                                                                    autocomplete="off" value="inactive">
                                                                <label class="form-label btn btn-outline-primary"
                                                                    for="inactive_status">Inactive</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="container"
                                                    style="padding-top: 0px;padding-bottom: 0px;margin-bottom: 15px;margin-top: 8px;">
                                                    <div class="row">
                                                        <div class="col-md-3 col-xxl-1"
                                                            style="margin-left: 40px;margin-top: 0px;padding-top: 8px;margin-right: 24px;">
                                                            <strong>Course Fee&nbsp;</strong>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input class="form-control" type="number" name="course_fee"
                                                                id="course_fee" required=""
                                                                placeholder="Enter the course Fee">
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" id="edit_mode" name="edit_mode" value="add">
                                            <input type="hidden" id="course_id_hidden" name="course_id_hidden">
                                            <input class="btn btn-primary" type="submit" style="margin-left: 807px;"
                                                name="add_course" value="Add Course" id="submit_Button">
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
                                        <th>Department</th>
                                        <th>Credits Hour</th>
                                        <th>Course Type</th>
                                        <th>Course Fee</th>
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
                                        <td><strong>Course Type</strong></td>
                                        <td><strong>Course Fee</strong></td>
                                        <td><strong>Status</strong></td>
                                        <td><strong><strong>Actions</strong></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow" style="box-shadow: 0px 0px 20px;">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold">Subject Management</p>
                </div>
                <div class="card-body">
                    <!-- Course Selection Dropdown -->
                    <div class="row">
                        <div class="col-md-4">
                            <label for="courseSelect" class="form-label">Select Course</label>
                            <select id="courseSelect" class="form-select" onchange="fetchSubjects()" style="height: 35px; padding: 0.25rem 0.5rem;">
                                <option value="">Select Course</option>
                                <!-- Populated dynamically through AJAX -->
                            </select>
                        </div>
                    </div>

                    <!-- Subject Table -->
                    <div class="table-responsive mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Subject Name</th>
                                    <th>Credits</th>
                                    <th>Semester</th>
                                    <th>Syllabus Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="subjectTableBody">
                                <!-- Populated dynamically through AJAX -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Add/Edit Subject Dropdown Button -->
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1"
                            aria-expanded="false" data-bs-toggle="collapse" data-bs-target="#subjectFormCollapse"
                            type="button" id="subjectDropdownButton">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24" width="1em"
                                fill="currentColor" style="width: 24px;height: 24px;font-size: 22px;">
                                <path d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                            </svg>&nbsp;Add/Edit Subject
                        </button>
                    </div>

                    <!-- Add/Edit Subject Form -->
                    <div id="subjectFormCollapse" class="collapse mt-3">
                        <form id="subjectForm" class="border p-3 rounded-3"
                            style="border: 1px solid #ddd; background-color: #f9f9f9;">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="subjectCode" class="form-label">Subject Code</label>
                                    <input type="text" id="subjectCode" class="form-control"
                                        placeholder="Enter Subject Code" required />
                                </div>
                                <div class="col-md-4">
                                    <label for="subjectName" class="form-label">Subject Name</label>
                                    <input type="text" id="subjectName" class="form-control"
                                        placeholder="Enter Subject Name" required />
                                </div>
                                <div class="col-md-4">
                                    <label for="subjectCredits" class="form-label">Credits</label>
                                    <input type="number" id="subjectCredits" class="form-control"
                                        placeholder="Enter Credits" required />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="subjectSemester" class="form-label">Semester</label>
                                    <input type="text" id="subjectSemester" class="form-control"
                                        placeholder="Enter Semester" required />
                                </div>
                                <div class="col-md-4">
                                    <label for="syllabusStatus" class="form-label">Syllabus Status</label>
                                    <select id="syllabusStatus" class="form-select" required>
                                        <option value="">Select Status</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Not Completed">Not Completed</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="editMode" value="add" />
                            <input type="hidden" id="subjectId" />
                            <button type="submit" class="btn btn-success">Save Subject</button>
                        </form>
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
    <script src="assets/js/Department/departments_data.js"></script>
    <script src="assets/js/Course/course_crud.js"></script>
    <script src="assets/js/Course/course_Validation.js"></script>
    <script src="assets/js/Course/course_stats.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="assets/js/Subjects/subject_crud.js"></script>
</body>

</html>