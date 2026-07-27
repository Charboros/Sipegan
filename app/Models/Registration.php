<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    //
    protected $fillable = [
        'registration_code',
        'type',
        'name',
        'email',
        'phone',
        'nim_nisn',
        'institution',
        'study_program',
        'start_date',
        'research_title',
        'participant_category',
        'birth_place',
        'birth_date',
        'gender',
        'address',
        'magang_months',
        'advisor_name',
        'advisor_phone',
        'document_path',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'birth_date' => 'date',
        'magang_months' => 'array',
    ];
}
