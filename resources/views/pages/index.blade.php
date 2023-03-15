{{-- Rending layout --}}
@extends('layout.layout')

{{-- Main content --}}
@section('content')
    <div class="mx-6">
        <div class="row">
            {{-- days difference calculator --}}
            <div class="col-md-4">
                <div class="d-flex flex-col items-center border-2 rounded drop-shadow-lg">
                    <div class="my-4 text-center">
                        <b class="text-2xl">Calculate days difference</b>
                        <p class="text-muted text-sm">*Find out the number of days between two DateTime parameters.</p>
                    </div>
                    <hr class="w-full" />
                    <ul id="days_diff_msgList"></ul>
                    <div class="mt-6 w-2/3">
                        <label for="days_diff_date_1" class="inline-block text-lg mb-2">First Date:</label>
                        <input type="datetime-local" class="border border-gray-200 rounded p-2 w-full" id="days_diff_date_1"/>
                    </div>
                    <div class="mt-6 w-2/3">
                        <label for="days_diff_date_2" class="inline-block text-lg mb-2">Second Date:</label>
                        <input type="datetime-local" class="border border-gray-200 rounded p-2 w-full" id="days_diff_date_2"/>
                    </div>
                    <div class="mt-6 w-2/3">
                        <button class="bg-cyan-800 text-white rounded py-2 px-4 hover:bg-cyan-700" id="days_diff_btn">Calulate</button>
                    </div>
                    {{-- result container --}}
                    <div class="bg-slate-300 w-full text-center mt-10 py-4">
                        <p>Result: the number of days between these two days is</p>
                        <b class="text-2xl" id="days_diff_result"></b>
                    </div>
                </div>
                {{-- Show actually API container --}}
                <div class="mt-3 text-center">
                    <b id="days_diff_API_label" class="hidden">Show API JSON result:</b>
                    <p id="days_diff_API_json" class="text-rose-600"></p>
                </div>
            </div>

            {{-- complete weeks difference calculator --}}
            <div class="col-md-4">
                <div class="d-flex flex-col items-center border-2 rounded drop-shadow-lg">
                    <div class="my-4 text-center">
                        <b class="text-2xl">Calculate complete weeks difference</b>
                        <p class="text-muted text-sm">*Find out the number of complete weeks between two DateTime parameters.</p>
                    </div>
                    <hr class="w-full" />
                    <ul id="weeks_diff_msgList"></ul>
                    <div class="mt-6 w-2/3">
                        <label for="weeks_diff_date_1" class="inline-block text-lg mb-2">First Date:</label>
                        <input type="datetime-local" class="border border-gray-200 rounded p-2 w-full" id="weeks_diff_date_1"/>
                    </div>
                    <div class="mt-6 w-2/3">
                        <label for="weeks_diff_date_2" class="inline-block text-lg mb-2">Second Date:</label>
                        <input type="datetime-local" class="border border-gray-200 rounded p-2 w-full" id="weeks_diff_date_2"/>
                    </div>
                    <div class="mt-6 w-2/3">
                        <button class="bg-cyan-800 text-white rounded py-2 px-4 hover:bg-cyan-700" id="weeks_diff_btn">Calulate</button>
                    </div>
                    <div class="bg-slate-300 w-full text-center mt-10 py-4">
                        <p>Result: the number of complete weeks between these two days is</p>
                        <b class="text-2xl" id="weeks_diff_result"></b>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <b id="weeks_diff_API_label" class="hidden">Show API JSON result:</b>
                    <p id="weeks_diff_API_json" class="text-rose-600"></p>
                </div>
            </div>

            {{-- timezones compare calculator --}}
            <div class="col-md-4">
                <div class="d-flex flex-col items-center border-2 rounded drop-shadow-lg">
                    <div class="my-4 text-center">
                        <b class="text-2xl">Compare two timezones</b>
                        <p class="text-muted text-sm">*Allow the specification of a timezone for comparison of input parameters from different timezones.</p>
                    </div>
                    <hr class="w-full" />
                    <ul id="timezone_diff_msgList"></ul>
                    <div class="mt-6 w-2/3">
                        <label for="time_zone_1" class="inline-block text-lg mb-2">First Timezone:</label>
                        <select class="w-full" id="time_zone_1">
                            @include('partials._timeZone')
                        </select>
                    </div>
                    <div class="mt-6 w-2/3">
                        <label for="time_zone_2" class="inline-block text-lg mb-2">Second Timezone:</label>
                        <select class="w-full" id="time_zone_2">
                            @include('partials._timeZone')
                        </select>
                    </div>
                    <div class="mt-6 w-2/3">
                        <button class="bg-cyan-800 text-white rounded py-2 px-4 hover:bg-cyan-700" id="timezone_diff_btn">Calulate</button>
                    </div>
                    <div class="bg-slate-300 w-full mt-10 py-4">
                        <ul class="ml-3">
                            <li>the current time of first timezone is <b id="time_zone_1_result"></b></li>
                            <li>the current time of second timezone is <b id="time_zone_2_result"></b></li>
                            <li>the difference of hours between these two timezone is <b id="time_zone_result"></b></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <b id="timezone_diff_API_label" class="hidden">Show API JSON result:</b>
                    <p id="timezone_diff_API_json" class="text-rose-600"></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        /**************************************/
        /* Script for days difference calculator
        /***************************************/

        // click calculator button
        $('#days_diff_btn').on('click', function() {
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
            type: "GET",
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
        $('#weeks_diff_btn').on('click', function() {
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
            type: "GET",
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
        $('#timezone_diff_btn').on('click', function() {
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
            type: "GET",
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
    </script>
@endsection