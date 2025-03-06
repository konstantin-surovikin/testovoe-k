<?php

declare(strict_types=1);

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $id
 */
class GetOneRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'uuid', 'exists:orders,uuid'],
        ];
    }
}
