<?php

namespace App\Http\Requests\API;

use App\Http\Requests\BusinessRequest;
use InfyOm\Generator\Request\APIRequest;

class UpdateBusinessAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return (new BusinessRequest())->rules();
    }
}
