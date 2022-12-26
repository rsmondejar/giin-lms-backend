<?php

namespace App\Interfaces;

/**
 * Interface ILeaveType
 * @package App\Models
 */
interface ILeaveType
{
    public const HOLIDAYS = 1;
    public const SICKNESS = 2;
    public const UNOFFICIAL = 3;
    public const ABSENCE = 4;
    public const OLD_SCHOOL = 5;
}
