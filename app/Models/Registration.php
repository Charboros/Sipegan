<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    //
    protected $fillable = [
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

    public const TYPE_MAGANG = 'magang';
    public const TYPE_PENELITIAN = 'penelitian';

    public const STATUS_MENUNGGU = 'menunggu';
    public const STATUS_DITERIMA = 'diterima';
    public const STATUS_DITOLAK = 'ditolak';
    public const STATUS_SELESAI = 'selesai';

    protected $casts = [
        'start_date' => 'date',
        'birth_date' => 'date',
        'magang_months' => 'array',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('nim_nisn', 'like', "%{$search}%")
                    ->orWhere('institution', 'like', "%{$search}%");
            });
        })
        ->when($filters['year'] ?? null, function ($query, $year) use ($filters) {
            if (isset($filters['months']) && is_array($filters['months'])) {
                $query->where(function ($q) use ($year, $filters) {
                    foreach ($filters['months'] as $month) {
                        $q->orWhere('created_at', 'like', "{$year}-{$month}%");
                    }
                });
            } else {
                $query->whereYear('created_at', $year);
            }
        }, function ($query) use ($filters) {
            if (isset($filters['months']) && is_array($filters['months'])) {
                $query->where(function ($q) use ($filters) {
                    foreach ($filters['months'] as $month) {
                        $q->orWhereMonth('created_at', $month);
                    }
                });
            }
        })
        ->when(isset($filters['status']) && $filters['status'] !== 'all', function ($query) use ($filters) {
            $query->where('status', $filters['status']);
        })
        ->when(isset($filters['type']) && $filters['type'] !== 'all', function ($query) use ($filters) {
            $query->where('type', $filters['type']);
        });
    }
}
