<?php

namespace App\Interfaces;

/**
 * Interface IRequestHolidaysErrorCode
 * @package App\Interfaces
 */
interface IRequestHolidaysErrorCode
{
    public const DAYS_PREVIOUSLY_REQUESTED = 1;
    public const ALL_HOLIDAYS_ALREADY_TAKEN = 2;
    public const USER_HOLIDAYS_NOT_SET = 3;
}
