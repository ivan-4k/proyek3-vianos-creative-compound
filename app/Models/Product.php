<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'products';
    protected $primaryKey = 'id_produk';
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id_kategori',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'main_image',
        'is_available',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_available' => 'boolean',
        ];
    }

    // Relations
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id_kategori');
    }

    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'id_produk', 'id_produk');
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class, 'id_produk', 'id_produk');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'id_produk', 'id_produk');
    }

    public function dailyStocks(): HasMany
    {
        return $this->hasMany(ProductDailyStock::class, 'id_produk', 'id_produk');
    }
}
