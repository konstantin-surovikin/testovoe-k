<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repository\BucketRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Domain\Order\Interfaces\Repository\BucketRepositoryInterface;
use Domain\Order\Interfaces\Repository\OrderRepositoryInterface;
use Domain\Order\Interfaces\Repository\ProductRepositoryInterface;
use Domain\Order\Interfaces\Service\AddProductServiceInterface;
use Domain\Order\Interfaces\Service\CancelPaymentServiceInterface;
use Domain\Order\Interfaces\Service\CheckPaymentInterface;
use Domain\Order\Interfaces\Service\ConfirmPaymentServiceInterface;
use Domain\Order\Interfaces\Service\GeneratePaymentUrlServiceInterface;
use Domain\Order\Interfaces\Service\GetBucketServiceInterface;
use Domain\Order\Interfaces\Service\GetOrderListServiceInterface;
use Domain\Order\Interfaces\Service\GetOrderServiceInterface;
use Domain\Order\Interfaces\Service\GetProductListServiceInterface;
use Domain\Order\Interfaces\Service\GetProductServiceInterface;
use Domain\Order\Interfaces\Service\PayServiceInterface;
use Domain\Order\Interfaces\Service\RemoveProductServiceInterface;
use Domain\Order\Mock\CheckPaymentService;
use Domain\Order\Mock\GeneratePaymentUrlService;
use Domain\Order\Services\AddProductService;
use Domain\Order\Services\CancelPaymentService;
use Domain\Order\Services\ConfirmPaymentService;
use Domain\Order\Services\GetBucketService;
use Domain\Order\Services\GetOrderListService;
use Domain\Order\Services\GetOrderService;
use Domain\Order\Services\GetProductListService;
use Domain\Order\Services\GetProductService;
use Domain\Order\Services\PayService;
use Domain\Order\Services\RemoveProductService;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Ramsey\Uuid\UuidFactory;
use Ramsey\Uuid\UuidFactoryInterface;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        AddProductServiceInterface::class => AddProductService::class,
        CancelPaymentServiceInterface::class => CancelPaymentService::class,
        CheckPaymentInterface::class => CheckPaymentService::class,
        ConfirmPaymentServiceInterface::class => ConfirmPaymentService::class,
        GetBucketServiceInterface::class => GetBucketService::class,
        GetOrderListServiceInterface::class => GetOrderListService::class,
        GetOrderServiceInterface::class => GetOrderService::class,
        GetProductListServiceInterface::class => GetProductListService::class,
        GetProductServiceInterface::class => GetProductService::class,
        PayServiceInterface::class => PayService::class,
        RemoveProductServiceInterface::class => RemoveProductService::class,

        UuidFactoryInterface::class => UuidFactory::class,
    ];

    public function register(): void
    {
        $this->app->bind(
            BucketRepositoryInterface::class,
            static fn(Application $app) => new BucketRepository(
                $app->make(UuidFactoryInterface::class),
                $app->make(Factory::class)->guard()->user()
            )
        );

        $this->app->bind(
            OrderRepositoryInterface::class,
            static fn(Application $app) => new OrderRepository()
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            static fn(Application $app) => new ProductRepository()
        );

        $this->app->bind(
            GeneratePaymentUrlServiceInterface::class,
            static fn(Application $app) => new GeneratePaymentUrlService(
                $app->make('url')->route('mock-payment')
            )
        );
    }
}
