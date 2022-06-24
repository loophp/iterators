<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

use ArrayIterator;
use Generator;
use Iterator;
use loophp\iterators\Contract\PausableIteratorAggregateInterface;

/**
 * @template TKey
 * @template T
 *
 * @implements PausableIteratorAggregateInterface<TKey, T>
 */
final class PausableIteratorAggregate implements PausableIteratorAggregateInterface
{
    /**
     * @var Iterator<TKey, T>
     */
    private Iterator $iterator;

    /**
     * @var CachingIteratorAggregate<TKey, T>
     */
    private CachingIteratorAggregate $iteratorAggregate;

    /**
     * @param Iterator<TKey, T> $iterator
     */
    public function __construct(Iterator $iterator)
    {
        $this->iteratorAggregate = new CachingIteratorAggregate($iterator);
        $this->iterator = new ArrayIterator();
    }

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        $iterator = $this->iteratorAggregate->getIterator();

        $this->iterator = $iterator;

        yield from $this->iterator;
    }

    /**
     * @return Generator<TKey, T>
     */
    public function rest(): Generator
    {
        $this->iterator->next();

        for ($this->iterator->next(); $this->iterator->valid(); $this->iterator->next()) {
            yield $this->iterator->key() => $this->iterator->current();
        }
    }
}
