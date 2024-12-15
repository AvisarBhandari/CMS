$(document).ready(function() {
    $('#daySelect').change(function() {
        var selectedDay = $(this).val();
        if (selectedDay) {
            fetchTimetable(selectedDay);  
        } else {
            $('#timetableBody').empty(); 
        }
    });
    function formatTime(time) {
        var date = new Date('1970-01-01T' + time + 'Z');  
        return date.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});  
    }

    function fetchTimetable(day) {
        $.ajax({
            url: 'Teacher_php/timetable.php',  
            type: 'GET',
            data: { day: day },  
            dataType: 'json',
            success: function(data) {
               
                $('#timetableBody').empty();

                if (data.length > 0) {
                  
                    $.each(data, function(index, row) {
                        var startTimeFormatted = formatTime(row.start_time); 
                        var endTimeFormatted = formatTime(row.end_time);  

                        var newRow = '<tr>' +
                                     '<td>' + row.course_name + '</td>' +  
                                     '<td>' + row.semester + '</td>' +  
                                     '<td>' + row.subject_name + '</td>' +
                                     '<td>' + startTimeFormatted + '</td>' +  
                                     '<td>' + endTimeFormatted + '</td>' +  
                                     '</tr>';
                        $('#timetableBody').append(newRow);
                    });
                } else {
                    $('#timetableBody').append('<tr><td colspan="5">No timetable available for this day.</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.log('Error: ' + error);
            }
        });
    }
});
