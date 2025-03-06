<?php

declare(strict_types=1);

namespace Domain\Order\Interfaces\Service;

use Domain\Order\DTO\Bucket\BucketDTO;

interface GetBucketServiceInterface
{
    public function execute(): BucketDTO;
}