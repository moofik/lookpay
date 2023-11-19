<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnonymousPayRequest extends FormRequest
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
            'payment_amount' => 'required',
            'currency' => 'required|string',
            'payment_method' => 'required',
            'email' => 'required|email',
            'trc20' => 'string',
           // 'file' => 'mimes:jpg,png,pdf,gif,jpeg,gif,bmp'
        ];
    }
}
