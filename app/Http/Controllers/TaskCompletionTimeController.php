<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCompletionTimeRequest;
use App\Services\TaskCompletionCalculator;

class TaskCompletionTimeController extends Controller
{

    public function __construct(private readonly TaskCompletionCalculator $taskCompletionCalculator)
    {
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(TaskCompletionTimeRequest $request)
    {
        $completionTime = $this->taskCompletionCalculator->calculate(
            startDatetime: $request->start_datetime,
            duration: $request->duration_minutes,
            workdayOnly: $request->workday_only,
            workStartTime: $request->work_start_time,
            workEndTime: $request->work_end_time
        );
        return response()->json(['estimated_completion_time' => $completionTime]);
    }
}
