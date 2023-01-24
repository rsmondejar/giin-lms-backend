<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * User Auth Resource.
 * @package App\Http\Resources
 */
class UserAuthResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        /** @var User $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'business' => [
                'id' => $this->business_id,
                'name' => $this->business->business_name,
            ],
            'department' => [
                'id' => $this->department_id,
                'name' => $this->department->department_name,
            ],
//            'frontend_role' => $this->frontend_role,
        ];
    }
}
