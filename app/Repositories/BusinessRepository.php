<?php

namespace App\Repositories;

use App\Models\Business;

class BusinessRepository extends BaseRepository
{
    protected array $fieldSearchable = [
        'business_name',
        'address',
        'city',
        'postal_code',
        'country',
        'phone',
        'email',
        'website',
        'logo'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Business::class;
    }
}
