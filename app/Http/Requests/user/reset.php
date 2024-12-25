<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

<<<<<<< HEAD
<<<<<<<< HEAD:app/Http/Requests/user/reset.php
class reset extends FormRequest
========
class store extends FormRequest
>>>>>>>> 48acb2bde2bf712d122428549a28e358621cbe95:app/Http/Requests/user/store.php
=======
<<<<<<<< HEAD:app/Http/Requests/user/update.php
class update extends FormRequest
========
class reset extends FormRequest
>>>>>>>> 48acb2bde2bf712d122428549a28e358621cbe95:app/Http/Requests/user/reset.php
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
        'identifier' => 'required', 
        'code'       => 'required|numeric',
        'password'   => 'required|string',
=======
            'name'     => 'nullable|string',
            'phone'    => 'nullable|string',
            'email'    => 'nullable|email',
            'image'    => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
>>>>>>> 48acb2bde2bf712d122428549a28e358621cbe95
        ];
    }
}
