<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'qris_image_path',
        'admin_whatsapp',
        'warranty_text',
        'shipping_rules_text',
        'shipping_fee_deadline_days',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'shipping_fee_deadline_days' => 'integer',
        ];
    }

    /**
     * Ambil record pengaturan tunggal (id = 1).
     */
    public static function current(): ?self
    {
        return static::find(1);
    }
}
