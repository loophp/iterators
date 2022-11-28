<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use IteratorAggregate;

use function count;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<int, list<T>>
 */
final class ChunkIterableAggregate implements IteratorAggregate
{
    private int $chunkSize;

    /**
     * @var iterable<TKey, T>
     */
    private iterable $iterable;

    /**
     * @param iterable<TKey, T> $iterable
     */
    public function __construct(iterable $iterable, int $chunkSize)
    {
        $this->iterable = $iterable;
        $this->chunkSize = $chunkSize;
    }

    /**
     * @return Generator<int, list<T>>
     */
    public function getIterator(): Generator
    {
        $values = [];

        foreach ($this->iterable as $value) {
            if (count($values) !== $this->chunkSize) {
                $values[] = $value;

                continue;
            }

            yield $values;

            $values = [$value];
        }

        yield $values;
    }
}
