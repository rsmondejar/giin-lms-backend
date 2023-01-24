<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use App\Models\PublicHoliday;

/**
 * Public Holiday Resource
 * @package App\Http\Resources
 */
class PublicHolidayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    #[ArrayShape([
        'id' => "mixed",
        'name' => "mixed",
        'date' => "mixed",
    ])]
    public function toArray($request): array
    {
        /** @var PublicHoliday $this */
        return [
            'id' => $this->id,
            'name' => $this->name,
            'date' => $this->date,
        ];
    }
}
