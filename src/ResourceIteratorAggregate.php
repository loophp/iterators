<?php

declare(strict_types=1);

namespace loophp\iterators;

use Closure;
use Generator;
use InvalidArgumentException;
use IteratorAggregate;

use function is_resource;

/**
 * @template T
 *
 * @implements IteratorAggregate<int, string|T>
 */
final class ResourceIteratorAggregate implements IteratorAggregate
{
    /**
     * @var Closure(resource): (T|mixed)
     */
    private Closure $consumer;

    /**
     * @var resource
     */
    private $resource;

    /**
     * @param false|resource $resource
     * @param Closure(resource): (T|mixed) $consumer
     */
    public function __construct($resource, private bool $closeResource = false, ?Closure $consumer = null)
    {
        if (!is_resource($resource) || 'stream' !== get_resource_type($resource)) {
            throw new InvalidArgumentException('Invalid resource type.');
        }

        $this->resource = $resource;

        $this->consumer = $consumer ??
            /**
             * @param resource $resource
             */
            static fn ($resource): bool|string => fgetc($resource);
    }

    /**
     * @return Generator<int, string|T>
     */
    public function getIterator(): Generator
    {
        $closeResource = $this->closeResource;
        $resource = $this->resource;

        try {
            while ($chunk = ($this->consumer)($resource)) {
                yield $chunk;
            }
        } finally {
            if ($closeResource) {
                fclose($resource);
            }
        }
    }
}
