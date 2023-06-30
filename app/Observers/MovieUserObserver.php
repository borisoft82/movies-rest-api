<?php

namespace App\Observers;

use App\Models\MovieUser;
use Illuminate\Support\Facades\Cache;

class MovieUserObserver
{
    /**
     * Handle the MovieUser "created" event.
     */
    public function created(MovieUser $movieUser): void
    {
        $this->makeCache($movieUser->user_id);
    }

    /**
     * Handle the MovieUser "updated" event.
     */
    public function updated(MovieUser $movieUser): void
    {
        $this->makeCache($movieUser->user_id);
    }

    /**
     * Handle the MovieUser "deleted" event.
     */
    public function deleted(MovieUser $movieUser): void
    {
        $this->makeCache($movieUser->user_id);
    }

    /**
     * Handle the MovieUser "restored" event.
     */
    public function restored(MovieUser $movieUser): void
    {
        $this->makeCache($movieUser->user_id);
    }

    /**
     * Handle the MovieUser "force deleted" event.
     */
    public function forceDeleted(MovieUser $movieUser): void
    {
        $this->makeCache($movieUser->user_id);
    }

    private function makeCache($user_id): void
    {        
        $key = "user_movies_{$user_id}";
        Cache::forget($key);
    }
}
