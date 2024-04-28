<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class LoginRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => $this->input('username') ? '' : ['required', 'string', 'email', 'max:255'],
            'username' => $this->input('email') ? '' : ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
