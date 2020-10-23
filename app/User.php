<?php

namespace App;

use App\Helper\HasUuidPrimary;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasUuidPrimary;

    const ROLE_ADMIN = 'ADMIN';
    const ROLE_INSTRUCTOR = 'INSTRUCTOR';
    const ROLE_STUDENT = 'STUDENT';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function instructor()
    {
        return $this->hasOne(Instructor::class, 'user_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'created_by');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class, 'created_by');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
}
