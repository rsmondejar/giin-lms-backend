<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Audit extends Model
{
    use SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = 'audit_logs';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'event',
        'model',
        'data',
    ];
}
