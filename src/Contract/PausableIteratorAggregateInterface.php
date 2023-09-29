<?php

declare(strict_types=1);

namespace loophp\iterators\Contract;

use Generator;
use IteratorAggregate;

/**
 * @template TKey
 * @template T
 *
 * @extends IteratorAggregate<TKey, T>
 */
interface PausableIteratorAggregateInterface extends IteratorAggregate
{
    /**
     * @return Generator<TKey, T>
     */
    public function rest(): Generator;
}
