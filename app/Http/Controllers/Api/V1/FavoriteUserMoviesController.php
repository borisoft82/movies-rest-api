<?php

namespace App\Http\Controllers\Api\V1;

use App\Constants\GlobalConstants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Requests\FavoriteMovieRequest;
use App\Models\Movie;

class FavoriteUserMoviesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function favoriteMovies(): JsonResponse 
    {
        $user_id = auth()->user()->id;
        $key = "user_movies_{$user_id}";
        
        $result = Cache::remember($key, GlobalConstants::CACHE_TIME, function() use($user_id) {
            return User::where('id', $user_id)->first()->favoriteMovies()->get();
        });
         
        return response()->json([
            'result' => $result, 
            'status' => Response::HTTP_CREATED
        ]);
     }

    public function addToFavorites(FavoriteMovieRequest $request): JsonResponse 
    {   
        $user = auth()->user();
        $movie_id = $request->input('movie_id');
        $addFavoriteMovie = (bool) $request->input('favorite_movie');        
        $favoriteMovieAdded = $user->favoriteMovies()->wherePivot('movie_id', $movie_id)->exists();
  
        if ($favoriteMovieAdded) {
            if ($addFavoriteMovie) {                    
                $result = 'The movie has already been added to favorites.';
                $status = 'Added';
            } else {
                $result = $user->favoriteMovies()->detach($movie_id); 
                $status = 'Removed';                  
            }
        } elseif ($addFavoriteMovie) {
            if ($movie_id) {
                $user->favoriteMovies()->attach($movie_id);
                $result = Movie::where('id', $movie_id)->first();
                $status = "Added";
            } else {                
                $result = "Select a movie";
                $status = "Not selected";
            }
        } else {
            $result = "First add movie to your favorites then remove it from your favorite list.";
            $status = "Not added";
        }        

        return response()->json([
            'status' => $status,
            'result' => $result
        ]);
    }
}
