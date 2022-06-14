<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use IteratorAggregate;
use Traversable;

use function in_array;

use const PHP_INT_MAX;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class UniqueIterableAggregate implements IteratorAggregate
{
    /**
     * @var iterable<TKey, T>
     */
    private iterable $iterable;

    private int $retries;

    /**
     * @param iterable<TKey, T> $iterable
     */
    public function __construct(iterable $iterable, int $retries = PHP_INT_MAX)
    {
        $this->iterable = $iterable;
        $this->retries = $retries;
    }

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Traversable
    {
        $retries = $this->retries;
        $seen = [];

        foreach ($this->iterable as $key => $value) {
            if (0 === $retries) {
                break;
            }

            if (in_array($value, $seen, true)) {
                --$retries;

                continue;
            }

            $seen[] = $value;

            yield $key => $value;
        }
    }
}
