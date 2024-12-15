$(document).ready(function() {
    $.ajax({
        url: 'Teacher_php/fetch_events.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var eventsList = $('#events-list');
            eventsList.empty();

            $.each(data, function(index, event) {
                var eventTime = convertTo12HourFormat(event.event_time);

                var eventItem = `
                    <li class="list-group-item">
                        <div class="row g-0 align-items-center">
                            <div class="col-xxl-9 me-2">
                                <h6 class="text-info mb-0">${event.event_date}</h6><small>${event.event_name}</small>
                            </div>
                        </div><span class="text-xs">${eventTime}</span>
                    </li>
                `;
                eventsList.append(eventItem);
            });
        },
        error: function() {
            console.error('Error fetching events');
        }
    });

    function convertTo12HourFormat(time) {
        var dateObj = new Date("1970-01-01T" + time + "Z");
        var hours = dateObj.getHours();
        var minutes = dateObj.getMinutes();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;
        minutes = minutes < 10 ? '0' + minutes : minutes;

        return hours + ':' + minutes + ' ' + ampm;
    }
});
