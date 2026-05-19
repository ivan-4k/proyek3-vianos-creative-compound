<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CafeTable extends Model
{
    use HasFactory;

    protected $table = 'cafe_tables';
    protected $primaryKey = 'id';

    protected $fillable = [
        'number',
        'capacity',
        'location',
        'status',
        'coord_x',
        'coord_y',
        'width',
        'height',
        'qr_code',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'capacity' => 'integer',
            'coord_x'  => 'integer',
            'coord_y'  => 'integer',
            'width'    => 'integer',
            'height'   => 'integer',
        ];
    }

    public function currentOrder(): HasOne
    {
        return $this->hasOne(Order::class, 'table_id', 'id')
            ->whereNotIn('order_status', ['completed', 'cancelled'])
            ->latest();
    }

    /**
     * Generate QR code string untuk meja
     */
    public static function generateQrCode(string $number): string
    {
        return 'TABLE_' . strtoupper(str_replace('-', '_', $number)) . '_QR';
    }

    // Scopes
    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByLocation($query, string $location)
    {
        return $query->where('location', $location);
    }
}
