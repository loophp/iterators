<?php

declare(strict_types=1);

namespace tests\loophp\iterators;

use ArrayIterator;
use IteratorAggregate;
use loophp\iterators\RecursiveIteratorAggregateIterator;
use PHPUnit\Framework\TestCase;
use Traversable;

class RecursiveIteratorAggregateIteratorTestObject implements IteratorAggregate
{
    public function __construct(public readonly string $name, public readonly array $items) {}

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }
}

/**
 * @internal
 *
 * @coversNothing
 */
final class RecursiveIteratorAggregateIteratorTest extends TestCase
{
    public function testRecursiveIteratorAggregateIterator()
    {
        $input = [
            new RecursiveIteratorAggregateIteratorTestObject('1', [
                new RecursiveIteratorAggregateIteratorTestObject('1-1', [
                    new RecursiveIteratorAggregateIteratorTestObject('1-1-1', []),
                ]),
                new RecursiveIteratorAggregateIteratorTestObject('1-2', []),
            ]),
            new RecursiveIteratorAggregateIteratorTestObject('2', []),
            new RecursiveIteratorAggregateIteratorTestObject('3', [
                new RecursiveIteratorAggregateIteratorTestObject('3-1', []),
            ]),
        ];
        $expected = [
            '0: 1',
            '1: 1-1',
            '2: 1-1-1',
            '1: 1-2',
            '0: 2',
            '0: 3',
            '1: 3-1',
        ];
        $result = [];
        $iterator = new RecursiveIteratorAggregateIterator(new ArrayIterator($input));

        foreach ($iterator as $item) {
            $result[] = $iterator->getDepth() . ': ' . $item->name;
        }
        self::assertSame($expected, $result);
    }
}
