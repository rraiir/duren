<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'code',
        'user_id',
        'status',
        'type',
        'total_price',
        'shipping_address',
        'checkout_at',
        'pay_deadline',
        'proof_path',
        'proof_upload_count',
        'reject_reason',
        'verified_at',
        'terms_accepted_at',
        'shipping_fee_paid_at',
        'delivery_method',
        'courier_name',
        'tracking_number',
        'cancel_reason',
        'completed_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'total_price' => 'integer',
            'proof_upload_count' => 'integer',
            'checkout_at' => 'datetime',
            'pay_deadline' => 'datetime',
            'verified_at' => 'datetime',
            'terms_accepted_at' => 'datetime',
            'shipping_fee_paid_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    /**
     * Relasi ke User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke OrderItem.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
