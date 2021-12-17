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
 * @implements IteratorAggregate<int, array{0: TKey, 1: T}>
 */
final class PackIterableAggregate implements IteratorAggregate
{
    /**
     * @var iterable<TKey, T>
     */
    private iterable $iterable;

    /**
     * @param iterable<TKey, T> $iterable
     */
    public function __construct(iterable $iterable)
    {
        $this->iterable = $iterable;
    }

    /**
     * @return Traversable<int, array{0: TKey, 1: T}>
     */
    public function getIterator(): Traversable
    {
        foreach ($this->iterable as $key => $value) {
            yield [$key, $value];
        }
    }
}
