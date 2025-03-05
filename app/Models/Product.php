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
 * @property string $name
 * @property int $cost
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder<static> newModelQuery()
 * @method static Builder<static> newQuery()
 * @method static Builder<static> query()
 * @method static Builder<static> whereCost($value)
 * @method static Builder<static> whereCreatedAt($value)
 * @method static Builder<static> whereId($value)
 * @method static Builder<static> whereName($value)
 * @method static Builder<static> whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Product extends Model
{
    protected $fillable = ['name', 'cost'];
}
