<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Devuelve la vista de configuración del usuario
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        if (!isset(Auth::user()->id)) {
            return redirect('login');
        }
        return view('user.config')->with(['user' => Auth::user()]);
    }

    /**
     * Cambia un usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $id = Auth::user()->id;

        Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id]
        ])->validate();

        /**
         * Busca el usuario segun la id del usuario identificado i mete toda la $data del formulario que se ha rellenado en el usuario i lo guarda
         */
        $user = User::find($id);
        $user->fill($data);
        $user->save();

        return redirect()->route('config')->with(['message' => 'User updated!']);
    }


    /**
     * Devuelve la vista para cambiar la contraseña
     *
     * @return \Illuminate\Http\Response
     */
    public function password()
    {
        if (!isset(Auth::user()->id)) {
            return redirect('login');
        }
        return view('user.password');
    }

    /**
     * Cambia la contraseña.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $data = $request->all();

        Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ])->validate();

        /**
         * Coje la id del usuario identificado y lo busca en la base de datos, coje la nueva password que le hemos passado y la encripta,
         * finalmente guarda la nueva password y modifica la base de datos.
         */
        $id = Auth::user()->id;
        $user = User::find($id);
        $data['password'] = Hash::make($data['password']);
        $user->fill($data);
        $user->save();

        return redirect()->route('configPassword')->with(['message' => 'Password updated!']);
    }
}
