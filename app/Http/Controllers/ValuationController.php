<?php

namespace App\Http\Controllers;

use App\Models\Valuation;
use Exception;
use Illuminate\Http\Request;

class ValuationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'note' => 'nullable',
            'opinion' => 'nullable',
            'brand' => 'nullable',
            'favorite' => 'nullable',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'users_id' => 'required',
            'movies_id' => 'required_without:series_id | nullable',
            'series_id' => 'required_without:movies_id | nullable',
        ]);

        if (!empty($params['movies_id']) && !empty($params['series_id'])) {
            return $this->sendResult(false, 'La valoración no puede tener los campos \'movies_id\' y \'series_id\' a la vez.', [], 422);
        }

        try {
            Valuation::create($params);
            $valuation = Valuation::latest()->first();

            return $this->sendResult(true, 'La valoración se ha creado correctamente.', $valuation);
        } catch (Exception $e) {
            return $this->sendResult(false, 'La valoración no se ha creado.', [], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $valuation = Valuation::find($id);

            if (empty($valuation)) {
                return $this->sendResult(false, 'La valoración no se ha encontrado.', [], 404);
            }

            return $this->sendResult(true, 'La valoración se ha encontrado.', $valuation);
        } catch (Exception $e) {
            return $this->sendResult(false, 'La valoración no se ha encontrado.', [], 500);
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
            'note' => 'nullable',
            'opinion' => 'nullable',
            'brand' => 'nullable',
            'favorite' => 'nullable',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'users_id' => 'nullable',
            'movies_id' => 'required_without:series_id | nullable',
            'series_id' => 'required_without:movies_id | nullable',
        ]);

        try {
            $valuation = Valuation::find($id);

            if (empty($valuation)) {
                return $this->sendResult(false, 'La valoración no se ha encontrado.', [], 404);
            }

            if (!empty($params['title'])) {
                $valuation->title = $params['title'];
            }

            if (!empty($params['poster'])) {
                $valuation->poster = $params['poster'];
            }

            if (!empty($params['description'])) {
                $valuation->description = $params['description'];
            }

            if (!empty($params['genre'])) {
                $valuation->genre = $params['genre'];
            }

            if (!empty($params['duration'])) {
                $valuation->duration = $params['duration'];
            }

            if (!empty($params['start_date'])) {
                $valuation->start_date = $params['start_date'];
            }

            if (!empty($params['total_note'])) {
                $valuation->total_note = $params['total_note'];
            }

            if (!empty($params['total_registered'])) {
                $valuation->total_registered = $params['total_registered'];
            }

            if (!empty($params['num_favorite'])) {
                $valuation->num_favorite = $params['num_favorite'];
            }

            if (!empty($params['num_season'])) {
                $valuation->num_season = $params['num_season'];
            }

            if (!empty($params['num_chapter'])) {
                $valuation->num_chapter = $params['num_chapter'];
            }

            if (!empty($params['ip_api'])) {
                $valuation->ip_api = $params['ip_api'];
            }

            $valuation->update();

            return $this->sendResult(true, 'La valoración se ha actualizado correctamente.', $valuation);
        } catch (Exception $e) {
            return $this->sendResult(false, 'La valoración no se ha actualizado.', [], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $valuation = Valuation::find($id);

            if (empty($valuation)) {
                return $this->sendResult(false, 'La valoración no se ha encontrado.', [], 404);
            }

            $valuation->delete();

            return $this->sendResult(true, 'La valoración se ha borrado correctamente.', []);
        } catch (Exception $e) {
            return $this->sendResult(false, 'La valoración no se ha borrado.', [], 500);
        }
    }
}
