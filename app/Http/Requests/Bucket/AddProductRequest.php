<?php

declare(strict_types=1);

namespace App\Http\Requests\Bucket;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read int $id
 */
class AddProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:products,id'],
        ];
    }
}
