$(document).ready(function () {
    // On semester change
    $('#semester').change(function () {
        const semester = $(this).val();

        if (semester) {
            $.ajax({
                url: 'Student_php/exam-routine.php', 
                type: 'POST',
                dataType: 'json',
                data: { semester: semester },
                success: function (response) {
                    console.log('Response Data:', response); 
                    console.log('Course Name:', response.course_name) 
                    if (response.success) {
                        let routineHTML = '';
                        response.data.forEach(item => {
                            routineHTML += `
                                <tr>
                                    <td>${item.exam_name}</td>
                                    <td>${item.exam_date}</td>
                                    <td>${item.exam_time}</td>
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
