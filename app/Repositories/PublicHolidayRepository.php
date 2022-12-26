<?php

namespace App\Repositories;

use App\Models\PublicHoliday;

class PublicHolidayRepository extends BaseRepository
{
    protected array $fieldSearchable = [
        'name',
        'date',
        'year'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return PublicHoliday::class;
    }

    public function create(array $input): PublicHoliday
    {
        $publicHoliday = new PublicHoliday();

        $publicHoliday->fill([
            'name' => $input['name'],
            'date' => $input['date']
        ]);

        $publicHoliday->year = $publicHoliday->date->year;

        $publicHoliday->save();

        return $publicHoliday;
    }
}
