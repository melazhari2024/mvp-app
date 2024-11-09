<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $options
 * @property string $name
 * @property string $failed_job_ids
 * @property int    $finished_at
 * @property int    $failed_jobs
 * @property int    $created_at
 * @property int    $total_jobs
 * @property int    $pending_jobs
 * @property int    $cancelled_at
 */
class JobBatch extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'job_batches';

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
        'options', 'name', 'finished_at', 'failed_jobs', 'failed_job_ids', 'created_at', 'total_jobs', 'pending_jobs', 'cancelled_at'
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
        'id' => 'string', 'options' => 'string', 'name' => 'string', 'finished_at' => 'int', 'failed_jobs' => 'int', 'failed_job_ids' => 'string', 'created_at' => 'int', 'total_jobs' => 'int', 'pending_jobs' => 'int', 'cancelled_at' => 'int'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [

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
