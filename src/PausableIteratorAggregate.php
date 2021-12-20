<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

use ArrayIterator;
use Iterator;
use IteratorAggregate;
use loophp\iterators\Contract\PausableIteratorAggregateInterface;
use Traversable;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class PausableIteratorAggregate implements PausableIteratorAggregateInterface
{
    /**
     * @var Iterator<TKey, T>
     */
    private Iterator $iterator;

    /**
     * @var IteratorAggregate<TKey, T>
     */
    private IteratorAggregate $iteratorAggregate;

    /**
     * @param Iterator<TKey, T> $iterator
     */
    public function __construct(Iterator $iterator)
    {
        $this->iteratorAggregate = new CachingIteratorAggregate($iterator);
        $this->iterator = new ArrayIterator();
    }

    /**
     * @return Traversable<TKey, T>
     */
    public function getIterator(): Traversable
    {
        $this->iterator = $this->iteratorAggregate->getIterator();

        yield from $this->iterator;
    }

    /**
     * @return Traversable<TKey, T>
     */
    public function rest(): Traversable
    {
        $this->iterator->next();

        for (; $this->iterator->valid(); $this->iterator->next()) {
            yield $this->iterator->key() => $this->iterator->current();
        }
    }
}
