<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace benchmarks\loophp\iterators;

use Generator;
use loophp\iterators\StringIteratorAggregate;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use PhpBench\Benchmark\Metadata\Annotations\ParamProviders;
use PhpBench\Benchmark\Metadata\Annotations\Sleep;
use Traversable;

/**
 * @Groups({"ci", "local"})
 *
 * @Sleep(500)
 */
final class StringIteratorAggregateBench extends IteratorBenchmark
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
        yield 'StringIteratorAggregate' => [
            'class' => StringIteratorAggregate::class,
            'data' => 'hello world',
        ];
    }

    protected function getSubject(array $params): Traversable
    {
        return new $params['class']($params['data']);
    }
}
