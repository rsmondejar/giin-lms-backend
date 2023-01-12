<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\LeaveDate
 *
 * @property int $id
 * @property int $leave_id
 * @property Carbon $date
 * @property int $is_half_day
 * @property int $is_cancelled
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Leave $leave
 * @method static Builder|LeaveDate byUser(int $userId)
 * @method static Builder|LeaveDate isActive()
 * @method static Builder|LeaveDate isFullDay()
 * @method static Builder|LeaveDate isHalfDay()
 * @method static Builder|LeaveDate newModelQuery()
 * @method static Builder|LeaveDate newQuery()
 * @method static Builder|LeaveDate query()
 * @method static Builder|LeaveDate whereCreatedAt($value)
 * @method static Builder|LeaveDate whereDate($value)
 * @method static Builder|LeaveDate whereDeletedAt($value)
 * @method static Builder|LeaveDate whereId($value)
 * @method static Builder|LeaveDate whereIsCancelled($value)
 * @method static Builder|LeaveDate whereIsHalfDay($value)
 * @method static Builder|LeaveDate whereLeaveId($value)
 * @method static Builder|LeaveDate whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static \Illuminate\Database\Query\Builder|LeaveDate onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|LeaveDate withTrashed()
 * @method static \Illuminate\Database\Query\Builder|LeaveDate withoutTrashed()
 */
class LeaveDate extends Model
{
    use SoftDeletes;
    
    public $table = 'leave_dates';

    protected $fillable = [
        'leave_id',
        'date',
        'is_half_day',
        'is_cancelled',
    ];

    protected $dates = ['date'];

    /**
     * @return BelongsTo
     */
    public function leave(): BelongsTo
    {
        return $this->belongsTo(Leave::class);
    }

    /**
     * Scope By User
     * @param Builder $query
     * @param int $userId
     * @return void
     */
    public function scopeByUser(Builder $query, int $userId): void
    {
        $query->whereHas('leave', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        });
    }

    /**
     * Scope By Is Half Day
     * @param Builder $query
     * @return Builder
     */
    public function scopeIsHalfDay(Builder $query): Builder
    {
        return $query->where('is_half_day', 1);
    }

    /**
     * Scope By Is Full Day
     * @param Builder $query
     * @return Builder
     */
    public function scopeIsFullDay(Builder $query): Builder
    {
        return $query->where('is_half_day', 0);
    }

    /**
     * Scope By Is Active
     * @param Builder $query
     * @return Builder
     */
    public function scopeIsActive(Builder $query): Builder
    {
        return $query->where('is_cancelled', 0);
    }
}
