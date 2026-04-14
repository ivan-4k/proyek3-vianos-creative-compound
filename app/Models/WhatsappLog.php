<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WhatsappLog extends Model
{
    use HasFactory;

    protected $table = 'whatsapp_logs';
    protected $primaryKey = 'id_wa_log';
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_pesanan',
        'id_users',
        'destination_number',
        'message',
        'status',
        'response',
        'type',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            //
        ];
    }

    // Relations
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'id_pesanan', 'id_pesanan');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }
}
