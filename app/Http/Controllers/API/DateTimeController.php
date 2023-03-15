<?php

namespace App\Http\Controllers\Api;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            $dateTime_1 = new DateTime($request->input('first_date'));
            $dateTime_2 = new DateTime($request->input('second_date'));

            $day_diff = $dateTime_2->diff($dateTime_1)->d;

            
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
            $dateTime_1 = new DateTime($request->input('first_date'));
            $dateTime_2 = new DateTime($request->input('second_date'));

            $week_diff = floor($dateTime_2->diff($dateTime_1)->days/7);

            
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
        $validator = Validator::make($request->all(), [
            'first_timezone'=> 'required',
            'second_timezone'=>'required'
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
            $timeZone1 = new DateTime(gmdate('h:i:s A', strtotime('-3 hours')));
            $timeZone2 = new DateTime(gmdate('h:i:s A', strtotime('-1 hour')));
            $hour_diff = $timeZone1->diff($timeZone2)->h;

            return response()->json([
                'status' => 200,
                'timeZone1'=>$timeZone1->format('h:i:s A'),
                'timeZone2'=>$timeZone2->format('h:i:s A'),
                'hour_diff' => $request->input('first_timezone')
            ]);
        }
    }
}
