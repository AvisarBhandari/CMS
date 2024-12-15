document.addEventListener('DOMContentLoaded', function () {
    fetchCourseDetails();
});

function fetchCourseDetails() {
    fetch('Student_php/fetch_course_details.php') 
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const courseDetails = data.course_details;
                const subjects = data.subjects;

                // Display course details in a responsive card
                let courseDetailsHTML = `
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Course Details</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Department Name:</strong> ${courseDetails.department_name}</p>
                            <p><strong>Course Name:</strong> ${courseDetails.course_name}</p>
                            <p><strong>Course Code:</strong> ${courseDetails.course_code}</p>
                            <p><strong>Credits:</strong> ${courseDetails.credits}</p>
                            <p><strong>Course Type:</strong> ${courseDetails.course_type}</p>
                            <p><strong>Course Fee:</strong> ₹${courseDetails.course_fee}</p>
                        </div>
                    </div>
                `;
                document.getElementById('courseDetails').innerHTML = courseDetailsHTML;

                // Display subjects in a table with hover effect and striped rows
                let subjectsHTML = `
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Subjects List</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Credits</th>
                                        <th>Semester</th>
                                    </tr>
                                </thead>
                                <tbody>
                `;
                
                subjects.forEach(subject => {
                    subjectsHTML += `
                        <tr>
                            <td>${subject.subject_name}</td>
                            <td>${subject.credits}</td>
                            <td>${subject.semester}</td>
                        </tr>
                    `;
                });

                subjectsHTML += `
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;
                document.getElementById('subjectsList').innerHTML = subjectsHTML;
            } else {
                alert(data.message || 'Error fetching data.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while fetching the course details.');
        });
}