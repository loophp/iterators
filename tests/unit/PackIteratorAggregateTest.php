<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use loophp\iterators\PackIterableAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class PackIteratorAggregateTest extends TestCase
{
    public function testWithAGenerator(): void
    {
        $input = static function () {
            yield true => true;

            yield ['foo'] => ['foo'];
        };

        $iterator = (new PackIterableAggregate($input()))->getIterator();
        $iterator->rewind();

        self::assertSame(0, $iterator->key());
        self::assertSame([true, true], $iterator->current());

        $iterator->next();

        self::assertSame(1, $iterator->key());
        self::assertSame([['foo'], ['foo']], $iterator->current());
    }
}
