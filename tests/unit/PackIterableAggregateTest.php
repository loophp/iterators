<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use Generator;
use loophp\iterators\PackIterableAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversDefaultClass \loophp\iterators
 */
final class PackIterableAggregateTest extends TestCase
{
    public function testWithAGenerator(): void
    {
        $input = static function (): Generator {
            $input = range('a', 'c');

            yield from array_combine($input, $input);
        };

        $iterator = (new PackIterableAggregate($input()));

        $a = iterator_to_array($iterator);

        $expected = [
            ['a', 'a'],
            ['b', 'b'],
            ['c', 'c'],
        ];

        self::assertSame($expected, $a);
    }
}
