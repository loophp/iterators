<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use Generator;
use loophp\iterators\CachingIteratorAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversDefaultClass \loophp\iterators
 */
final class CachingIteratorAggregateTest extends TestCase
{
    public function testWithAGenerator(): void
    {
        $input = static function (): Generator {
            yield true => true;

            yield false => false;

            yield ['a'] => ['a'];

            yield from range('a', 'c');
        };

        $iterator = (new CachingIteratorAggregate($input()));

        $a = $b = [];

        foreach ($iterator as $key => $value) {
            $a[] = [$key, $value];
        }

        foreach ($iterator as $key => $value) {
            $b[] = [$key, $value];
        }

        $expected = [
            [true, true],
            [false, false],
            [['a'], ['a']],
            [0, 'a'],
            [1, 'b'],
            [2, 'c'],
        ];

        self::assertEquals($expected, $a);
        self::assertTrue($a === $b);
    }
}
