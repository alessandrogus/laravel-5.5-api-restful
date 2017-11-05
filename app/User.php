<?php

namespace App;

use App\Article;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


/**
* Class User
* @package App
* 
* @property int id
* @property string name
* @property string email
* @property password
* @property string remember_token
* @property Carbon created_at
* @property Carbon updated_at
*/

class User extends Authenticatable
{
    use  HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles() {
        return $this->hasMany(Article::class, 'author_id', 'id');
    }
}
