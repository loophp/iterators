<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use loophp\iterators\StringIteratorAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class StringIteratorAggregateTest extends TestCase
{
    public static function provideBasicCases(): iterable
    {
        yield [
            'hello world',
            'o',
            [
                'hell',
                ' w',
                'rld',
            ],
        ];

        yield [
            'hello world',
            '',
            str_split('hello world'),
        ];

        yield [
            '😃😁😂',
            '',
            mb_str_split('😃😁😂'),
        ];

        yield [
            'a😃b😃c',
            '😃',
            range('a', 'c'),
        ];
    }

    /**
     * @dataProvider provideBasicCases
     */
    public function testBasic(string $input, string $delimiter, mixed $expected)
    {
        self::assertSame(
            $expected,
            iterator_to_array(new StringIteratorAggregate($input, $delimiter))
        );
    }
}
