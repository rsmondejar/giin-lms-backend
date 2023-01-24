<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JetBrains\PhpStorm\ArrayShape;
use App\Interfaces\ILeaveState;
use App\Interfaces\ILeaveType;
use App\Models\LeaveDate;

class HolidaysResource extends JsonResource implements ILeaveType, ILeaveState
{
    public const CLASS_MAP = [
        'App\Models\PublicHoliday' => 'festive',
        'App\Models\LeaveDate' => 'holiday'
    ];

    /**
     * Transform the resource into an array.
     *
     * @param Request
     * @return array
     */
    #[ArrayShape([
        'date' => "mixed",
        'className' => "string"
    ])]
    public function toArray($request): array
    {
        return [
            'date' => $this->date->format('Y-m-d'),
            'className' => $this->getClassName()
        ];
    }

    /**
     * @return string
     */
    private function getClassName(): string
    {
        $class = self::CLASS_MAP[get_class($this->resource)];

        /** @var LeaveDate $this */
        if ($class === 'holiday' && $this->leave->state_id === ILeaveState::PENDING) {
            $class = 'unapproved';
        }

        // Para cuando haya que meter la clase de CSS para dias de ausencia:
        // + generar la clase en el componente del front Calendar.vue
//        if ($this->leave->type_id === ILeaveType::SICKNESS) {
//            $class = 'sickleave';
//        }

        return $class;
    }
}
