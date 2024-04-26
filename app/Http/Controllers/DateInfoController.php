<?php

namespace App\Http\Controllers;

use App\Http\Requests\DateInfoRequest;
use App\Services\DateInfoService;

class DateInfoController extends Controller
{

    public function __construct(private readonly DateInfoService $dateInfoService)
    {
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(DateInfoRequest $request)
    {

        $result = $this->dateInfoService->getDayType($request->date);
        return response()->json(['day_type' => $result]);

    }
}
