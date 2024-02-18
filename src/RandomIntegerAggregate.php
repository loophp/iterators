<?php

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use IteratorAggregate;

use const PHP_INT_MAX;

/**
 * @implements IteratorAggregate<int, int>
 */
final class RandomIntegerAggregate implements IteratorAggregate
{
    public function __construct(
        private readonly ?int $seed = null,
        private readonly int $min = 0,
        private readonly int $max = PHP_INT_MAX,
    ) {}

    /**
     * @return Generator<int, int>
     */
    public function getIterator(): Generator
    {
        if (null !== $this->seed) {
            mt_srand($this->seed);
        }

        while (true) {
            yield mt_rand($this->min, $this->max);
        }
    }
}
