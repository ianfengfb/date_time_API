<?php
namespace App\Calculator;

use DateTime;

class DateTimeCalculator 
{
    public function days_diff_calculator($dateTime_1, $dateTime_2) {
            $dateTime_1 = new DateTime($dateTime_1);
            $dateTime_2 = new DateTime($dateTime_2);
            return $dateTime_2->diff($dateTime_1)->d;
    }

    public function weeks_diff_calculator($dateTime_1, $dateTime_2) {
            $dateTime_1 = new DateTime($dateTime_1);
            $dateTime_2 = new DateTime($dateTime_2);
            return floor($dateTime_2->diff($dateTime_1)->days/7);
    }

    public function timezone_compare_calculator($timeZone1, $timeZone2) {
            return $timeZone1->diff($timeZone2)->h;
    }
}