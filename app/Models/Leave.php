<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use App\Traits\LeaveStateTrait;
use App\Traits\LeaveTypeTrait;

/**
 * App\Models\Leave
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $requested_to_user_id
 * @property string|null $comment
 * @property string|null $emails
 * @property int $state_id
 * @property int $type_id
 * @property int $user_holiday_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Collection|LeaveDate[] $dates
 * @property-read int|null $dates_count
 * @property-read HigherOrderBuilderProxy|mixed|null $first_date
 * @property-read HigherOrderBuilderProxy|mixed|null $last_date
 * @property-read User|null $manager
 * @property-read User|null $requestedToUser
 * @property-read LeaveState $state
 * @property-read LeaveType $type
 * @property-read User $user
 * @property-read UserHoliday $userHoliday
 * @method static Builder|Leave byUser(int $userId)
 * @method static Builder|Leave isAllowed()
 * @method static Builder|Leave newModelQuery()
 * @method static Builder|Leave newQuery()
 * @method static Builder|Leave ofCurrentMonth()
 * @method static Builder|Leave ofCurrentYear()
 * @method static Builder|Leave ofFuture()
 * @method static Builder|Leave ofLastYear()
 * @method static Builder|Leave ofNextYear()
 * @method static Builder|Leave query()
 * @method static Builder|Leave statusApproved()
 * @method static Builder|Leave statusCancelled()
 * @method static Builder|Leave statusPending()
 * @method static Builder|Leave statusRejected()
 * @method static Builder|Leave typeAbsence()
 * @method static Builder|Leave typeHolidays()
 * @method static Builder|Leave typeOldSchool()
 * @method static Builder|Leave typeSeniority()
 * @method static Builder|Leave typeSickness()
 * @method static Builder|Leave typeUnofficial()
 * @method static Builder|Leave whereComment($value)
 * @method static Builder|Leave whereCreatedAt($value)
 * @method static Builder|Leave whereDeletedAt($value)
 * @method static Builder|Leave whereEmails($value)
 * @method static Builder|Leave whereId($value)
 * @method static Builder|Leave whereRequestedToUserId($value)
 * @method static Builder|Leave whereStateId($value)
 * @method static Builder|Leave whereTypeId($value)
 * @method static Builder|Leave whereUpdatedAt($value)
 * @method static Builder|Leave whereUserHolidayId($value)
 * @method static Builder|Leave whereUserId($value)
 * @mixin Eloquent
 * @method static Builder|Leave byManager(int $userId)
 * @method static \Illuminate\Database\Query\Builder|Leave onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Leave withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Leave withoutTrashed()
 */
class Leave extends Model
{
    use LeaveStateTrait;
    use LeaveTypeTrait;
    use SoftDeletes;

    public $table = 'leaves';

    protected $fillable = [
        'user_id',
        'requested_to_user_id',
        'emails',
        'comment',
        'state_id',
        'type_id',
        'user_holiday_id',
    ];

    protected $appends = ['first_date', 'last_date'];

    /**
     * Get First Date Attribute
     * @return HigherOrderBuilderProxy|mixed|null
     */
    public function getFirstDateAttribute(): mixed
    {
        return $this->dates()->orderBy('date')?->first()?->date;
    }

    /**
     * Get Last Date Attribute
     * @return HigherOrderBuilderProxy|mixed|null
     */
    public function getLastDateAttribute(): mixed
    {
        return $this->dates()->orderByDesc('date')?->first()?->date;
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function requestedToUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_to_user_id');
    }

    /**
     * @return BelongsTo
     */
    public function manager(): BelongsTo
    {
        return $this->requestedToUser();
    }

    /**
     * @return BelongsTo
     */
    public function userHoliday(): BelongsTo
    {
        return $this->belongsTo(UserHoliday::class, 'user_holiday_id');
    }

    /**
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(LeaveState::class, 'state_id');
    }

    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(LeaveType::class, 'type_id');
    }

    /**
     * @return HasMany
     */
    public function dates(): HasMany
    {
        return $this->hasMany(LeaveDate::class);
    }

    /**
     * Scope Current Year
     * @param Builder $query
     * @return Builder
     */
    public function scopeOfCurrentYear(Builder $query): Builder
    {
        return $query->whereHas('dates', fn ($query) => $query->whereYear('date', now()->year));
    }

    /**
     * Scope Last Year
     * @param Builder $query
     * @return Builder
     */
    public function scopeOfLastYear(Builder $query): Builder
    {
        return $query->whereHas('dates', fn ($query) => $query->whereYear('date', now()->subYear()->year));
    }

    /**
     * Scope Next Year
     * @param Builder $query
     * @return Builder
     */
    public function scopeOfNextYear(Builder $query): Builder
    {
        return $query->whereHas('dates', fn ($query) => $query->whereYear('date', now()->addYear()->year));
    }

    /**
     * Scope Future
     * @param Builder $query
     * @return Builder
     */
    public function scopeOfFuture(Builder $query): Builder
    {
        return $query->whereHas('dates', fn ($query) => $query->whereYear('date', '>=', now()->year));
    }

    /**
     * Scope Current Month
     * @param Builder $query
     * @return Builder
     */
    public function scopeOfCurrentMonth(Builder $query): Builder
    {
        return $query->whereHas(
            'dates',
            fn ($query) => $query->whereBetween('date', [
                today()->firstOfMonth(),
                today()->lastOfMonth()
            ])
        );
    }

    /**
     * Scope By User
     * @param Builder $query
     * @param int $userId
     * @return Builder
     */
    public function scopeByUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope By Manager
     * @param Builder $query
     * @param int $userId
     * @return Builder
     */
    public function scopeByManager(Builder $query, int $userId): Builder
    {
        return $query->where('requested_to_user_id', $userId);
    }
}
