<?php

declare(strict_types=1);

namespace Domain\Order\Models;

use ArrayIterator;

class Bucket
{
    /**
     * @param array<int, ProductBucket> $positions
     * @param string|null $uuid
     */
    public function __construct(
        public ?string $uuid = null,
        private array $positions = [],
    )
    {
    }

    /**
     * @param Product $additional
     * @return $this
     */
    public function addProduct(Product $additional): static
    {
        $this->positions[$additional->id] = $this->positions[$additional->id] ?? new ProductBucket(
            $additional->id,
            $this->uuid,
            0
        );
        $this->positions[$additional->id]->amount++;

        return $this;
    }

    /**
     * @param Product $removal
     * @return $this
     */
    public function removeProduct(Product $removal): static
    {
        $this->positions[$removal->id] = $this->positions[$removal->id] ?? new ProductBucket(
            $removal->id,
            $this->uuid,
            1
        );

        if (--$this->positions[$removal->id]->amount <= 0) {
            unset($this->positions[$removal->id]);
        }

        return $this;
    }

    /**
     * @return ArrayIterator<int, ProductBucket>
     */
    public function getProducts(): ArrayIterator
    {
        return new ArrayIterator(array_values($this->positions));
    }
}
