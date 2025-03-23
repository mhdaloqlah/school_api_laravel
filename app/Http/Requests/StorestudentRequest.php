<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StorestudentRequest extends FormRequest
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
            'first_name'=>'required|max:255|string',
            'last_name'=>'required|max:255|string',
            'father'=>'sometimes|max:255|string',
            'mother'=>'sometimes|max:255|string',
            'birth_date'=>'sometimes',
            'birth_place'=>'sometimes|max:255|string',
            'username'=>'required|max:255|string',
            'image'=>'sometimes',
            'grade_id'=>'required',
            'subclass_id'=>'required',
            'register_year_id'=>'required',
            'register_term_id'=>'required',
            'status'=>'sometimes',
            'address'=>'sometimes|max:255|string',
            'phone'=>'sometimes|max:255|string',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([

            'success'   => false,
            'message'   => 'Validation errors',
            'data'  => $validator->errors()

        ]));
    }
}
