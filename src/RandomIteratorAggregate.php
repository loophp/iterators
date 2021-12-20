<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

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
        $this->iteratorAggregate = new CachingIteratorAggregate($iterator);
        $this->seed = $seed ?? random_int(PHP_INT_MIN, PHP_INT_MAX);
    }

    /**
     * @return Traversable<TKey, T>
     */
    public function getIterator(): Traversable
    {
        $indexes = $this->predictableRandomArray(
            range(0, iterator_count($this->iteratorAggregate->getIterator()) - 1),
            $this->seed
        );

        $i = 0;

        foreach ($indexes as $index) {
            foreach ($this->iteratorAggregate as $k => $v) {
                if ($indexes[$index] === $i++) {
                    yield $k => $v;
                    $i = 0;

                    continue 2;
                }
            }
        }
    }

    /**
     * @param array<int, int> $array
     *
     * @return array<int, int>
     */
    private function predictableRandomArray(array $array, int $seed): array
    {
        mt_srand($seed);
        shuffle($array);
        mt_srand();

        return $array;
    }
}
