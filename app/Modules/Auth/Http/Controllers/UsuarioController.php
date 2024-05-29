<?php


namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Http\Requests\UsuarioStoreRequest;
use App\Modules\Auth\Http\Requests\UsuarioUpdateRequest;
use App\Modules\Auth\Models\Usuario;
/**
 * Class UsuarioController
 * @package App\Http\Controllers
 */
class UsuarioController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::latest('updated_at')->paginate();
        $offset = $usuarios->firstItem(); 
        
        return view('auth::usuarios.index', compact('usuarios', 'offset'))
            ->with('i', (request()->input('page', 1) - 1) * $usuarios->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuario = new Usuario();
        return view('auth::usuarios.create', compact('usuario'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UsuarioStoreRequest $request)
    {
        $data = $request->validated();
        $data['is_admin'] = $request->has('is_admin') ? 1 : 0;
        
        Usuario::create($data);
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);

        return view('auth::usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);

        return view('auth::usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsuarioUpdateRequest $request, Usuario $usuario)
    {
        $data = $request->validated();
        $data['is_admin'] = $request->has('is_admin') ? 1 : 0;
        if(empty($data['password']))  unset($data['password']);

        $usuario->update($data);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente');
    }
}
