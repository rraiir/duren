<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /**
     * Konstanta ukuran dan tipe produk durian.
     */
    public const SIZES = ['S', 'M', 'L'];
    public const TYPE_READY = 'ready';
    public const TYPE_PREORDER = 'preorder';
    public const TYPES = [self::TYPE_READY, self::TYPE_PREORDER];
    public const MIN_WEIGHT_GRAM = 100;
    public const MIN_PRICE = 1000;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'size',
        'est_weight_gram',
        'price',
        'stock',
        'type',
        'eta_text',
        'description',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'est_weight_gram' => 'integer',
            'price' => 'integer',
            'stock' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Relasi ke CartItem.
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Relasi ke OrderItem.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Cek apakah tipe produk adalah ready stock.
     */
    public function isReady(): bool
    {
        return $this->type === 'ready';
    }

    /**
     * Cek apakah tipe produk adalah preorder.
     */
    public function isPreorder(): bool
    {
        return $this->type === 'preorder';
    }
}
