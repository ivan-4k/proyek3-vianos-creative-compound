<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'id_pesanan';
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_users',
        'order_code',
        'queue_number',
        'subtotal',
        'total',
        'payment_status',
        'order_status',
        'notes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'total' => 'decimal:2',
            'queue_number' => 'integer',
        ];
    }

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_users', 'id_users');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'id_pesanan', 'id_pesanan');
    }

    public function whatsappLogs(): HasMany
    {
        return $this->hasMany(WhatsappLog::class, 'id_pesanan', 'id_pesanan');
    }
}
