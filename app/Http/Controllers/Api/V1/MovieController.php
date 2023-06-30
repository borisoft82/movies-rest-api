<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieAddRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Http\Resources\MovieCollection;
use App\Http\Resources\MovieResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $movies = new MovieCollection(Movie::paginate(10));

        return response()->json($movies, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieAddRequest $request): JsonResponse
    {
        $movie = Movie::create($request->validated());

        return response()->json([
            'movie' => new MovieResource($movie), 
            'status' => Response::HTTP_CREATED
        ]);
            
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie): JsonResponse
    {
        if ($movie->user_id !== auth()->user()->id) {
            return response()->json([
                'massage' => 'You are not allowed to see others movies', 
            ]);
        }

        return response()->json([
            'movie' => new MovieResource($movie), 
            'status' => Response::HTTP_OK
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Movie $movie, MovieUpdateRequest $request): JsonResponse
    {
        $movie->update($request->validated());

        return response()->json([
            'movie' => new MovieResource($movie), 
            'status' => Response::HTTP_OK
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie): JsonResponse
    {
        if ($movie->user_id !== auth()->user()->id) {
            return response()->json([
                'massage' => 'You are not allowed to delete others movies', 
            ]);
        }

        $movie->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

}
