<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
			'username' => 'required',
			'nombre_completo' => 'required',
			'estado' => 'required|string',
			'email' => 'required|email',
			'password' => 'required|min:8',
			'password_confirmation' => 'required|same:password',
			'rol' => 'nullable|boolean',
        ];
    }
}
