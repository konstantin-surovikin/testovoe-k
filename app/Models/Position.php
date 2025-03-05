<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $name
 * @property int $cost
 * @property int $amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Order $order
 * @property-read Product $product
 * @method static Builder<static>|Position newModelQuery()
 * @method static Builder<static>|Position newQuery()
 * @method static Builder<static>|Position query()
 * @method static Builder<static>|Position whereAmount($value)
 * @method static Builder<static>|Position whereCost($value)
 * @method static Builder<static>|Position whereCreatedAt($value)
 * @method static Builder<static>|Position whereId($value)
 * @method static Builder<static>|Position whereName($value)
 * @method static Builder<static>|Position whereOrderId($value)
 * @method static Builder<static>|Position whereProductId($value)
 * @method static Builder<static>|Position whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Position extends Model
{
    protected $fillable = ['order_id', 'product_id', 'name', 'cost', 'amount'];


    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
