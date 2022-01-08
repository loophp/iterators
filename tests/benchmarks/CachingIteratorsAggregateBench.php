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
use PhpBench\Benchmark\Metadata\Annotations\Sleep;
use Psl\Iter\Iterator as IterIterator;
use Traversable;

/**
 * @Sleep(500)
 */
final class CachingIteratorsAggregateBench extends IteratorBenchmark
{
    /**
     * @Groups({"ci", "local"})
     * @ParamProviders("provideGenerators")
     */
    public function bench(array $params): void
    {
        $this->doBench(
            $this->getSubject($params),
            $params
        );
    }

    /**
     * @Groups({"others"})
     * @ParamProviders("provideGeneratorsWithOthers")
     */
    public function benchWithOthers(array $params): void
    {
        $this->doBench(
            $this->getSubject($params),
            $params
        );
    }

    public function provideGenerators(): Generator
    {
        $items = 2500;

        yield 'CachingIteratorAggregate' => [
            'class' => CachingIteratorAggregate::class,
            'size' => $items,
        ];
    }

    public function provideGeneratorsWithOthers(): Generator
    {
        $items = 2500;

        yield 'SimpleCachingIteratorAggregate' => [
            'class' => SimpleCachingIteratorAggregate::class,
            'size' => $items,
        ];

        yield 'CachingIteratorAggregate' => [
            'class' => CachingIteratorAggregate::class,
            'size' => $items,
        ];

        yield 'Psl\Iter\Iterator' => [
            'class' => IterIterator::class,
            'size' => $items,
        ];
    }

    protected function doBench(Traversable $input, array $params): void
    {
        iterator_to_array($this->loopUntil($input, $params));
        parent::doBench($input, $params);
    }
}
