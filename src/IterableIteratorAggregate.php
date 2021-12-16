<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

use IteratorAggregate;
use Traversable;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class IterableIteratorAggregate implements IteratorAggregate
{
    /**
     * @var IteratorAggregate<TKey, T>
     */
    private IteratorAggregate $iterator;

    /**
     * @param iterable<TKey, T> $iterable
     */
    public function __construct(iterable $iterable)
    {
        $this->iterator = new ClosureIteratorAggregate(static fn () => yield from $iterable);
    }

    /**
     * @return Traversable<TKey, T>
     */
    public function getIterator(): Traversable
    {
        return $this->iterator->getIterator();
    }
}
