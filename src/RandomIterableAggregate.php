<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

use ArrayIterator;
use Generator;
use IteratorAggregate;
use Traversable;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class RandomIterableAggregate implements IteratorAggregate
{
    /**
     * @var IteratorAggregate<array-key, array{0: TKey, 1: T}>
     */
    private IteratorAggregate $iteratorAggregate;

    private int $seed;

    /**
     * @param iterable<TKey, T> $iterable
     */
    public function __construct(iterable $iterable, int $seed = 0)
    {
        $this->iteratorAggregate = new PackIterableAggregate($iterable);
        $this->seed = $seed;
    }

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        mt_srand($this->seed);

        yield from $this->randomize($this->iteratorAggregate, $this->seed);
    }

    /**
     * @param Traversable<int, array{0: TKey, 1: T}> $traversable
     *
     * @return Generator<TKey, T>
     */
    private function randomize(Traversable $traversable, int $seed): Generator
    {
        $isQueueEmpty = true;
        $queue = [];

        foreach (new UnpackIterableAggregate($traversable) as $key => $value) {
            if (mt_rand(0, $seed) === 0) {
                yield $key => $value;

                continue;
            }

            $queue[] = [$key, $value];
            $isQueueEmpty = false;
        }

        if (false === $isQueueEmpty) {
            yield from $this->randomize(new ArrayIterator($queue), $seed);
        }
    }
}
