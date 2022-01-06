<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace benchmarks\loophp\iterators;

use Generator;
use loophp\iterators\CachingIteratorAggregate;
use loophp\iterators\SimpleCachingIteratorAggregate;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use PhpBench\Benchmark\Metadata\Annotations\ParamProviders;
use Psl\Iter\Iterator as IterIterator;
use Traversable;

/**
 * @Groups({"CachingIteratorsAggregateBench"})
 */
final class CachingIteratorsAggregateBench extends IteratorBenchmark
{
    /**
     * @ParamProviders("provideGenerators")
     */
    public function bench(array $params): void
    {
        $this->doBench(
            $this->getSubject($params),
            $params
        );
    }

    public function provideGenerators(): Generator
    {
        $items = 5000;

        yield SimpleCachingIteratorAggregate::class => [
            'class' => SimpleCachingIteratorAggregate::class,
            'size' => $items,
        ];

        yield CachingIteratorAggregate::class => [
            'class' => CachingIteratorAggregate::class,
            'size' => $items,
        ];

        yield IterIterator::class => [
            'class' => IterIterator::class,
            'size' => $items,
        ];
    }

    protected function doBench(Traversable $input, array $params): void
    {
        iterator_to_array($this->loopUntil($input, $params));
        iterator_to_array($this->loop($input));
    }
}
