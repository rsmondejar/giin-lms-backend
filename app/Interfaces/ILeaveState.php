<?php

namespace App\Interfaces;

/**
 * Interface ILeaveState
 * @package App\Interfaces
 */
interface ILeaveState
{
    public const PENDING = 1;
    public const APPROVED = 2;
    public const REJECTED = 3;
    public const CANCELLED = 4;
}
