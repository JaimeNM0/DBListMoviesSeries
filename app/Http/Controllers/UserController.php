<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $params = $request->validate([
            'page' => 'sometimes | required | int | min:1',
            'per_page' => 'sometimes | required | int | min:1 | max:50',
        ]);

        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;

        try {
            $users = User::paginate($perPage);

            return $this->sendResult(true, 'Todos los usuarios se han enviado.', $users);
        } catch (Exception $e) {
            return $this->sendResult(false, 'El usuario no se ha encontrado.', [], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $params = $request->validate([
            'nick' => 'required',
            'photo' => 'nullable',
            'name' => 'nullable',
            'surname' => 'nullable',
            'phone' => 'nullable',
            'birth_date' => 'nullable',
            'email' => 'required | unique:users,email',
            'password' => 'required',
        ]);

        try {
            User::create($params);
            $user = User::latest()->first();

            return $this->sendResult(true, 'El usuario se ha creado correctamente.', $user);
        } catch (Exception $e) {
            return $this->sendResult(false, 'El usuario no se ha creado.', [], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = User::find($id);

            if ($user == null) {
                return $this->sendResult(false, 'El usuario no se ha encontrado.', [], 404);
            }

            return $this->sendResult(true, 'El usuario se ha encontrado.', $user);
        } catch (Exception $e) {
            return $this->sendResult(false, 'El usuario no se ha encontrado.', [], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $params = $request->validate([
            'nick' => 'nullable',
            'photo' => 'nullable',
            'name' => 'nullable',
            'surname' => 'nullable',
            'phone' => 'nullable',
            'birth_date' => 'nullable',
            'email' => 'nullable',
            'password' => 'nullable',
        ]);

        try {
            $user = User::find($id);

            if ($user == null) {
                return $this->sendResult(false, 'El usuario no se ha encontrado.', [], 404);
            }

            if (!empty($params['nick'])) {
                $user->nick = $params['nick'];
            }

            if (!empty($params['photo'])) {
                $user->photo = $params['photo'];
            }

            if (!empty($params['name'])) {
                $user->name = $params['name'];
            }

            if (!empty($params['surname'])) {
                $user->surname = $params['surname'];
            }

            if (!empty($params['phone'])) {
                $user->phone = $params['phone'];
            }

            if (!empty($params['birth_date'])) {
                $user->birth_date = $params['birth_date'];
            }

            if (!empty($params['email'])) {
                if ($user->email != $params['email']) {
                    $user_email = User::where('email', $user->email)->first();
                    if ($user_email == null) {
                        $user->email = $params['email'];
                    } else {
                        return $this->sendResult(false, 'Este correo electrónico ' . $params['email'] . ' no se puede utilizar.', [], 400);
                    }
                }
            }

            if (!empty($params['password'])) {
                $user->password = $params['password'];
            }

            $user->update();

            return $this->sendResult(true, 'El usuario se ha actualizado correctamente.', $user);
        } catch (Exception $e) {
            return $this->sendResult(false, 'El usuario no se ha actualizado.', [], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $user = User::find($id);

            if ($user == null) {
                return $this->sendResult(false, 'El usuario no se ha encontrado.', [], 404);
            }

            $user->delete();

            return $this->sendResult(true, 'El usuario se ha borrado correctamente.', []);
        } catch (Exception $e) {
            return $this->sendResult(false, 'El usuario no se ha borrado.', [], 500);
        }
    }
}
