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
                'diff' => $day_diff
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

        $startDateTime = new DateTime("2023-03-20");
        $endDateTime = new DateTime("2023-03-05");

        $week_diff = floor($endDateTime->diff($startDateTime)->days/7);

        return response()->json([
            'status' => 200,
            'diff' => $week_diff
        ]);
    }

    /**
     * Allow the specification of a timezone for comparison of input parameters from different timezones.
     *
     * @return \Illuminate\Http\Response
     * 
     * By Ian
     * On 15 Mar 2023
     */
    public function compareTimezones()
    {
        $timeZone1 = new DateTimeZone('America/Los_Angeles');
        $timeZone1= new DateTime('now', $timeZone1);

        $timeZone2 = new DateTimeZone('America/New_York');
        $timeZone2= new DateTime('now', $timeZone2);

        $timeZone1_offset = $timeZone1->getOffset() / 3600;
        $timeZone2_offset = $timeZone2->getOffset() / 3600;
        $hour_diff = abs($timeZone1_offset - $timeZone2_offset);

        return response()->json([
            'status' => 200,
            'timeZone1'=>$timeZone1->format('h:i:s A'),
            'timeZone2'=>$timeZone2->format('h:i:s A'),
            'diff' => $hour_diff
        ]);
    }
}
