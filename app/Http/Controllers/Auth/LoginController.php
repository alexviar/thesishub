<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //declaro una variable con esta ruta
    protected $redirectTo = '/trabajos-grado/buscar';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //validacion de inicio de sesión de un usuario
    public function login(Request $request)
    {
        //validar de la petición que tenga estos 2 atributos
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        //Nueva variable llamada credencial que solo tomare 2 unicamente de la peticion el campo username y password
        $credenciales = $request->only('username', 'password');
        // Intenta autenticar al usuario
        if (Auth::attempt($credenciales)) {
            // El usuario ha sido autenticado correctamente
            // Redirigir a la vista declarada en redirectTo
            return redirect()->intended($this->redirectTo);
        }else {
            // El usuario no ha sido autenticado
            // Enviar a la misma vista del login los siguientes mensajes de error.
            return back()->withErrors(
                [
                    'username' => 'El usuario puede estar incorrecto. Por favor, inténtelo de nuevo.',
                    'password' => 'La clave puede estar incorrecta. Por favor, inténtelo de nuevo.'
                ]
            );
        }
    }
}
