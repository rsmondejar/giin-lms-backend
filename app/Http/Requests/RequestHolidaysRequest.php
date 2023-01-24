<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class RequestHolidaysRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape([
        'reason' => "string", // NOSONAR
        'manager' => "string", // NOSONAR
        'dates' => "string", // NOSONAR
//        'dates.*' => "string", // NOSONAR
        'comment' => "string", // NOSONAR
        'notifyEmails' => "string" // NOSONAR
    ])] public function rules(): array
    {
        return [
            'reason' => 'required|exists:App\Models\LeaveType,id',
            'manager' => 'required|exists:App\Models\User,id',
            'dates' => 'required',
//            'dates.*' => 'required|date_format:Y-m-d',
            'comment' => 'nullable',
            'notifyEmails' => '',
        ];
    }

}
