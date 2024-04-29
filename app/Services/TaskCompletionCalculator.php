<?php

namespace App\Services;

use App\Enums\DayType;
use Carbon\Carbon;

class TaskCompletionCalculator
{

    public function __construct(private readonly DateInfoService $dateInfoService)
    {
    }

    public function calculate(string $startDatetime, int $duration, string $workdayOnly, string $workStartTime, string $workEndTime): string
    {
        $start = Carbon::parse($startDatetime);

        $workStart = Carbon::parse($startDatetime)->setTimeFromTimeString($workStartTime);
        $workEnd = Carbon::parse($startDatetime)->setTimeFromTimeString($workEndTime);

        if ($workdayOnly) {
            $start = $this->skipNonWorkingDays($start);
        }

        $workdayDuration = $workStart->diffInMinutes($workEnd);
        if ($duration <= $workdayDuration && $start->copy()->addMinutes($duration)->lte($workEnd)) {
            $start->addMinutes($duration);
        } else {

            $daysNeeded = intdiv($duration, $workdayDuration);
            $remainingMinutes = $duration % $workdayDuration;

            $start->addWeekdays($daysNeeded);
            $start->setTimeFromTimeString($workStartTime);
            if ($remainingMinutes > 0) {
                if ($start->copy()->addMinutes($remainingMinutes)->gte($workEnd)) {
                    $start->addMinutes($remainingMinutes);
                } else {
                    $start->addWeekday()->setTimeFromTimeString($workStartTime)->addMinutes($remainingMinutes);
                }
            }
        }

        return $start->format('Y-m-d H:i:s');
    }

    private function skipNonWorkingDays(Carbon $start): Carbon
    {
        do {
            $dayType = $this->dateInfoService->getDayType($start);
            if ($dayType === DayType::Weekend || $dayType === DayType::Holiday) {
                $start->modify('next weekday');
            }
        } while ($dayType === DayType::Weekend || $dayType === DayType::Holiday);

        return $start;
    }
}
