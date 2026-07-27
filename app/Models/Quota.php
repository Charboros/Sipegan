<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quota extends Model
{
    protected $fillable = [
        'month',
        'quota_magang',
        'quota_penelitian',
    ];
}
