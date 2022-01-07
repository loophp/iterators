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
 * @implements IteratorAggregate<TKey, T>
 */
final class UnpackIterableAggregate implements IteratorAggregate
{
    /**
     * @var iterable<array-key, array{0: TKey, 1: T}>
     */
    private iterable $iterable;

    /**
     * @param iterable<array-key, array{0: TKey, 1: T}> $iterable
     */
    public function __construct(iterable $iterable)
    {
        $this->iterable = $iterable;
    }

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        foreach ($this->iterable as [$key, $value]) {
            yield $key => $value;
        }
    }
}
