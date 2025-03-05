<?php

declare(strict_types=1);

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $type
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static>|PaymentType newModelQuery()
 * @method static Builder<static>|PaymentType newQuery()
 * @method static Builder<static>|PaymentType query()
 * @method static Builder<static>|PaymentType whereCreatedAt($value)
 * @method static Builder<static>|PaymentType whereId($value)
 * @method static Builder<static>|PaymentType whereName($value)
 * @method static Builder<static>|PaymentType whereType($value)
 * @method static Builder<static>|PaymentType whereUpdatedAt($value)
 * @mixin Eloquent
 */
class PaymentType extends Model
{
    protected $fillable = ['type', 'name'];
}
