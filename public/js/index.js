/**************************************/
/* Script for days difference calculator
/***************************************/

// click calculator button
$('#days_diff_btn').on('click', function () {
    const days_diff_date_1 = $('#days_diff_date_1').val();
    const days_diff_date_2 = $('#days_diff_date_2').val();
    //AJAX data
    const data = {
        'first_date': days_diff_date_1,
        'second_date': days_diff_date_2
    }
    console.log(days_diff_date_1);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "/api/numberOfDays",
        data: data,
        dataType: "json",
        success: function (response) {
            // One or both of the dates are not provided
            if (response.status == 400) {
                $('#days_diff_msgList').html("");
                $('#days_diff_msgList').addClass('alert alert-danger mt-2');
                $.each(response.errors, function (key, err_value) {
                    $('#days_diff_msgList').append('<li>' + err_value + '</li>');
                });
                // Get AJAX response successfully
            } else {
                $('#days_diff_msgList').html("");
                $('#days_diff_msgList').removeClass('alert alert-danger mt-2');
                $('#days_diff_result').text(response.day_diff);
                // Show actually API JSON response
                $('#days_diff_API_label').css('display', 'block');
                var response_json = JSON.stringify(response);
                $('#days_diff_API_json').text(response_json);
            }
        }
    });
})

/**************************************/
/* Script for days difference calculator
/***************************************/

// click calculator button
$('#weeks_diff_btn').on('click', function () {
    const weeks_diff_date_1 = $('#weeks_diff_date_1').val();
    const weeks_diff_date_2 = $('#weeks_diff_date_2').val();
    //AJAX data
    const data = {
        'first_date': weeks_diff_date_1,
        'second_date': weeks_diff_date_2
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "/api/numberOfWeeks",
        data: data,
        dataType: "json",
        success: function (response) {
            // One or both of the dates are not provided
            if (response.status == 400) {
                $('#weeks_diff_msgList').html("");
                $('#weeks_diff_msgList').addClass('alert alert-danger mt-2');
                $.each(response.errors, function (key, err_value) {
                    $('#weeks_diff_msgList').append('<li>' + err_value + '</li>');
                });
                // Get AJAX response successfully
            } else {
                $('#weeks_diff_msgList').html("");
                $('#weeks_diff_msgList').removeClass('alert alert-danger mt-2');
                $('#weeks_diff_result').text(response.week_diff);
                // Show actually API JSON response
                $('#weeks_diff_API_label').css('display', 'block');
                var response_json = JSON.stringify(response);
                $('#weeks_diff_API_json').text(response_json);
            }
        }
    });
})

/**************************************/
/* timezones compare calculator
/***************************************/

// click calculator button
$('#timezone_diff_btn').on('click', function () {
    const time_zone_1 = $('#time_zone_1').val();
    const time_zone_2 = $('#time_zone_2').val();
    //AJAX data
    const data = {
        'first_timezone': time_zone_1,
        'second_timezone': time_zone_2
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "/api/compareTimezones",
        data: data,
        dataType: "json",
        success: function (response) {
            // One or both of the dates are not provided
            if (response.status == 400) {
                $('#timezone_diff_msgList').html("");
                $('#timezone_diff_msgList').addClass('alert alert-danger mt-2');
                $('#timezone_diff_msgList').append('<li>' + response.errors + '</li>');
                // Get AJAX response successfully
            } else {
                $('#timezone_diff_msgList').html("");
                $('#timezone_diff_msgList').removeClass('alert alert-danger mt-2');
                $('#time_zone_1_result').text(response.timeZone1);
                $('#time_zone_2_result').text(response.timeZone2);
                $('#time_zone_result').text(response.hour_diff);
                // Show actually API JSON response
                $('#timezone_diff_API_label').css('display', 'block');
                var response_json = JSON.stringify(response);
                $('#timezone_diff_API_json').text(response_json);
            }
        }
    });
})