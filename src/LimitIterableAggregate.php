<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use IteratorAggregate;
use LimitIterator;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class LimitIterableAggregate implements IteratorAggregate
{
    /**
     * @var iterable<TKey, T>
     */
    private iterable $iterable;

    private int $limit;

    private int $offset;

    /**
     * @param iterable<TKey, T> $iterable
     */
    public function __construct(iterable $iterable, int $offset = 0, int $limit = -1)
    {
        $this->iterable = $iterable;
        $this->offset = $offset;
        $this->limit = $limit;
    }

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        yield from new LimitIterator(
            (new IterableIteratorAggregate($this->iterable))->getIterator(),
            $this->offset,
            $this->limit
        );
    }
}
