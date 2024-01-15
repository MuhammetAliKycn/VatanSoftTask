<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
class AuthRequest extends FormRequest
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
        if ($this->is('api/login')) {
            return [
                'email' => 'required|email',
                'password' => 'required|min:3',
            ];
        }
        if ($this->is('api/register')) {
            return [
                'username' => 'required|max:25',
                'email' => 'required|email|unique:users',
                'phone' => 'required|numeric|unique:users',
                'password' => 'required|min:3',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];
        }
        return [];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => $validator->errors()->first(),
            'data' => (object) [],
        ]));
    }
    // public function messages()
    // {
    //     return [
    //         'email.required' => 'E-posta adresi zorunludur.',
    //         'email.email' => 'Geçerli bir e-posta adresi giriniz.',
    //         'password.required' => 'Şifre zorunludur.',
    //         'password.min' => 'Şifre en az :min karakter olmalıdır.',
    //     ];
    // }
}
