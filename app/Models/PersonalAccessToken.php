<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

/**
 * @property int    $updated_at
 * @property int    $last_used_at
 * @property int    $expires_at
 * @property int    $created_at
 * @property string $tokenable_type
 * @property string $abilities
 * @property string $token
 * @property string $name
 */
class PersonalAccessToken extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'personal_access_tokens';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'updated_at', 'tokenable_id', 'tokenable_type', 'abilities', 'token', 'name', 'last_used_at', 'expires_at', 'created_at'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'updated_at' => 'timestamp', 'tokenable_type' => 'string', 'abilities' => 'string', 'token' => 'string', 'name' => 'string', 'last_used_at' => 'timestamp', 'expires_at' => 'timestamp', 'created_at' => 'timestamp'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'updated_at', 'last_used_at', 'expires_at', 'created_at'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    // Scopes...

    // Functions ...

    // Relations ...
}
