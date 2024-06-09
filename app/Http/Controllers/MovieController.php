<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Exception;
use Illuminate\Http\Request;

class MovieController extends Controller
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
            $movies = Movie::paginate($perPage);

            return $this->sendResult(true, 'Todas las películas se han enviado.', $movies);
        } catch (Exception $e) {
            return $this->sendResult(false, 'La película no se ha encontrado.', [], 500);
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
            'year' => 'nullable',
            'total_note' => 'nullable',
            'total_registered' => 'nullable',
            'num_favorite' => 'nullable',
            'ip_api' => 'required | unique:movies,ip_api',
        ]);

        try {
            Movie::create($params);
            $movie = Movie::latest()->first();

            return $this->sendResult(true, 'La película se ha creado correctamente.', $movie);
        } catch (Exception $e) {
            return $this->sendResult(false, 'La película no se ha creado.', [], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $movie = Movie::find($id);

            if (empty($movie)) {
                return $this->sendResult(false, 'La película no se ha encontrado.', [], 404);
            }

            return $this->sendResult(true, 'La película se ha encontrado.', $movie);
        } catch (Exception $e) {
            return $this->sendResult(false, 'La película no se ha encontrado.', [], 500);
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
            'year' => 'nullable',
            'total_note' => 'nullable',
            'total_registered' => 'nullable',
            'num_favorite' => 'nullable',
            'ip_api' => 'nullable',
        ]);

        try {
            $movie = Movie::find($id);

            if (empty($movie)) {
                return $this->sendResult(false, 'La película no se ha encontrado.', [], 404);
            }

            if (!empty($params['title'])) {
                $movie->title = $params['title'];
            }

            if (!empty($params['poster'])) {
                $movie->poster = $params['poster'];
            }

            if (!empty($params['description'])) {
                $movie->description = $params['description'];
            }

            if (!empty($params['genre'])) {
                $movie->genre = $params['genre'];
            }

            if (!empty($params['year'])) {
                $movie->year = $params['year'];
            }

            if (!empty($params['start_date'])) {
                $movie->start_date = $params['start_date'];
            }

            if (!empty($params['total_note'])) {
                $movie->total_note = $params['total_note'];
            }

            if (!empty($params['total_registered'])) {
                $movie->total_registered = $params['total_registered'];
            }

            if (!empty($params['num_favorite'])) {
                $movie->num_favorite = $params['num_favorite'];
            }

            if (!empty($params['ip_api'])) {
                $movie->ip_api = $params['ip_api'];
            }

            $movie->update();

            return $this->sendResult(true, 'La película se ha actualizado correctamente.', $movie);
        } catch (Exception $e) {
            return $this->sendResult(false, 'La película no se ha actualizado.', [], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $movie = Movie::find($id);

            if (empty($movie)) {
                return $this->sendResult(false, 'La película no se ha encontrado.', [], 404);
            }

            $movie->delete();

            return $this->sendResult(true, 'La película se ha borrado correctamente.', []);
        } catch (Exception $e) {
            return $this->sendResult(false, 'La película no se ha borrado.', [], 500);
        }
    }
}
