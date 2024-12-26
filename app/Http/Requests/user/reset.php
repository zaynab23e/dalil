<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class reset extends FormRequest

{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

        'identifier' => 'required', 
        'code'       => 'required|numeric',
        'password'   => 'required|string',
            'name'     => 'nullable|string',
            'phone'    => 'nullable|string',
            'email'    => 'nullable|email',
            'image'    => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ];
    }
}
