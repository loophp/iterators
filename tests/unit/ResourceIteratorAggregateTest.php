<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace tests\loophp\iterators;

use InvalidArgumentException;
use loophp\iterators\ResourceIteratorAggregate;
use PHPUnit\Framework\TestCase;

use function is_resource;

/**
 * @internal
 *
 * @coversDefaultClass \loophp\iterators
 */
final class ResourceIteratorAggregateTest extends TestCase
{
    public function testCanIterate(): void
    {
        $iterator = new ResourceIteratorAggregate(fopen('data://text/plain,ABC', 'rb'));
        self::assertSame(range('A', 'C'), iterator_to_array($iterator));
    }

    public function testClosesOpenedFileIfNeeded(): void
    {
        $file = fopen('data://text/plain,ABC', 'rb');
        $iterator = new ResourceIteratorAggregate($file, true);

        self::assertSame(range('A', 'C'), iterator_to_array($iterator));
        self::assertFalse(is_resource($file));
        self::assertIsResource($file);
    }

    public function testDoesNotAllowNonResource(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $iterator = new ResourceIteratorAggregate(false);
    }

    public function testDoesNotAllowUnsupportedResource(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $iterator = new ResourceIteratorAggregate(imagecreate(100, 100));
    }

    public function testDoesNotCloseResourceByDefault(): void
    {
        $file = fopen('data://text/plain,ABC', 'rb');
        $iterator = new ResourceIteratorAggregate($file);

        self::assertSame(range('A', 'C'), iterator_to_array($iterator));
        self::assertTrue(is_resource($file));
        self::assertIsResource($file);
    }
}
