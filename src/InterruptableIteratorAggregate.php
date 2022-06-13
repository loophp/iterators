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
final class InterruptableIteratorAggregate implements IteratorAggregate
{
    public const BREAK = 'break';

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
     * @return Generator<Generator<TKey, T>, array{0: TKey, 1: T}>
     */
    public function getIterator(): Generator
    {
        $generator = $this->getGenerator();

        foreach ($generator as $key => $value) {
            yield $generator => [$key, $value];
        }
    }

    /**
     * @return Generator<TKey, T>
     */
    private function getGenerator(): Generator
    {
        foreach ($this->iterable as $key => $value) {
            /** @var mixed $return */
            $return = yield $key => $value;

            if (self::BREAK === $return) {
                break;
            }
        }
    }
}
