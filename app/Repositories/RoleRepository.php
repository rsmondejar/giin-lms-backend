<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'guard_name'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Role::class;
    }
}
