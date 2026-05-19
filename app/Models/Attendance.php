<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_users',
        'date',
        'clock_in_time',
        'clock_out_time',
        'work_hours',
        'overtime_hours',
        'status',
        'lat_in',
        'lng_in',
        'lat_out',
        'lng_out',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'date'         => 'date',
            'work_hours'   => 'decimal:2',
            'overtime_hours' => 'decimal:2',
            'lat_in'       => 'decimal:7',
            'lng_in'       => 'decimal:7',
            'lat_out'      => 'decimal:7',
            'lng_out'      => 'decimal:7',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    /**
     * Hitung jam kerja berdasarkan clock_in dan clock_out
     */
    public function calculateWorkHours(): float
    {
        if (!$this->clock_in_time || !$this->clock_out_time) {
            return 0;
        }

        $clockIn  = \Carbon\Carbon::parse($this->clock_in_time);
        $clockOut = \Carbon\Carbon::parse($this->clock_out_time);

        return round($clockOut->diffInMinutes($clockIn) / 60, 2);
    }

    // Scopes
    public function scopeForUser($query, int $userId)
    {
        return $query->where('id_users', $userId);
    }

    public function scopeForMonth($query, int $month, int $year)
    {
        return $query->whereMonth('date', $month)->whereYear('date', $year);
    }
}
