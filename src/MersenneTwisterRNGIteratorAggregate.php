<?php

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use IteratorAggregate;

use const PHP_INT_MAX;
use const PHP_INT_MIN;

/**
 * @implements IteratorAggregate<int, int>
 */
final class MersenneTwisterRNGIteratorAggregate implements IteratorAggregate
{
    private int $max = PHP_INT_MAX;

    private int $min = PHP_INT_MIN;

    private int $seed = 0;

    /**
     * @return Generator<int, int>
     */
    public function getIterator(): Generator
    {
        if (0 !== $this->seed) {
            mt_srand($this->seed);
        }

        // @phpstan-ignore-next-line
        while (true) {
            yield mt_rand($this->min, $this->max);
        }
    }

    public function withMax(int $max): self
    {
        $clone = clone $this;
        $clone->max = $max;

        return $clone;
    }

    public function withMin(int $min): self
    {
        $clone = clone $this;
        $clone->min = $min;

        return $clone;
    }

    public function withSeed(int $seed): self
    {
        $clone = clone $this;
        $clone->seed = $seed;

        return $clone;
    }
}
