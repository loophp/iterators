<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace benchmarks\loophp\iterators;

use Closure;
use Generator;
use loophp\iterators\ClosureIterator;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use PhpBench\Benchmark\Metadata\Annotations\ParamProviders;
use PhpBench\Benchmark\Metadata\Annotations\Sleep;
use Traversable;

/**
 * @Groups({"ci", "local"})
 * @Sleep(500)
 */
final class ClosureIteratorBench extends IteratorBenchmark
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
        $items = 2500;

        yield 'ClosureIterator' => [
            'class' => ClosureIterator::class,
            'size' => $items,
        ];
    }

    protected function getSubject(array $params): Traversable
    {
        return new $params['class'](Closure::fromCallable([__CLASS__, 'loop']), [$this->getGenerator($params)]);
    }
}
