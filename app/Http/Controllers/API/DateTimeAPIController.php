<?php

namespace App\Http\Controllers\Api;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Calculator\DateTimeCalculator;
use Illuminate\Support\Facades\Validator;

class DateTimeAPIController extends Controller
{
    /**
     * Find out the number of days between two DateTime parameters.
     *
     * @return \Illuminate\Http\Response
     * 
     * By Ian
     * On 15 Mar 2023
     */
    public function numberOfDays(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_date'=> 'required',
            'second_date'=>'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {   
            $day_diff = (new DateTimeCalculator())->days_diff_calculator($request->input('first_date'), $request->input('second_date'));
            
            return response()->json([
                'status' => 200,
                'day_diff' => $day_diff
            ]);
        }
    }

    /**
     * Find out the number of complete weeks between two DateTime parameters.
     *
     * @return \Illuminate\Http\Response
     * 
     * By Ian
     * On 15 Mar 2023
     */
    public function numberOfWeeks(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_date'=> 'required',
            'second_date'=>'required'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }
        else
        {   

            $week_diff = (new DateTimeCalculator())->weeks_diff_calculator($request->input('first_date'), $request->input('second_date'));

            
            return response()->json([
                'status' => 200,
                'week_diff' => $week_diff
            ]);
        }
    }

    /**
     * Allow the specification of a timezone for comparison of input parameters from different timezones.
     *
     * @return \Illuminate\Http\Response
     * 
     * By Ian
     * On 15 Mar 2023
     */
    public function compareTimezones(Request $request)
    {
        $timeZone1_offset = $request->input('first_timezone');
        $timeZone2_offset = $request->input('second_timezone');

        if($timeZone1_offset == '' || $timeZone2_offset == '')
        {
            return response()->json([
                'status'=>400,
                'errors'=>'Please select a timezone.'
            ]);
        }
        else
        {   
            $timeZone1 = new DateTime(gmdate('h:i:s A', strtotime($timeZone1_offset)));
            $timeZone2 = new DateTime(gmdate('h:i:s A', strtotime($timeZone2_offset)));
            $hour_diff = (new DateTimeCalculator())->timezone_compare_calculator($timeZone1, $timeZone2);

            return response()->json([
                'status' => 200,
                'timeZone1'=>$timeZone1->format('h:i:s A'),
                'timeZone2'=>$timeZone2->format('h:i:s A'),
                'hour_diff' => $hour_diff
            ]);
        }
    }
}
