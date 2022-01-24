<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace benchmarks\loophp\iterators;

use Generator;
use loophp\iterators\TypedIteratorAggregate;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use PhpBench\Benchmark\Metadata\Annotations\ParamProviders;
use PhpBench\Benchmark\Metadata\Annotations\Sleep;

/**
 * @Groups({"ci", "local"})
 * @Sleep(500)
 */
final class TypedIteratorAggregateBench extends IteratorBenchmark
{
    /**
     * @ParamProviders("provideGenerators")
     */
    public function bench(array $params): void
    {
        $this->doBench(
            $this->getSubject($params),
            []
        );
    }

    public function provideGenerators(): Generator
    {
        $items = 2500;

        yield 'TypedIteratorAggregate' => [
            'class' => TypedIteratorAggregate::class,
            'size' => $items,
        ];
    }
}
