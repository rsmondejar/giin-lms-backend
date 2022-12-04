<?php

namespace App\Http\Requests;

use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Http\FormRequest;

class BusinessRequest extends FormRequest
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
        $id = $this->route('business');

        return [
            'business_name' => [
                'required',
                "unique:businesses,id,$id",
                'max:60'
            ],
            'address' => 'required|max:' . AppServiceProvider::DEFAULT_STRING_LENGTH,
            'city' => 'required|max:60',
            'postal_code' => 'required|max:10',
            'country' => 'required|max:60',
            'phone' => 'required|max:20',
            'email' => 'required|email|max:100',
            'website' => 'max:100|nullable',
            'logo' => 'nullable|mimes:jpg,png|max:1024'
        ];
    }
}
