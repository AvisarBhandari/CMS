$(document).ready(function() {
   
    $.ajax({
        url: 'Teacher_php/get_faculty_department.php', 
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                var department = data.department;
                $.ajax({
                    url: 'Teacher_php/get_courses_by_department.php', 
                    method: 'GET',
                    data: { department: department },
                    dataType: 'json',
                    success: function(coursesData) {
                        if (coursesData.success) {
                           
                            coursesData.courses.forEach(function(course) {
                                $.ajax({
                                    url: 'Teacher_php/get_student_count.php', 
                                    method: 'GET',
                                    data: { course_code: course.course_code },
                                    dataType: 'json',
                                    success: function(studentsData) {
                                        console.log('Student Count Data:', studentsData)
                                        if (studentsData.success) {
                                            var courseCard = `
                                                <div class="col-md-6 col-xl-3 col-xxl-3 mb-4 me-3 ms-5" data-aos="fade-right"
                                                    data-aos-duration="650" data-aos-delay="500" data-aos-once="true">
                                                    <div class="card shadow border-left-primary py-2" style="box-shadow: 0px 0px;">
                                                        <div class="card-body">
                                                            <div class="row g-0 align-items-center">
                                                                <div class="col me-2">
                                                                    <div class="text-uppercase text-primary fw-bold text-xs mb-1">
                                                                        <span>Total Student in ${course.course_name}</span>
                                                                    </div>
                                                                    <div class="text-dark fw-bold h5 mb-0">
                                                                        <span>${studentsData.total_students}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                                        height="1em" fill="currentColor" viewBox="0 0 16 16"
                                                                        class="bi bi-person fa-2x text-gray-300">
                                                                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"></path>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            `;
                                            $('#course-info-container').append(courseCard);
                                        } else {
                                            console.log("No students found for course " + course.course_name);
                                        }
                                    }
                                });
                            });
                        }
                    }
                });
            }
        }
    });
});