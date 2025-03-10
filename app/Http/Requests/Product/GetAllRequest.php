<?php

declare(strict_types=1);

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read int $page
 * @property-read int $perPage
 * @property-read string $sortBy
 * @property-read string $sortOrder
 */
class GetAllRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => ['sometimes', 'integer', 'min:1'],
            'perPage' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'sortBy' => ['sometimes', 'string', 'in:name,cost'],
            'sortOrder' => ['sometimes', 'string', 'in:asc,desc,ASC,DESC'],
        ];
    }
}
