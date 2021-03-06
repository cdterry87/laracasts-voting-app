<?php

namespace App\Models;

use App\Models\Idea;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }

    public function getAvatar()
    {
        $firstCharacter = $this->email[0];
        $randomDigit = ord(strtolower($firstCharacter)) - (is_numeric($firstCharacter) ? 21 : 96);

        return 'https://www.gravatar.com/avatar/' . md5($this->email) . '?s=200&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-' . $randomDigit . '.png';
    }

    public function votes()
    {
        return $this->belongsToMany(Idea::class, 'votes');
    }

    public function isAdmin()
    {
        return in_array($this->email, [
            'chase.terry87@gmail.com'
        ]);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
