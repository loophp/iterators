<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use InvalidArgumentException;
use IteratorAggregate;
use Traversable;

use function is_resource;

/**
 * @implements IteratorAggregate<int, string>
 */
final class ResourceIteratorAggregate implements IteratorAggregate
{
    private bool $closeResource;

    /**
     * @var resource
     */
    private $resource;

    /**
     * @param false|resource $resource
     */
    public function __construct($resource, bool $closeResource = false)
    {
        if (!is_resource($resource) || 'stream' !== get_resource_type($resource)) {
            throw new InvalidArgumentException('Invalid resource type.');
        }

        $this->resource = $resource;
        $this->closeResource = $closeResource;
    }

    public function getIterator(): Traversable
    {
        yield from new ClosureIteratorAggregate(
            /**
             * @param resource $resource
             *
             * @return Generator<int, string, mixed, void>
             */
            static function ($resource, bool $closeResource = false): Generator {
                try {
                    while (false !== $chunk = fgetc($resource)) {
                        yield $chunk;
                    }
                } finally {
                    if ($closeResource) {
                        fclose($resource);
                    }
                }
            },
            [$this->resource, $this->closeResource]
        );
    }
}
