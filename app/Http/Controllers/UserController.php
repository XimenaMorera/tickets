<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $users = DB::table('users')
           
        //     ->select(
        //         'users.id',
        //         'users.name',
        //         'users.email',
        //         'users.role', // Si role es un campo directamente en 'users'
        //     )
        //     ->get();

        //     return view('usuarios.index', compact('users')); 
        $search = $request->input('search');

        $users = DB::table('users')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%')
                             ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->select('id', 'name', 'email', 'role')
            ->get();
    
        return view('usuarios.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  $users = DB::table('users')->get();

        // Retornar la vista de creación de ticket con los usuarios
        return view('usuarios.new', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:administrador,soporte',
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = $validated['password']; 
        $user->role = $validated['role'];
        $user->save();

        return redirect()->route('usuarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id); // Busca el usuario por ID
        $roles = ['administrador', 'soporte']; // Opciones de rol
        return view('usuarios.edit', compact('user', 'roles')); // Retorna la vist
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8', // La contraseña puede estar vacía si no se desea cambiar
            'role' => 'required|in:administrador,soporte',
        ]);
    
        $user = User::findOrFail($id);
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if ($request->filled('password')) {
            $user->password = $validated['password']; // Guardar nueva contraseña solo si se especifica
        }
        $user->role = $validated['role'];
        $user->save();
    
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
