<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use App\Interfaces\ILeaveType;

/**
 * App\Models\LeaveType
 *
 * @property int $id
 * @property string $name
 * @property int $is_unplanned
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|Leave[] $leaves
 * @property-read int|null $leaves_count
 * @method static Builder|LeaveType isUnplanned()
 * @method static Builder|LeaveType newModelQuery()
 * @method static Builder|LeaveType newQuery()
 * @method static \Illuminate\Database\Query\Builder|LeaveType onlyTrashed()
 * @method static Builder|LeaveType query()
 * @method static Builder|LeaveType whereCreatedAt($value)
 * @method static Builder|LeaveType whereDeletedAt($value)
 * @method static Builder|LeaveType whereId($value)
 * @method static Builder|LeaveType whereIsUnplanned($value)
 * @method static Builder|LeaveType whereName($value)
 * @method static Builder|LeaveType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|LeaveType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|LeaveType withoutTrashed()
 * @mixin Eloquent
 */
class LeaveType extends Model implements ILeaveType
{
    use SoftDeletes;

    public $table = 'leave_types';

    protected $fillable = ['name', 'is_unplanned'];

    /**
     * @return HasMany
     */
    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class);
    }

    /**
     * Scope Is Unplanned
     * @param Builder $query
     * @return Builder
     */
    public function scopeIsUnplanned(Builder $query): Builder
    {
        return $query->where('is_unplanned', true);
    }
}
