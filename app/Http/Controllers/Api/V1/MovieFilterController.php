<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MovieFilterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function __invoke(Request $request): JsonResponse
    {
        $id = $request->input('id');
        $title = $request->input('title');
        $slug = $request->input('slug');
        $storyline = $request->input('storyline');
        $director = $request->input('director');
        $writer = $request->input('writer');
        $cast = $request->input('cast');
        $genre = $request->input('genre');
        $sort = $request->input('sort');

        $pagination = $request->input('pagination');

        $query = Movie::query();

        if($id) {
            $query->where('id', $id);
        }

        if($title) {
            $query->where('title', $title);
        }

        if($slug) {
            $query->where('slug', $slug);
        }

        if($storyline) {
            $query->where('storyline', 'LIKE', '%' . $storyline .'%');
        }

        if($director) {
            $query->where('director', $director);
        }

        if($writer) {
            $query->where('writer', $writer);
        }

        if($cast) {
            $query->where('cast', $cast);
        }

        if($genre) {
            $query->where('genre_id', $genre);
        }

        if ($sort) {
            $query->orderBy('id', $sort);
        }

        $result = $query->paginate($pagination);

        return response()->json([
            'result' => $result
        ]);

    }
}

