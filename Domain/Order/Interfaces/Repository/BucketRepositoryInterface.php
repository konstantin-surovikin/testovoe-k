<?php

declare(strict_types=1);

namespace Domain\Order\Interfaces\Repository;

use Domain\Order\Models\Bucket;

interface BucketRepositoryInterface
{
    /**
     * @return Bucket|null
     */
    public function get(): ?Bucket;

    public function save(Bucket $bucket): void;
}
