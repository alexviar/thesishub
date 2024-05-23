<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->rol==1;    }

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
			'password' => 'nullable|min:8',
			'password_confirmation' => 'same:password',
			'rol' => 'nullable|boolean',
        ];
    }
}
