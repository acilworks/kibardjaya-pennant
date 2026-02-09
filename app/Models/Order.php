<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Order status constants
    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';

    protected $fillable = [
        'order_number',
        'total_amount',
        'payment_status',
        'payment_method',
        'customer_name',
        'customer_email',
        'order_status',
        'tracking_number',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public static function getStatusOptions(): array
    {
        return [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_PROCESSING => 'Processing',
            self::STATUS_SHIPPED => 'Shipped',
            self::STATUS_DELIVERED => 'Delivered',
        ];
    }
}