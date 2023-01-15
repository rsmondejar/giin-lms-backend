<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class IncorporationDate
 *
 * @package App\Models
 * @property int $user_id
 * @property int $business_id Business ID
 * @property Carbon $begin_date
 * @property Carbon|null $end_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Business $business
 * @property-read User $user
 * @method static Builder|IncorporationDate newModelQuery()
 * @method static Builder|IncorporationDate newQuery()
 * @method static \Illuminate\Database\Query\Builder|IncorporationDate onlyTrashed()
 * @method static Builder|IncorporationDate query()
 * @method static Builder|IncorporationDate whereBeginDate($value)
 * @method static Builder|IncorporationDate whereBusinessId($value)
 * @method static Builder|IncorporationDate whereCreatedAt($value)
 * @method static Builder|IncorporationDate whereDeletedAt($value)
 * @method static Builder|IncorporationDate whereEndDate($value)
 * @method static Builder|IncorporationDate whereId($value)
 * @method static Builder|IncorporationDate whereUpdatedAt($value)
 * @method static Builder|IncorporationDate whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|IncorporationDate withTrashed()
 * @method static \Illuminate\Database\Query\Builder|IncorporationDate withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $deleted_at
 * @method static Builder|IncorporationDate isNotIntern()
 */
class IncorporationDate extends Model
{
    protected $connection = 'mysql';

    public $table = 'users_has_incorporation_dates';

    public $fillable = [
        'user_id',
        'business_id',
        'begin_date',
        'end_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'business_id' => 'integer',
        'begin_date' => 'date',
        'end_date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'business_id' => 'required',
        'begin_date' => 'datetime:Y-m-d',
        'end_date' => 'nullable|datetime:Y-m-d',
    ];

    public static array $interBusiness = [
       // Add businesses
    ];

    /**
     * @return BelongsTo
     **/
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    /**
     * @return BelongsTo
     **/
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Is Not Intern (No es becario)
     * @param $query
     * @return mixed
     */
    public function scopeIsNotIntern($query)
    {
        return $query->whereNotIn('business_id', self::$interBusiness);
    }

    public function isInter(): bool
    {
        return in_array($this->business_id, self::$interBusiness);
    }
}
