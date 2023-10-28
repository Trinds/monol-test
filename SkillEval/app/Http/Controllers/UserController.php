<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'searchParam' => 'nullable|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->route('users.index')->withErrors($validator)->withInput();
        }
        isset($request->searchParam) ?
            $users = User::query()
                ->where(strtoupper('name'), 'LIKE', '%' . strtoupper($request->searchParam) . '%')
                ->orWhere(strtoupper('email'), 'LIKE', '%' . strtoupper($request->searchParam) . '%')
                ->paginate(8)->withQueryString()
            :
            $users = User::with('roles')->paginate(8)->withQueryString();
        return view('users.index', ['users' => $users]);
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $imagePath = null;
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6|max:255',
            'roles' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Oops! Algo correu mal ao criar o utilizador. Por favor verifique o(s) seguinte(s) erro:');
        }

        try {
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('public/images');
                $imagePath = str_replace('public/', '', $imagePath);
                $user->image = $imagePath;
            }

            $user->password = bcrypt($request->input('password'));
            $user->save();
            $user->roles()->sync($request->input('roles'));

            return redirect()->route('users.index')->with('success', 'Utilizador criado com sucesso.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao criar o utilizador.');
        }
    }


    public function update(Request $request, User $user)
    {
        $imagePath = null;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'email' => 'required|email|unique:users,email,' . $user->id . '|max:255',
            'password' => 'sometimes|confirmed|min:6|max:255',
            'roles' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            $imagePath = str_replace('public/', '', $imagePath);
        } else {
            $imagePath = $user->image;
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Oops! Algo correu mal ao atualizar o utilizador. Por favor verifique o(s) seguinte(s) erro:');
        }

        try {
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->image = $imagePath;
            if ($request->filled('password')) {
                if (strlen($request->input('password')) < 6) {
                    $validator->getMessageBag()->add('password', 'A password deve ter pelo menos 6 caracteres.');

                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error', 'Oops! Algo correu mal ao atualizar o utilizador. Por favor verifique o(s) seguinte(s) erro:');
                }
                $user->password = bcrypt($request->input('password'));
            }

            $user->roles()->sync($request->input('roles'));
            $user->save();

            if (auth()->user()->isAdmin()) {
                return redirect()->route('users.index')->with('success', 'Utilizador atualizado com sucesso.');
            } else {
                return redirect()->route('users.show', $user)->with('success', 'Dados atualizados com sucesso.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar o utlizador.');
        }
    }

    public function destroy(User $user)
    {
        $countAdmins = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->count();
        if ($countAdmins == 1 && $user->hasRole('admin')) {
            return redirect()->back()->with('error', 'Não é possível eliminar o único administrador existente.');
        }
        if ($user->id == Auth::user()->id) {
            try {
                Auth::logout();
                $user->delete();
                Session::flush();
                return redirect()->route('login')->with('status', 'Conta eliminada com sucesso!');
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Ocorreu um erro ao eliminar o utilizador.');
            }
        }
        try {
            $user->delete();
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao eliminar o utilizador.');
        }
        return redirect()->route('users.index')->with('success', 'Utilizador eliminado com sucesso!');
    }
}
