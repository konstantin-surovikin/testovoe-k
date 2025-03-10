<?php

declare(strict_types=1);

namespace App\Http\Requests\Bucket;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $payment_type
 */
class PayRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payment_type' => ['required', 'string', 'in:First,Second,Third'],
        ];
    }
}
