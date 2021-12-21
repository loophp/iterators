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
use IteratorAggregate;
use Traversable;

use const PHP_INT_MAX;
use const PHP_INT_MIN;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class RandomIteratorAggregate implements IteratorAggregate
{
    /**
     * @var IteratorAggregate<TKey, T>
     */
    private IteratorAggregate $iteratorAggregate;

    private int $seed;

    /**
     * @param Iterator<TKey, T> $iterator
     */
    public function __construct(Iterator $iterator, ?int $seed = null)
    {
        $this->iteratorAggregate = new PackIterableAggregate($iterator);
        $this->seed = $seed ?? random_int(PHP_INT_MIN, PHP_INT_MAX);
    }

    /**
     * @return Traversable<TKey, T>
     */
    public function getIterator(): Traversable
    {
        mt_srand($this->seed);

        yield from $this->randomize($this->iteratorAggregate, $this->seed);
    }

    /**
     * @return Generator<TKey, T>
     */
    private function randomize(Traversable $traversable, int $seed): Generator
    {
        $isQueueEmpty = true;
        $queue = new ArrayIterator([]);

        foreach (new UnpackIterableAggregate($traversable) as $key => $value) {
            if (mt_rand(0, $seed) === 0) {
                yield $key => $value;

                continue;
            }

            $queue->append([$key, $value]);
            $isQueueEmpty = false;
        }

        if (false === $isQueueEmpty) {
            yield from $this->randomize($queue, $seed);
        }
    }
}
