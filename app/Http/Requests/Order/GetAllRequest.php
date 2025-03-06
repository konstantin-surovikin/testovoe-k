<?php

declare(strict_types=1);

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read int $page
 * @property-read int $perPage
 * @property-read string $sortBy
 * @property-read string $sortOrder
 * @property-read string $from
 * @property-read string $to
 * @property-read string $status
 */
class GetAllRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'page' => ['sometimes', 'integer', 'min:1'],
            'perPage' => ['sometimes', 'integer', 'min:1', 'max:100'],
            'sortBy' => ['sometimes', 'string', 'in:status,created_at'],
            'sortOrder' => ['sometimes', 'string', 'in:asc,desc,ASC,DESC'],
            'from' => ['sometimes', 'date', 'date_format:Y-m-d'],
            'to' => ['sometimes', 'date', 'date_format:Y-m-d'],
            'status' => ['sometimes', 'string', 'in:Paid,Unpaid,Denied'],
        ];
    }
}
