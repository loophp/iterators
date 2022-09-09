<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use Generator;
use loophp\iterators\UnpackIterableAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class UnpackIteratorAggregateTest extends TestCase
{
    public function testRewind(): void
    {
        $input = static function () {
            yield [true, true];

            yield [['foo'], ['foo']];
        };

        $iterator = (new UnpackIterableAggregate($input()))->getIterator();
        $iterator->rewind();

        self::assertTrue($iterator->key());
        self::assertTrue($iterator->current());

        $iterator->next();

        self::assertSame(['foo'], $iterator->key());
        self::assertSame(['foo'], $iterator->current());
    }

    public function testWithAGenerator(): void
    {
        $input = static function (): Generator {
            yield ['a', 'a'];

            yield ['b', 'b'];

            yield ['c', 'c'];
        };

        $iterator = (new UnpackIterableAggregate($input()));

        $a = iterator_to_array($iterator);

        $expected = [
            'a' => 'a',
            'b' => 'b',
            'c' => 'c',
        ];

        self::assertSame($expected, $a);
    }
}
