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

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        // Intenta autenticar al usuario
        if (Auth::attempt($credentials)) {
            // El usuario ha sido autenticado correctamente
            return redirect()->intended($this->redirectTo);
        }else {
            // El usuario no ha sido autenticado
            return back()->withErrors(
                [
                    'username' => 'El usuario puede estar incorrecto. Por favor, inténtelo de nuevo.',
                    'password' => 'La clave puede estar incorrecta. Por favor, inténtelo de nuevo.'
                ]
            );
        }
    }
}
