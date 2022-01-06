<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace benchmarks\loophp\iterators;

use Generator;
use loophp\iterators\PausableIteratorAggregate;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use PhpBench\Benchmark\Metadata\Annotations\ParamProviders;
use Traversable;

/**
 * @Groups({"ci", "local"})
 */
final class PausableIteratorAggregateBench extends IteratorBenchmark
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

        yield 'PausableIteratorAggregate' => [
            'class' => PausableIteratorAggregate::class,
            'size' => $items,
        ];
    }

    protected function doBench(Traversable $input, array $params): void
    {
        iterator_to_array($this->loopUntil($input, $params));
        iterator_to_array($this->loop($input->rest()));
    }
}
