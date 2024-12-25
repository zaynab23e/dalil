<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

<<<<<<< HEAD
class store extends FormRequest
=======
<<<<<<<< HEAD:app/Http/Requests/user/reset.php
class reset extends FormRequest
========
class store extends FormRequest
>>>>>>>> 48acb2bde2bf712d122428549a28e358621cbe95:app/Http/Requests/user/store.php
>>>>>>> 48acb2bde2bf712d122428549a28e358621cbe95
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
<<<<<<< HEAD
            'name'     => 'required|string',
            'phone'    => 'required|string',
            'email'    => 'required|email',
            'image'    => 'nullable|image',
            'password' => 'required|string',
=======
        'identifier' => 'required', 
        'code'       => 'required|numeric',
        'password'   => 'required|string',
>>>>>>> 48acb2bde2bf712d122428549a28e358621cbe95
        ];
    }
}
