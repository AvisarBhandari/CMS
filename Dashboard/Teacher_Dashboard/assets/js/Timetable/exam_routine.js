$(document).ready(function () {

    $.ajax({
        url: 'Teacher_php/fetch_courses_data.php', 
        type: 'POST',
        dataType: 'json',
        success: function (response) {
            if (response.success) {
                let courseOptions = '<option value="">Select Course</option>';
                response.courses.forEach(item => {
                    courseOptions += `<option value="${item.course_code}">${item.course_name}</option>`;
                });
                $('#course').html(courseOptions);
            } else {
                $('#course').html(`<option>${response.message}</option>`);
            }
        },
        error: function () {
            $('#course').html('<option>Error fetching courses</option>');
        }
    });

    // On course and semester change
    $('#course, #semester').change(function () {
        const course_code = $('#course').val();
        const semester = $('#semester').val();

        if (course_code && semester) {
            $.ajax({
                url: 'Teacher_php/fetch_exam_routine_display.php', 
                type: 'POST',
                dataType: 'json',
                data: { course_code: course_code, semester: semester },
                success: function (response) {
                    if (response.success) {
                        let routineHTML = '';
                        response.data.forEach(item => {
                            const examTime12Hour = convertTo12HourFormat(item.exam_time);
                            routineHTML += `
                                <tr>
                                    <td>${item.exam_name}</td>
                                    <td>${item.exam_date}</td>
                                    <td>${examTime12Hour}</td>
                                    <td>${item.subject_name}</td>
                                    <td>${item.duration} mins</td>
                                    <td>${item.location}</td>
                                </tr>`;
                        });
                        $('#exam-routine').html(routineHTML);
                    } else {
                        $('#exam-routine').html(`<tr><td colspan="6">${response.message}</td></tr>`);
                    }
                },
                error: function () {
                    $('#exam-routine').html('<tr><td colspan="6">Error fetching routine.</td></tr>');
                }
            });
        } else {
            $('#exam-routine').html('');
        }
    });
});

function convertTo12HourFormat(time) {
    let [hours, minutes] = time.split(':');
    let period = 'AM';

    hours = parseInt(hours);
    
    if (hours >= 12) {
        period = 'PM';
        if (hours > 12) hours -= 12;
    } else if (hours === 0) {
        hours = 12;
    }

    minutes = minutes ? minutes : '00';
    return `${hours}:${minutes} ${period}`;
}
