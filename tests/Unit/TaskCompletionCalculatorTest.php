<?php

use PHPUnit\Framework\TestCase;
use App\Services\TaskCompletionCalculator;
use App\Services\DateInfoService;
use App\Enums\DayType;

class TaskCompletionCalculatorTest extends TestCase
{
    private $dateInfoServiceMock;
    private $calculator;

    protected function setUp(): void
    {
        $this->dateInfoServiceMock = $this->createMock(DateInfoService::class);
        $this->calculator = new TaskCompletionCalculator($this->dateInfoServiceMock);
    }

    public function testCalculateOneWorkingDayWithDelayedWorkingHour()
    {
        $startDatetime = '2024-04-01 09:00:00'; // Monday
        $duration = 180; // 3 hours
        $workdayOnly = true;
        $workStartTime = '08:00:00';
        $workEndTime = '17:00:00';

        $this->dateInfoServiceMock->method('getDayType')
            ->willReturn(DayType::WorkingDay);

        $result = $this->calculator->calculate($startDatetime, $duration, $workdayOnly, $workStartTime, $workEndTime);

        $this->assertEquals('2024-04-01 12:00:00', $result);
    }


    public function testAnotherDay()
    {
        $startDatetime = '2024-04-01 09:00:00';
        $duration = 480; // 8 hours
        $workdayOnly = true;
        $workStartTime = '08:00:00';
        $workEndTime = '16:00:00';

        $this->dateInfoServiceMock->method('getDayType')
            ->willReturn(DayType::WorkingDay);

        $result = $this->calculator->calculate($startDatetime, $duration, $workdayOnly, $workStartTime, $workEndTime);

        $this->assertEquals('2024-04-02 09:00:00', $result);
    }

    public function testCalculateWithWeekendInterruption()
    {
        $startDatetime = '2024-04-05 16:00:00'; // Friday
        $duration = 480; // 8 hours
        $workdayOnly = true;
        $workStartTime = '08:00:00';
        $workEndTime = '17:00:00';

        $this->dateInfoServiceMock->method('getDayType')
            ->willReturnOnConsecutiveCalls(DayType::WorkingDay, DayType::Weekend, DayType::Weekend, DayType::WorkingDay);

        $result = $this->calculator->calculate($startDatetime, $duration, $workdayOnly, $workStartTime, $workEndTime);

        $this->assertEquals('2024-04-08 15:00:00', $result); // The task ends by the end of Monday
    }

    // Additional tests can include scenarios for holidays, part-time work days, and edge cases like time wrapping around midnight.
}
