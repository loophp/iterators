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

use function get_class;
use function gettype;
use function is_object;

/**
 * @template TKey
 * @template T
 *
 * @implements IteratorAggregate<TKey, T>
 */
final class TypedIterableAggregate implements IteratorAggregate
{
    /**
     * @var callable(mixed): string
     */
    private $getType;

    /**
     * @var iterable<TKey, T>
     */
    private iterable $iterable;

    /**
     * @param iterable<TKey, T> $iterable
     * @param callable(mixed): string $getType
     */
    public function __construct(iterable $iterable, ?callable $getType = null)
    {
        $this->iterable = $iterable;

        $this->getType = $getType ??
            /**
             * @param mixed $variable
             */
            static function ($variable): string {
                if (!is_object($variable)) {
                    return gettype($variable);
                }

                $interfaces = class_implements($variable);

                if ([] === $interfaces || false === $interfaces) {
                    return get_class($variable);
                }

                sort($interfaces);

                return implode(',', $interfaces);
            };
    }

    /**
     * @return Generator<TKey, T>
     */
    public function getIterator(): Generator
    {
        $previousType = null;

        foreach ($this->iterable as $key => $value) {
            if (null === $value) {
                yield $key => $value;

                continue;
            }

            $currentType = ($this->getType)($value);
            $previousType ??= $currentType;

            if ($currentType !== $previousType) {
                throw new InvalidArgumentException(
                    sprintf(
                        "Detected mixed types: '%s' and '%s' !",
                        $previousType,
                        $currentType
                    )
                );
            }

            yield $key => $value;
        }
    }
}
