<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserHoliday
 *
 * @property int $id
 * @property int $user_id
 * @property int $year
 * @property string $holidays
 * @property string $seniority_days
 * @property string $extra
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Collection|Leave[] $leaves
 * @property-read int|null $leaves_count
 * @property-read User $user
 * @method static Builder|UserHoliday byUser(int $userId)
 * @method static Builder|UserHoliday newModelQuery()
 * @method static Builder|UserHoliday newQuery()
 * @method static Builder|UserHoliday ofCurrentYear()
 * @method static Builder|UserHoliday ofLastYear()
 * @method static Builder|UserHoliday query()
 * @method static Builder|UserHoliday whereCreatedAt($value)
 * @method static Builder|UserHoliday whereDeletedAt($value)
 * @method static Builder|UserHoliday whereExtra($value)
 * @method static Builder|UserHoliday whereHolidays($value)
 * @method static Builder|UserHoliday whereId($value)
 * @method static Builder|UserHoliday whereSeniorityDays($value)
 * @method static Builder|UserHoliday whereUpdatedAt($value)
 * @method static Builder|UserHoliday whereUserId($value)
 * @method static Builder|UserHoliday whereYear($value)
 * @mixin Eloquent
 */
class UserHoliday extends Model
{
    use SoftDeletes;

    protected $table = 'user_holidays';

    protected $fillable = ['user_id', 'year', 'holidays', 'seniority_days', 'extra'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class, 'user_holiday_id');
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
     * Scope Current Year
     * @param Builder $query
     * @return Builder
     */
    public function scopeOfCurrentYear(Builder $query): Builder
    {
        return $query->where('year', now()->year);
    }

    /**
     * Scope Last Year
     * @param Builder $query
     * @return Builder
     */
    public function scopeOfLastYear(Builder $query): Builder
    {
        return $query->where('year', now()->subYear()->year);
    }
}
