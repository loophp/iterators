<?php

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use IteratorAggregate;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<Generator<TKey, T>, array{0: TKey, 1: T}>
 */
final class InterruptableIterableIteratorAggregate implements IteratorAggregate
{
    public const BREAK = 'break';

    /**
     * @param iterable<TKey, T> $iterable
     */
    public function __construct(private iterable $iterable) {}

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
            /** @var string $return */
            $return = yield $key => $value;

            if (self::BREAK === $return) {
                break;
            }
        }
    }
}
