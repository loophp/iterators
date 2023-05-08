<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use LimitIterator;
use loophp\iterators\MersenneTwisterRNGIteratorAggregate;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class MersenneTwisterRNGIteratorAggregatorTest extends TestCase
{
    public function testBasic(): void
    {
        $iterator =
            new LimitIterator(
                (new MersenneTwisterRNGIteratorAggregate())->withMin(1)->withMax(100)->getIterator(),
                0,
                100
            );

        $expected = range(0, 100);
        self::assertNotSame($expected, iterator_to_array($iterator));
    }

    public function testSeed(): void
    {
        $seed = -1;
        $innerIterator = (new MersenneTwisterRNGIteratorAggregate())->withSeed($seed);

        $iterator = new LimitIterator($innerIterator->getIterator(), 0, 10);

        $expected = [
            -7422378986580066014,
            7607120784305990727,
            5331760257347419712,
            5165154706003526138,
            -8892443392435847392,
            8660855838641975931,
            1718781808164485227,
            -6527986301322975030,
            7551637291286289549,
            991259994952170583,
        ];

        self::assertSame($expected, iterator_to_array($iterator));

        $iterator = new LimitIterator($innerIterator->withSeed(-1)->getIterator(), 0, 10);

        self::assertSame($expected, iterator_to_array($iterator));
    }

    public function testWithers(): void
    {
        $iterator = (new MersenneTwisterRNGIteratorAggregate());

        self::assertNotEquals($iterator, $iterator->withMax(10));
        self::assertNotEquals($iterator, $iterator->withMin(0));
        self::assertNotEquals($iterator, $iterator->withSeed(123));
    }

    public function testWithSeed(): void
    {
        $seed = 123;

        $iterator =
            new LimitIterator(
                (new MersenneTwisterRNGIteratorAggregate())->withMin(1)->withMax(10)->withSeed($seed)->getIterator(),
                0,
                10
            );

        $expected = [3, 10, 3, 1, 1, 3, 7, 8, 10, 5];
        self::assertSame($expected, iterator_to_array($iterator));
    }
}
