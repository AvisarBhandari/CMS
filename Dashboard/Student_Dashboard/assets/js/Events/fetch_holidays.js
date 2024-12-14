$(document).ready(function() {
    $.ajax({
        url: 'Student_php/fetch_holidays.php', 
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var eventsList = $('#holiday-list');
            eventsList.empty(); 
            $.each(data, function(index, holiday) {
                var holidayItem = `
                    <li class="list-group-item">
                        <div class="row g-0 align-items-center">
                            <div class="col-xxl-9 me-2">
                                <h6 class="text-info mb-0">${holiday.holiday_date}</h6><small>${holiday.reason}</small>
                            </div>
                        </div>
                    </li>
                `;
                eventsList.append(holidayItem); 
            });
        },
        error: function() {
            console.error('Error fetching holidays');
        }
    });
});
