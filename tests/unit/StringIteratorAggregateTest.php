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
 * @coversDefaultClass \loophp\iterators
 */
final class StringIteratorAggregateTest extends TestCase
{
    public function testBasicStringWithDelimiter()
    {
        $input = 'hello world';
        $delimiter = 'o';
        $iterator = new StringIteratorAggregate($input, $delimiter);
        $output = [
            'hell',
            ' w',
            'rld',
        ];

        self::assertSame($output, iterator_to_array($iterator));
    }

    public function testBasicStringWithoutDelimiter()
    {
        $input = 'hello world';
        $iterator = new StringIteratorAggregate($input);

        self::assertSame(str_split($input), iterator_to_array($iterator));
    }
}
