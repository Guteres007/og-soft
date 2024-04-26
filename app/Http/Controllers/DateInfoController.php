<?php

namespace App\Http\Controllers;

use App\Enums\DayType;
use App\Http\Requests\DateInfoRequest;
use Carbon\Carbon;

class DateInfoController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(DateInfoRequest $request)
    {


        //TODO: Státní svátky dodělat
        $holidays = [
            '01-01-2022',
            '01-05-2022',
            '08-05-2022',
            '05-07-2022',
            '06-07-2022',
            '28-09-2022',
            '28-10-2022',
            '17-11-2022',
            '24-12-2022',
            '25-12-2022',
            '26-12-2022',
        ];



        $date = Carbon::parse($request->date);
        $isWeekend = $date->isWeekend();
        $result = $isWeekend ? DayType::Weekend : DayType::WorkingDay;

        return response()->json(['day_type' => $result]);


    }
}
