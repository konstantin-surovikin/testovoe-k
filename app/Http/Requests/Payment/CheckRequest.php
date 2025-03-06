<?php

declare(strict_types=1);

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $uuid
 */
class CheckRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['required', 'string'],
        ];
    }
}
