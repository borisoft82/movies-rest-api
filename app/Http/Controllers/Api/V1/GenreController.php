<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\GenreRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\GenreResource;

class GenreController extends Controller
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
        $genres = GenreResource::collection(Genre::all());

        return response()->json($genres, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenreRequest $request): JsonResponse
    {
        $genre = Genre::create($request->validated());

        return response()->json([
            'genre' => new GenreResource($genre), 
            'status' => Response::HTTP_CREATED
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre): JsonResponse
    {
        return response()->json([
            'genre' => new GenreResource($genre), 
            'status' => Response::HTTP_OK
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Genre $genre, GenreRequest $request): JsonResponse
    {
        $genre->update($request->validated());

        return response()->json([
            'genre' => new GenreResource($genre), 
            'status' => Response::HTTP_OK
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre): JsonResponse
    {
        $genre->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
