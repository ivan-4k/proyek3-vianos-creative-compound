<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CafeSetting extends Model
{
    use HasFactory;

    protected $table = 'cafe_settings';
    protected $primaryKey = 'id_setting';
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'opening_time',
        'closing_time',
        'is_open',
        'is_order_open',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'opening_time' => 'string',
            'closing_time' => 'string',
            'is_open' => 'boolean',
            'is_order_open' => 'boolean',
        ];
    }
}
