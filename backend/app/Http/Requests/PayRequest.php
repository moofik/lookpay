<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayRequest extends FormRequest
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
            'currency_from' => 'required|string',
            'currency_to' => 'required|string',
            'payment_amount' => 'required',
            //'file' => 'mimes:jpg,png,pdf,gif,jpeg,gif,bmp'
        ];
    }
}
