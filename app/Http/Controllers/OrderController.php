<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\OrderFilterDTO;
use App\DTO\PaginationDTO;
use App\Http\Requests\Order\GetAllRequest;
use App\Services\OrderService;
use DateTimeImmutable;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrderService $orderService,
    )
    {
    }

    public function getOne(string $uuid): JsonResponse
    {
        $orderDTO = $this->orderService->getOrder($uuid);

        return response()->json([
            'result' => true,
            'message' => null,
            'data' => $orderDTO,
        ]);
    }

    public function getAll(GetAllRequest $request): JsonResponse
    {

        $paginationDTO = new PaginationDTO(
            $request->page ?? 0,
            $request->perPage ?? 15,
            $request->sortBy,
            $request->sortOrder
        );

        $from = null;
        if ($request->from !== null) {
            $from = DateTimeImmutable::createFromFormat('Y-m-d', $request->from);
        }
        $to = null;
        if ($request->to !== null) {
            $to = DateTimeImmutable::createFromFormat('Y-m-d', $request->to);
        }

        $orderFilterDTO = new OrderFilterDTO(
            $from,
            $to,
            $request->status
        );

        $orders = $this->orderService->getOrders($paginationDTO, $orderFilterDTO);

        return response()->json([
            'result' => true,
            'message' => null,
            'data' => $orders,
        ]);
    }
}
