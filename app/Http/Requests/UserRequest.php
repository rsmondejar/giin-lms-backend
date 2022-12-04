<?php

namespace App\Http\Requests;

use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->route('user');

        return [
            'name' => 'required|max:' . AppServiceProvider::DEFAULT_STRING_LENGTH,
            'email' => [
                'required',
                'email',
                "unique:users,id,$id",
                'max:60'
            ],
            'email_verified_at' => 'nullable|datetime',
            'password' => 'string|nullable|max:' . AppServiceProvider::DEFAULT_STRING_LENGTH,
            'remember_token' => 'nullable|max:100|datetime',
            'business_id' => [
                'nullable',
                'numeric',
                'exists:businesses,id'
            ],
            'department_id' => [
                'nullable',
                'numeric',
                'exists:departments,id'
            ],
        ];
    }
}
