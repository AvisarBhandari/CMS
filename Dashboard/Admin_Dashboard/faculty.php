<?php
// Start the session to store the image
session_start();
include '../php/db_connect.php'; // Database connection


$id = $_SESSION['id']; // or $_POST['id']
$role = $_SESSION['role']; // or $_POST['role']

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
      <title>Table - Academy Keeper</title>
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
            <div class="container-fluid d-flex flex-column p-0">
               <a
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
                  <li class="nav-item">
                     <a class="nav-link active" href="faculty.php"><i
                        class="fas fa-table"></i><span>Faculty Management&nbsp;</span></a><a class="nav-link"
                        href="student.php"><i class="far fa-user"
                        style="font-size: 14px;"></i><span>StudentManagement&nbsp;</span></a>
                     <a class="nav-link" href="financial.php">
                        <svg xmlns="http://www.w3.org/2000/svg"
                           width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                           fill="none" stroke-linecap="round" stroke-linejoin="round"
                           class="icon icon-tabler icon-tabler-moneybag" style="font-size: 14px;">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path
                              d="M9.5 3h5a1.5 1.5 0 0 1 1.5 1.5a3.5 3.5 0 0 1 -3.5 3.5h-1a3.5 3.5 0 0 1 -3.5 -3.5a1.5 1.5 0 0 1 1.5 -1.5z">
                           </path>
                           <path d="M4 17v-1a8 8 0 1 1 16 0v1a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z"></path>
                        </svg>
                        <span style="padding-left: 2px;">Financial&nbsp; Management&nbsp;</span>
                     </a>
                  </li>
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
                        <li class="nav-item dropdown d-sm-none no-arrow">
                           <a class="dropdown-toggle nav-link"
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
                           <div class="nav-item dropdown no-arrow">
                              <a class="dropdown-toggle nav-link"
                                 aria-expanded="false" data-bs-toggle="dropdown" href="#"><span
                                 class="d-none d-lg-inline me-2 text-gray-600 small">
                              <?php
                                 echo $_SESSION['name'];
                                 ?>
                              </span><img
                                 class="border rounded-circle img-profile"
                                 src="<?php
    echo $img;
    ?>"></a>
                              <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                 <a
                                    class="dropdown-item" href="#"><i
                                    class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a><a
                                    class="dropdown-item" href="#">
                                 <div class="dropdown-divider"></div>
                                 <a class="dropdown-item" href="#"><i
                                    class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout</a>
                              </div>
                           </div>
                        </li>
                     </ul>
                  </div>
               </nav>
               <div class="d-sm-flex justify-content-between align-items-center mb-4" data-aos="fade"
                  data-aos-duration="1150" data-aos-delay="500" style="padding-left: 24px;">
                  <h3 class="text-dark mb-0">Team</h3>
               </div>
               <div class="container py-4 py-xl-5">
                  <div class="text-center text-white-50 bg-primary border rounded border-0 p-3">
                     <div class="row row-cols-2 row-cols-md-4">
                        <div class="col" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="500">
                           <div class="p-3">
                              <h4 class="display-5 fw-bold text-white mb-0" id="totalFaculty"></h4>
                              <p class="mb-0">Faculty Members</p>
                           </div>
                        </div>
                        <div class="col">
                           <div data-aos="fade-up-right" data-aos-duration="1200" data-aos-delay="600" class="p-3">
                              <h4 class="display-5 fw-bold text-white mb-0" id="activeFaculty"></h4>
                              <p class="mb-0">Active Faculty</p>
                           </div>
                        </div>
                        <div class="col">
                           <div data-aos="fade-down-left" data-aos-duration="1200" data-aos-delay="700"
                              class="p-3">
                              <h4 class="display-5 fw-bold text-white mb-0" id="absenteeismRate"></h4>
                              <p class="mb-0">Absenteeism Rate</p>
                           </div>
                        </div>
                        <div class="col">
                           <div data-aos="fade-left" data-aos-duration="1200" data-aos-delay="800" class="p-3">
                              <h4 class="display-5 fw-bold text-white mb-0" id="presentFaculty"></h4>
                              <p class="mb-0">Faculty Attandance</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="container">
                  <div class="row">
                     <div class="col-12 col-md-6 col-xl-5">
                        <div class="card shadow mb-4" data-aos="flip-left" data-aos-duration="750"
                           data-aos-delay="350" style="box-shadow: 0px 0px 20px 0px;">
                           <div class="card-header d-flex justify-content-between align-items-center"
                              style="height: 57.4px; box-shadow: 0px 0px;">
                              <h6 class="text-primary fw-bold m-0">Faculty Status Overview</h6>
                           </div>
                           <div class="card-body p-0" style="box-shadow: 0px 0px;">
                              <div class="chart-area">
                                 <canvas id="facultyStatusChart"></canvas>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-12 col-md-6 col-xl-7">
                        <div class="card shadow mb-4" data-aos="flip-right" data-aos-duration="750"
                           data-aos-delay="200" style="box-shadow: 0px 0px 20px;">
                           <div class="card-header py-3">
                              <p class="text-primary m-0 fw-bold">Monthly Teacher Absences</p>
                           </div>
                           <div class="card-body" style="height: 352px;">
                              <div class="chart-area">
                                 <canvas id="absenceChart"></canvas>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="container-fluid">
                  <div class="card shadow" data-aos="flip-up" data-aos-duration="700" data-aos-delay="400">
                     <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Faculty Info</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-nowrap">
                                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable">
                                    <div class="dropdown">
                                    <button
                                       class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1"
                                       aria-expanded="false" data-bs-toggle="dropdown"
                                       data-bs-auto-close="outside" type="button">
                                       <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24"
                                          width="1em" fill="currentColor"
                                          style="width: 24px;height: 24px;font-size: 22px;">
                                          <path d="M0 0h24v24H0z" fill="none"></path>
                                          <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                                       </svg>
                                       &nbsp;Add Faculty
                                    </button>
                                    <div class="dropdown-menu"
                                       style="width: 1076px;box-shadow: 0px 0px 20px 1px ;position:relative;left:100px">
                                       <h3 class="text-light text-bg-primary"
                                          style="padding-left: 43%;padding-top: 4px;margin-top: -8px;margin-bottom: 14px;height: 41.6px;"
                                          id="dropdownbtn">Add Faculty</h3>
                                       <form style="padding-bottom: 0px;" id="facultyForm">
                                          <div style="margin-top: 30px; margin-right: -1px;">
                                             <div class="container"
                                                style="padding-top: 0px; padding-bottom: 0px; margin-bottom: 15px; margin-top: 8px;">
                                                <div class="row">
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 40px; margin-top: 0px; padding-top: 8px; margin-right: 24px;">
                                                      <strong>Faculty ID</strong>
                                                   </div>
                                                   <div class="col-md-3">
                                                      <input class="form-control" type="text"
                                                         name="faculty_id" id="faculty_id"
                                                         placeholder="Enter Faculty ID" required
                                                         pattern="^TEA-\d{4}-\d{4}$" maxlength="13"
                                                         minlength="13" autofocus>
                                                   </div>
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 210px; padding-top: 7px;">
                                                      <strong>Faculty Name</strong>
                                                   </div>
                                                   <div class="col-md-3" style="margin-left: 31px;">
                                                      <input class="form-control" type="text"
                                                         name="faculty_name" id="faculty_name"
                                                         placeholder="Enter Faculty Name" required
                                                         minlength="2" maxlength="25">
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="container"
                                                style="padding-top: 0px; padding-bottom: 0px; margin-bottom: 15px; margin-top: 8px;">
                                                <div class="row">
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 40px; margin-top: 0px; padding-top: 8px; margin-right: 24px;">
                                                      <strong>Position</strong>
                                                   </div>
                                                   <div class="col-md-3">
                                                      <input class="form-control" type="text"
                                                         name="position" id="position"
                                                         placeholder="Enter Position Name" required
                                                         minlength="2" maxlength="25">
                                                   </div>
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 210px; padding-top: 7px;">
                                                      <strong>Address</strong>
                                                   </div>
                                                   <div class="col-md-3" style="margin-left: 31px;">
                                                      <input class="form-control" type="text"
                                                         name="address" id="address"
                                                         placeholder="Enter Address" required
                                                         minlength="5" maxlength="50">
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="container"
                                                style="padding-top: 0px; padding-bottom: 0px; margin-bottom: 15px; margin-top: 8px;">
                                                <div class="row mb-xxl-3">
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 40px; margin-top: 0px; padding-top: 8px; margin-right: 24px;">
                                                      <strong>D.O.B</strong>
                                                   </div>
                                                   <div class="col-md-3">
                                                      <input class="form-control" type="date" id="dob"
                                                         name="dob" style="width: 247.85px;" required>
                                                   </div>
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 210px; padding-top: 7px;">
                                                      <strong>Start Date</strong>
                                                   </div>
                                                   <div class="col-md-3 ps-xxl-1"
                                                      style="margin-left: 31px; padding-left: 50px; padding-top: 2px;">
                                                      <input class="form-control" type="date"
                                                         name="start_date" id="start_date"
                                                         style="width: 247.85px;" required>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="container"
                                                style="padding-top: 0px; padding-bottom: 0px; margin-bottom: 15px; margin-top: 8px;">
                                                <div class="row mb-xxl-3">
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 40px; margin-top: 0px; padding-top: 8px; margin-right: 24px;">
                                                      <strong>Salary</strong>
                                                   </div>
                                                   <div class="col-md-3">
                                                      <input class="form-control" type="number"
                                                         name="salary" id="salary"
                                                         placeholder="Enter Salary" required min="3000"
                                                         max="100000">
                                                   </div>
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 210px; padding-top: 7px;">
                                                      <strong>Phone Number</strong>
                                                   </div>
                                                   <div class="col-md-3 ps-xxl-1"
                                                      style="margin-left: 31px; padding-left: 50px; padding-top: 2px;">
                                                      <input class="form-control" type="tel"
                                                         name="phone_number" id="phone_number"
                                                         placeholder="Enter Phone Number" required
                                                         pattern="(98|97)\d{8}" maxlength="10"
                                                         minlength="10">
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="container"
                                                style="padding-top: 0px; padding-bottom: 0px; margin-bottom: 15px; margin-top: 8px;">
                                                <div class="row">
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 40px; margin-top: 0px; padding-top: 8px; margin-right: 24px;">
                                                      <label
                                                         for="department_dropdown"><strong>Department</strong></label>
                                                   </div>
                                                   <div class="col-md-3">
                                                      <select class="form-control" name="department"
                                                         id="department" type="text" required>
                                                         <option value="">Select Department</option>
                                                         <!-- Options populated via AJAX -->
                                                      </select>
                                                   </div>
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 30px; padding-top: 8px; padding-left: 50px; position:relative ;left:150px;">
                                                      <strong>Status</strong>
                                                   </div>
                                                   <div class="col-md-3"
                                                      style="position:relative ;left:200px;">
                                                      <select class="form-control" name="status"
                                                         id="status" required>
                                                         <option value="">Select Status</option>
                                                         <option value="Active">Active</option>
                                                         <option value="Inactive">Inactive</option>
                                                      </select>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <input type="hidden" id="edit_mode" name="edit_mode" value="add">
                                          <input type="hidden" id="faculty_id_hidden"
                                             name="faculty_id_hidden">
                                          <input class="btn btn-primary" type="submit"
                                             style="margin-left: 807px;" value="Add Faculty">
                                       </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1"
                                 aria-expanded="false" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                 style="position: relative; top:-45px; left:180px" type="button">
                                 <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24"
                                    width="1em" fill="currentColor"
                                    style="width: 24px;height: 24px;font-size: 22px;">
                                    <path d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                                 </svg>
                                 &nbsp;Mark or Edit Attendance
                              </button>
                              <div class="dropdown-menu"
                                 style="width: 100%; box-shadow: 0px 0px 20px 1px; position: relative; left: 0; padding: 10px;">
                                 <h3 class="text-light text-bg-primary text-center py-1 mb-3" id="dropdownbtn"
                                    style="font-size: 18px;">Mark or Edit Attendance</h3>
                                 <form id="attendanceForm" method="POST" style="padding-bottom: 0px;">
                                    <div style="margin: 15px;">
                                       <div class="container">
                                          <div class="row mb-2">
                                             <div class="col-md-4"><strong>Today's Date</strong></div>
                                             <div class="col-md-8">
                                                <input class="form-control form-control-sm" type="date"
                                                   name="attendance_date" id="attendance_date" required
                                                   value="">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="table-responsive"
                                          style="max-height: 300px; overflow-y: auto;">
                                          <table class="table table-bordered table-sm">
                                             <thead>
                                                <tr>
                                                   <th>Faculty ID</th>
                                                   <th>Name</th>
                                                   <th>Status</th>
                                                </tr>
                                             </thead>
                                             <tbody id="attendanceTable">
                                                <!-- Populated via AJAX -->
                                             </tbody>
                                          </table>
                                       </div>
                                       <div class="d-flex justify-content-end gap-2">
                                          <button class="btn btn-primary btn-sm" id="addAttendance"
                                             type="button">Add</button>
                                          <button class="btn btn-primary btn-sm" id="editAttendance"
                                             type="button">Edit</button>
                                          <button class="btn btn-primary btn-sm" id="updateAttendance"
                                             type="button">Update</button>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                            </div>
                                    <div class="dropdown">
                                    <button
                                       class="btn btn-danger dropdown-toggle ps-xxl-0 mt-xxl-0 pt-xxl-1 pb-xxl-1"
                                       aria-expanded="false" data-bs-toggle="dropdown"
                                       data-bs-auto-close="outside" type="button">
                                       <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 24 24"
                                          width="1em" fill="currentColor"
                                          style="width: 24px;height: 24px;font-size: 22px;">
                                          <path d="M0 0h24v24H0z" fill="none"></path>
                                          <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
                                       </svg>
                                       &nbsp;Add Administrator
                                    </button>
                                    <div class="dropdown-menu"
                                       style="width: 1076px;box-shadow: 0px 0px 20px 1px ;position:relative;left:100px">
                                       <h3 class="text-light text-bg-primary"
                                          style="padding-left: 43%;padding-top: 4px;margin-top: -8px;margin-bottom: 14px;height: 41.6px;"
                                          id="dropdownbtn">Add Administrator</h3>
                                       <form style="padding-bottom: 0px;"  method="post" action="../php/Faculty/insert_admin.php" id="adminForm" >
                                          <div style="margin-top: 30px; margin-right: -1px;">
                                             <div class="container"
                                                style="padding-top: 0px; padding-bottom: 0px; margin-bottom: 15px; margin-top: 8px;">
                                                <div class="row">
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 40px; margin-top: 0px; padding-top: 8px; margin-right: 24px;">
                                                      <strong>Admin ID</strong>
                                                   </div>
                                                   <div class="col-md-3">
                                                      <input class="form-control" type="text"
                                                         name="admin_id" id="admin_id"
                                                         placeholder="Enter Admin ID" required
                                                         pattern="^(ADM-\d{4}-\d{4}$" maxlength="13"
                                                         minlength="13" autofocus>
                                                   </div>
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 210px; padding-top: 7px;">
                                                      <strong>Admin Name</strong>
                                                   </div>
                                                   <div class="col-md-3" style="margin-left: 31px;">
                                                      <input class="form-control" type="text"
                                                         name="admin_name" id="admin_name"
                                                         placeholder="Enter Faculty Admin" required
                                                         minlength="2" maxlength="25">
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="container"
                                                style="padding-top: 0px; padding-bottom: 0px; margin-bottom: 15px; margin-top: 8px;">
                                                <div class="row">
                                                    
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 40px; margin-top: 0px; padding-top: 8px; margin-right: 24px;">
                                                      <strong>Status</strong>
                                                   </div>
                                                   <div class="col-md-3">
                                                    
                                                      <select class="form-control" name="status"
                                                         id="status" required>
                                                         <option value="">Select Status</option>
                                                         <option value="Active">Active</option>
                                                         <option value="Inactive">Inactive</option>
                                                      </select>
                                                   </div>
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 210px; padding-top: 7px;">
                                                      <strong>Address</strong>
                                                   </div>
                                                   <div class="col-md-3" style="margin-left: 31px;">
                                                      <input class="form-control" type="text"
                                                         name="address" id="address"
                                                         placeholder="Enter Address" required
                                                         minlength="5" maxlength="50">
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="container"
                                                style="padding-top: 0px; padding-bottom: 0px; margin-bottom: 15px; margin-top: 8px;">
                                                <div class="row mb-xxl-3">
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 40px; margin-top: 0px; padding-top: 8px; margin-right: 24px;">
                                                      <strong>D.O.B</strong>
                                                   </div>
                                                   <div class="col-md-3">
                                                      <input class="form-control" type="date" id="dob"
                                                         name="dob" style="width: 247.85px;" required>
                                                   </div>
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 210px; padding-top: 7px;">
                                                      <strong>Start Date</strong>
                                                   </div>
                                                   <div class="col-md-3 ps-xxl-1"
                                                      style="margin-left: 31px; padding-left: 50px; padding-top: 2px;">
                                                      <input class="form-control" type="date"
                                                         name="start_date" id="start_date"
                                                         style="width: 247.85px;" required>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="container"
                                                style="padding-top: 0px; padding-bottom: 0px; margin-bottom: 15px; margin-top: 8px;">
                                                <div class="row mb-xxl-3">
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 40px; margin-top: 0px; padding-top: 8px; margin-right: 24px;">
                                                      <strong>Salary</strong>
                                                   </div>
                                                   <div class="col-md-3">
                                                      <input class="form-control" type="number"
                                                         name="salary" id="salary"
                                                         placeholder="Enter Salary" required min="3000"
                                                         max="100000">
                                                   </div>
                                                   <div class="col-md-3 col-xxl-1"
                                                      style="margin-left: 210px; padding-top: 7px;">
                                                      <strong>Phone Number</strong>
                                                   </div>
                                                   <div class="col-md-3 ps-xxl-1"
                                                      style="margin-left: 31px; padding-left: 50px; padding-top: 2px;">
                                                      <input class="form-control" type="tel"
                                                         name="phone_number" id="phone_number"
                                                         placeholder="Enter Phone Number" required
                                                         pattern="(98|97)\d{8}" maxlength="10"
                                                         minlength="10">
                                                   </div>
                                                </div>
                                             </div>

                                          </div>
                                          <input type="hidden" id="edit_mode" name="edit_mode" value="add">
                                          <input type="hidden" id="admin_id_hidden"
                                             name="admin_id_hidden">
                                          <input class="btn btn-primary" type="submit"
                                             style="margin-left: 807px;" value="Add Admin">
                                       </form>
                                    </div>
                                    </div>
                        </div>
                        
                        <div class="col-md-6 ">
                           <div class="text-end dataTables_filter" id="dataTable_filter">
                              <label class="form-label d-block w-100">
                              <input type="search" class="form-control form-control-sm"
                                 id="facultySearchInput" placeholder="Search by Faculty ID or Name"
                                 oninput="fetchFaculty(this.value)">
                              </label>
                           </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid"
                           aria-describedby="dataTable_info">
                           <table class="table my-0" id="dataTable">
                              <thead>
                                 <tr>
                                    <th>Department</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Address&nbsp;</th>
                                    <th>DOB</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                    <th>Phone No</th>
                                    <th>Status</th>
                                    <th><strong>Actions</strong></th>
                                 </tr>
                              </thead>
                              <tbody id="faculty_table_body">
                              </tbody>
                              <tfoot>
                                 <tr>
                                    <th>Department</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Address&nbsp;</th>
                                    <th>DOB</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                    <th>Phone No</th>
                                    <th>Status</th>
                                    <th><strong>Actions</strong></th>
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
         </div>
         <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
      </div>
          <script src="assets/js/sweetalert.js"></script>



    <?php
    if(isset($_SESSION['status']) && $_SESSION['massage']) {
    ?>
    <script>
    swal({
  title: "<?php echo $_SESSION['massage']; ?>",
  icon: "<?php echo $_SESSION['status']; ?>",
});
    </script>
    <?php
    unset($_SESSION['status']);
    unset($_SESSION['massage']);
}
?>
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/bootstrap/js/bootstrap.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script src="assets/js/aos.min.js"></script>
      <script src="assets/js/chart.min.js"></script>
      <script src="assets/js/bs-init.js"></script>
      <script src="assets/js/theme.js"></script>
      <script src="assets/js/validate_faculty.members.js"></script>
      <script src="assets/js/faculty_absence.js"></script>
      <script src="assets/js/faculty_status.js"></script>
      <script src="assets/js/Faculty/faculty_stats.js"></script>
      <script src="assets/js/Faculty/faculty_crud_data.js"></script>
      <script src="assets/js/Faculty/faculty_attandance.js"></script>
      <script src="assets/js/Department/departments_data.js"></script>
   </body>
</html>
