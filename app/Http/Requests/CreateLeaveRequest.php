<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class CreateLeaveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    #[ArrayShape([
        'comment' => "string", // NOSONAR
        'dates' => "string", // NOSONAR
        'requested_to_user_id' => "string", // NOSONAR
        'emails' => "string" // NOSONAR
    ])] public function rules(): array
    {
        return [
            'comment' => 'nullable',
            'dates' => 'required',
            'requested_to_user_id' => 'exists:App\Models\User,id',
            'emails' => 'nullable|string',
        ];
    }
}
