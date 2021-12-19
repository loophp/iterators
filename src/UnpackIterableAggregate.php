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
final class UnpackIterableAggregate implements IteratorAggregate
{
    /**
     * @var iterable<int|string, array{0: TKey, 1: T}>
     */
    private iterable $iterable;

    /**
     * @param iterable<int|string, array{0: TKey, 1: T}> $iterable
     */
    public function __construct(iterable $iterable)
    {
        $this->iterable = $iterable;
    }

    /**
     * @return Traversable<TKey, T>
     */
    public function getIterator(): Traversable
    {
        foreach ($this->iterable as $value) {
            yield $value[0] => $value[1];
        }
    }
}
