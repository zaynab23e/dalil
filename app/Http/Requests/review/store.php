<?php

namespace App\Http\Requests\review;

use Illuminate\Foundation\Http\FormRequest;

class store extends FormRequest
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
            'content'=>'required|string',
            'rating'=>'required|numeric|in:1,1.5,2,2.5,3,3.5,4,4.5,5',
            'image'=>'nullable|string',
            'user_id'=>'required|exists:users,id',
            //'place_id'=>'required|exists:users,id',

        ];
    }
}
