<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function show (User $user)
    {
        return view('users.show', compact('user'));
    }


    
    public function update(Request $request, User $user)
    {
        $imagePath = null; 

        $customMessages = [
            'required' => 'O :attribute é obrigatório.',
            'email' => 'O :attribute deve ser um endereço de email válido.',
            'confirmed' => 'A confirmação :attribute não coincide.',
            'min' => 'A password deve ter pelo menos :min caractéres.',
            'image' => 'A imagem deve ser um ficheiro do tipo jpeg, png, jpg, gif ou svg com um tamanho máximo de 5 megabytes.'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'roles' => 'required',
        ], $customMessages);

        if ($request->hasFile('image'))
        {
            $imagePath = $request->file('image')->store('public/images');
            $imagePath = str_replace('public/', '', $imagePath);
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Oops! Algo correu mal ao atualizar o utlizador. Por favor verifique o(s) seguinte(s) erro:');
        }

        try {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->image = $imagePath;
            $user->password = bcrypt($request->input('password'));
            $user->roles()->sync($request->input('roles'));
            $user->save();

            return redirect()->route('users.index')->with('success', 'Utlizador atualizado com sucesso.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar o utlizador.');
        }
    }
    
    
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }


}
