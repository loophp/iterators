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
        return count($this->stack);
    }

    /**
     * @return Generator<int,T>
     */
    public function getIterator(): Generator
    {
        $iterator = self::findIterator($this->input);
        $this->stack = [];

        while (true) {
            while (null !== $iterator && $iterator->valid() === false) {
                $iterator = array_pop($this->stack);
            }

            if (null === $iterator) {
                return;
            }
            $current = $iterator->current();

            yield $current;
            $iterator->next();

            if ($current instanceof Traversable) {
                $this->stack[] = $iterator;
                $iterator = self::findIterator($current);
            }
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
