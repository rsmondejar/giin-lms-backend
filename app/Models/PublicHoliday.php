<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PublicHoliday
 *
 * @property-read string $day_name
 * @property string $name Name
 * @property Carbon $date Date
 * @property int $year Year
 * @method static Builder|PublicHoliday newModelQuery()
 * @method static Builder|PublicHoliday newQuery()
 * @method static Builder|PublicHoliday ofYear(string $year)
 * @method static Builder|PublicHoliday query()
 * @mixin Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|PublicHoliday whereCreatedAt($value)
 * @method static Builder|PublicHoliday whereDate($value)
 * @method static Builder|PublicHoliday whereDeletedAt($value)
 * @method static Builder|PublicHoliday whereId($value)
 * @method static Builder|PublicHoliday whereName($value)
 * @method static Builder|PublicHoliday whereUpdatedAt($value)
 * @method static Builder|PublicHoliday whereYear($value)
 * @method static \Illuminate\Database\Query\Builder|PublicHoliday onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|PublicHoliday withTrashed()
 * @method static \Illuminate\Database\Query\Builder|PublicHoliday withoutTrashed()
 */
class PublicHoliday extends Model
{
    use SoftDeletes;

    public $table = 'public_holidays';

    protected $fillable = ['name', 'date', 'year'];

    protected $dates = ['date'];

    protected $appends = ['day_name'];

    protected $casts = [
        'name' => 'string',
        'date' => 'date:Y-m-d',
    ];

    /**
     * @return string
     */
    public function getDayNameAttribute(): string
    {
        return $this->date->locale('es_ES')->dayName;
    }

    /**
     * Scope Year
     * @param Builder $query
     * @param string $year
     * @return Builder
     */
    public function scopeOfYear(Builder $query, string $year): Builder
    {
        return $query->whereYear('year', $year);
    }
}
