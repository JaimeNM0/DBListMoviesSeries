<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Exception;
use Illuminate\Http\Request;

class SerieController extends Controller
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
            $series = Serie::paginate($perPage);

            return $this->sendResult(true, 'Todas las series se han enviado.', $series);
        } catch (Exception $e) {
            return $this->sendResult(false, 'La serie no se ha encontrado.', [], 500);
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
            'title' => 'required',
            'poster' => 'nullable',
            'description' => 'nullable',
            'genre' => 'nullable',
            'duration' => 'nullable',
            'start_date' => 'nullable',
            'total_note' => 'nullable',
            'total_registered' => 'nullable',
            'num_favorite' => 'nullable',
            'num_season' => 'nullable',
            'num_chapter' => 'nullable',
            'ip_api' => 'required | unique:series,ip_api',
        ]);

        try {
            Serie::create($params);
            $serie = Serie::latest()->first();

            return $this->sendResult(true, 'La serie se ha creado correctamente.', $serie);
        } catch (Exception $e) {
            return $this->sendResult(false, 'La serie no se ha creado.', [], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $serie = Serie::find($id);

            if ($serie == null) {
                return $this->sendResult(false, 'La serie no se ha encontrado.', [], 404);
            }

            return $this->sendResult(true, 'La serie se ha encontrado.', $serie);
        } catch (Exception $e) {
            return $this->sendResult(false, 'La serie no se ha encontrado.', [], 500);
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
            'title' => 'nullable',
            'poster' => 'nullable',
            'description' => 'nullable',
            'genre' => 'nullable',
            'duration' => 'nullable',
            'start_date' => 'nullable',
            'total_note' => 'nullable',
            'total_registered' => 'nullable',
            'num_favorite' => 'nullable',
            'num_season' => 'nullable',
            'num_chapter' => 'nullable',
            'ip_api' => 'nullable',
        ]);

        try {
            $serie = Serie::find($id);

            if ($serie == null) {
                return $this->sendResult(false, 'La serie no se ha encontrado.', [], 404);
            }

            if (!empty($params['title'])) {
                $serie->title = $params['title'];
            }

            if (!empty($params['poster'])) {
                $serie->poster = $params['poster'];
            }

            if (!empty($params['description'])) {
                $serie->description = $params['description'];
            }

            if (!empty($params['genre'])) {
                $serie->genre = $params['genre'];
            }

            if (!empty($params['duration'])) {
                $serie->duration = $params['duration'];
            }

            if (!empty($params['start_date'])) {
                $serie->start_date = $params['start_date'];
            }

            if (!empty($params['total_note'])) {
                $serie->total_note = $params['total_note'];
            }

            if (!empty($params['total_registered'])) {
                $serie->total_registered = $params['total_registered'];
            }

            if (!empty($params['num_favorite'])) {
                $serie->num_favorite = $params['num_favorite'];
            }

            if (!empty($params['num_season'])) {
                $serie->num_season = $params['num_season'];
            }

            if (!empty($params['num_chapter'])) {
                $serie->num_chapter = $params['num_chapter'];
            }

            if (!empty($params['ip_api'])) {
                $serie->ip_api = $params['ip_api'];
            }

            $serie->update();

            return $this->sendResult(true, 'La serie se ha actualizado correctamente.', $serie);
        } catch (Exception $e) {
            return $this->sendResult(false, 'La serie no se ha actualizado.', [], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $serie = Serie::find($id);

            if ($serie == null) {
                return $this->sendResult(false, 'La serie no se ha encontrado.', [], 404);
            }

            $serie->delete();

            return $this->sendResult(true, 'La serie se ha borrado correctamente.', []);
        } catch (Exception $e) {
            return $this->sendResult(false, 'La serie no se ha borrado.', [], 500);
        }
    }
}
