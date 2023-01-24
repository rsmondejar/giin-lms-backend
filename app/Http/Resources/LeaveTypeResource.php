<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use App\Models\LeaveType;

/**
 * Leave Type Resource
 * @package App\Http\Resources
 */
class LeaveTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    #[ArrayShape([
        'id' => "mixed",
        'name' => "mixed"
    ])]
    public function toArray($request): array
    {
        /** @var LeaveType $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
