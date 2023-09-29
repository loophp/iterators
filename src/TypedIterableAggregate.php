<?php

declare(strict_types=1);

namespace loophp\iterators;

use Generator;
use InvalidArgumentException;
use IteratorAggregate;

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
     * @param iterable<TKey, T> $iterable
     * @param callable(mixed): string $getType
     */
    public function __construct(private iterable $iterable, ?callable $getType = null)
    {
        $this->getType = $getType ??
            static function (mixed $variable): string {
                if (!is_object($variable)) {
                    return gettype($variable);
                }

                // There is no need to check for false here anymore, since
                // $variable is an object and therefore, the class must exist.
                if ([] === $interfaces = class_implements($variable)) {
                    return $variable::class;
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
