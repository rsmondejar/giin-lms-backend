<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use App\Interfaces\ILeaveState;


/**
 * App\Models\LeaveState
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Leave[] $leaves
 * @property-read int|null $leaves_count
 * @method static Builder|LeaveState newModelQuery()
 * @method static Builder|LeaveState newQuery()
 * @method static Builder|LeaveState query()
 * @method static Builder|LeaveState whereCreatedAt($value)
 * @method static Builder|LeaveState whereId($value)
 * @method static Builder|LeaveState whereName($value)
 * @method static Builder|LeaveState whereUpdatedAt($value)
 * @mixin Eloquent
 */
class LeaveState extends Model implements ILeaveState
{
    public $table = 'leave_states';

    protected $fillable = ['name'];

    /**
     * @return HasMany
     */
    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class);
    }
}
