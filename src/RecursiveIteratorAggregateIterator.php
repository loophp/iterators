<?php

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use Iterator;
use IteratorAggregate;
use RuntimeException;
use Traversable;

use function count;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<int, T>
 */
class RecursiveIteratorAggregateIterator implements IteratorAggregate
{
    /**
     * @var list<Iterator>
     */
    private array $stack = [];

    /**
     * @param Traversable<TKey,T> $input
     */
    public function __construct(private readonly Traversable $input) {}

    public function getDepth(): int
    {
        return count($this->stack) - 1;
    }

    /**
     * @return Generator<int,T>
     */
    public function getIterator(): Generator
    {
        $this->stack = [self::findIterator($this->input)];

        while (true) {
            while (count($this->stack) > 0 && !end($this->stack)->valid()) {
                array_pop($this->stack);
            }

            if (count($this->stack) === 0) {
                return;
            }
            $current = end($this->stack)->current();

            yield $current;
            end($this->stack)->next();
            $this->stack[] = self::findIterator($current);
        }
    }

    private static function findIterator(Traversable $input): Iterator
    {
        $prev = null;

        while (!($input instanceof Iterator)) {
            if ($prev === $input || !($input instanceof IteratorAggregate)) {
                throw new RuntimeException('Invalid iterator');
            }
            $prev = $input;
            $input = $input->getIterator();
        }

        return $input;
    }
}
