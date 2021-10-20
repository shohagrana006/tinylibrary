<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookValidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'issue_member' => 'required',
            'book_name' => 'required',
            'book_code' => 'required|unique:books',
            'issue_date' => 'required',
            'return_date' => 'required',
        ];
    }
}
