<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

<<<<<<<< HEAD:app/Http/Requests/user/update.php
class update extends FormRequest
========
class reset extends FormRequest
>>>>>>>> 48acb2bde2bf712d122428549a28e358621cbe95:app/Http/Requests/user/reset.php
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
            'name'     => 'nullable|string',
            'phone'    => 'nullable|string',
            'email'    => 'nullable|email',
            'image'    => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ];
    }
}
