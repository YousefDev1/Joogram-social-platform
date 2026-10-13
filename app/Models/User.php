<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Dom\Comment;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

#[Fillable([
    'name',
    'email',
    'password',
    'username',
    'avatar',
    'bio',
    'private_account'
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'private_account' => 'boolean',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'following_user_id')->withPivot('confirmed');
    }

    public function follower()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_user_id', 'user_id')->withPivot('confirmed');
    }

    public function suggestedUsers()
    {
        $user = Auth::user();

        return User::where('id', '!=', $user->id)
        ->whereNotIn('id' , $user->following()->pluck('users.id'))
        ->inRandomOrder()
        ->limit(5)
        ->get();
    }

    public function follow(User $user)
    {
        if ($this->id == $user->id) {
            return;
        }
        if ($user->private_account) {
            $this->following()->attach($user, ['confirmed' => false]);
        }
        else 
        {
            $this->following()->attach($user, ['confirmed' => true]);
        }
    }
    public function unfollow(User $user)
    {
        return $this->following()->detach($user->id);
    }

    public function isFollowing(User $user)
    {
        return $this->following()->where('following_user_id',$user->id)->where('confirmed',true)->exists();
    }
    public function isPending(User $user)
    {
        return $this->following()->where('following_user_id',$user->id)->where('confirmed',false)->exists();
    }
}
