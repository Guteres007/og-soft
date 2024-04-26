<?php

namespace App\Enums;

enum DayType: string
{
    case WorkingDay = 'WorkingDay';
    case Weekend = 'Weekend';
    case Holiday = 'Holiday';
}

