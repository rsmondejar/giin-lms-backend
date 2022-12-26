<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
 */
class PublicHoliday extends Model
{
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
