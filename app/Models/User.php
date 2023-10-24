<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'display_name',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function friendships(): BelongsToMany
    {
        return $this->belongsToMany(Friendship::class);
    }

    public function getOtherUsersIdFromFriends()
    {
        $users = [];

        foreach ($this->friendships as $friend) {
            $toAdd = $friend->users()->get();

            foreach ($toAdd as $user){
                if($this->id !== $user->id)
                array_push($users, $user->id);
            }

        }

        return $users;
    }

    public function getPendingFriendshipsUsers()
    {
        $friendships = [];

        foreach ($this->friendships as $friend) {
            $toAdd = [];

            if($friend->pending) {
                $users = [];
                // TODO: Do something
                foreach ($friend->users()->get() as $toAdd ) {
                    array_push($users , $toAdd->username);
                }
                array_push($users, $friend->pending);
                array_push($friendships, $users);
            }
        }

        return $friendships;
    }
}
