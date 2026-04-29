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
        'weekday_opening_time',
        'weekday_closing_time',
        'weekend_opening_time',
        'weekend_closing_time',
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
            'weekday_opening_time' => 'string',
            'weekday_closing_time' => 'string',
            'weekend_opening_time' => 'string',
            'weekend_closing_time' => 'string',
            'is_open' => 'boolean',
            'is_order_open' => 'boolean',
        ];
    }
}
