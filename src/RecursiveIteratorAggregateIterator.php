<?php

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use IteratorAggregate;
use Traversable;

use function count;

class RecursiveIteratorAggregateIterator implements IteratorAggregate
{
    private array $stack = [];

    public function __construct(Traversable $input)
    {
        $this->stack[] = $input instanceof IteratorAggregate ? $input->getIterator() : $input;
    }

    public function getDepth()
    {
        return count($this->stack) - 1;
    }

    public function getIterator(): Generator
    {
        while (true) {
            while (!empty($this->stack) && !end($this->stack)->valid()) {
                array_pop($this->stack);
            }

            if (empty($this->stack)) {
                return;
            }
            $current = end($this->stack)->current();

            yield $current;
            end($this->stack)->next();
            $this->stack[] = $current instanceof IteratorAggregate ? $current->getIterator() : $current;
        }
    }
}
