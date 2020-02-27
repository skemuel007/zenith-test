<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 * @package App
 *
 * @SWG\Definition(
 *     definition="User Registration",
 *     required={"name", "email", "password"},
 *     @SWG\Property(
 *          property="name",
 *          type="string",
 *          description="User's name",
 *          example="Samuel Kelvin"
 *     ),
 *     @SWG\Property(
 *          property="email",
 *          type="string",
 *          description="User's email address",
 *          example="hope@yahoo.co.uk"
 *     ),
 *     @SWG\Property(
 *          property="password",
 *          type="string",
 *          description="User's password",
 *          example="12345"
 *     )
 * )
 *
 * * @SWG\Definition(
 *     definition="User Login",
 *     required={"email", "password"},
 *     @SWG\Property(
 *          property="email",
 *          type="string",
 *          description="User's email address",
 *          example="hope@yahoo.co.uk"
 *     ),
 *     @SWG\Property(
 *          property="password",
 *          type="string",
 *          description="User's password",
 *          example="12345"
 *     )
 * )
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        // return key
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
