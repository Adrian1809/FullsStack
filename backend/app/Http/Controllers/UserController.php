<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   public function index()
    {
        $user = auth()->user();
        
        // Si es admin, retorna todos los usuarios
        if ($user->role === 'admin') {
            return User::select('id', 'name', 'email', 'role', 'created_at')->get();
        }
        
        // Si es usuario regular, retorna solo su propio usuario
        return User::where('id', $user->id)->select('id', 'name', 'email', 'role', 'created_at')->get();
    }

    public function show($id)
    {
        $user = auth()->user();
        $targetUser = User::findOrFail($id);
        
        // Un usuario puede ver su propio perfil, los admins ven a cualquiera
        if ($user->id !== $targetUser->id && $user->role !== 'admin') {
            return response()->json(['message' => 'No tienes permiso para ver este usuario'], 403);
        }
        
        return $targetUser;
    }

    public function me()
    {
        return auth()->user();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'sometimes|in:user,admin'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'user'
        ]);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|min:6',
            'role' => 'sometimes|in:user,admin'
        ]);

        $data = [];
        if ($request->has('name')) $data['name'] = $request->name;
        if ($request->has('email')) $data['email'] = $request->email;
        if ($request->has('password')) $data['password'] = Hash::make($request->password);
        if ($request->has('role')) $data['role'] = $request->role;

        $user->update($data);

        return response()->json($user);
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Usuario eliminado'
        ]);
    }
}
