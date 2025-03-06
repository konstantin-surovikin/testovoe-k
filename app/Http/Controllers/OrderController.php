<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Order\GetAllRequest;
use DateTimeImmutable;
use Domain\Order\DTO\GetOrderListDTO;
use Domain\Order\DTO\OrderFilterDTO;
use Domain\Order\DTO\PaginationDTO;
use Domain\Order\Enums\OrderStatuses;
use Domain\Order\Exceptions\OrderIsNullException;
use Domain\Order\Interfaces\Service\GetOrderListServiceInterface;
use Domain\Order\Interfaces\Service\GetOrderServiceInterface;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * @param string $uuid
     * @param GetOrderServiceInterface $getOrderService
     * @return JsonResponse
     * @throws OrderIsNullException
     */
    public function getOne(
        string $uuid,
        GetOrderServiceInterface $getOrderService
    ): JsonResponse
    {
        return $this->withData($getOrderService->execute($uuid));
    }

    public function getAll(
        GetAllRequest $request,
        GetOrderListServiceInterface $getOrderListService
    ): JsonResponse
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
        $status = null;
        if ($request->status !== null) {
            $status = OrderStatuses::from($request->status);
        }

        $orderFilterDTO = new OrderFilterDTO($from, $to, $status);

        return $this->withData($getOrderListService->execute(new GetOrderListDTO($paginationDTO, $orderFilterDTO)));
    }
}
