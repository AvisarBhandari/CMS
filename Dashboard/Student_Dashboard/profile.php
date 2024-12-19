<?php session_start();?>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #fafafa;
            color: #333;
        }


        .profile-section {
            background: linear-gradient(145deg, #f0f8ff, #e0f7fa);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 850px;
            border: 1px solid #d1e0e6;
        }


        .profile-section h2 {
            font-size: 26px;
            font-weight: 700;
            color: #00796b;
            margin-bottom: 20px;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
        }

        .profile-section h2::after {
            content: "";
            width: 50px;
            height: 3px;
            background-color: #00796b;
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
        }


        .profile-section p {
            font-size: 16px;
            color: #607d8b;
            line-height: 1.6;
            margin: 5px 0;
        }


        .profile-section .row {
            margin: 0 -10px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .profile-section .row .col-md-6 {
            padding: 10px;
            flex: 0 0 48%;
        }

        .profile-section .row .col-md-6 p {
            padding: 14px;
            background: #ffffff;
            border-radius: 10px;
            border: 1px solid #b0bec5;
            font-size: 15px;
            color: #455a64;
        }


        .profile-section .row .col-md-6 p:hover {
            background-color: #e0f7fa;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
        }


        .profile-section .row .col-md-6 p strong {
            color: #00796b;
            font-weight: bold;
        }


        .profile-section .row:nth-child(odd) {
            background-color: #ffffff;
        }

        .profile-section .row:nth-child(even) {
            background-color: #f5f5f5;
        }


        .profile-section .action-btn {
            text-align: center;
            margin-top: 20px;
        }

        .profile-section .action-btn button {
            background-color: #00796b;
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            padding: 12px 24px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-section .action-btn button:hover {
            background-color: #004d40;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
        }


        @media (max-width: 768px) {
            .profile-section .row .col-md-6 {
                flex: 0 0 100%;
                margin-bottom: 10px;
            }
        }
    </style>

</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 navbar-dark"
            data-aos="fade-right" data-aos-duration="1200" data-aos-once="true">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#"
                    style="padding-bottom: 0px;padding-top: 0px;">
                    <div class="sidebar-brand-icon rotate-n-15" style="transform: rotate(3deg);">
                        <img src="assets/img/untitled-1.png" width="103" height="110"
                            style="margin-right: -32px;margin-top: -12px;margin-left: -37px;margin-bottom: -6px;">
                    </div>
                    <div class="sidebar-brand-text mx-3"><span
                            style="padding-top: 0px;padding-bottom: 0px;">Academy<br>Keeper</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar-1">
                    <li class="nav-item"><a class="nav-link" href="index.php"><i
                                class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                    <li class="nav-item"><a class="nav-link active" href="profile.php"><i class="fas fa-user"
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
                            data-aos="slide-down" data-aos-duration="1200" data-aos-delay="400" data-aos-once="true">
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
                                            class="d-none d-lg-inline me-2 text-gray-600 small"> <?php echo $_SESSION['name'];?></span><img
                                            class="border rounded-circle img-profile"
                                            src="assets/img/untitled-1.png"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in"><a
                                            class="dropdown-item" href="#"><i
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
                    <h3 class="text-dark mb-4" data-aos="fade" data-aos-duration="1200" data-aos-delay="500"
                        data-aos-once="true">Profile</h3>

                    <div class="container mt-5">
                        <h2 class="text-center">Student Profile</h2>
                        <div id="profile-section" class="card shadow p-4 mt-4 profile-section">
                            <!-- Profile details will be dynamically loaded here -->
                        </div>
                    </div>

                    <script>
                        $(document).ready(function () {
                            // Fetch student profile data using AJAX
                            $.ajax({
                                url: 'Student_php/fetch_student_profile.php', // Server-side script to fetch profile data
                                method: 'POST',
                                dataType: 'json',
                                success: function (response) {
                                    if (response.success) {
                                        const profile = response.data;
                                        const profileHtml = `
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <p><strong>Student ID:</strong> ${profile.student_id}</p>
                                                    <p><strong>Roll No:</strong> ${profile.student_roll}</p>
                                                    <p><strong>Name:</strong> ${profile.student_name}</p>
                                                    <p><strong>Gender:</strong> ${profile.gender}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Email:</strong> ${profile.email}</p>
                                                    <p><strong>Department:</strong> ${profile.department_name}</p>
                                                    <p><strong>Course Code:</strong> ${profile.course_code}</p>
                                                    <p><strong>Phone No:</strong> ${profile.phone_no}</p>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <p><strong>Date of Birth:</strong> ${profile.dob}</p>
                                                    <p><strong>Admission Date:</strong> ${profile.admission_date}</p>
                                                    <p><strong>Parent Name:</strong> ${profile.parent_name}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Address:</strong> ${profile.address}</p>
                                                </div>
                                            </div>`;
                                        $('#profile-section').html(profileHtml);
                                    } else {
                                        $('#profile-section').html('<p class="text-danger">Failed to load profile data.</p>');
                                    }
                                },
                                error: function () {
                                    $('#profile-section').html('<p class="text-danger">An error occurred while fetching profile data.</p>');
                                }
                            });
                        });
                    </script>
                </div>
            </div>
            <footer class="bg-white sticky-footer footer">
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