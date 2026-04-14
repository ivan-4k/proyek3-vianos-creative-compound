<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductDailyStock extends Model
{
    use HasFactory;

    protected $table = 'product_daily_stocks';
    protected $primaryKey = 'id_stok';
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_produk',
        'date',
        'stock',
        'remaining_stock',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'date',
            'stock' => 'integer',
            'remaining_stock' => 'integer',
        ];
    }

    // Relations
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_produk', 'id_produk');
    }
}
