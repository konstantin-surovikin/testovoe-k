<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $uuid
 * @property string $status
 * @property int|null $payment_type_id
 * @property int $entity_id
 * @property string $entity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read PaymentType|null $paymentType
 * @property-read Collection<int, Position> $positions
 * @property-read int|null $positions_count
 * @method static Builder<static> newModelQuery()
 * @method static Builder<static> newQuery()
 * @method static Builder<static> query()
 * @method static Builder<static> whereCreatedAt($value)
 * @method static Builder<static> whereEntity($value)
 * @method static Builder<static> whereEntityId($value)
 * @method static Builder<static> whereId($value)
 * @method static Builder<static> wherePaymentTypeId($value)
 * @method static Builder<static> whereStatus($value)
 * @method static Builder<static> whereUpdatedAt($value)
 * @method static Builder<static> whereUuid($value)
 * @mixin Eloquent
 */
class Order extends Model
{
    protected $fillable = ['uuid', 'status', 'payment_type_id', 'entity_id', 'entity'];


    public function positions(): HasMany
    {
        return $this->hasMany(Position::class);
    }

    public function paymentType(): HasOne
    {
        return $this->hasOne(PaymentType::class);
    }


}
