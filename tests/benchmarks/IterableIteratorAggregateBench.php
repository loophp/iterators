<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace benchmarks\loophp\iterators;

use Generator;
use loophp\iterators\IterableIteratorAggregate;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use PhpBench\Benchmark\Metadata\Annotations\ParamProviders;

/**
 * @Groups({"ci", "local"})
 */
final class IterableIteratorAggregateBench extends IteratorBenchmark
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

        yield IterableIteratorAggregate::class => [
            'class' => IterableIteratorAggregate::class,
            'size' => $items,
        ];
    }
}
