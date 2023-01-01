<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use App\Interfaces\ILeaveType;

/**
 * Trait LeaveTypeTrait
 * @package App\Traits
 */
trait LeaveTypeTrait
{
    /**
     * Scope Type Holidays
     * @param Builder $query
     * @return Builder
     */
    public function scopeTypeHolidays(Builder $query): Builder
    {
        return $query->where('type_id', ILeaveType::HOLIDAYS);
    }

    /**
     * Scope Type Sickness
     * @param Builder $query
     * @return Builder
     */
    public function scopeTypeSickness(Builder $query): Builder
    {
        return $query->where('type_id', ILeaveType::SICKNESS);
    }

    /**
     * Scope Type Unofficial
     * @param Builder $query
     * @return Builder
     */
    public function scopeTypeUnofficial(Builder $query): Builder
    {
        return $query->where('type_id', ILeaveType::UNOFFICIAL);
    }

    /**
     * Scope Type Absence
     * @param Builder $query
     * @return Builder
     */
    public function scopeTypeAbsence(Builder $query): Builder
    {
        return $query->where('type_id', ILeaveType::ABSENCE);
    }

    /**
     * Scope Type Old School
     * @param Builder $query
     * @return Builder
     */
    public function scopeTypeOldSchool(Builder $query): Builder
    {
        return $query->where('type_id', ILeaveType::OLD_SCHOOL);
    }

    /**
     * Scope Seniority
     * @param Builder $query
     * @return Builder
     */
    public function scopeTypeSeniority(Builder $query): Builder
    {
        return $this->scopeTypeOldSchool($query);
    }
}
