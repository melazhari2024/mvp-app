<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $failed_at
 * @property string $exception
 * @property string $connection
 * @property string $payload
 * @property string $queue
 * @property string $uuid
 */
class FailedJob extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'failed_jobs';

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
        'failed_at', 'exception', 'connection', 'payload', 'queue', 'uuid'
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
        'failed_at' => 'timestamp', 'exception' => 'string', 'connection' => 'string', 'payload' => 'string', 'queue' => 'string', 'uuid' => 'string'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'failed_at'
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
