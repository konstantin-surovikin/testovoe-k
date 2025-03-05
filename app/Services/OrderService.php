<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\OrderDTO;
use App\DTO\OrderFilterDTO;
use App\DTO\PaginationDTO;
use App\DTO\PositionDTO;
use App\Models\Order;
use App\Models\Position;

class OrderService
{
    public function getOrder(string $uuid): OrderDTO
    {
        $order = Order::where('uuid', $uuid)->firstOrFail();
        $positions = Position::where('order_id', $order->id)->get();

        $positionDTOs = $positions->map(function ($position) {
            return new PositionDTO(
                $position->id,
                $position->name,
                $position->cost,
                $position->amount
            );
        })->toArray();

        return new OrderDTO(
            $order->uuid,
            $order->status,
            $positionDTOs
        );
    }

    public function getOrders(PaginationDTO $paginationDTO, OrderFilterDTO $orderFilterDTO): array
    {
        $query = Order::query();

        if ($orderFilterDTO->from) {
            $query->where('created_at', '>=', $orderFilterDTO->from);
        }
        if ($orderFilterDTO->to) {
            $query->where('created_at', '<=', $orderFilterDTO->to);
        }
        if ($orderFilterDTO->status) {
            $query->where('status', $orderFilterDTO->status);
        }

        if ($paginationDTO->sortBy) {
            $query->orderBy($paginationDTO->sortBy, strtolower($paginationDTO->sortOrder));
        }

        $orders = $query->paginate($paginationDTO->perPage, ['*'], 'page', $paginationDTO->page);

        return $orders->map(function (Order $order) {
            $positions = $order->positions->map(function (Position $position) {
                return new PositionDTO(
                    $position->id,
                    $position->name,
                    $position->cost,
                    $position->amount
                );
            })->toArray();

            return new OrderDTO(
                $order->uuid,
                $order->status,
                $positions
            );
        })->toArray();
    }
}
