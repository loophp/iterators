<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use ArrayIterator;
use Countable;
use Generator;
use InvalidArgumentException;
use IteratorAggregate;
use JsonSerializable;
use loophp\iterators\TypedIterableAggregate;
use PHPUnit\Framework\TestCase;
use stdClass;
use Traversable;

use function gettype;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class TypedIterableAggregateTest extends TestCase
{
    private const LIST_DATA = [1, 2, 3];

    private const MAP_DATA = ['foo' => 1, 'bar' => 2];

    public function testAllowsArrayOfAnyType(): void
    {
        $input = [self::MAP_DATA, self::LIST_DATA];
        $expected = $input;
        $iterator = new TypedIterableAggregate(new ArrayIterator($input));

        self::assertSame($expected, iterator_to_array($iterator));
    }

    public function testAllowsCustomGettypeCallback(): void
    {
        $callback = static fn ($variable): string => gettype($variable);

        $obj1 = new class() {
            public function sayHello(): string
            {
                return 'Hello';
            }
        };
        $obj2 = new stdClass();

        $input = [new $obj1(), new $obj2()];
        $expected = $input;
        $iterator = new TypedIterableAggregate(new ArrayIterator($input), $callback);

        self::assertSame($expected, iterator_to_array($iterator));
    }

    public function testAllowsDifferentClassesWithMultipleInterfaces(): void
    {
        $obj1 = new class() implements Countable, JsonSerializable {
            public function count(): int
            {
                return 0;
            }

            public function jsonSerialize(): string
            {
                return '';
            }
        };

        $obj2 = new class() implements JsonSerializable, Countable {
            public function count(): int
            {
                return 0;
            }

            public function jsonSerialize(): string
            {
                return '';
            }
        };

        $input = [new $obj1(), new $obj2()];
        $expected = $input;
        $iterator = new TypedIterableAggregate(new ArrayIterator($input));

        self::assertSame($expected, iterator_to_array($iterator));
    }

    public function testAllowsDifferentClassesWithSameInterface(): void
    {
        $obj1 = new class() implements Countable {
            public function count(): int
            {
                return 0;
            }
        };

        $obj2 = new class() implements Countable {
            public function count(): int
            {
                return 0;
            }
        };

        $input = [new $obj1(), new $obj2()];
        $expected = $input;

        $iterator = new TypedIterableAggregate(new ArrayIterator($input));
        self::assertSame($expected, iterator_to_array($iterator));
    }

    public function testAllowsDifferentClassesWithSameInterfaceButInDifferentOrder(): void
    {
        $obj1 = new class() implements Countable, IteratorAggregate {
            public function count(): int
            {
                return 0;
            }

            public function getIterator(): Traversable
            {
                yield 0;
            }
        };

        $obj2 = new class() implements Countable, IteratorAggregate {
            public function count(): int
            {
                return 0;
            }

            public function getIterator(): Traversable
            {
                yield 0;
            }
        };

        $input = [new $obj1(), new $obj2()];
        $expected = $input;

        $iterator = new TypedIterableAggregate(new ArrayIterator($input));
        self::assertSame($expected, iterator_to_array($iterator));
    }

    public function testAllowsNullType(): void
    {
        $input = [1, null, 3];
        $expected = $input;
        $iterator = new TypedIterableAggregate(new ArrayIterator($input));
        self::assertSame($expected, iterator_to_array($iterator));
    }

    public function testAllowsSameClassWithInterface(): void
    {
        $obj = new class() implements Countable {
            public function count(): int
            {
                return 0;
            }
        };

        $input = [new $obj(), new $obj()];
        $expected = $input;
        $iterator = new TypedIterableAggregate(new ArrayIterator($input));
        self::assertSame($expected, iterator_to_array($iterator));
    }

    public function testAllowsSameClassWithMultipleInterfaces(): void
    {
        $obj = new class() implements Countable, JsonSerializable {
            public function count(): int
            {
                return 0;
            }

            public function jsonSerialize(): string
            {
                return '';
            }
        };

        $input = [new $obj(), new $obj()];
        $expected = $input;
        $iterator = new TypedIterableAggregate(new ArrayIterator($input));
        self::assertSame($expected, iterator_to_array($iterator));
    }

    public function testAllowsSameClassWithoutInterface(): void
    {
        $obj1 = new stdClass();
        $obj1->id = 1;

        $obj2 = new stdClass();
        $obj2->id = 2;

        $input = [new $obj1(), new $obj2()];
        $expected = $input;
        $iterator = new TypedIterableAggregate(new ArrayIterator($input));
        self::assertSame($expected, iterator_to_array($iterator));
    }

    public function testDisallowsBoolMixed(): void
    {
        $iterator = (new TypedIterableAggregate(new ArrayIterator([true, false, 'bar'])))->getIterator();
        $iterator->next();

        $this->expectException(InvalidArgumentException::class);

        $iterator->next();
    }

    public function testDisallowsDifferentClasses(): void
    {
        $obj1 = new class() {
            public function sayHello(): string
            {
                return 'Hello';
            }
        };

        $obj2 = new stdClass();

        $input = [new $obj1(), new $obj2()];
        $iterator = (new TypedIterableAggregate(new ArrayIterator($input)))->getIterator();

        $this->expectException(InvalidArgumentException::class);

        $iterator->next();
    }

    public function testDisallowsFloatMixed(): void
    {
        $input = [2.3, 5.6, 1];
        $iterator = (new TypedIterableAggregate(new ArrayIterator($input)))->getIterator();
        $iterator->next();
        $this->expectException(InvalidArgumentException::class);

        $iterator->next();
    }

    public function testDisallowsIntMixed(): void
    {
        $input = [1, 2, 'foo'];
        $iterator = (new TypedIterableAggregate(new ArrayIterator($input)))->getIterator();

        $iterator->next();

        $this->expectException(InvalidArgumentException::class);

        $iterator->next();
    }

    public function testDisallowsMixedAtBeginning(): void
    {
        $iterator = (new TypedIterableAggregate(new ArrayIterator([1, 'bar', 'foo'])))->getIterator();

        $this->expectException(InvalidArgumentException::class);

        $iterator->next();
    }

    public function testDisallowsMixedInMiddle(): void
    {
        $iterator = (new TypedIterableAggregate(new ArrayIterator([1, 'bar', 2])))->getIterator();

        $this->expectException(InvalidArgumentException::class);

        $iterator->next();
    }

    public function testDisallowsMixOfClassesWithAndWithoutInterfaces(): void
    {
        $obj1 = new class() implements Countable {
            public function count(): int
            {
                return 0;
            }
        };

        $obj2 = new class() {
            public function count(): int
            {
                return 0;
            }
        };

        $input = [new $obj1(), new $obj2()];
        $iterator = (new TypedIterableAggregate(new ArrayIterator($input)))->getIterator();

        $this->expectException(InvalidArgumentException::class);

        $iterator->next();
    }

    public function testDisallowsMixOfClassesWithDifferentInterfaces(): void
    {
        $obj1 = new class() implements Countable {
            public function count(): int
            {
                return 0;
            }
        };

        $obj2 = new class() implements JsonSerializable {
            public function jsonSerialize(): string
            {
                return '';
            }
        };

        $input = [new $obj1(), new $obj2()];
        $iterator = (new TypedIterableAggregate(new ArrayIterator($input)))->getIterator();

        $this->expectException(InvalidArgumentException::class);

        $iterator->next();
    }

    public function testDisallowsResourceMixedOpenClosed(): void
    {
        $openResource = fopen('data://text/plain,ABCD', 'rb');
        $closedResource = fopen('data://text/plain,XYZ', 'rb');
        fclose($closedResource);

        $input = [$openResource, $closedResource];
        $iterator = (new TypedIterableAggregate(new ArrayIterator($input)))->getIterator();

        $this->expectException(InvalidArgumentException::class);

        $iterator->next();
    }

    public function testDisallowsStringMixed(): void
    {
        $iterator = (new TypedIterableAggregate(new ArrayIterator(['foo', 'bar', 3])))->getIterator();

        $iterator->next();

        $this->expectException(InvalidArgumentException::class);

        $iterator->next();
    }

    public function testIsInitializableFromArray(): void
    {
        $iterator = (new TypedIterableAggregate(new ArrayIterator(self::LIST_DATA)))->getIterator();

        self::assertTrue($iterator->valid());

        $expected = self::LIST_DATA;
        self::assertSame($expected, iterator_to_array($iterator));
    }

    public function testIsInitializableFromGenerator(): void
    {
        $gen = static fn (): Generator => yield from self::MAP_DATA;

        $iterator = (new TypedIterableAggregate($gen()))->getIterator();

        self::assertTrue($iterator->valid());
        $expected = self::MAP_DATA;
        self::assertSame($expected, iterator_to_array($iterator));
    }

    public function testIsInitializableFromIterator(): void
    {
        $iterator = (new TypedIterableAggregate(new ArrayIterator(self::LIST_DATA)))->getIterator();

        self::assertTrue($iterator->valid());
        $expected = self::LIST_DATA;
        self::assertSame($expected, iterator_to_array($iterator));
    }

    public function testReturnAnIntKey(): void
    {
        $iterator = (new TypedIterableAggregate(new ArrayIterator(self::LIST_DATA)))->getIterator();

        self::assertSame(0, $iterator->key());
        $iterator->next();
        self::assertSame(1, $iterator->key());
    }

    public function testReturnAStringKey(): void
    {
        $iterator = (new TypedIterableAggregate(new ArrayIterator(self::MAP_DATA)))->getIterator();

        self::assertSame('foo', $iterator->key());
        $iterator->next();
        self::assertSame('bar', $iterator->key());
    }

    public function testRewind(): void
    {
        $iteratorAggregate = new TypedIterableAggregate(new ArrayIterator(['foo']));

        $iterator = $iteratorAggregate->getIterator();

        self::assertSame('foo', $iterator->current());

        $iterator->next();
        self::assertFalse($iterator->valid());
        self::assertNull($iterator->current());

        $iterator = $iteratorAggregate->getIterator();
        self::assertTrue($iterator->valid());
        self::assertSame('foo', $iterator->current());
    }

    public function testWithNullValues(): void
    {
        $input = ['a' => null, 'b' => null];
        $expected = $input;
        $iterator = new TypedIterableAggregate(new ArrayIterator($input));

        self::assertSame($expected, iterator_to_array($iterator));
    }
}
