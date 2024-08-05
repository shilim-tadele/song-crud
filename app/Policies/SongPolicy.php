<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Song;
use Illuminate\Auth\Access\HandlesAuthorization;

class SongPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    public function view(User $user, Song $song)
    {
        return true; // Allow any user to view a song
    }

    public function create(User $user)
    {
        return $user->is_admin; // Only admins can create songs
    }

    public function update(User $user, Song $song)
    {
        return $user->is_admin; // Only admins can update songs
    }

    public function delete(User $user, Song $song)
    {
        return $user->is_admin; // Only admins can delete songs
    }
}


