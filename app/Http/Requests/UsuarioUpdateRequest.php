<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UsuarioUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->is_admin;    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'username' => 'required',
			'nombre_completo' => 'required',
			'estado' => 'nullable|in:1,2',
			'email' => 'required|email',
			'password' => ['nullable', Password::default() ],
			'password_confirmation' => 'same:password',
			'is_admin' => 'nullable|boolean',
        ];
    }
}
