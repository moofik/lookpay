<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayAndRegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:255|unique:users',
            'currency_from' => 'required|string',
            'currency_to' => 'required|string',
            'password' => 'required|string',
            'payment_amount' => 'required',
          //  'payment_method' => 'required',
          //  'file' => 'mimes:jpg,png,pdf,gif,jpeg,gif,bmp'
        ];
    }
}
