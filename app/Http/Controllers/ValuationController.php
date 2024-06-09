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
            return $this->sendResult(false, 'La valoración no puede tener una id de serie y película a la vez.', [], 422);
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
            'movies_id' => 'nullable',
            'series_id' => 'nullable',
        ]);

        if (!empty($params['movies_id']) && !empty($params['series_id'])) {
            return $this->sendResult(false, 'La valoración no puede tener una id de serie y película a la vez.', [], 422);
        }

        try {
            $valuation = Valuation::find($id);

            if (empty($valuation)) {
                return $this->sendResult(false, 'La valoración no se ha encontrado.', [], 404);
            }

            if (!empty($params['note'])) {
                $valuation->note = $params['note'];
            }

            if (!empty($params['opinion'])) {
                $valuation->opinion = $params['opinion'];
            }

            if (!empty($params['brand'])) {
                $valuation->brand = $params['brand'];
            }

            if (!empty($params['favorite'])) {
                $valuation->favorite = $params['favorite'];
            }

            if (!empty($params['start_date'])) {
                $valuation->start_date = $params['start_date'];
            }

            if (!empty($params['end_date'])) {
                $valuation->end_date = $params['end_date'];
            }

            if (!empty($params['users_id'])) {
                $valuation->users_id = $params['users_id'];
            }

            if (!empty($params['movies_id'])) {
                $valuation->movies_id = $params['movies_id'];
            }

            if (!empty($params['series_id'])) {
                $valuation->series_id = $params['series_id'];
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

    /**
     * Trae la información del usuario que creo la valoración.
    */
    public function getValuationUser($id)
    {
        return $this->sendResult(true, 'El usuario se ha obtenido correctamente.', data: Valuation::find($id)->user);
    }

    /**
     * Trae la información de la serie o película que está vinculada con la valoración.
    */
    public function getValuationContent($id)
    {
        try {
            if (Valuation::find($id)->serie) {
                return $this->sendResult(true, 'La serie se ha obtenido correctamente.', data: Valuation::find($id)->serie);
            }

            if (Valuation::find($id)->movie) {
                return $this->sendResult(true, 'La película se ha obtenido correctamente.', data: Valuation::find($id)->movie);
            }

            return $this->sendResult(false, 'La serie o película no se ha encontrado.', [], 404);
        } catch (Exception $e) {
            return $this->sendResult(false, 'La serie o película no se ha encontrado.', [], 500);
        }
    }
}
