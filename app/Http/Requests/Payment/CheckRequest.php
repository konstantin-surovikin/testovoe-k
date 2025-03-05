<?php

declare(strict_types=1);

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class CheckRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'uuid' => ['required', 'string'],
        ];
    }
}
