<?php

namespace App\Services;

use App\Enums\DayType;
use Carbon\Carbon;
use App\Models\Holiday;

class DateInfoService
{
    public function getDayType(string $dateString): DayType
    {
        $date = Carbon::parse($dateString);
        $isWeekend = $date->isWeekend();
        $isHoliday = Holiday::where('date', $date->format('Y-m-d'))->exists();
        if ($isHoliday) {
            return DayType::Holiday;
        }
        return $isWeekend ? DayType::Weekend : DayType::WorkingDay;
    }
}
