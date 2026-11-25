<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    /**
     * Konstanta status dan batasan pesanan.
     */
    public const STATUS_WAITING_PAYMENT = 'waiting_payment';
    public const STATUS_WAITING_PRICE_APPROVAL = 'waiting_price_approval';
    public const STATUS_WAITING_VERIFICATION = 'waiting_verification';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_SHIPPED = 'shipped';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';
    public const PAY_DEADLINE_MINUTES = 15;
    public const MAX_PROOF_UPLOADS = 2;

    public const NEGO_NONE = 'none';
    public const NEGO_PENDING = 'pending';
    public const NEGO_APPROVED = 'approved';
    public const NEGO_REJECTED = 'rejected';

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
        'proposed_price',
        'negotiation_status',
        'negotiation_note',
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
     * Alias relasi ke pembeli.
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke OrderItem.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Alias relasi orderItems.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Relasi ke ulasan pesanan (jika ada).
     */
    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }
}
