<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use IteratorAggregate;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<int, array{0: TKey, 1: T}>
 */
final class PackIterableAggregate implements IteratorAggregate
{
    /**
     * @param iterable<TKey, T> $iterable
     */
    public function __construct(private iterable $iterable)
    {
    }

    /**
     * @return Generator<int, array{0: TKey, 1: T}>
     */
    public function getIterator(): Generator
    {
        foreach ($this->iterable as $key => $value) {
            yield [$key, $value];
        }
    }
}
