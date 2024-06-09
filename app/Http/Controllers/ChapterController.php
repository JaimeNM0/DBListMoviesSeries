<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Exception;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $chapters = Chapter::all();

            return $this->sendResult(true, 'Todos los capítulos se han enviado.', $chapters);
        } catch (Exception $e) {
            return $this->sendResult(false, 'El capítulo no se ha encontrado.', [], 500);
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
            'num_season' => 'nullable',
            'num_chapter' => 'nullable',
            'start_date' => 'nullable',
            'series_id' => 'required',
        ]);

        try {
            Chapter::create($params);
            $chapter = Chapter::latest()->first();

            return $this->sendResult(true, 'El capítulo se ha creado correctamente.', $chapter);
        } catch (Exception $e) {
            return $this->sendResult(false, 'El capítulo no se ha creado.', [], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $chapter = Chapter::find($id);

            if (empty($chapter)) {
                return $this->sendResult(false, 'El capítulo no se ha encontrado.', [], 404);
            }

            return $this->sendResult(true, 'El capítulo se ha encontrado.', $chapter);
        } catch (Exception $e) {
            return $this->sendResult(false, 'El capítulo no se ha encontrado.', [], 500);
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
            'num_season' => 'nullable',
            'num_chapter' => 'nullable',
            'start_date' => 'nullable',
            'series_id' => 'nullable',
        ]);

        try {
            $chapter = Chapter::find($id);

            if (empty($chapter)) {
                return $this->sendResult(false, 'El capítulo no se ha encontrado.', [], 404);
            }

            if (!empty($params['name'])) {
                $chapter->name = $params['name'];
            }

            if (!empty($params['num_season'])) {
                $chapter->num_season = $params['num_season'];
            }

            if (!empty($params['num_chapter'])) {
                $chapter->num_chapter = $params['num_chapter'];
            }

            if (!empty($params['start_date'])) {
                $chapter->start_date = $params['start_date'];
            }

            if (!empty($params['series_id'])) {
                $chapter->series_id = $params['series_id'];
            }

            $chapter->update();

            return $this->sendResult(true, 'El capítulo se ha actualizado correctamente.', $chapter);
        } catch (Exception $e) {
            return $this->sendResult(false, 'El capítulo no se ha actualizado.', [], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $chapter = Chapter::find($id);

            if (empty($chapter)) {
                return $this->sendResult(false, 'El capítulo no se ha encontrado.', [], 404);
            }

            $chapter->delete();

            return $this->sendResult(true, 'El capítulo se ha borrado correctamente.', []);
        } catch (Exception $e) {
            return $this->sendResult(false, 'El capítulo no se ha borrado.', [], 500);
        }
    }
}
