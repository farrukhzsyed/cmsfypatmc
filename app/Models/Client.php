<?php

namespace App\Models;

use App\Notifications\Client\Auth\ResetPassword;
use App\Notifications\Client\Auth\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname','username', 'email', 'tel', 'address','gender', 'avatar', 'password',
    ];


    /**
     * Get the projects for the blog post.
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'ownBy');
    }


    /**
     * Get the projects for the blog post.
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'issuedTo');
    }


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

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }
}