<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Exception;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $actors = Actor::all();

            return $this->sendResult(true, 'Todos los actores se han enviado.', $actors);
        } catch (Exception $e) {
            return $this->sendResult(false, 'El actor no se ha encontrado.', [], 500);
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
            'name' => 'nullable',
            'character' => 'nullable',
            'photo' => 'nullable',
            'id_actor' => 'required',
            'movies_id' => 'required',
        ]);

        try {
            Actor::create($params);
            $actor = Actor::latest()->first();

            return $this->sendResult(true, 'El actor se ha creado correctamente.', $actor);
        } catch (Exception $e) {
            return $this->sendResult(false, 'El actor no se ha creado.', [], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $actor = Actor::find($id);

            if ($actor == null) {
                return $this->sendResult(false, 'El actor no se ha encontrado.', [], 404);
            }

            return $this->sendResult(true, 'El actor se ha encontrado.', $actor);
        } catch (Exception $e) {
            return $this->sendResult(false, 'El actor no se ha encontrado.', [], 500);
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
            'name' => 'nullable',
            'character' => 'nullable',
            'photo' => 'nullable',
            'id_actor' => 'nullable',
            'movies_id' => 'nullable',
        ]);

        try {
            $actor = Actor::find($id);

            if ($actor == null) {
                return $this->sendResult(false, 'El actor no se ha encontrado.', [], 404);
            }

            if (!empty($params['name'])) {
                $actor->name = $params['name'];
            }

            if (!empty($params['character'])) {
                $actor->character = $params['character'];
            }

            if (!empty($params['photo'])) {
                $actor->photo = $params['photo'];
            }

            if (!empty($params['id_actor'])) {
                $actor->id_actor = $params['id_actor'];
            }

            if (!empty($params['movies_id'])) {
                $actor->movies_id = $params['movies_id'];
            }

            $actor->update();

            return $this->sendResult(true, 'El actor se ha actualizado correctamente.', $actor);
        } catch (Exception $e) {
            return $this->sendResult(false, 'El actor no se ha actualizado.', [], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $actor = Actor::find($id);

            if ($actor == null) {
                return $this->sendResult(false, 'El actor no se ha encontrado.', [], 404);
            }

            $actor->delete();

            return $this->sendResult(true, 'El actor se ha borrado correctamente.', []);
        } catch (Exception $e) {
            return $this->sendResult(false, 'El actor no se ha borrado.', [], 500);
        }
    }
}
